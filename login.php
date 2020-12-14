<!DOCTYPE>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    Library System
  </title>
  <link rel = "stylesheet" type = "text/css" href = "style.css" />
  <script src="script.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
  <section>
    <div class="header">
      <h1>
      Library System
      </h1>
    </div>
    <div id="navigation" >
        <ul>
          <li> <a class="open-button" onclick="login()" href="#login" >Log In</a>
          <li><a class="active"  href="librarianpage.php">Administrator Home</a></li>
          <li><a class="active"  href="userpage.php">Member Home</a></li>
        </ul>
    </div>
    <div style="background-image: url('images/image1.jpg'); background-size: cover; height:480px; padding-top:80px;">">
    </div>
<div id="some images">
<section>
  <a href="https://www.barnesandnoble.com/b/new-releases/_/N-1oyg" id="links">New Releases 2020- 2021</a>
  <img class="diamond-effect" alt="New Book Releases" src="images/image4.jpg" >
</section>


  <section>
    <a href="https://www.vogue.com/article/best-winter-books" id="links">Winter Reads 2020</a>
    <img class="diamond-effect" alt="Winter Reads" src="images/image5.jpg" >

  </section>

</div>

<!--footer-->
<footer style="color:rgb(0, 0, 0); padding:50px; margin:0; text-align:center; position: absolute;">
  <h1>Made  by Abbie, Joseph and Rosie</h1>

</footer>

<div class="form-login" id="loginF">
  <form action="file.php" class="form-container" id="loginform">
    <label for="email"><b>Email</b></label>
    <input type="text" id="email" placeholder="enter email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" id="psw" placeholder="Enter Password" name="psw" required>

    <div id="login-status"></div>
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

    var data = {
      'email' : email,
      'psw' : psw
    };
    $.ajax({
        url: 'file.php',
        type: 'post',
        data: data,
        success:function(response){
            if(response == 'admin'){
                window.location = "librarianpage.php";
            } else if(response =='user'){
                window.location = "userpage.php";
            } else if(response =='passerr'){
                $('#login-status').text('incorrect password');
            } else if(response == 'usererr'){
                $('#login-status').text('incorrect username');
            }
        }
    })
  })
})
</script>


</body>
</html>
