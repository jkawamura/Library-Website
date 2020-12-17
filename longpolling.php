<?php
session_start();
$email = $_SESSION['email'];
session_write_close();
date_default_timezone_set('America/New_York');
$time = strtotime((new DateTime('NOW'))->format("Y-m-d H:i:s"));
$latest = lastPost();

while(strtotime($latest)<=$time){
    sleep(2);
    $latest = lastPost();
}

$servername = 'localhost';
$username = 'gtstudent';
$password = '';
$dbname = 'test';
$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query = "select id from jk_users where email = '" . $email . "';";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$userid = $row['id'];

$query = "select name, title, author, due, max(timestamp) from jk_accounts, jk_books, jk_transactions where jk_accounts.id=jk_books.borrower and jk_transactions.bookid=jk_books.id and jk_accounts.userid='" . $userid . "' group by jk_books.title;";
$result = $conn->query($query);

echo '<tr><th>Account</th><th>Title</th><th>Author</th><th>Due Date</th></tr>';
while($row = $result->fetch_assoc()){
    echo '<tr><td>' . $row["name"] . '</td><td>' . $row["title"] . '</td><td>' . $row["author"] . '</td><td>' . $row["due"] . '</td></tr>';
}


function lastPost(){
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['admin'] == true || time()-$_SESSION["login_time"] > 5400 || !isset($_SESSION['email'])){
        session_destroy();
        exit;
    }
    $email = $_SESSION['email'];
    session_write_close();
    $servername = 'localhost';
    $username = 'gtstudent';
    $password = '';
    $dbname = 'test';
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "select max(timestamp) from jk_transactions, jk_users, jk_accounts where jk_users.email ='" . $email . "' and jk_users.id = jk_accounts.userid and jk_transactions.accountid = jk_accounts.id;";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    if(isset($row['max(timestamp)'])){
        return $row['max(timestamp)'];
    }

}

?>