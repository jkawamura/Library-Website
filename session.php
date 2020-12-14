<?php  
// To check if session is started. 
header("Location: http://comet.cs.brynmawr.edu/~jkawamura/Systems-of-HTML-Javascript-PHP-MySQL/librarianpage.php", true, 301);
/*
if(isset($_Session["loggedin"])){
    echo "here";
    if(isset($_SESSION["email"])){
        if($_SESSION['admin'] == true){
            echo "hi";
            header("Location: librarianpage.php");
        } else {
            header("");
        }
} else { 
    header("Location:login.php"); 
} 
}*/
?> 