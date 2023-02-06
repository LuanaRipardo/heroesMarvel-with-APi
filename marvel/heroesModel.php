<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once 'conn.php';
require_once 'MarvelApiClient.php';

class HeroesModel
{
    private $conn;
    private $apiClient;

    public function __construct()
    {
        $this->conn = new Conn();
        $this->apiClient = new MarvelApiClient();
        $this->fetchData();
    }

    private function fetchData()
    {
        $data = $this->apiClient->fetchData();
        $this->processData($data);
    }

    private function processData(array $data)
    {
        $heroes = [];
        foreach ($data['data']['results'] as $hero) {
            $heroes[] = [
                'name' => $hero['name'],
                'description' => substr($hero['description'], 0, 250),
                'thumbnail' => $hero['thumbnail']['path'] . '.' . $hero['thumbnail']['extension']
            ];
        }

        $this->conn->insertData($heroes);
    }

    public function getHeroes() {
      try {
          $heroes = $this->conn->selectData();
  
          if (empty($heroes)) {
              throw new Exception("Não há heróis disponíveis no momento.");
          }
  
          return $heroes;
      } catch (Exception $e) {
          echo $e->getMessage();
          return [];
      }
  }
}  
?>
