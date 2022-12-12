<?php
  include_once('../config.php');
  if(isset($_SESSION['unique_id']) && isset($_SESSION['user_type'])) {
    if($_SESSION['user_type'] === 'user') {
      header('location: ../');
    }
  } else {
      header('location: ../');
  }
  
  if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $unique_id = $_GET['id'];
    $sql = mysqli_query($conn, "SELECT * FROM poll where unique_id = '$unique_id'");
    $row = mysqli_fetch_array($sql);
    if($row["unique_id"] != $unique_id) {
      header('location: ../');
    } else {
      $sql = "DELETE FROM poll WHERE unique_id = '$unique_id'";
      if ($conn->query($sql)) {
        $sql2 = "INSERT INTO notification (detail) VALUES ('Admin deleted a poll')";
      if(mysqli_query($conn, $sql2)) {
           header('location: ./admin-page.php?msg=Poll deleted successfully!');
        }
      }
    }
    
  } else {
    header('location: ./admin-page.php');
  }
?>