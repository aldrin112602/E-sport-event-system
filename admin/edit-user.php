<?php 
  include_once('../config.php');
  
  if(isset($_SESSION['unique_id']) && isset($_SESSION['user_type'])) {
    if($_SESSION['user_type'] === 'user') {
      header('location: ../');
    }
  } else {
      header('location: ../');
  }
  $success_msg = "";

  $id = ($_SERVER['REQUEST_METHOD'] == "GET") ? $_GET['id'] : '';
  if($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['unique_id'];
    $username = test_input($_POST['username']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    if(strlen($password) < 6) {
        $error_msg = "Password must at least 6 characters!";
      } else {
        $sql = "UPDATE users SET username = '$username', email = '$email', password = '$password' WHERE unique_id = '$id'";  
         if($conn->query($sql)) {
           $success_msg = "User updated successfully!";
           echo "<script>
                   setTimeout(() => {
                     location.href = '../';
                   }, 000);
                </script>";
         } else {
           $error_msg = "Failed to update user!";
         }
      }
  }
  
  if(empty($id)) {
    header('location: ../');
  }
  $sql = mysqli_query($conn, "SELECT * FROM users where unique_id = '{$id}'");
      $row = mysqli_fetch_array($sql);
      if($row["unique_id"] != $id) {
        header('location: ../');
      }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../res/bootstrap@5.0.0-alpha2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <style>
      body {
        background: linear-gradient(purple, blue);
        background-repeat: no-repeat;
        height: 100vh;
      }
      @media(min-width: 600px) {
        body {
          display: flex;
          align-items: center;
          justify-content: center;
        }
      }
      label, #a, .btn, p {
        font-size: 14px;
      }
      img {
        height: 200px;
        object-fit: cover;
      }
    </style>
</head>
<body>
  
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="container bg-white border rounded py-5">
    <a href="../" class="nav-link"><span style="font-size: 25px" class="ml-1 fa fa-arrow-left text-primary"></span></a>
    
        <h2 class="fw-bold mt-5 mx-3 text-dark">Edit user</h2>
          <!-- Username input -->
          <div class="form-outline mt-1 mb-1 position-relative">
            <label class="form-label">Username</label>
            <input value="<?php echo $row['username']; ?>" required type="text" autofocus name="username" class="form-control pl-4 form-control-lg" />
            <i class="fas fa-user"></i>
          </div>
          <!-- Email input -->
          <div class="form-outline mt-1 mb-1 position-relative">
            <label class="form-label">Email address</label>
            <input value="<?php echo $row['email']; ?>" required type="email" name="email" class="form-control pl-4 form-control-lg" />
            <i class="fas fa-at"></i>
          </div>
          <!-- Password input -->
          <div class="form-outline position-relative mb-2">
            <label class="form-label">Password</label>
            <input value="<?php echo $row['password']; ?>" id="pswd" required type="password" name="password" class="form-control form-control-lg pl-4" />
            <i class="fas fa-unlock-alt"></i>
            <i id="eye" onclick="showHide()" class="fa fa-eye-slash"></i>
          </div>
          <input value="<?php echo $id; ?>" type="hidden" name="unique_id">
          <?php
             if(!empty($error_msg)) {
               echo '
                <div class="alert p-1 text-center alert-danger" role="alert"> 
                    <small>'
                    . $error_msg .
                    '</small>
                </div>';
             } else if(!empty($success_msg)) {
               echo '
                <div class="alert p-1 text-center alert-success" role="alert"> 
                    <small>'. $success_msg .'</small>
                </div>';
             }
          ?>
          <!-- Submit button -->
          <button type="submit" class="btn btn-lg btn-success mt-3 btn-block">Update user</button>
     
            </form>

<script src="../show-hide-password.js"></script>
</body>
</html>
