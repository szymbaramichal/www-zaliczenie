<?php

    $servername = "localhost";
    $dbname = "projekt";
    $username = "root";
    $password = "";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    if ($_POST['action'] == 'LogIn')
    {
        $sql = "SELECT `Password`, `Role` FROM Users WHERE Email = '" . $_POST['email'] . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashFromDb = $row["Password"];
            if(!password_verify($_POST['password'], $hashFromDb))
            {
                echo "Niepoprawny login lub hasło. <a href='index.php'>Wróć na stronę</a>";
            }
            else
            {
                setcookie("user", $_POST['email']);
                setcookie("role", $row['Role']);
                header("Location: http://localhost/www-zaliczenie/index.php");
            }
        } else {
            echo "Niepoprawny login lub hasło. <a href='index.php'>Wróć na stronę</a>";
        }
    }
    else if($_POST['action'] == 'Register')
    {
        $sql = "SELECT 'Password' FROM Users WHERE Email = '" . $_POST['email'] . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "Już jest użytkownik o takim loginie.";
        } else {
            $email = $_POST['email'];
            $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO `users` (`Email`, `Password`, `Role`) VALUES ('$email','$passwordHash', 1)";

            if($conn->query($sql)) 
            {
                setcookie("user", $_POST['email']);
                setcookie("role", 1);
                header("Location: http://localhost/www-zaliczenie/index.php");
                die();
            }
            else
            {
                echo "Problem z dodaniem wiersza, spróbuj jeszcze raz :(";
            }
        }
    }
    else
    {
        echo "Coś poszło nie tak, cofnij się i spróbuj jeszcze raz!";
    }

?>