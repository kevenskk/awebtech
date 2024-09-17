<?php

include 'dbconnection.php';


$conn = new mysqli($servername, $username, $password, $dbname);



// return image path and solution
$stmt = $conn->prepare("SELECT imagepath, solution FROM captcha"); 
$stmt->execute();

$result = $stmt->get_result();


$paths = array();
while($row = $result->fetch_assoc()) {
    $paths[] = $row;

}

// return JSON 
echo json_encode($paths);

$stmt->close();

$conn->close();
?>