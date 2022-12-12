<?php
  include_once('../config.php');
  if($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = test_input($_POST['username']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $target_file =  '../Uploads/' . uniqid() . '_' . basename($_FILES["file"]["name"]);

    if(strlen($password) < 6) {
        
        echo '<script>
                alert("Password must at least 6 characters!");
             </script>';

             header('location: ./admin-page.php');

      } else {
      $sql = "UPDATE users SET username = '$username', email = '$email', password = '$password', profile = '$target_file' WHERE unique_id = '{$_SESSION['unique_id']}'";
      $sql2 = "UPDATE quiz_score SET username = '$username', profile = '$target_file' WHERE unique_id = '{$_SESSION['unique_id']}'";
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                        if($conn->query($sql) && $conn->query($sql2)) {
                                // check if user, then update profile on quiz_score table
                                if($_SESSION['user_type'] == 'user') {
                                    $sql2 = "UPDATE quiz_score SET profile = '$target_file' WHERE unique_id = '$id'";
                                    if($conn->query($sql2)) {
                                        echo '<script>
                                                alert("Profile  updated successfully!");
                                              </script>';

                                        header('location: ./admin-page.php');
                                    } else {
                                        
                                        echo '<script>
                                                alert("Failed to update profile!");
                                              </script>';
                                        header('location: ./admin-page.php');
                                    }
                                    } else {
                                        // then if admin
                                        echo '<script>
                                                alert("Profile  updated successfully!");
                                              </script>';
                                        header('location: ./admin-page.php');
                                    }
                        }
                } else {
                    echo '<script>
                             alert("Failed to update profile!");
                          </script>';
                }
       }
     }
        
?>