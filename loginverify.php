<?php

session_start();



include 'dbconnection.php';



if(isset($_POST['email']) && isset($_POST['password'])){

  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  
  

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }



  if ($stmt = $conn->prepare('SELECT email, password, userid, name, phone, role FROM users WHERE email = ?')) {
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();

    $stmt->store_result();
  
    if ($stmt->num_rows > 0) {
      $stmt->bind_result($email,$password, $userid, $name, $phone, $role);
      $stmt->fetch();
      // verify entered password with stored hashed password in SQL DB
      if (password_verify($_POST['password'], $password)) {

        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['email'] = $email;
        $_SESSION['userid'] = $userid;
        $_SESSION['name'] = $name;
        $_SESSION['phone'] = $phone;
        $_SESSION['role'] = $role;

        
        header('Location: order.php');


        exit;
      } else {
      
       
         // set errorr messages and redirect to login
        $_SESSION['error'] = 'Incorrect username and/or password! Please try again.';
        header('Location: login.php');
        exit();
        
      }
    } else {
        

       

        $_SESSION['error'] = 'Incorrect username and/or password! Please try again.';
        header('Location: login.php');

        exit();

      
    }
    $stmt->close();
  }
  


}

  
  
 

?>