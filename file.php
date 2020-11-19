//prompt the user for email and name
<?php
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
}

?>
