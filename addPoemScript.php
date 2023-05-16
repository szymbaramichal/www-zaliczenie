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
    //VALIDATION
    $title = $_POST["title"];
    $content = $_POST["content"];
    $year = $_POST["year"];
    $id = $_POST["id"] ?? null;

    $validTitle = !empty($title);
    $validUser = isset($_COOKIE["user"]);
    $validContent = !empty($content) && strlen($content) <= 500;
    $validYear = !empty($year);

    $allFieldsAreValid = $validTitle && $validContent && $validYear && $validUser;
    
    if (!$_SERVER["REQUEST_METHOD"] == "POST" || !$allFieldsAreValid) {

      if (!$validUser) {
        echo '<section id="main" class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading text-black">Nie jesteś zalogowany. Zaloguj się aby dodać wiersz!</h1>
          <p>
            <a href="index.php" class="btn btn-primary my-2">Wróć na główną!</a>
          </p>
        </div>
      </section>';
      }

      if (!$validTitle) {
        echo '<section id="main" class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading text-black">Tytuł jest wymagany</h1>
          <p>
            <a href="index.php" class="btn btn-primary my-2">Wróć na główną!</a>
          </p>
        </div>
      </section>';
      }

      if (!$validContent) {
        echo '<section id="main" class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading text-black">Treść wiersza jest wymagana, może mieć maksymalnie 500 znaków!</h1>
          <p>
            <a href="index.php" class="btn btn-primary my-2">Wróć na główną!</a>
          </p>
        </div>
      </section>';
      }
    
      if (!$validYear) {
        echo '<section id="main" class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading text-black">Podaj rok napisania wiersza!</h1>
          <p>
            <a href="index.php" class="btn btn-primary my-2">Wróć na główną!</a>
          </p>
        </div>
      </section>';
      }
    } else {
        $servername = "localhost";
        $dbname = "projekt";
        $username = "root";
        $password = "";
    
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if(isset($id))
        {
          $sql = "UPDATE poems SET Title = '$title', PoemDate = $year, Content = '$content' WHERE Id = $id";
        }
        else
        {
          $sql = "INSERT INTO poems (Author, Title, PoemDate, Content) VALUES ('".$_COOKIE['user']."', '$title', $year, '$content')";
        }

        if($conn->query($sql)) 
        {
            echo '<section id="main" class="jumbotron text-center">
            <div class="container">
              <h1 class="jumbotron-heading text-capitalize text-black">Dodano wiersz!</h1>
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
            <h1 class="jumbotron-heading text-black">Coś poszło nie tak!</h1>
            <p>
              <a href="index.php" class="btn btn-primary my-2">Wróć na główną!</a>
            </p>
          </div>
        </section>';
        }
      $conn->close();
    }
?>
</body>
</html>