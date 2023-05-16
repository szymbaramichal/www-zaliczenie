<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Poeci</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.addpoem.css">
        <link rel="icon" href="./src/icon.png">
    </head>
<body>
<header>
    <div class="navbar navbar-dark bg-dark pl-5">
          <a href="index.php" class="navbar-brand">
              <strong>Wiersze online</strong>
          </a>
    </div>
  </header>

<div class="text-center mt-5 w-100">
    <div class="card flex-md-row mb-4 box-shadow h-md-250">
      <div class="card-body">
        <h1>
        <?php
          $queries = array();
          parse_str($_SERVER['QUERY_STRING'], $queries);
          $id = $queries['id'];

          $servername = "localhost";
          $dbname = "projekt";
          $username = "root";
          $password = "";

          $conn = new mysqli($servername, $username, $password, $dbname);

          $sql = "SELECT Id, Author, Title, Content, PoemDate FROM poems WHERE Id = $id";

          $result = $conn->query($sql);

          $row = $result->fetch_assoc();

          $title = $row["Title"];
          $year = $row["PoemDate"];
          $content = $row["Content"];
          $author = $row["Author"];
          echo '<strong class="mb-2 text-primary text-center">'.$title.'</strong></h1><h5 class="mb-0">';
          echo '<a class="text-muted">'.$author.'</a> </h5>';
          echo '<div class="mb-1 text-muted">'.$year.'</div>';
          echo '<textarea readonly style="resize: none" class="form-control" name="content" id="content" rows="30">'.$content.'</textarea>';
          echo '';
          $conn->close();
        ?>
      </div>
      <img class="card-img-right mt-lg-5" src="./src/poem.png" alt="Poem" style="width: 200px; height: 250px;">
    </div>
</div>
</body>
</html>