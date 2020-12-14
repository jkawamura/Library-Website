<?php
$title = $_POST['title'];
$author = $_POST['author'];

$servername = 'localhost';
$username = 'gtstudent';
$password = '';
$dbname = 'test';

$conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
              }
        $query = "select * from jk_books where author = '" . $author . "' and title = 'title';";
        $result = $conn->query($query);
        if($result){
                $row = $result->fetch_assoc();
                $check = "available";
                if($row['status'] == $check){
                echo "<p>this book is not currently being borrowed</p>";
                }
                else{

        }                                                                                                                                                                                                                                                                                           }else{
                echo "<p>this book does not exist in the library</p>";
        }
?>
