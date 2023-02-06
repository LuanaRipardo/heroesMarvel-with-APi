<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once 'conn.php';
require_once 'MarvelApiClient.php';

class StoriesModel
{
    private $conn;
    private $heroes;

    public function __construct(HeroesModel $heroes)
    {
        $this->conn = new Conn();
        $this->heroes = $heroes;
        $this->processData();
    }

    private function processData()
    {
        $data = $this->heroes->getHeroes();
        $stories = [];
        foreach ($data as $hero) {
            $stories[] = [
                'hero_id' => $hero['id'],
                'title' => $hero['name'],
                'description' => substr($hero['description'], 0, 250),
            ];
        }

        $this->conn->insertStoryData($stories);
    }

    public function getStories() {
        try {
            $stories = $this->conn->selectStoryData();
    
            if (empty($stories)) {
                throw new Exception("Não há histórias disponíveis no momento.");
            }
    
            return $stories;
        } catch (Exception $e) {
            echo $e->getMessage();
            return [];
        }
    }
}

?>
