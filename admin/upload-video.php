<?php
        include_once('../config.php');
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["unique_id"]) && $_SESSION['user_type'] == 'admin') {
          $original_file_name = $_FILES["file"]["name"];
          $title = test_input($_POST['title']);
          $category = test_input($_POST['category']);
          $folderPath = '../Uploads/' . uniqid();
          $path = $folderPath . "-" . $_FILES["file"]["name"];
          $size_raw = $_FILES["file"]["size"];
          $size_as_mb = number_format(($size_raw / 1048576), 2);
          if(move_uploaded_file($_FILES["file"]["tmp_name"], $path)) {
            $sql = "INSERT INTO videos (path, title, category) VALUES ('$path', '$title', '$category')";
            if(mysqli_query($conn, $sql)) {
              $sql2 = "INSERT INTO notification (detail) VALUES ('Admin uploaded a video')";
               if(mysqli_query($conn, $sql2)) {
                     header('location: ./admin-page.php?msg=Upload file completed!');
               }
            } else {
              header('location: ./admin-page.php?msg=Failed to upload video!');
            }
          } else { 
             header('location: ./admin-page.php?msg=Failed to upload video!');
          }
        } else {
          header('location: ../');
        }
?>