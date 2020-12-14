<?php
session_start();
if($_SESSION['admin']!=true){
  session_destroy(); 
  exit;
} else if(time()-$_SESSION["login_time"] > 5400) {  
  session_destroy(); 
  exit;
} 

if(!isset($_POST['radio']) || !isset($_POST['author']) || !isset($_POST['borrower'])){
  echo "<p>Please make a selection</p>";
  exit;
}
$radio = $_POST['radio'];
$author = $_POST['author'];
$borrower = $_POST['borrower'];

$servername = 'localhost';
$username = 'gtstudent';
$password = '';
$dbname = 'test';
$conn = mysqli_connect($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

if($radio == 'overdue'){
    $query = "select title, author, name, email, due from jk_books, jk_accounts, jk_users, jk_transactions where jk_transactions.due<curdate() and jk_transactions.bookid=jk_books.ID and jk_books.borrower=jk_accounts.id and jk_accounts.userid=jk_users.id and jk_books.status='out' and jk_transactions.type!='in' group by title;";

    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    echo '<tr><th>Title</th><th>Author</th><th>Account</th><th>Email</th><th>Due Date</th></tr>';
    while($row = $result->fetch_assoc()){
      echo '<tr><td>' . $row["title"] . '</td><td>' . $row["author"] . '</    td><td>' . $row["name"] . '</td><td>' . $row["email"] . '</td><td>' . $row["due"] . '</td></tr>';
    }
} else if($radio == 'author'){
    if(!empty($author)){
        $query = "select title, author, name, email, due from jk_books, jk_accounts, jk_users, jk_transactions where jk_books.status='out' and jk_books.borrower=jk_accounts.id and jk_accounts.userid=jk_users.id and jk_accounts.id=jk_transactions.accountid and jk_transactions.type!='in' and where jk_books.author='" . $author . "' group by title;";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();

        echo '<tr><th>Title</th><th>Author</th><th>Account</th><th>Email</th><th>Due Date</th></tr>';

        while($row = $result->fetch_assoc()){
          echo '<tr><td>' . $row["title"] . '</td><td>' . $row["author"] . '</    td><td>' . $row["name"] . '</td><td>' . $row["email"] . '</td><td>' . $row["due"] . '</td></tr>';
        }

    } else{
        echo "<p>Please type an author's name</p>";
    }
} else if($radio == 'borrower'){
  if(!empty($borrower)){
    $query = "select title, author, name, email, due from jk_books, jk_accounts, jk_users, jk_transactions where jk_users.email='" . $borrower . "' and jk_books.status='out' and jk_books.borrower=jk_accounts.id and jk_accounts.userid=jk_users.id and jk_accounts.id=jk_transactions.accountid and jk_transactions.type!='in' group by title;";

    $result = $conn->query($query);
    $row = $result->fetch_assoc();

    echo '<tr><th>Title</th><th>Author</th><th>Account</th><th>Email</th><th>Due Date</th></tr>';

    while($row = $result->fetch_assoc()){
      echo '<tr><td>' . $row["title"] . '</td><td>' . $row["author"] . '</    td><td>' . $row["name"] . '</td><td>' . $row["email"] . '</td><td>' . $row["due"] . '</td></tr>';
    }

} else{
    echo "<p>Please type a user's email</p>";
  }
}
?>