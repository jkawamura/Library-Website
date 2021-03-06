<?php
session_start();
if($_SESSION['admin']!=true){
  session_destroy(); 
  exit;
} else if(time()-$_SESSION["login_time"] > 5400) {  
  session_destroy(); 
  exit;
} 

$email = $_POST['email'];
$psw = $_POST['psw'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];

if(empty($email) || empty($psw) || empty($fname) || empty($lname)){
  echo "<p>Fill in all the fields </p>";
} elseif(!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
  echo "<p>Only letters and white space allowed in name</p>";
} elseif(!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
  echo "<p>Only letters and white space allowed in name</p>";
} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
  echo "<p>Enter a valid email</p>";
} else{

    $servername = 'localhost';
    $username = 'gtstudent';
    $password = '';
    $dbname = 'test';


    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $query = "select email from jk_users where email = '" . $email . "';";

    $result = $conn->query($query);
    $row = $result->fetch_assoc();

    if(isset($row['email'])){
      if($row['email'] == $email){
        echo "<p>An account with that email already exists</p>";
      }
    } else{
      $sql = "insert into jk_users(email, password, firstname, lastname, role) values ('" . $email . "', '" . password_hash($psw, PASSWORD_BCRYPT) . "', '" . $fname . "', '" . $lname . "', 'user');";
      $conn->query($sql);

      $sql = "insert into jk_accounts(userid, name) values ((select id from jk_users where email = '" . $email . "'), '" . $fname . "');";
      $conn->query($sql);

      echo "<p>User registered successfully</p>";
  }
}
?>