<?php
    include_once('../config.php');
    $sql = "SELECT * FROM event ORDER BY id DESC";
    if($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0) {
        $id = 0;
        while($row = mysqli_fetch_array($result)){
        $id++;
            echo '
            <div style="background-image: linear-gradient(-45deg, rgba(100,100,50,0.2), rgba(0,0,255, 0.4))" class="my-3 mr-3 text-dark border p-4 rounded col-lg position-relative">
            <small><strong>Date: </strong>'.$row['start_date'].' at '.$row['start_time'].'</small><br>
             <!--<button onclick="this.parentElement.style.display=\'none\';" style="top: 10px;right: 10px;" class="btn btn-close bg-white position-absolute"></button>-->
            <h4>Event title: '.$row['event_name'].'</h4>
            <small class=""> Description: '.$row['description'].'</small><br><br>

            </div>
            ';
        }
        mysqli_free_result($result); 
        }
    }
?>