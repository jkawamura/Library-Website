function login(){
  document.getElementById("loginF").style.display="block";
}

function signUp(){
  document.getElementById("signupF").style.display="block";
}

function closeForm(){
  document.getElementById("loginF").style.display="none";
}

function confirmPassword(){
  if(document.getElementById("cpsw").value == document.getElementById("signup-psw").value){
    document.getElementById("confirm").innerHTML = "Passwords Match";
    document.getElementById("confirm").style.color = "green";
  } else{
    document.getElementById("confirm").innerHTML = "Passwords Don't Match";
    document.getElementById("confirm").style.color = "red";
  }
}

