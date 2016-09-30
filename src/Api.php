<?php

namespace InternetBS;

use GuzzleHttp\Client;

class Api
{
    private $host = null;
    private $apiKey = null;
    private $password = null;

    public function __construct($apiKey, $password, $production = false)
    {

        if (!isset($apiKey)) {
            throw new Exceptions\InvalidParameterException("Application key parameter is empty");
        }
        if (!isset($password)) {
            throw new Exceptions\InvalidParameterException("Application password parameter is empty");
        }

        $this->apiKey = $apiKey;
        $this->password = $password;
        $this->host = $production ? 'api.internet.bs' : 'testapi.internet.bs';
    }

    public function execute($commandName, $params = null)
    {
        $params['apikey'] = $this->apiKey;
        $params['password'] = $this->password;
        $params['responseformat'] = 'JSON';

        $apiRequestUrl = 'https://' . $this->host . '/' . $commandName;

        $client = new Client();
        $res = $client->request('POST', $apiRequestUrl, [
            'query' => $params
        ]);

        return json_decode($res->getBody());
    }
}