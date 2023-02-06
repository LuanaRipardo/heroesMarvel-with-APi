<?php

require_once "conn.php";

$conn = new Conn();
$conn = $conn->connect();

$checkTable = "SHOW TABLES LIKE 'heroes'";
$result = $conn->query($checkTable);

if ($result->num_rows == 0) {
    $sql = "CREATE TABLE heroes (
      id INT AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(255) NOT NULL,
      description TEXT NOT NULL,
      thumbnail TEXT NOT NULL
    );
    
    CREATE TABLE stories (
      id INT AUTO_INCREMENT PRIMARY KEY,
      hero_id INT NOT NULL,
      title VARCHAR(255) NOT NULL,
      description TEXT NOT NULL,
      FOREIGN KEY (hero_id) REFERENCES heroes(id)
    );";
    
    if ($conn->multi_query($sql) === TRUE) {
        echo "Tabelas criadas com sucesso";
    } else {
        echo "Erro ao criar as tabelas: " . $conn->error;
    }
} else {
    echo "As tabelas já existem.";
}

$conn->close();
  
?>