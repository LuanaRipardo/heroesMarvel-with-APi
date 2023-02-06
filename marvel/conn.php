<?php

include_once 'config.php';


class Conn {

  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $dbname = DB_NAME;


  public function connect() {
    
    $conn = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);

    if ($conn->connect_error) {
      die("Erro na conexão: " . mysqli_connect_error());
    }

    return $conn;
  }

  public function insertData($data) {
    $conn = $this->connect();
    $success = true;
  
    foreach ($data as $hero) {
      if (isset($hero['name']) && isset($hero['description']) && isset($hero['thumbnail'])) {
        $name = mysqli_real_escape_string($conn, $hero['name']);
        $description = substr(mysqli_real_escape_string($conn, $hero['description']), 0, 250);
        $thumbnail = mysqli_real_escape_string($conn, $hero['thumbnail']);
        $sql = "INSERT INTO heroes (name, description, thumbnail) VALUES ('$name', '$description', '$thumbnail')";
  
        if ($conn->query($sql) !== TRUE) {
          $success = false;
          error_log("Erro ao inserir dados: " . $conn->error, 0);
          break;
        }
      }
    }
  
    if ($success) {
      echo "Heróis inseridos com sucesso.";
    } else {
      echo "Ocorreu um erro ao inserir dados.";
    }
  }
  

public function insertStoryData($data) {
  $conn = $this->connect();
  $success = true;

  foreach ($data as $story) {
    if (isset($story['hero_id']) && isset($story['title']) && isset($story['description'])) {
      $hero_id = mysqli_real_escape_string($conn, $story['hero_id']);
      $title = mysqli_real_escape_string($conn, $story['title']);
      $description = substr(mysqli_real_escape_string($conn, $story['description']), 0, 250);

      $sql = "INSERT INTO stories (hero_id, title, description) VALUES ('$hero_id', '$title', '$description')";

      if ($conn->query($sql) === FALSE) {
        error_log("Erro ao inserir dados: " . $conn->error, 0);
        $success = false;
        break;
      }
    }
  }

  if ($success) {
    echo "Histórias inseridas com sucesso.";
  } else {
    echo "Ocorreu um erro ao inserir dados.";
  }
}



  public function selectData() {
    $conn = $this->connect();
    $sql = "SELECT * FROM heroes";
    $result = $conn->query($sql);
  
    $data = array();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $data[] = $row;
      }
    }
  
    $conn->close();
    return $data;
  }

  public function selectStoryData() {
    $conn = $this->connect();
  
    $sql = "SELECT * FROM stories";
    $result = $conn->query($sql);
  
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
  }

}

?>
