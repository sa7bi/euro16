<?php

namespace sahbi\utils;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

/**
*
*/
class HttpClient
{
	protected $client;
	const FIXTURES_URL = 'http://api.football-data.org/v1/soccerseasons/424/fixtures';
	const LEAGUE_TABLE = 'http://api.football-data.org/v1/soccerseasons/424/leagueTable';
	function __construct()
	{
		$this->client = new Client();
	}

	public function getAllFixtures($team = null)
	{
		$response = $this->client->request('GET', self::FIXTURES_URL);
		$collection = new Collection(json_decode($response->getBody()));
		$fixtures = new Collection($collection->get('fixtures'));

		if ( is_null($team)) {
			return $fixtures->where('status','FINISHED');
		} else {
			return $fixtures->filter(function($value, $key) use($team){
				return (strtolower($value->homeTeamName) == strtolower($team) || strtolower($value->awayTeamName) == strtolower($team))? $value: null;
			});
		}

	}




}

