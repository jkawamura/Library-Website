<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['admin'] == true || time()-$_SESSION["login_time"] > 5400 || !isset($_SESSION['email'])){
    session_destroy();
    exit;
}

$servername = 'localhost';
$username = 'gtstudent';
$password = '';
$dbname = 'test';
$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$query = "select id from jk_users where email = '" . $_SESSION['email'] . "';";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$userid = $row['id'];

$query = "select name, title, author, due, max(timestamp) from jk_accounts, jk_books, jk_transactions where jk_accounts.id=jk_books.borrower and jk_transactions.bookid=jk_books.id and jk_accounts.userid='" . $userid . "' group by jk_books.title;";
$result = $conn->query($query);

echo '<tr><th>Account</th><th>Title</th><th>Author</th><th>Due Date</th></tr>';
while($row = $result->fetch_assoc()){
    echo '<tr><td>' . $row["name"] . '</td><td>' . $row["title"] . '</td><td>' . $row["author"] . '</td><td>' . $row["due"] . '</td></tr>';
}


?>
