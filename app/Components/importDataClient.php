<?php

namespace App\Components;

use GuzzleHttp\Client;

class ImportDataClient
{
	public $client;

	public function __construct()
	{
		// из https://docs.guzzlephp.org/en/stable/quickstart.html + '$this->'
		$this->client = new Client([ 
			// Base URI is used with relative requests 
			'base_uri' => 'https://jsonplaceholder.typicode.com/', // это роут, на который мы отправим запрос и получим результаты
			// You can set any number of default request options.
			'timeout'  => 2.0, // в течении, какого времы Guzzle будет ждать результат
			'verify' => false, // отключаем SSL-сертификацию
		]);
	}
}
