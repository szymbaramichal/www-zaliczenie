<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" href="./src/icon.png">
    <title>Wiersze</title>
</head>
<body>
<header>
    <div class="navbar navbar-dark bg-dark pl-5">
          <a href="index.php" class="navbar-brand">
              <strong>Wiersze online</strong>
          </a>
    </div>
</header>

<?php
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);
    $id = $queries['id'];

    $servername = "localhost";
    $dbname = "projekt";
    $username = "root";
    $password = "";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM poems WHERE Id = $id";

    if($conn->query($sql)) 
    {
        echo '<section id="main" class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading text-capitalize text-black">Usunięto wiersz!</h1>
          <p>
            <a href="index.php" class="btn btn-primary my-2">Wróć na główną!</a>
          </p>
        </div>
      </section>';
    }
    else
    {
        echo '<section id="main" class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading text-black">Nie udało się usunąć wiersza</h1>
          <p>
            <a href="index.php" class="btn btn-primary my-2">Wróć na główną!</a>
          </p>
        </div>
      </section>';
    }
    $conn->close();
?>
</body>
</html>