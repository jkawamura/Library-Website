<?php
session_start();
if($_SESSION['admin']!=true){
        session_destroy(); 
        exit;
} else if(time()-$_SESSION["login_time"] > 5400) {  
        session_destroy(); 
        exit;
} 
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
$query = "select * from jk_books where author = '" . $author . "' and title = '" . $title . "';";
$result = $conn->query($query);
$row = $result->fetch_assoc();
if($row['status'] == 'available'){
        echo '<p>The book is already available</p>';
        exit;
}

$query = "insert into jk_transactions(bookid, accountid, type) values('" . $row['ID'] . "','" . $row['borrower'] . "', 'in');";
$conn->query($query);

$query = "update jk_books set status = 'available', borrower=NULL where ID = '" . $row['ID'] . "';";
$conn->query($query);
echo "<p>Book returned successfully!</p>"
?>
