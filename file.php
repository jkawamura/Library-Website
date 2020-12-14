<?php
  session_start();
  $servername = "localhost";
  $username = "gtstudent";
  $password = "";
  $dbname = "test";
  $conn = new mysqli($servername, $username, $password, $dbname);
  $email = $_POST["email"];
  $psw = $_POST["psw"];

  if ($conn->connect_error) {
      return "Connection failed to user database " . $conn->connect_error;
  }
  $sql = "select * from jk_users where email='". $email . "';";

  $result = $conn->query($sql);
  if($result){
    $row = $result->fetch_assoc();
  } else{
    echo"error";
  }
  

  if(isset($row['email'])){
    if($row['email'] == $email){


      if (password_verify($psw, $row["password"])) {
        $_SESSION["loggedin"]=true;
        if($row['role'] == 'admin'){
          $_SESSION["admin"]=true;
          $_SESSION["email"]=$email;
          $_SESSION["login_time"] = time(); 
          echo "admin";
        } else{
          $_SESSION["admin"]=false;
          $_SESSION["email"]=$email;
          $_SESSION["login_time"] = time(); 
          echo "user";
        }

    } else{
        echo "passerr";
    }
  } else{
      echo "usererr";
  }
} else{ 
    echo "usererr";
} 
/*
  if ($result) {
    $row = $result->fetch_assoc();
    if (password_verify($psw, $row["psw"])) {
        $_SESSION["loggedin"]=true;
        $_SESSION["sectionlog"]=1;
        if ($_REQUEST["remember"]) {
            $_SESSION["username"] = $_POST["email"];
        }
        else {
            unset($_SESSION["username"]);
        }
        echo "success";
    } else {
        $_SESSION["loggedin"]=false;
        unset($_SESSION["sectionlog"]);
        echo "bad password";
    }
} else {
    $_SESSION["loggedin"]=false;
    unset($_SESSION["sectionlog"]);
    echo "bad username";
}
/*
//if name field is filled in
if (isset($_POST['name']) && isset($_POST['email'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
//validate name

if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
  $nameErr = "Only letters and white space allowed";
}
  //validate the email address
  if (! filter_var($email, FILTER_VALIDATE_EMAIL))
  {
  echo "please enter a valid email!";
  }
  
  //do  something with the name and email and password
  //log in
}*/

?>
