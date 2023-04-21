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

<div class="container mt-5">
    <div class="row">
        <div class="col-sm" style="background-image: url('./src/poet1.jpg'); background-repeat: no-repeat;">
        </div>
        <div class="col-lg text-center">
            <form class="form-control" action="addPoemScript.php" method="post">
                <div class="form-group h1">
                    <label for="title">Tytuł</label>
                    <?php
                        $queries = array();
                        $title = "";
                        $year = 0;
                        $content = "";
                        parse_str($_SERVER['QUERY_STRING'], $queries);
                        $id = $queries['id'] ?? null;

                        if(isset($id))
                        {
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
                            echo '<input style="display: none" id="id" name="id" value="'.$id.'">';
                            echo '<input type="text" class="form-control" id="title" name="title" value="'.$title.'">';
                        }
                        else
                        {
                            echo '<input type="text" class="form-control" id="title" name="title">';
                        }
                    ?>
                </div>
                <div class="form-group h1">
                    <label for="year">Rok napisania</label>
                    <?php
                        if(isset($id))
                        {
                            echo '<input type="number" class="form-control" id="year" name="year" value="'.$year.'">';
                        }
                        else
                        {
                            echo '<input type="number" class="form-control" id="year" name="year">';
                        }
                    ?>
                </div>
            <div class="form-group h1">
                <label for="content">Treść</label>
                <?php
                    if(isset($id))
                    {
                        echo '<textarea style="resize: none" class="form-control" name="content" id="content" rows="25">'.$content.'</textarea>';
                    }
                    else
                    {
                        echo '<textarea style="resize: none" class="form-control" name="content" id="content" rows="25"></textarea>';
                    }
                ?>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-sm" style="background-image: url('./src/poet3.jpg'); background-repeat: no-repeat;">
        </div>
    </div>
</div>

</body>
</html>