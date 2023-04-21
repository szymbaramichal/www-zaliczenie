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
    $id = $_POST["id"];

    $validTitle = !empty($title);
    $validUser = isset($_COOKIE["user"]);
    $validContent = !empty($content);
    $validYear = !empty($year);

    $allFieldsAreValid = $validTitle && $validContent && $validYear && $validUser;
    
    if (!$_SERVER["REQUEST_METHOD"] == "POST" || !$allFieldsAreValid) {

      if (!$validUser) {
        echo "Nie jesteś zalogowany. Zaloguj się na stronę. </br>";
      }

      if (!$validTitle) {
        echo "Tytuł jest wymagany </br>";
      }

      if (!$validContent) {
        echo "Treść jest wymagana </br>";
      }
    
      if (!$validYear) {
        echo "Rok napisania jest wymagany </br>";
      }
      
      echo "<a href='addPoem.html'>Uzupełnij formularz jeszcze raz.</a>";
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
            echo "Dodano poprawnie wiersz! :) </br>";
            echo "<a href='index.php'>Wróć na stronę</a>";
        }
        else
        {
            echo "Problem z dodaniem wiersza, spróbuj jeszcze raz :( </br>";
            echo "<a href='index.php'>Wróć na stronę</a>";
        }
      $conn->close();
    }
?>
</body>
</html>