 setInterval(function(){
    $.ajax({
      url: "SessionCheck.php",
      success:function(response){
        if(response == 'logout'){
            window.location = "login.php";
        } 
    }
  })
}, 500);

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

function closeSignup(){
    document.getElementById("signupF").style.display="none";
}
function closenewB(){
    document.getElementById("newbookF").style.display="none";
}
function closeAdd(){
    document.getElementById("addaccountF").style.display="none";
}
function closeBorrow(){
    document.getElementById("checkborrowF").style.display="none";
}
function closeReturn(){
    document.getElementById("returnbookF").style.display="none";
}

function addaccount(){
  document.getElementById("addaccountF").style.display="block";
}

function checkborrow(){
  document.getElementById("checkborrowF").style.display="flex";
}

function returnbook(){
    document.getElementById("returnbookF").style.display="block";
}

function borrowBook(){
  document.getElementById("borrowB").style.display="block";
}

function closeBorrowB(){
  document.getElementById("borrowB").style.display="none";
}

function yourBook(){
  document.getElementById("yourB").style.display="block";
  $('#booklist').html("");
  $("#booklist").load('yourbooks.php');
}

function closeYourBooks(){
  document.getElementById("yourB").style.display="none";
}

function findBook(){
  document.getElementById("findB").style.display="flex";
}

function closeFind(){
  document.getElementById("findB").style.display="none";
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
