<?php

$email = $_POST['email'];
$servername = 'localhost';
$username = 'gtstudent';
$password = '';
$dbname = 'test';
// Try and connect using the info above.
$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

$query = "select email from jk_users where email = '" . $email . "';";

$result = $conn->query($query);

if($result){
    echo "you already have an account";
} else {
    
}



?>