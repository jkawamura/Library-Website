<?php
session_start();
if(!isset($_SESSION['loggedin'])){
   header('Location: login.php#login');
} else if($_SESSION['admin'] == true){
    header('Location: login.php#login');
} else if(time()-$_SESSION["login_time"] > 5400)  {  
    session_destroy();
    header("Location:login.php"); 
}
?>

<!DOCTYPE>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel = "stylesheet" type = "text/css" href = "style.css" />
  <link rel = "stylesheet" type = "text/css" href = "userpage.css" />
  <script src="script.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <title>
    Library System
  </title>
</head>
<body>
  <section>
    <div class="header">
      <h1>
       Welcome to the Library
      </h1>


    <div id="navigation" >
        <ul>
        <li><a class="active"  href="logout.php">Logout</a></li>
        <li><a class="active" onclick="yourBook()" href="#borrowed">Your Books</a></li>
        <li><a class="active" onclick="borrowBook()" href="#userbrw">Borrow a Book</a></li>
        <li><a class="active" onclick="findBook()" href="#userbrw">Find a Book</a></li>
        </ul>
    </div>
  </div>

<div style="background-image: url('images/image1.jpg'); background-size: cover; height:480px; padding-top:80px;">">
</div>

  </section>

  <section class="examples">
  <div class="box"  >

    <span style="--i:1"> <img src="images/book0.jpg" alt="decorative image" ></span>
    <span style="--i:2"><img src="images/book1.jpg" alt="decorative image"   ></span>
    <span style="--i:3"><img src="images/book2.jpg"  alt="decorative image"  ></span>
    <span style="--i:4"><img src="images/book3.jpg"  alt="decorative image"  ></span>
    <span style="--i:5"><img src="images/book4.jpg"  alt="decorative image"  ></span>
    <span style="--i:6"><img src="images/book5.jpg"  alt="decorative image"  ></span>
    <span style="--i:7"><img src="images/book6.jpg"  alt="decorative image"  ></span>
    <span style="--i:8"><img src="images/book7.jpg"  alt="decorative image"  ></span>
    <span style="--i:9"><img src="images/book8.jpg" alt="decorative image"   ></span>



    </div>
</section>


<div class="form-signup" id="borrowB">
	<form action="borrowbook.php" method="POST" class="form-container" id="userbrw" >
	  <h1>Borrow a Book</h1>
	  <label for="btitle" ><b>Title</b></label>
    <input type="text" placeholder="Enter the book title" id="btitle" name="btitle" required>
      
	  <label for="bauthor"><b>Author</b></label>
    <input type="text" placeholder="Author" id="bauthor" name="bauthor" required>

    <label for="baccount"><b>Which Account?</b></label>
    <input type="text" placeholder="Account name" id="baccount" name="baccount" required>
    
    <div id="borrow-mssg"></div>
	  <button type="submit" class="btn" id="addbk">Borrow</button>
  
  </form>

  <button class="btn cancel" onclick="closeBorrowB()">Close</button>
</div>

<div class ="form-login" id="yourB" style="width:60%">
    <table style="width:100%" id="booklist">
    </table>
    <button class="btn cancel" onclick="closeYourBooks()">Close</button>
</div>


<script>
$(function(){
		$("#userbrw").submit(function(event){
			event.preventDefault();
			var title = $('#btitle').val();
      var author = $('#bauthor').val();
      var account = $('#baccount').val();

			var data = {'title' : title,
            'author' : author,
            'account' : account};
      
			$('#borrow-mssg').load('borrowbook.php', data);
	})
})


  $(function(){
  $("#loginF").submit(function(event){
    event.preventDefault();
    var email = $('#email').val();
    var psw = $('#psw').val();

    var data = {'email' : email,
    'psw' : psw
    };
    $('#login-status').load('file.php', data);
  })
})

</script>
</body>
</html>

