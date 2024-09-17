<?php

session_start();

include 'dbconnection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


  

if (isset($_SESSION['email']) && isset($_SESSION['phone']) && isset($_SESSION['name'])) {
    $email = htmlspecialchars($_SESSION['email']);
    $phone = htmlspecialchars($_SESSION['phone']);
    $name = htmlspecialchars($_SESSION['name']);

    $item = $_POST['item'];
    

    $priceQuery = "SELECT price FROM items WHERE itemname = '$item'";
    $result = $conn->query($priceQuery);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $price = $row["price"];
        }
    } else {
        echo "0 results";
    }

    
    
    $query = "INSERT INTO orders (customer,email, phone, item, price) VALUES ('$name', '$email', '$phone', '$item', '$price')";
     


    if ($conn->query($query) === TRUE) {
        $_SESSION['order'] = 'Order placed successfully!';
        header('Location: order.php');

      } else {
        $_SESSION['order'] = 'Error occured while placing order!';
        header('Location: order.php');

      }
    }
$conn->close();

?>