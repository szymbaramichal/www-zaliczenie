<?php
    if(isset($_COOKIE["user"]))
    {
        setcookie("user", "", time() - 3600);
        setcookie("role", "", time() - 3600);
        header("Location: http://localhost/www-zaliczenie/index.php");
    }
?>