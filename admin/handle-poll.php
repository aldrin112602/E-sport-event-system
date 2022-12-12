<?php
  include_once('../config.php');
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $enable = $_POST['enable'];
    $sql = "UPDATE poll SET enabled = '$enable' WHERE unique_id = '$id'";
    
    if(mysqli_query($conn, $sql)) {
      echo ($enable == 'true') ? 'Poll enabled!' : 'Poll disabled!';
    } else {
      echo 'Something went wrong, please try again!';
    }
  } else {
    header('location: ./admin-page.php');
  }
?>