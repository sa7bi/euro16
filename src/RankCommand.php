<?php

namespace sahbi;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
*
*/
class RankCommand extends Command
{
	protected function configure()
	{
		$this->setName('rank')
			->setDescription('List all groups and teams by points');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$output->write('Hello there');
	}
}