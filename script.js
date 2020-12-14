function login(){
  document.getElementById("loginF").style.display="block";
}

function newbook(){
    document.getElementById("newbookF").style.display="block";
}

function signUp(){
  document.getElementById("signupF").style.display="block";
}

function closeForm(){
  document.getElementById("loginF").style.display="none";
}

function addaccount(){
  document.getElementById("addaccountF").style.display="block";
}

function checkborrow(){
  document.getElementById("checkborrowF").style.display="block";
}

function returnbook(){
    document.getElementById("returnbookF").style.display="block";
}

function borrowBook(){
  document.getElementById("borrowB").style.display="block";
}

function confirmPassword(){
  if(document.getElementById("cpsw").value == document.getElementById("signup-psw").value){
    document.getElementById("confirm").innerHTML = "Passwords Match";
    document.getElementById("confirm").style.color = "green";
    document.getElementById("register").disabled = false;
  } else{
    document.getElementById("confirm").innerHTML = "Passwords Don't Match";
    document.getElementById("confirm").style.color = "red";
    document.getElementById("register").disabled = true;
  }
}

$(document).ready(function() {
  $("#formButton").click(function() {
    $("#form1").toggle();
  });
});
