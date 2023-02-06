<?php

require_once __DIR__ . '/vendor/autoload.php';

// Conecta ao banco de dados
require_once 'conn.php';
// Verifica se a conexão foi estabelecida com sucesso
if (!$conn) {
  die("Conexão com o banco de dados falhou: " . mysqli_connect_error());
}

// Recupera os dados da API
$data = file_get_contents('API URL');
$heroes = json_decode($data, true);

// Percorre a lista de heróis e insere cada um deles no banco de dados
foreach ($heroes as $hero) {
  $hero_name = mysqli_real_escape_string($conn, $hero['name']);
  $hero_description = mysqli_real_escape_string($conn, $hero['description']);
  $hero_thumbnail = mysqli_real_escape_string($conn, $hero['thumbnail']['path'] . '.' . $hero['thumbnail']['extension']);

  $sql = "INSERT INTO heroes (name, description, thumbnail)
          VALUES ('$hero_name', '$hero_description', '$hero_thumbnail')";

  if (mysqli_query($conn, $sql)) {
    echo "Herói inserido com sucesso: $hero_name\n";
    $hero_id = mysqli_insert_id($conn);

    // Percorre a lista de histórias do herói e insere cada uma delas no banco de dados
    foreach ($hero['stories']['items'] as $story) {
      $title = mysqli_real_escape_string($conn, $story['name']);
      $description = mysqli_real_escape_string($conn, $story['type']);

      $sql = "INSERT INTO stories (hero_id, title, description)
              VALUES ('$hero_id', '$title', '$description')";

      if (mysqli_query($conn, $sql)) {
        echo "História inserida com sucesso: $title\n";
      } else {
        echo "Erro ao inserir história: " . mysqli_error($conn) . "\n";
      }
    }
  } else {
    echo "Erro ao inserir herói: " . mysqli_error($conn) . "\n";
  }
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
?>
