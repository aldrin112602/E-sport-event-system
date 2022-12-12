<?php
include_once('../config.php');
 if(!isset($_SESSION['unique_id']) && !isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'admin') {
   header('location: ../');
 }
 $sql = mysqli_query($conn, "SELECT * FROM users where unique_id = '{$_SESSION['unique_id']}' and user_type = '{$_SESSION['user_type']}'");
 $row = mysqli_fetch_array($sql);
 if($row["unique_id"] == $_SESSION['unique_id'] && $row["user_type"] == $_SESSION['user_type']) {
   $_SESSION['username'] = $row['username'];
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../res/bootstrap@5.0.0-alpha2.min.css"> 
    <link rel="stylesheet" href="../res/chartist.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 90px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            z-index: 99;
        }

        @media (max-width: 767.98px) {
            .sidebar {
                top: 11.5rem;
                padding: 0;
            }
            #main {
               margin-top: 175px;
            }
        }

        .navbar {
            box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .1);
        }

        @media (min-width: 767.98px) {
            .navbar {
                top: 0;
                position: sticky;
                z-index: 999;
                width: 100%;
            }
        }
        
        @media (max-width: 767.98px) {
            .navbar {
                top: 0;
                position: fixed;
                z-index: 999;
                width: 100%;
            }
            #rr {
              margin: 0;
              padding: 0;
              width: 100%;
            }
        }
        .sidebar .nav-link {
            color: #333;
        }

        .sidebar .nav-link.active {
            color: #0d6efd;
        }
        label, th, td, #a, .btn, p {
             font-size: 14px;
        }
    </style>
    <script>
    function edit_user(id) {
      const url = `./edit-user.php?id=${id}`;
      location.href = url;
    }
    function delete_user(id, username) {
      const isDel = confirm('Are you sure you want to delete ' + username + ' ?');
      if(isDel) {
        const url = `./delete-user.php?id=${id}`;
        location.href = url;
      }
    }
    </script>
</head>
<body>
    <nav class="navbar navbar-light bg-light p-3">
        <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
            <a class="navbar-brand" href="#">
                Admin Dashboard
            </a>
            <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
            
            <div class="dropdown">
                <button class="btn btn-primary border dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                  Welcome, <?php echo $_SESSION['username']; ?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <li><a class="dropdown-item" href="../live-chat.php">
                    <span class="fas fa-comments"></span>&nbsp;&nbsp;Live chat</a></li>
                  <hr>
                  <li><a class="dropdown-item" href="../sign-out.php"><span class="fas fa-sign-out"></span>&nbsp;&nbsp;Sign out</a></li>
                </ul>
              </div>
        </div>
    </nav>
    <div id="main" class="container-fluid">
        <div class="row" id="rr">
            <nav id="sidebar" class="col-md-3 col-lg-2 border d-md-block bg-light sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            <span class="ml-2">Dashboard</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#users">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            <span class="ml-2">Users</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#profile">
                            <span style="font-size: 20px" class="fas fa-user-edit text-dark"></span>
                            <span class="ml-2">Edit profile</span></span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="./create-poll.php?id=<?php echo $_SESSION['unique_id']; ?>">
                            <span style="font-size: 20px" class="fas fa-poll-h text-dark"></span>
                            <span class="ml-3">Create poll</span></span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                           <span style="font-size: 20px" class="fas fa-upload text-dark"></span>&nbsp;&nbsp;
                               Upload video
                          </a>
                        </li>
                       <li class="nav-item">
                          <a class="nav-link" href="#videos">
                            <span style="font-size: 20px" class="fas fa-video-camera text-dark"></span>
                            <span class="ml-2">Videos</span></span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#ranking">
                            <span style="font-size: 20px" class="fas fa-trophy text-dark"></span>
                            <span class="ml-2">Quiz Leaderboard</span></span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="./manage-event.php?id=<?php echo $_SESSION['unique_id']; ?>" class="nav-link">
                            <span class="fas fa-calendar"></span>
                            <span class="ml-3">Create Event</span></span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="#myChart" class="nav-link">
                            <span class="fas fa-bar-chart"></span>
                            <span class="ml-3">Report</span></span>
                          </a>
                        </li>
                      </ul>
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#users">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Overview</li>
                    </ol>
                </nav>
                <div class="row">
                    <div id="users" class="ontainer-fluid mb-4">
                        <div class="container-fluid">
                            <h5 class="card-header">Registered users</h5>
                            <div class="card-body">
                                <div class="table-responsive" style="width: 100%;">
                                    <table class="table table-striped">
                                        <thead>
                                          <tr>
                                            <th scope="col">Username</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Password</th>
                                            <th scope="col">Profile</th>
                                            <th scope="col">Edit</th>
                                            <th>Delete</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                              $sql = "SELECT * FROM users";
                                              if($result = mysqli_query($conn, $sql)) {
                                               if(mysqli_num_rows($result) > 0) {
                                                  while($row = mysqli_fetch_array($result)) {
                                                    if($row['unique_id'] != $_SESSION['unique_id']) {
                                                      echo '<tr><td>'.$row['username'].'</td><td>'.$row['email'].'</td><td>'.$row['password'].'</td><td><img class="rounded-circle border" height="50px" width="50px" src="'. (!empty($row['profile']) ? $row['profile'] : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZE6Kl_u2cYdgSqclEF85VVC8nAHAsR_mwTw&usqp=CAU') .'"/></td><td><button class="btn btn-sm btn-success" onclick="edit_user(\''.$row['unique_id'].'\')">Edit</button></td><td><button class="btn btn-sm btn-danger" onclick="delete_user(\''.$row['unique_id'].'\', \''.$row['username'].'\')">Delete</button></td></tr>';
                                                    }
                                                  }
                                                  mysqli_free_result($result);     
                                               }
                                              }
                                          ?>
                                        </tbody>
                                      </table>
                                </div>
                                <a href="#" class="btn btn-block btn-light">View all</a>
                            </div>
                        </div>               
                      </div>
                      <div id="ranking" style="" class="my-5 border bg-light p-5 px-4 container-fluid">
                      <h4>Quiz Leaderboard league</h4>
                      <?php
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
                                      <img src="'. (!empty($row['profile']) ? $row['profile'] : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZE6Kl_u2cYdgSqclEF85VVC8nAHAsR_mwTw&usqp=CAU') .'" height="50px" width="50px" alt="profile" class="rounded-circle"/>&nbsp;
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
                      ?> 
                      </div>

                      <div id="poll" class="my-5 row px-4">
                          <?php
                            $participants = 0;
                            $sql = "SELECT * FROM users WHERE user_type <> 'admin'";
                            if($result = mysqli_query($conn, $sql)) {
                            if(mysqli_num_rows($result) > 0) {
                              while($row = mysqli_fetch_array($result)){
                              $participants++;
                              } mysqli_free_result($result);
                            }
                            }
                      
                        $sql = "SELECT * FROM poll";
                        if($result = mysqli_query($conn, $sql)) {
                        if(mysqli_num_rows($result) > 0) {
                            $poll = 0;
                            while($row = mysqli_fetch_array($result)){
                              $poll++;
                              $data_arr = explode(',', $row['data']);
                              echo '
                                  <div class="col-lg border-success mb-4 mt-3 mx-3 rounded border p-4">
                                    <span><span class="fas fa-poll-h"></span>&nbsp;&nbsp;Poll</span>
                                  <div class="form-check float-end d-inline-block form-switch">
                                    <input onclick="enable(this.checked, \''.$row['unique_id'].'\')" class="form-check-input" type="checkbox"'.(($row['enabled'] == 'true') ? 'checked' : '').' role="switch" id="flexSwitchCheckDefault" />
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Enable/Disable</label>
                                  </div>
                                    ';
                              for($i = 0; $i < (count($data_arr) - 1); $i++) {
                                if($i == 0) {
                                  if(strlen($data_arr[$i] > 30)){
                                    echo '<h6 class="mt-3">'. $data_arr[$i] .'</h6>';
                                  } 
                                  else {
                                  echo '<h3 class="mt-3">'. $data_arr[$i] .'</h3>';
                                  }
                                }
                                if($i > 1) {
                                  echo '<div class="px-2 pt-1 overflow-hidden position-relative my-3 border rounded">
                                       <div style="width:'; 
                                  $votes = explode(',', $row['votes']);
                                  $_match = 0;
                                  for($j = 0; $j < count($votes); $j++) {
                                    if($votes[$j] == $data_arr[$i]) {
                                      $_match++;
                                    }
                                  }
                                  echo (100 / $participants) * $_match . '%';
                                  echo '; z-index: -10; height: 100%; top: 0; left: 0;" class="position-absolute bg-success"></div>&nbsp;&nbsp;<label>'.$data_arr[$i].'</label>
                                  <small class="float-end">'.(100 / $participants) * $_match .'%</small>
                                  </div>';
                                }
                              }
                            echo '
                            <div class="d-grid">
                            <button onclick="delete_poll(\''.$row['unique_id'].'\')" class="btn d-block btn btn-danger">Delete poll</button></div>
                            </div>';
                            }
                            mysqli_free_result($result);
                        }
                      }
                      ?>
                    </div>
                    <script>
                      function enable(isEn, id) {
                        let xhr = new XMLHttpRequest();
                        let data = new URLSearchParams();
                        xhr.onload = function() {
                          alert(xhr.response);
                        }
                        data.append('enable', isEn)
                        data.append('id', id)
                        
                        xhr.open('POST', './handle-poll.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.send(data);
                      }
                    </script>

                    <div id="videos" class="">
                        <h4 class="">Uploaded videos</h4>
                        <div class=" row justify-content-center">
                              <?php
                                $sql = "SELECT * FROM videos ORDER BY id DESC";
                                if($result = mysqli_query($conn, $sql)) {
                                  if(mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_array($result))
                                    { 
                                      echo '
                                      <div class=" p-3 m-2 border col-6 col-md-4">
                                      
                                      <h5 class="pt-3">'.$row['title'].'</h5>
                                      <small>Uploaded on '.$row['date'].'<br>
                                      Category: '.$row['category'].'
                                      </small>
                                      <video width="100%" height="auto" controls>
                                            <source src="'.$row['path'].'" type="video/mp4">
                                            <source src="'.$row['path'].'" type="video/ogg">
                                            Your browser does not support the video tag.
                                    </video>
                                    <div class="d-grid pb-3">
                                        <button onclick="delete_video('.$row['id'].')" class="btn btn-block btn-danger">Delete video</button>
                                        </div>
                                      </div>
                                      ';
                                    }
                                    mysqli_free_result($result);
                                  }
                                }
                              ?>
                           
                        </div>
                    </div>

                    <div id="event" class="mt-5 px-4 container-fluid">
                          <h2>Your Events</h2>
                          <div class="row">
                    <?php
                    $sql = "SELECT * FROM event ORDER BY id DESC";
                      if($result = mysqli_query($conn, $sql)) {
                        if(mysqli_num_rows($result) > 0) {
                          $id = 0;
                          while($row = mysqli_fetch_array($result)){
                          $id++;
                            echo '
                            <div style="background-image: linear-gradient(-45deg, rgba(100,100,50,0.2), rgba(0,0,255, 0.1))" class="my-3 mr-3 text-dark border pt-5 pb-2 rounded col-lg position-relative">
                              <small><strong>Date: </strong>'.$row['start_date'].' at '.$row['start_time'].'</small><br>
                              <button onclick="this.parentElement.style.display=\'none\';" style="top: 10px;right: 10px;" class="btn btn-close bg-white position-absolute"></button>
                              <h4>Event title: '.$row['event_name'].'</h4>
                              <small class=""> Description: '.$row['description'].'</small><br><br>
                              <div class="d-grid pb-3">
                              <button onclick="delete_event('.$row['id'].')" class="btn btn-block btn-danger">Delete event</button>
                              </div>
                            </div>
                            ';
                          }
                        mysqli_free_result($result); 
                        }
                      }
                    ?>
                </div>
              </div>
              <div id="event" class="mt-5 px-4 container-fluid">
                <h5>Report</h5>
                <canvas id="myChart"></canvas>
                </div>
                <script>
                  const labels = [
                    'January',
                    'February',
                    'March',
                    'April',
                    'May',
                    'June',
                  ];

                  const data = {
                    labels: labels,
                    datasets: [{
                      label: 'Dataset report',
                      backgroundColor: 'rgb(255, 99, 132)',
                      borderColor: 'rgb(255, 99, 132)',
                      data: [0, 10, 5, 2, 20, 30, 45],
                    }]
                  };

                  const config = {
                    type: 'line',
                    data: data,
                    options: {}
                  };
         
                  const myChart = new Chart(
                    document.getElementById('myChart'),
                    config
                  );
                
                  function delete_event(id) {
                    let con = confirm("Are you sure to delete event?");
                    if(con) {
                      location.href = './delete-event.php?id=' + id;
                    }
                  }
                  function delete_video(id) {
                    let con = confirm("Are you sure to delete video?");
                    if(con) {
                      location.href = './delete-video.php?id=' + id;
                    }
                  }
                </script>
                <!-- START OF MODAL CHANGE PROFILE-->
                <div class="modal fade" id="profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM users where unique_id = '{$_SESSION['unique_id']}'");
                        $row = mysqli_fetch_array($sql);
                        if($row["unique_id"] != $_SESSION['unique_id']) {
                          header('location: ../');
                        } else {
                            $_SESSION['profile'] = $row['profile'];
                        }    
                    ?>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Change profile</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="container overflow-hidden rounded p-4 bg-white border" action="./change-profile.php" enctype="multipart/form-data" method="POST">
                                    <!-- INSERT ALL INPUTS HERE -->
                                    <div class="form-floating mt-3 ms-4 me-4">
                                        <input required type="text" class="form-control form-control-lg" value="<?php echo $row['username']; ?>" name="username" placeholder="Username" id="floatingUsername">
                                        <label for="floatingUsername">Username</label>
                                    </div>
                                    <div class="form-floating mt-3 ms-4 me-4">
                                        <input required type="email" class="form-control form-control-lg" value="<?php echo $row['email']; ?>" name="email" placeholder="Email" id="floatingEmail">
                                        <label for="floatingEmail">Email</label>
                                    </div>
                                    <div class="form-floating mt-3 ms-4 me-4">
                                        <input required type="password" class="form-control form-control-lg" value="<?php echo $row['password']; ?>" name="password" placeholder="Password" id="floatingPassword">
                                        <label for="floatingPassword">Password</label>
                                    </div>
                                    <div class="form-floating pb-1 mt-3 ms-4 me-4">
                                        <input value="<?php echo $_SESSION['unique_id']; ?>" type="hidden" name="unique_id">
                                        <input accept="image/*" required type="file" class="form-control form-control-lg mb-1" name="file" id="floatingFile">
                                        <label for="floatingFile">Choose photo</label>
                                    </div>
                                    <div class="d-grid mt-3 ms-4 me-4">
                                        <button class="btn btn-primary btn-lg mb-4" type="submit">Change profile</button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer ">
                                <div class="search-container d-grid mb-3">
                                    <button class="btn btn-light border ms-1 search" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  <!-- END OF MODAL CHANGE PROFILE-->
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><span class="fas fa-upload"></span>&nbsp;&nbsp;Upload video</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="upload-video.php" enctype="multipart/form-data" method="POST">
                            <label class="mt-3">Choose mp4 file to upload</label>
                            <input name="file" required id="file" type="file" accept="video/*" class="form-control">
                            <label class="mt-3">Category</label>
                            
                            <select class="form-select" name="category">
                              <option value="ml">Mobile Legend</option>
                              <option value="cod">Call of Duty Mobile</option>
                              <option value="others">Others</option>
                            </select>
                            
                            <label class="mt-3">Write something about your video</label>
                            <textarea name="title" placeholder="Write something.." required class="form-control"></textarea>
                        </div>
                        <div class="modal-footer">
                          <button data-bs-dismiss="modal" type="button" class="btn btn-light border">Cancel</button>
                          <button id="upload-btn" type="submit" class="btn btn-primary">Upload video</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </main>
        </div>
    </div>
    <?php
      if(!empty($_GET['msg'])) {
        echo '
        <div id="msg" class="toast show fixed-top m-2">
           <div class="toast-header d-flex align-items-center justify-content-between">
               Message
             <button onclick="document.getElementById(\'msg\').style.display=\'none\';" type="button" class="btn-close" data-bs-dismiss="toast"></button>
           </div>
        <div class="toast-body">
           '.$_GET['msg'].'
        </div>
       </div>';
   echo '
     <script>
      setTimeout(function() {
          var query = window.location.search.substring(1)
      
          if(query.length) {
             if(window.history != undefined && window.history.pushState != undefined) {
                  window.history.pushState({}, document.title, window.location.pathname);
             }
          } 
      
          window.location.reload(); 
     }, 5000);
    </script>
       ';
    }
      
    ?>
    <script src="../show-hide-password.js"></script>
     <script>
       function delete_poll(id) {
         let con = confirm('Are you sure to delete poll?')
         if(con) {
           location.href = './delete-poll.php?id=' + id;
         }
       }
     </script>
</body>
</html>
