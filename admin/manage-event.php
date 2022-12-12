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
    $event_name = test_input($_POST['event_name']);
    $date = $_POST["date"];
    $time = $_POST["time"];
    $description = test_input($_POST["description"]);
    //save to table db
    $sql = "INSERT INTO event(event_name, start_date, start_time, description) VALUES('$event_name', '$date', '$time', '$description')";
    if(mysqli_query($conn, $sql)) {
      $sql2 = "INSERT INTO notification (detail) VALUES ('Admin created an event')";
      if(mysqli_query($conn, $sql2)) {
              $success_msg = "Event successfully created!";
                echo "<script>
                      setTimeout(() => {
                        location.href = './admin-page.php?msg=Event successfully created!';
                      }, 3000);
                </script>";
      }
    } else {
      $error_msg = "Something went wrong, unable to create event!";
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
    <title>Create Event</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../res/bootstrap@5.0.0-alpha2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <img class="img-fluid" src="../res/undraw_special_event_4aj8.png" alt="especial-event"/>
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <h2 class="fw-bold mt-5 mx-3 text-dark">Create Event</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="px-3" method="post">
          <!-- event name input -->
          <div class="form-outline mt-1 mb-1 position-relative">
            <label class="form-label"><b>Event name</b></label>
            <input required type="text" autofocus name="event_name" class="form-control pl-4 form-control-md" />
          </div>
          <!-- date input -->
          <div class="form-outline mt-3 mb-1 position-relative">
            <label class="form-label"><b>Start Date</b></label>
            <input required type="date" name="date" class="form-control pl-4 form-control-md" />
          </div>
          
           <!-- time input -->
           <div class="form-outline mt-3 mb-1 position-relative">
             <label class="form-label"><b>Start time</b></label>
             <input required type="time" name="time" class="form-control pl-4 form-control-md" />
           </div>
          
          <!--Description input -->
          <div class="form-outline mt-3 mb-2">
            <label class="form-label"><b>Description</b></label>
            <textarea value="" name="description" class="form-control form-control-md pl-4"></textarea>
            <small>
             Description provide more information about your event so guests what to expect.
            </small>
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
          <button type="submit" class="btn btn-primary mt-3 btn-md btn-block">Create Event</button>
        </form>
      </div>
    </div>
  </div>
</section>
</body>
</html>
