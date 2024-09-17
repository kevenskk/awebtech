<?php
 include 'dbconnection.php';



$type = $_POST['type']; // POST method returns selected type


$query = "SELECT itemname, price, image FROM items WHERE type = ? "; // SQL query to return selected item info
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $type);
$stmt->execute();
$result = $stmt->get_result();

// Store the items in an array
$items = [];
while ($row = $result->fetch_assoc()) {
  $items[] = [
    'itemname' => $row['itemname'],
    'price' => $row['price'],
    'image' => $row['image']
  ];
}



// Return the items as JSON to ajax request
echo json_encode($items); 

// close connections
$stmt->close(); 

$conn->close();


?>