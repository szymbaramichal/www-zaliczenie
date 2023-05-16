<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="./src/icon.png">
    <title>Wiersze</title>
</head>
<body>
  <header>
    <div class="navbar navbar-dark bg-dark box-shadow">
      <div class="container d-flex justify-content-between">
        <a href="index.php" class="navbar-brand d-flex align-items-center">
            <strong>Wiersze online</strong>
        </a>
      </div>
    </div>
  </header>

  <main role="main">

    <div class="album py-5 bg-light">
      <div class="container">

        <div class="row">
            <?php
              $servername = "localhost";
              $dbname = "projekt";
              $username = "root";
              $password = "";

              $conn = new mysqli($servername, $username, $password, $dbname);

              $sql = "SELECT Id, Author, Title, Content, PoemDate FROM poems ORDER BY Id DESC";

              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  $author = $row["Author"];
                  $id = $row["Id"];
                  $content = $row["Content"];
                  $contentToDisplay = substr($content, 0, 35);
                  $contentToDisplay .= "...";

                  echo '          
                  <div class="col-md-4">
                  <div class="card mb-4 box-shadow">
                    <div class="card-body">
                      <p class="card-text">'.$contentToDisplay.'</p>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                          <a class="btn btn-sm btn-outline-info" href="view.php?id='.$id.'">View</a>
                          ';
                            if(isset($_COOKIE["user"]))
                            {
                              if($author == $_COOKIE["user"] || $_COOKIE["role"] == 2)
                              {
                                echo '<a class="ml-1 btn btn-sm btn-outline-info" href="addPoem.php?id='.$id.'">Edit</a>';
                                echo '<a class="ml-1 btn btn-sm btn-outline-danger" href="delete.php?id='.$id.'">Delete</a>';
                              }
                            }
                  echo '
                        <input type="password" style="display: none" name="id" value="'.$row["Id"].'">
                        </div>
                        <small class="text-muted">'.$author.'</small>
                      </div>
                    </div>
                  </div>
                </div>';
                }
              }

            ?>
        </div>
      </div>
    </div>

  </main>
</body>
</html>