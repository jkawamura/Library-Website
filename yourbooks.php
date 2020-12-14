<?php
session_start();
if(!isset($_SESSION['loggedin'])){
    session_destroy();
    header('Location: login.php#login');
    exit;
} else if($_SESSION['admin'] == true){
    session_destroy();
    header('Location: login.php#login');
    exit;
} else if(time()-$_SESSION["login_time"] > 5400)  {  
    session_destroy();
    header("Location:login.php"); 
    exit;
} else if(!isset($_SESSION['email'])){
    session_destroy();
    header("Location:login.php"); 
    exit;
}

$email = $_SESSION['email'];

$servername = 'localhost';
$username = 'gtstudent';
$password = '';
$dbname = 'test';


$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$query = "select id from jk_users where email = '" . $email . "';"
"select * from jk_accounts where id = (select id from jk_users where email = '" . $email . "');"
select * from jk_accounts where userid = (select id from jk_users where email = 'jdoe@gmail.com');

$result = $conn->query($query);

while($row = $result->fetch_assoc()){
    
    $books = $conn->query($query);
}


?>
