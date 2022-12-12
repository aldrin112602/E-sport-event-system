<?php
  include_once('../config.php');
   //Save score
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $score = test_input($_POST['score']);
    $items = test_input($_POST['items']);
    $sql = "UPDATE quiz_score SET score = '$score', profile = '{$_SESSION['profile']}', items = '$items' WHERE unique_id = '{$_SESSION['unique_id']}'";  
         if($conn->query($sql)) { 
           echo $score;
         } else {
           echo '';
         }
   } else {
    header('location: ../');
   }
?>