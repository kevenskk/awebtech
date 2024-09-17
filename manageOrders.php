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
 
  <title>Manage Orders</title>

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



<script src= "https://unpkg.com/react@16/umd/react.production.min.js"></script>
<script src= "https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
<script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<?php

session_start();



?>



<header class="header">
        <h2 class="logo"><a href="order.php">Food Company</a></h2>
        <ul class="navmenu">
           

            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?> 
  <li><a  href="order.php">Home</a></li>

<li><a class="active" href="manageOrders.php">Manage Orders</a></li>

<li><a href="logout.php">Logout</a></li>

<?php else: ?>
  <li><a class="active" href="order.php">Home</a></li>

  <li><a href="login.php">Login</a></li>
  <li><a href="registration.php">Register</a></li>
<?php endif; ?>
            
        </ul>
    </header>

  
    
<div class = "input-container">
<input type="orderid" placeholder="Enter Order ID" name="orderid" id="orderid" required  />

<button onclick="showOrder(document.getElementById('orderid').value)">View Order</button>

</div>

<div id="tableContainer" style = "overflow-x:auto;"><b></b></div>
    
  
</div>
           
    <script> // AJAX query to retrieve orders

function showOrder(str) {
  if (str == "") {
    document.getElementById("tableContainer").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("tableContainer").innerHTML = this.responseText; // display the order details in a table
      }
    };
    xmlhttp.open("GET","getOrder.php?orderid="+str,true);
    xmlhttp.send();
  }
}


</script>

    

      










</body>
</html>
