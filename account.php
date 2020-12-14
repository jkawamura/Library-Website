<?php
session_start();
if($_SESSION['admin']!=true){
  header('Location: login.php');
  exit();
}

$email = $_POST['email'];
$account = $_POST['account'];

if(empty($email) || empty($account)){
  echo "<p>Fill in all the fields </p>";
} elseif(!preg_match("/^[a-zA-Z-' ]*$/",$account)) {
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
            $sql = "insert into jk_accounts(userid, name) values ((select id from jk_users where email= '" . $email . "'), '" . $account . "');";
            $conn->query($sql);
            echo "<p>Account added successfully</p>";

        } else{
            echo "<p>That account doesn't exist</p>";
        }
    } else{
        echo "<p>That account doesn't exist</p>";
  }
}
?>