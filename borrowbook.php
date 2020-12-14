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




$title = $_POST['title'];
$author = $_POST['author'];
$account = $_POST['account'];


$servername = 'localhost';
$username = 'gtstudent';
$password = '';
$dbname = 'test';
$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "select id from jk_accounts where name = '" . $account . "' and userid = (select id from jk_users where email = '" . $_SESSION['email'] . "');";
$result = $conn->query($query);
$row = $result->fetch_assoc();
if(!isset($row['id'])){
    echo '<p>That account does not exist</p>';
    exit;
}
$accountid = $row['id'];

$query = "select * from jk_books where title = '" . $title . "' and author = '" . $author . "';";
$result = $conn->query($query);
$row = $result->fetch_assoc();
if(!isset($row['ID'])){
    echo '<p>That book is unavailable</p>';
    exit;
} else if($row['status'] == 'out'){
    echo '<p>That book is unavailable</p>';
    exit;
}
$bookid = $row['ID'];

$query = "update jk_books set status = 'out', borrower='" . $accountid . "' where ID = '" . $bookid . "';";
$conn->query($query);

$query = "insert into jk_transactions(bookid, accountid, due, type) values('" . $bookid . "','" . $accountid . "', date_add(curdate(), interval 7 day), 'out');";
$conn->query($query);
echo "<p>Book borrowed successfully!</p>"

?>