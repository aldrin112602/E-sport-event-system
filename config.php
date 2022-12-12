<?php
session_start();
// Create connection
$conn = mysqli_connect("localhost","root","","SystemDB");
// Check connection
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
  }
?>