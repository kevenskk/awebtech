<!DOCTYPE html>
<html>
<body>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Open+Sans:wght@300;400;600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
 
  <title>My Orders</title>

  <style>
   table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
    font-family: 'Montserrat', sans-serif;

    color: white;
}

th {
    background-color: #f2f2f2;
    color: black;
}
</style>
</head>


<?php



session_start(); // Start the session





?>

<header class="header">
        <h2 class="logo"><a href="order.php">Food Company</a></h2>
        <ul class="navmenu">
           

            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
  <li><a  href="order.php">Home</a></li>

<li><a class="active" href="orders.php">My Orders</a></li>

<li><a href="logout.php">Logout</a></li>

<?php else: ?>
  <li><a class="active" href="order.php">Home</a></li>

  <li><a href="login.php">Login</a></li>
  <li><a href="registration.php">Register</a></li>
<?php endif; ?>
            
        </ul>
    </header>



<div class = "submit-page">

      <div class = "submitcontainer">

           <form className="login-form"  method= "POST"  autoComplete="off" >
       
           

<?php



include 'dbconnection.php';

if(isset($_SESSION['loggedin'])) {
    echo "<p> My Orders </p>";
}else {

    echo "<p> Please login to view your orders. </p>"; 

}

if(isset($_SESSION['email'])) {
    $email = htmlspecialchars($_SESSION['email']);
    $stmt = $conn->prepare("SELECT orderid, item, price FROM orders WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();


if ($result->num_rows > 0) {
    // Display orders in a table
    echo "<table>";
    echo "<tr><th>Order ID</th><th>Item</th><th>Price (£)</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['orderid'] . "</td>";
        echo "<td>" . $row['item'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
       
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p> No orders found. </p>"; // Display message if no orders found
}
}


?>


</form>
    



</body>
</html>


