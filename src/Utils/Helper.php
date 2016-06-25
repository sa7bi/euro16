<?php

namespace sahbi\Utils;

use Dotenv\Dotenv;


/**
*
*/
class Helper
{
	protected $dotenv;

	public function __construct()
	{
	    $dotenv = new Dotenv(dirname('..'));
		$dotenv->load();
	}


	protected function getKey($keyName)
	{
		return getenv($keyName);
	}

	public function getApiKey()
	{

		return $this->getKey('API_KEY');
	}

}