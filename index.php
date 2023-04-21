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
          <a href="#" class="navbar-brand d-flex align-items-center">
              <strong>Wiersze online</strong>
          </a>
          <?php
            if(!isset($_COOKIE["user"]))
            {
              echo '<form class="row" method="POST" action="authUser.php"> <input type="email" class="form-control col-3" name="email" placeholder="Email">
              <input type="password" class="form-control col-3 ml-1" name="password" placeholder="Hasło">
              <button type="submit" class="btn btn-success ml-2" name="action" value="LogIn">Zaloguj!</button>
              <button type="submit" class="btn btn-info ml-2" name="action" value="Register">Załóż konto!</button>
              </form>';
            }
            else
            {
              echo '<form class="row" method="POST" action="logout.php">
              <p class="text-center text-info h3"> Witaj '.$_COOKIE["user"].'</p>
              <button type="submit" class="btn btn-danger ml-2" name="action" value="Register">Wyloguj się!</button>
              </form>';
            }
          ?>
      </div>
    </div>
  </header>

  <main role="main">

    <section id="main" class="jumbotron text-center">
      <div class="container">
        <h1 class="jumbotron-heading text-capitalize text-white">Wiersze online</h1>
        <p class="lead text-white">Dodawaj i czytaj wiersze online! Korzystaj z tekstów za darmo!</p>
        <p>
          <a href="addpoem.php" class="btn btn-primary my-2">Dodaj wiersz!</a>
          <a href="poets.html" class="btn btn-secondary my-2">Galeria poetów</a>
        </p>
      </div>
    </section>

    <div class="album py-5 bg-light">
      <div class="container">

        <div class="row">
            <?php
              $servername = "localhost";
              $dbname = "projekt";
              $username = "root";
              $password = "";

              $conn = new mysqli($servername, $username, $password, $dbname);

              $sql = "SELECT Id, Author, Title, Content, PoemDate FROM poems ORDER BY Id DESC LIMIT 9";

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
                          <form method="POST" action="editView.php">
                          <button type="submit" name="action" value="view" class="btn btn-sm btn-outline-secondary">View</button>
                          ';
                            if(isset($_COOKIE["user"]))
                            {
                              if($author == $_COOKIE["user"] || $_COOKIE["role"] == 2)
                              {
                                echo '<a class="btn btn-sm btn-outline-info" href="addPoem.php?id='.$id.'">Edit</a>';
                                echo '<a class="ml-1 btn btn-sm btn-outline-danger" href="delete.php?id='.$id.'">Delete</a>';
                              }
                            }
                  echo '
                        <input type="password" style="display: none" name="id" value="'.$row["Id"].'">
                        </form>
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

  <footer class="text-muted">
    <div class="container">
      <p class="float-right">
        <a href="#">Wróc na górę</a>
      </p>
      <p>Strona to projekt zaliczeniowy na przedmiot: Języki hipertekstowe i tworzenie stron WWW</p>
      <p>W razie zainteresowania jak progresowały prace nad projektem zapraszam do mojego <a href="https://github.com/szymbaramichal/www-zaliczenie">repozytorium</a>.</p>
      <p>
        <?php
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          $sql = "SELECT Amount FROM Visitors WHERE Id = 1";

          $result = $conn->query($sql);
          $row = $result->fetch_assoc();
          $amount = $row["Amount"];

          echo "Stronę wyświetlono: " . $amount  . " razy.";

          $amount++;

          $sql = "UPDATE Visitors SET Amount=" .$amount. " WHERE Id = 1";
          $conn->query($sql);
          $conn->close();
          ?>
      </p>
    </div>
  </footer>
</body>
</html>