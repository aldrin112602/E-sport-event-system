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
  $data = "";
  $unique_id = $_GET['id'];
  if($_SERVER['REQUEST_METHOD'] == "POST") {
    $unique_id = $_POST['unique_id'];
    foreach($_POST as $key => $value) {
      $val = str_replace(',', '&comma;', trim($value));
      $data .= $val.', ';
    }
    $data = test_input($data);
    $un_id = md5(uniqid());
    //Save poll
    $sql = "INSERT INTO poll (data, unique_id, enabled) VALUES ('$data', '$un_id', 'true')";
    if(mysqli_query($conn, $sql)) {
      $sql2 = "INSERT INTO notification (detail) VALUES ('Admin created a poll')";
      if(mysqli_query($conn, $sql2)) {
            header('location: ./admin-page.php?msg=Poll created successfully!');
      }
    } else {
      $error_msg = "Failed to create poll!";
    }
  }
  
  if(empty($unique_id)) {
    header('location: ../');
  }
  $sql = mysqli_query($conn, "SELECT * FROM users where unique_id = '{$unique_id}'");
      $row = mysqli_fetch_array($sql);
      if($row["unique_id"] != $unique_id) {
        header('location: ../');
      }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Poll</title>
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
    </style>
</head>
<body>
  <section>
  <div class="container bg-white border rounded py-5 h-100">
    <a href="../" class="nav-link"><span style="font-size: 25px" class="ml-1 fa fa-arrow-left text-primary"></span></a>
    <div class="row d-flex py-5 align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img class="img-fluid" src="../res/undraw_Segment_analysis_re_ocsl.png" alt=""/>
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <h2 class="fw-bold mt-5 mx-3 text-dark">Create poll</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="px-3" method="post">
          <!-- title input -->
          <div class="form-outline mt-1 mb-1 position-relative">
            <textarea required autofocus placeholder="What's your poll about?" name="title" class="form-control pl-4 form-control-lg"></textarea>
            <input value="<?php echo $unique_id; ?>" type="hidden" name="unique_id">
          </div>
          <div id="option-con" class="form-outline mt-4 mb-1">
            <input name="option-1" required class="form-control pl-4 form-control-lg" type="text" placeholder="Options"/>
          </div> 
          <div class="form-outline mt-1 mb-1">
            <button id="add-btn" type="button" class="btn border btn-light mt-3 btn-lg btn-block">Add option</button>
            <script>
              $(document).ready(() => {
                let i = 1
                $('#add-btn').on('click', () => {
                  i++;
                  let input = `<div class="position-relative"><input name="option-${i}" required class="form-control mt-4 pl-4 form-control-md" type="text" placeholder="Options"/>
                  <button onclick="this.parentElement.style.display = 'none';" type="button" class="btn btn-close position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);"></button>
                  </div>`;
                  $('#option-con').append(input);
                })
              })
            </script>
          </div> 
          <?php
             if(!empty($error_msg)) {
               echo '
                <div class="alert p-1 mt-1 text-center alert-danger" role="alert"> 
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
          <button type="submit" class="btn btn-primary mt-3 btn-lg btn-block">Create poll</button>
        </form>
      </div>
    </div>
  </div>
</section>
</body>
</html>
