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
    $id = $_GET['id'];
      $sql = "DELETE FROM videos WHERE id = $id";
      if ($conn->query($sql)) {
        $sql2 = "INSERT INTO notification (detail) VALUES ('Admin deleted a video')";
      if(mysqli_query($conn, $sql2)) {
           header('location: ./admin-page.php?msg=Video deleted successfully!');
        }
      }
  } else {
    header('location: ./admin-page.php');
  }
?>