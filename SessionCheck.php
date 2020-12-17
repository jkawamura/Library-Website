<?php
session_start();
if(isset($_SESSION['loggedin']) && isset($_SESSION['email']) && isset($_SESSION['admin'])){
  if(time()-$_SESSION["login_time"] > 5400) {
    session_destroy();
    echo "logout";
  } 
} else{
  session_destroy();
  echo "logout";
}
?>