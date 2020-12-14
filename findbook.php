<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    session_destroy();
    exit;
} else if($_SESSION['admin'] == true){
    session_destroy();
    exit;
} else if(time()-$_SESSION["login_time"] > 5400)  {  
    session_destroy();
    exit;
} else if(!isset($_SESSION['email'])){
    session_destroy();
    exit;
}

if(!isset($_POST['radio']) && !isset($_POST['title']) && !isset($_POST['author']) && !isset($_POST['genre'])){
  echo "<p>Please make a selection</p>";
  exit;
}
$radio = $_POST['radio'];
$title = $_POST['title'];
$author = $_POST['author'];
$genre = $_POST['genre'];

$servername = 'localhost';
$username = 'gtstudent';
$password = '';
$dbname = 'test';
$conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

if($radio == 'title'){
    if(!empty($title)){
        $query = "select * from jk_books where title='" . $title . "';";
        $result = $conn->query($query);

        echo '<tr><th>Title</th><th>Author</th><th>Genre</th><th>Year</th><th>Status</th></tr>';

        while($row = $result->fetch_assoc()){
          echo '<tr><td>' . $row["title"] . '</td><td>' . $row["author"] . '</    td><td>' . $row["genre"] . '</td><td>' . $row["year"] . '</td><td>' . $row["status"] . '</td></tr>';
        }

    } else{
        echo "<p>Please type a title</p>";
    }

} else if($radio == 'author'){
    if(!empty($author)){
        $query = "select title, author, genre, year, status from jk_books where jk_books.author='" . $author . "';";
        $result = $conn->query($query);

        echo '<tr><th>Title</th><th>Author</th><th>Genre</th><th>Year</th><th>Status</th></tr>';

        while($row = $result->fetch_assoc()){
          echo '<tr><td>' . $row["title"] . '</td><td>' . $row["author"] . '</    td><td>' . $row["genre"] . '</td><td>' . $row["year"] . '</td><td>' . $row["status"] . '</td></tr>';
        }

    } else{
        echo "<p>Please type an author's name</p>";
    }
} else if($radio == 'genre'){
  if(!empty($genre)){
    $query = "select title, author, genre, year, status from jk_books where jk_books.genre='" . $genre . "';";
        $result = $conn->query($query);

        echo '<tr><th>Title</th><th>Author</th><th>Genre</th><th>Year</th><th>Status</th></tr>';

        while($row = $result->fetch_assoc()){
          echo '<tr><td>' . $row["title"] . '</td><td>' . $row["author"] . '</    td><td>' . $row["genre"] . '</td><td>' . $row["year"] . '</td><td>' . $row["status"] . '</td></tr>';
        }

    } else{
        echo "<p>Please type a genre</p>";
    }
} else{
    echo "<p>Please type a genre</p>";
}
?>