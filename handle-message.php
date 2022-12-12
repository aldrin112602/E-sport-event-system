<?php
 include_once('./config.php');
 if(!isset($_SESSION['unique_id']) && !isset($_SESSION['user_type'])) {
   header('location: ./');
 }

 if($_SERVER['REQUEST_METHOD'] == 'POST') {
   $message = test_input($_POST['message']);
   $unique_id = $_SESSION['unique_id'];
   $username = $profile = '';
   //Get username and profile of user using his/her unique_id
   $sql = mysqli_query($conn, "SELECT * FROM users where unique_id = '$unique_id'");
   $row = mysqli_fetch_array($sql);
   if($row["unique_id"] == $unique_id) {
    $username = $row['username'];
    $profile = $row['profile'];
   }
   $sql = "INSERT INTO messages (message, unique_id, username, profile) VALUES ('$message', '$unique_id', '$username', '$profile')";
   if(mysqli_query($conn, $sql)) {
     echo "Message sent!";
   }
 } else {
   header('location: ./');
 }


?>