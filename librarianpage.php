<?php
session_start();
if(!isset($_SESSION['loggedin'])){
   header('Location: login.php');
} else if($_SESSION['admin'] == false){
    header('Location: login.php');
} else if(time()-$_SESSION["login_time"] > 5400)  { 
	session_destroy(); 
    header("Location:login.php"); 
}
?>

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
	<div class="header">
	<h1>Small Town Library System</h1>
	</div>
	<div id="navigation" >
		<ul>
		<li><a class="active" href="logout.php">Logout</a></li>
		<li><a class="active" onclick="signUp()" href="#signup">Register New User</a></li>
		<li><a class="active" onclick="addaccount()" href="#addaccount">Add Additional Account</a></li>
		<li><a class="active" onclick="newbook()" href="#newbook">Add New Book</a></li>
		<li><a class="active" onclick="checkborrow()" href="#checkbooks">Check Borrowed Books</a></li>
		<li><a class="active" onclick="returnbook()" href="#return">Return Borrowed Book</a></li>
		</ul>
	</div>

	<div class="form-signup" id="signupF">
		<form action="register.php" method="POST" class="form-container" id="signupform">

			<h1>Signup</h1>
			<label for="fname"><b>First Name</b></label>
			<input type="text" id="fname" placeholder="Enter First Name" name="fname" required>

			<label for="lname"><b>Last Name</b></label>
			<input type="text" id="lname" placeholder="Enter Last Name" name="lname" required>

			<label for="email"><b>Email</b></label>
			<input type="text" id="signup-email" placeholder="enter email" name="email" required>

			<label for="psw"><b>Password</b></label>
			<input type="password" id="signup-psw" placeholder="Enter Password" name="psw" onkeyup="confirmPassword()"  required>
			<input type="password" id="cpsw" placeholder="Confirm Password" name="cpsw" onkeyup="confirmPassword()" required>
			<p id="confirm">Passwords Match</p>
			<div id="signup-mssg"></div>

			<button type="submit" class="btn" id="register">Sign Up</button>
		</form>
		<button class="btn cancel" onclick="closeSignup(), $('#signup-mssg').html('')">Close</button>
	</div>

	<div class="form-signup" id="addaccountF">
		<form action="account.php" method="POST" class="form-container" id="accountform">

			<h1>Add Account</h1>
			<label for="accountemail"><b>User Email</b></label>
			<input type="text" id="account-email" placeholder="enter email" name="accountemail" required>

			<label for="lname"><b>Account Name</b></label>
			<input type="text" id="account-name" placeholder="Enter Account Name" name="accountname" required>

			<div id="account-mssg"></div>

			<button type="submit" class="btn" id="accountsubmit">Sign Up</button>
		</form>
		<button class="btn cancel" onclick="closeAdd(), $('#account-mssg').html('')">Close</button>
	</div>

	<div class="form-signup" id="newbookF">
		<form action="newbook.php" method="POST" class="form-container" id="addbook">
			<h1>Add Book</h1>
			<label for="btitle"><b>Title</b></label>
			<input type="text" id="btitle" name="btitle" required>
			<label for="bauthor"><b>Author</b></label>
			<input type="text" id="bauthor" name="bauthor" required>
			<label for="bgenre"><b>Genre (no capitalizations)</b></label>
			<input type="text" id="bgenre" name="bgenre" required>
			<label for="bdate"><b>Year Published</b></label>
			<input type="text" id="bdate" name="bdate" required>
			<div id="book-mssg"></div>
			<button type="submit" class="btn" id="addbk">Add Book</button>
		</form>
		<button class="btn cancel" onclick="closenewB(), $('#book-mssg').html('')">Close</button>
	</div>

	<div class="form-signup" id="checkborrowF">
		<div>
		<form action="borrowCheck.php" method="POST" class="form-container" id="checkborrow">
			<h1>Find Borrowed Books By:</h1>
			<input type="radio" name="borrowCriteria" id="borrowOverdue" value="overdue">Overdue Books<br>
			<input type="radio" name="borrowCriteria" value="author">Author<input type="text" id="borrowAuthor" name="author" placeholder="Author's name"><br>
			<input type="radio" name="borrowCriteria" value="borrower">Borrower<input type="text" id="borrowUser" name="borrower" placeholder="Borrower's email"><br>
			<button type="submit" class="btn" id="findBook">Find Books</button>
		</form>	
		<button class="btn cancel" onclick="closeBorrow(), $('#borrow-mssg').html('')">Close</button>
		</div>		
		<div id="borrow-mssg"></div>
	</div>

	<div class="form-signup" id="returnbookF">
		<form action="returnBook.php" method="POST" class="form-container" id="return">
			<h1>Return a Borrowed Book</h1>
			<label for="returnTitle"><b>Title</b></label>
			<input type="text" name="returnTitle" id="returnTitle" required>
			<label for="returnAuthor"><b>Author</b></label>
			<input type="text" name="returnAuthor" id="returnAuthor" required>
			<div id="return-mssg"></div>
			<button type="submit" class="btn" id="returnBook">Return Book</button>
		</form>
		<button class="btn cancel" onclick="closeReturn(), $('#return-mssg').html('')">Close</button>
	</div>


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

	$(function(){
		$("#accountform").submit(function(event){
			event.preventDefault();
			var email = $('#account-email').val();
			var account = $('#account-name').val();

			var data = {
				'email' : email,
				'account' : account,
			};
			$('#account-mssg').load('account.php', data);
		})
	})

	$(function(){
		$("#addbook").submit(function(event){
			event.preventDefault();
			var title = $('#btitle').val();
			var author = $('#bauthor').val();
			var genre = $('#bgenre').val();
			var date = $('#bdate').val();
			var data = {'title' : title,
						'author' : author,
						'genre' : genre,
						'date' : date };
			$('#book-mssg').load('book.php', data);
		})
	})

	$(function(){
		$("#checkborrow").submit(function(event){
			$('#borrow-mssg').html('');
			event.preventDefault();

			var radio = $('input[name="borrowCriteria"]:checked').val();
			var author = $('#borrowAuthor').val();
			var borrower = $('#borrowUser').val();

			var data = {'radio' : radio,
						'author' : author,
						'borrower' : borrower};
			$('#borrow-mssg').load('borrowCheck.php', data);
		})
	})

	$(function(){
		$("#return").submit(function(event){
			event.preventDefault();

			var title = $('#returnTitle').val();
			var author = $('#returnAuthor').val();

			var data = {'title' : title,
						'author' : author};
			$('#return-mssg').load('returnBook.php', data);
	})
	})

		setInterval(function(){
		$.ajax({
		url: "SessionCheck.php",
		success:function(response){
			if(response == 'logout'){
				window.location = "login.php";
			} 
		}
	})
	}, 5000);
	</script>

  </body>
</html>
