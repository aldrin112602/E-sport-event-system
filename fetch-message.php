<?php
include_once( './config.php' );
if ( !isset( $_SESSION[ 'unique_id' ] ) && !isset( $_SESSION[ 'user_type' ] ) ) {
    header( 'location: ./' );
}

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' ) {
    $sql = 'SELECT * FROM messages';

    if ( $result = mysqli_query( $conn, $sql ) ) {
        if ( mysqli_num_rows( $result ) > 0 ) {
            while( $row = mysqli_fetch_array( $result ) ) {

                if ( $_SESSION[ 'user_type' ] == 'admin' ) {
                    $profile = str_ireplace( '../', './', $row[ 'profile' ] );
                } else {
                    // $profile = $row[ 'profile' ];
                    $profile = str_ireplace( '../', './', $row[ 'profile' ] );
                }

                if ( $_SESSION[ 'unique_id' ] == $row[ 'unique_id' ] ) {
                    echo '
                    <div style="width: 100%;" class="my-2 msg outgoing">';
                    // echo '
                    //   <img class="border" src="'.( !empty( $profile ) ? $profile : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZE6Kl_u2cYdgSqclEF85VVC8nAHAsR_mwTw&usqp=CAU' ).'">
                      echo '<small>'.$row[ 'username' ].'</small>';
                    echo '
                      <span>'.$row[ 'message' ] .'</span>
                    </div>
                   ';

                } else {
                    echo '
                  <div style="width: 100%;" class="my-2 msg incoming">';
                    // echo '
                    // <img class="border" src="'.( !empty( $profile ) ? $profile : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZE6Kl_u2cYdgSqclEF85VVC8nAHAsR_mwTw&usqp=CAU' ).'">
                    echo '<small>'.$row[ 'username' ].'</small>';
                    echo '
                    <span>'.$row[ 'message' ] .'</span>
                  </div>
                 ';

                }
            }
            mysqli_free_result( $result );
        }
    } else {
        echo '
     <div class="alert alert-warning alert-dismissible fade show" role="alert">
          No message yet, Start conversation..
         <button type="button" class="btn-close btn-sm float-end" data-dismiss="alert" aria-label="Close"></button>
     </div>';
    }

} else {
    header( 'location: ./' );
}
?>