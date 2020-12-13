<?php
$title = $_POST['title'];
$author = $_POST['author'];
$genre = $_POST['genre'];
$date = $_POST['date'];

if(empty($title) || empty($author) || empty($genre) || empty($date)){
  echo "<p>Fill in all the fields </p>";
} else{

    $servername = 'localhost';
    $username = 'gtstudent';
    $password = '';
    $dbname = 'test';

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "select title from jk_books where title = '" . $title . "';";

    $result = $conn->query($query);
    $row = $result->fetch_assoc();

    if(isset($row['title'])){
        if($row['title'] == $title){
        echo "<p>That book is already in the database</p>";
        }
    } else{
        $sql = "insert into jk_books(title, author, genre, year, status) values ('" . $title . "', '" . $author . "', '" . $genre . "', '" . $date . "', 'available');";
        $conn->query($sql);
        echo "<p>Book added successfully</p>";
    }
}

?>