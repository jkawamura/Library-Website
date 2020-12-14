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

    $query = "select id, email from jk_users where email = '" . $email . "';";

    $result = $conn->query($query);
    $row = $result->fetch_assoc();

    if(isset($row['email'])){
        if($row['email'] == $email){
            $sql = "select name from jk_accounts where userid = '" . $row['id'] . "';";
            $result = $conn->query($sql);
            while($names = $result->fetch_assoc()){
              if($names['name'] == $account){
                echo "<p>Account name taken</p>";
                exit;
              }
            }
        
            $sql = "insert into jk_accounts(userid, name) values ('" . $row['id'] . "', '" . $account . "');";
            $conn->query($sql);
            echo "<p>Account added successfully</p>";

        } else{
            echo "<p>That user doesn't exist</p>";
        }
    } else{
        echo "<p>That user doesn't exist</p>";
  }
}
?>