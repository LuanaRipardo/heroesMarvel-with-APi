<?php

use GuzzleHttp\Client;

require_once 'vendor/autoload.php';
require_once 'conn.php';

class MarvelApiClient
{
    private $apiKey = "afe55388ce413516c84e6a8f80694fcc";
    private $privateKey = "5601acaf936ec57a649b7bd1451f9f1a42483f4f";
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function fetchData(): array
{
    $letters = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
    $randomLetter = $letters[array_rand($letters)];
    
    $timestamp = time();
    $hash = md5($timestamp . $this->privateKey . $this->apiKey);
    $url = "https://gateway.marvel.com/v1/public/characters?nameStartsWith=" . $randomLetter . "&apikey=" . $this->apiKey . "&ts=" . $timestamp . "&hash=" . $hash;

    $response = $this->client->get($url);

    if ($response->getStatusCode() !== 200) {
        throw new Exception('Failed to fetch data from Marvel API');
    }

    return json_decode($response->getBody(), true);
}

}

?>