<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Marvel&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="style.css">

  <title>Hero Stories</title>
</head>
<body>
  <div class="container">
  <a href="index.php" class="stories-button">Voltar</a>
    <h1 class="text-center my-3 textprincipal">Histórias dos Heróis</h1>
    <div class="row">
      <?php
        require_once 'conn.php';

        $database = new Conn();
        $conn = $database->connect();

        $result = mysqli_query($conn, "SELECT h.name, h.thumbnail, s.title, s.description 
                               FROM heroes h
                               INNER JOIN stories s 
                               ON h.id = s.hero_id
                               WHERE s.description IS NOT NULL");

        while ($row = mysqli_fetch_assoc($result)) {
            if (!empty($row['description'])) {
      ?>
      <div class="col-sm-4 mb-3">
        <div class="card">
          <img src="<?php echo $row['thumbnail']; ?>" class="card-img-top" alt="Hero Thumbnail">
          <div class="card-body">
            <h5 class="card-title">
              <?php echo $row['title']; ?>
            </h5>
            <p class="card-text">
              <?php echo $row['description']; ?>
            </p>
          </div>
        </div>
      </div>
      <?php
        }
    }
      ?>
    </div>
  </div>
</body>
</html>
