<?php

include 'dbconnection.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);



$orderid = $_GET['orderid'];



// SQL query to return Orders from selected orderID
$stmt = $conn->prepare("SELECT orderid, customer, email, phone, price, item FROM orders WHERE orderid = ?");
$stmt->bind_param("s", $orderid);
$stmt->execute();

$result = $stmt->get_result();

// Print table 
echo "<table>
<tr>
<th>OrderID</th>
<th>Customer</th>
<th>Email</th>
<th>Phone</th>
<th>Price</th>
<th>Item</th>

</tr>";


// print table data
while($row = $result->fetch_assoc()) {
echo "<tr>";
echo "<td>" . $row['orderid'] . "</td>";
echo "<td>" . $row['customer'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['phone'] . "</td>";
echo "<td>" . $row['price'] . "</td>";
echo "<td>" . $row['item'] . "</td>";
echo "</tr>";

}
echo "</table>";

// Close connections

$stmt->close();

$conn->close();

?>