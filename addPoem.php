<?php
    $author = $_POST["author"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $year = $_POST["year"];

    $validAuthor = !empty($author);
    $validTitle = !empty($title);
    $validContent = !empty($content);
    $validYear = !empty($year);

    $allFieldsAreValid = $validAuthor && $validTitle && $validContent && $validYear;

    $sql = "INSERT INTO poems (Author, Title, PoemDate, Content) WHERE Id = 1";
    
    if (!$_SERVER["REQUEST_METHOD"] == "POST" || !$allFieldsAreValid) {

      if (!$validAuthor) {
        echo "Autor jest wymagany </br>";
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
      
    } else {
        $servername = "localhost";
        $dbname = "projekt";
        $username = "root";
        $password = "";
    
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO poems (Author, Title, PoemDate, Content) VALUES ('$author', '$title', $year, '$content')";

        if($conn->query($sql)) 
        {
            echo "Dodano poprawnie wiersz! :)";
        }
        else
        {
            echo "Problem z dodaniem wiersza, spróbuj jeszcze raz :(";
        }
    }
?>