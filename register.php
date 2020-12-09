<?php

$email = $_POST['email'];
$psw = $_POST['psw'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];

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
$row = $result->fetch_assoc();
if(isset($row['email'])){
  if($row['email'] == $email){
    exit("An account with that email already exists");
  }
} else{
  $sql = "insert into jk_users(email, password, firstname, lastname, address) values ('" . $email . "', '" . password_hash($psw, PASSWORD_BCRYPT) . "', '" . $fname . "', '" . $lname . "', 'test_register');";
  echo $sql;
  $result = $conn->query($sql);
}
?>