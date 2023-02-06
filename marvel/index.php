<!DOCTYPE html>
<html lang="pt_BR">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Marvel&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Lista de Heróis</title>
    
  </head>
  <body>
    <div class="container">
        <a href="stories.php" class="stories-button">Histórias</a>
<h1 class="text-center my-3 textprincipal">Heróis com histórias</h1>

<div class="high-pages row">
    <?php
        
        require_once 'conn.php';

        $database = new Conn();
        $conn = $database->connect();          
        $result = mysqli_query($conn, "SELECT DISTINCT h.name, h.thumbnail FROM heroes h INNER JOIN stories s ON h.id = s.hero_id LIMIT 12");
        while ($row = mysqli_fetch_assoc($result)) {
          if (!empty($row['name']) && !empty($row['thumbnail'])) {
    ?>
    <div class="col-sm-4 mb-3">
      <a href="stories.php?hero_id=<?php echo $row['id']; ?>">
        <div class="card">
          <img src="
          <?php 
            echo $row['thumbnail']; 
          ?>
          " 
          class="card-img-top" alt="Hero Thumbnail">
          <div class="card-body">
            <h5 class="card-title principal">
              <?php echo $row['name']; 
              ?>
            </h5>
          </div>
        </div>
      </a>
</div>          
<?php
      }
    }
?>
</div>
</div>
  </body>
</html>