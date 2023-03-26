<?php
    //VALIDATION
    $title = $_POST["title"];
    $content = $_POST["content"];
    $year = $_POST["year"];

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

        $sql = "INSERT INTO poems (Author, Title, PoemDate, Content) VALUES ('".$_COOKIE['user']."', '$title', $year, '$content')";

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
    }
?>