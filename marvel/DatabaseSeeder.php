<?php

include 'heroesModel.php';
include 'storiesModel.php';

$heroes = new HeroesModel();
$heroesData = $heroes->getHeroes();

$stories = new StoriesModel($heroes);
$storiesData = $stories->getStories();

?>
