<?php
include_once('../config.php');
  if(!isset($_SESSION['unique_id']) || !isset($_SESSION['user_type'])) {
      header('location: ../');
  }
  if($_SERVER['REQUEST_METHOD'] == 'GET') {
     $category = $_GET['category'];
     if($category != 'others') {
     $sql = "SELECT * FROM videos WHERE category = '$category' ORDER BY id DESC";
     } else {
      $sql = "SELECT * FROM videos ORDER BY id DESC"; 
     }
   if($result = mysqli_query($conn, $sql)) {
    if(mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_array($result))
      { 
        echo '
        <div class="p-3 col-lg rounded pt-4 border my-3">
         <h5 class="title">'.$row['title'].'</h5>
         <i>Uploaded on 
         '.$row['date'].'</i><br><br>
         <video width="100%" height="auto" controls>
              <source src="'.$row['path'].'" type="video/mp4">
              <source src="'.$row['path'].'" type="video/ogg">
              Your browser does not support the video tag.
         </video>
        </div>
        ';
      }
      mysqli_free_result($result);
    } else {
      echo '
       <div class="container-fluid">
         <strong>
         <span class="fas fa-bell"></span>
           Dont have any video available yet.</strong>
       </div>
      ';
    }
   }
  } else {
    header('location: ../');
  } 
  ?>