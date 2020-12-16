<?php
session_start();
if(isset($_SESSION)){
  if(time()-$_SESSION["login_time"] > 10) {
    session_destroy();
    echo "logout";
  } 
}
?>