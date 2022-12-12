<?php 
    include_once('./config.php');
    if(!isset($_SESSION['unique_id']) && !isset($_SESSION['user_type'])) {
      header('location: ./');
    }
   $sql = "SELECT * FROM notification ORDER BY date DESC";
   if($result = mysqli_query($conn, $sql)) {
    if(mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_array($result))
      { 
       echo '
      <div class="alert ';
      if(trim($row['detail']) == 'Admin created an event' || trim($row['detail']) == 'Admin uploaded a video' || trim($row['detail']) == 'Admin created a poll') {
        echo 'alert-info';
      } else {
        echo 'alert-danger';
      }
      echo ' alert-dismissible fade show">
                    <strong>
                    <span class="fas fa-bell"></span> '.$row['detail'].'
                    </strong><br>
                    <small class="text-secondary">'.$row['date'].'</small>
            </div>'; 
      }
      mysqli_free_result($result);
    } else {
      echo '
        <div class="alert alert-warning alert-dismissible fade show">
            <strong>
                <span class="fas fa-bell"></span> You don\'t have any notification yet. 
            </strong>
        </div>';
    }
   }
?>