<?php
include_once('../config.php');
  if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM quiz_score ORDER BY score DESC";
    if($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0) {
        $id = 0;
        $previous = 0;
        $prevS = "";
        while($row = mysqli_fetch_array($result)){
        if(!($row['score'] == '')) {
            $id++;
            if($row['score'] == $prevS) $id = $previous;
        echo '
            <div class="bg-secondary rounded text-white my-3 container-fluid p-3">
            <span>'.$id.'</span>&nbsp;&nbsp;
            <!--
            <img style="height: 20xp; width: 20px;" src="'. (!empty($row['profile']) ? $row['profile'] : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZE6Kl_u2cYdgSqclEF85VVC8nAHAsR_mwTw&usqp=CAU') .'" alt="profile" class="rounded-circle"/> -->&nbsp;
            <strong>'.$row['username'].'</strong>
            <small class="float-end">Scored of '.$row['score'].'/'.$row['items'].'</small>
            </div>
        ';
        $previous = $id;
        $prevS = $row['score'];
        } 
        }
        mysqli_free_result($result);
        }
    }
  }
?> 