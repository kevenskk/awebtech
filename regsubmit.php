<?php

session_start(); // Start the session

include 'dbconnection.php';



$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


 
// check if POST array containg registration information is set
if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['password'])){
  $username = htmlspecialchars($_POST['username']);
  $email = htmlspecialchars ($_POST['email']);
  $phone = htmlspecialchars($_POST['phone']);
  $password = htmlspecialchars($_POST['password']);
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  
  // prepare and execute SQL query to check if username or email already exists
  $stmt = $conn->prepare("SELECT * FROM users WHERE name = ? OR email = ?");
  $stmt->bind_param("ss", $username, $email);
  $stmt->execute();

  $result = $stmt->get_result();

 
  

 
  if ($result->num_rows > 0) {
    $_SESSION['regError'] = 'Username/Email already exists.';
    header('Location: registration.php');
     
} else if(filter_var($email, FILTER_SANITIZE_EMAIL) && filter_var($username, FILTER_SANITIZE_STRING) && filter_var($phone, FILTER_SANITIZE_NUMBER_INT)) {
    $sql = "INSERT INTO users (name, phone, email, password, role) VALUES ('$username', '$phone', '$email', '$hashed_password', 'Customer')";

    if ($conn->query($sql) === TRUE) {

      header('Location: login.php');

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  
}



?>