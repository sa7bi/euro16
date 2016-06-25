<?php
namespace sahbi;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use sahbi\Utils\Helper;
use sahbi\utils\HttpClient;

class FetchNextMatches extends Command {
	protected function configure()
	{
		$this->setName('results')
			->setDescription('List all matches for the day')
			->addOption('team', null, InputOption::VALUE_OPTIONAL,'Specify a team');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$http = new HttpClient();
		if (! is_null($input->hasOption('team'))){
			$param = $input->getOption('team');
			$fixtures = new Collection($http->getAllFixtures($param));
			$this->FetchResultByTeam($fixtures, $output);
		}else {
			$fixtures = new Collection($http->getAllFixtures());
			$this->FetchAllResults($fixtures,$output);
		}

	}

	private function FetchResultByTeam($collection, $output)
	{
	    $table = new Table($output);
	    $table->setHeaders(['Team','Opponent','Date','Result']);
	    $collection->map(function($item, $key) use ($table){
	    	$table->addRow([
	    		$item->homeTeamName,
	    		$item->awayTeamName,
	    		Carbon::parse($item->date)->format('d/m/Y'),
	    		$item->result->goalsHomeTeam . ' : ' . $item->result->goalsAwayTeam
	    	]);
	    });
	    $table->render();
	}

	private function FetchAllResults($collection, $output)
	{
	    $table = new Table($output);
		$table->setHeaders(['Team','Opponent','Date','Result']);
		$collection->map(function($item, $key) use ($table){
			if ($item->result->goalsHomeTeam > $item->result->goalsAwayTeam){
				$table->addRow([
					'<bg=yellow;options=bold>'.$item->homeTeamName .'</>',
					$item->awayTeamName,
					Carbon::parse($item->date)->format('d/m/Y'),
					$item->result->goalsHomeTeam . ' : ' . $item->result->goalsAwayTeam
					]);
			} elseif($item->result->goalsHomeTeam < $item->result->goalsAwayTeam) {
				$table->addRow([
					$item->homeTeamName,
					'<bg=yellow;options=bold>'.$item->awayTeamName.'</>',
					Carbon::parse($item->date)->format('d/m/Y'),
					$item->result->goalsHomeTeam . ' : ' . $item->result->goalsAwayTeam
					]);
			} else {
				$table->addRow([
					$item->homeTeamName,
					$item->awayTeamName,
					Carbon::parse($item->date)->format('d/m/Y'),
					$item->result->goalsHomeTeam . ' : ' . $item->result->goalsAwayTeam
					]);
			}


		    	//$output->writeln('<info>'. $item->homeTeamName .'</info>');
		});
		$table->render();
	}



}