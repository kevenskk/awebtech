<!DOCTYPE html>
<html>
<body>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Welcome to the Food Company. Explore our menu and place your order from the comfort of your home.">
  <meta name="keywords" content="Food, Order, Home Delivery, Burger, Sandwich, Vegatarian">

  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Open+Sans:wght@300;400;600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
   
  <title>Order Here</title>
  
  <style>


  </style>
</head>



<script src= "https://unpkg.com/react@16/umd/react.production.min.js"></script>
<script src= "https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
<script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<?php

session_start(); // Start the session

// Ensure that users are logged in before they can place an order,
// Links are displayed according to login status and role
?>

<header class="header">
        <h2 class="logo"><a href="order.php">Food Company</a></h2>
        <ul class="navmenu">
  

        
  <?php if (isset($_SESSION['loggedin']) && $_SESSION['role'] == 'Customer'): ?> 
  <li><a class="active" href="order.php">Home</a></li>
  <li><a href="orders.php">My Orders</a></li>
  <li><a href="logout.php">Logout</a></li>


  <?php elseif (isset($_SESSION['loggedin']) && $_SESSION['role'] == 'Manager'): ?>
  <li><a class="active" href="order.php">Home</a></li>

<li><a href="manageOrders.php">Manage Orders</a></li>

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

           <form className="login-form" action = "placeOrder.php" method= "POST"  autoComplete="off" >
           
           <label for="type"></label>

<select name="type" id="type">
<option value="select" disabled selected>Select Item</option>

  <option value="Burger">Burger</option>
  <option value="Sandwich">Sandwich</option>
   
</select>
            
<label for="item"></label>

<select name="item" id="item">

</select>

           
<img id="itemImage" src="" alt="">

<p id = "itemPrice"> </p>



<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
    <input id = "placeOrderButton" type="submit" value="Order" />
  <?php else: ?>
    <p>Please log in to place an order.</p>

  <?php endif; ?>
  
  <?php
    if (isset($_SESSION['order'])) {
      echo "<p class='order'>" . $_SESSION['order'] . "</p>";
      unset($_SESSION['order']);
    }
  ?>
  
      </form>
</div>
</div>







<script>
$(document).ready(function() {
  $('#type').change(function() {
    $('#itemImage').attr('src', '' ).attr('alt', '').attr('width', '').attr('height', '');
    $('#itemPrice').text('');

    $.ajax({
      url: 'fetchItems.php',
      type: 'POST',
      data: { type: $(this).val() },
      success: function(data) {
        var items = JSON.parse(data);
        var options = '';
         

        for (var i = 0; i < items.length; i++) {

          options += '<option value="' + items[i].itemname + '">' + items[i].itemname +  '</option>'
        }
        $('#item').html(options);

        $('#item').change(function() {
          var index = $(this).prop('selectedIndex');
          $('#itemPrice').text('£' + items[index].price);


          
          $('#itemImage').attr('src', items[index].image ).attr('alt', items[index].itemname).attr('width', '256').attr('height', '256');
        });
        
        

      }
    });
  });
});
</script>

<script>



</script>








</body>
</html>


