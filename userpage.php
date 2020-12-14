<?php
session_start();
if(!isset($_SESSION['loggedin'])){
   header('Location: login.php');
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

          <!--debug this code before submission -->
          <li><a class="active" onclick="borrowBook()" href="#signup">Borrow a book</a></li>
          <li><a class="open-button" onclick="login()" href="#login">Login</a></li>
          <li><a class="active"  href="index.html">Home</a></li>
        </ul>
    </div>
  </div>

<!--form for searching, resolve before submission-->
  <div id="searchbox" >
    <h2>What Books are You Looking For?</h2>
    <input type="text" placeholder="Search...">
    <input type="submit"><i class="fa fa-search"></i></button>
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

<div class="form-login">
  <form action="file.php" class="form-container" id="loginF">
    <h1>Login</h1>
    <label for="email"><b>Email</b></label>
    <input type="text" id="email" placeholder="enter email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" id="psw" placeholder="Enter Password" name="psw" required>

    <span id="login-status"></span>
    <button type="submit" class="btn">Login</button>
  </form>
  <button class="btn cancel" onclick="closeForm()">Close</button>
</div>
<script>


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


<script>
  $(function(){
  $("#signupform").submit(function(event){
    event.preventDefault();
    var email = $('#signup-email').val();
    var psw = $('#signup-psw').val();
    var fname = $('#fname').val();
    var lname = $('#lname').val();

    var data = {'email' : email,
    'psw' : psw,
    'fname' : fname,
    'lname' : lname};

    $('#signup-mssg').load('register.php', data);
  })
})
</script>
</body>
</html>
