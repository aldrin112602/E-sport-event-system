<?php
        include_once('../config.php');
        if(!isset($_SESSION['unique_id']) || !isset($_SESSION['user_type']) || $_SESSION['user_type'] == 'admin') {
        header('location: ../accountlogin.php');
        }
        //Get profile
        $sql = mysqli_query($conn, "SELECT * FROM users where unique_id = '{$_SESSION["unique_id"]}'");
        $row = mysqli_fetch_array($sql);
        $profile = $row['profile'];


        // Save votes
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $unique_id = $_POST['unique_id'];
            $vote = "";
            foreach ($_POST as $key => $value) {
                if($value != $unique_id) {
                $vote = $value;
                }
            }
            
            $sql = mysqli_query($conn, "SELECT * FROM poll WHERE unique_id = '$unique_id'");
            $row = mysqli_fetch_array($sql);
            $current_vote = $row['votes'];
            $current_vote .= $vote . ',';
            $users_id = explode(',', $row['users_id']);
            $current_users_id = $row['users_id'];
            $current_users_id .= $_SESSION['unique_id'].',';
            $x = false;
            for($i = 0; $i < count($users_id); $i++) {
                if($users_id[$i] == $_SESSION['unique_id']) {
                    $x = true;
                }
                if(!$x) {
                    $sql2 = "UPDATE poll SET votes = '$current_vote', users_id = '$current_users_id' WHERE unique_id = '$unique_id'";
                    if ($conn->query($sql2)) {
                      echo "<script> alert('You voted ".$vote."!'); </script>";
                    }
                } else {
                    echo "<script> alert('Sorry your vote can\'t be change!'); </script>";
                }
            }
        
        }

 ?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="../css/homepage.css">
    <script src="https://www.w3schools.com/lib/w3.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.2/axios.min.js" integrity="sha512-bHeT+z+n8rh9CKrSrbyfbINxu7gsBmSHlDCb3gUF1BjmjDzKhoKspyB71k0CIRBSjE5IVQiMMVBgCWjF60qsvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script type="text/javascript">
        (function() {
           emailjs.init('user_8RxhiBLflHRk3k7KJJmVI');
        })();
    </script>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
    * {
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
    }
    #msg-container {
    max-height: 400px;
   }

      
   .msg {
     display: flex;
     width: 100%;
     margin: 30px 0;
   }
   .incoming {
     align-items: flex-start;
     position: relative;
   }
   .incoming img {
     margin-bottom: 30px;
   }
   
   .incoming span {
     background: rgba(0,0,10,0.1);
     border-radius: 0 5px 5px 5px;
     padding: 5px 10px;
     max-width: 70%;
     margin-top: 30px;
     margin-left: 50px;
     color: #222;
   }
   #msg-container span {
     word-wrap: break-word;
   }
   .outgoing {
     align-items: flex-end;
     width: 100%;
     position: relative;
     flex-direction: column;
     justify-content: flex-end;
   }
  
   .incoming small {
     position: absolute;
     left: 50px;
     top: 10px;
   }
   .outgoing small {
     position: absolute;
     /* right: 50px; */
     top: 0;
   }
    .outgoing span {
     background: #5C6AFF;
     border-radius: 5px 0 5px 5px;
     padding: 5px 10px;
     max-width: 70%;
     margin-top: 20px;
     /* margin-right: 10px; */
     color: #fff;
   }
   #msg-container img {
     box-shadow: 1px 1px 5px #eee;
     height: 40px;
     width: 40px;
     border-radius: 50%;
     object-fit: cover;
   } 




         
            
       
    </style>
</head>

<body>
    <div class="header bg-dark">
        <div class="logo-container">
            <div class="logo">
                <div class="logo-img me-2 mb-2">
                    <img src="../img/logo.jpg" alt="" class="rounded-circle">
                </div>
                <h1 id="logo-txt" class="ms-2">EEMS</h1>
            </div>
        </div>
        <div class="search-container mb-3">
            <form action="">
                <input type="text" id="s" oninput="w3.filterHTML('#vid-con', 'div', this.value)" class="form-control" placeholder="Search">
            </form>
            <button onclick="w3.filterHTML('#vid-con', 'div', document.getElementById('s').value)" class="btn btn-primary ms-1 search">Search</i></button>
        </div>
        <div class="profile-container">
            <i class="bi bi-bell" id="liveToastBtn">
                <!-- INSERT THE TOTAL NUMBER OF NOTIFICATION AVAILABLE HERE -->
            </i>
            <div class="profile-box">
            <img class="rounded-circle overflow-hidden" src="<?php echo !empty($row['profile']) ? $row['profile'] : 'https://cdn150.picsart.com/upscale-245339439045212.png'; ?>" alt="Profile">
            </div>
        </div>
    </div>
    <div class="body-container">
        <div class="bg-dark sidebar border-top border-light">
            <div class="side-items mt-3">
                <a href="./homepage.php" class="sidebar-item fs-6 mt-3">
                    <i class="bi bi-house-door mb-2"></i>
                    Home
                </a>
                <!-- <a href="./edit-profile.php?id=<?php echo $_SESSION['unique_id']; ?>" class="sidebar-item fs-6 mt-2"> -->
                <a href="#" class="sidebar-item fs-6 mt-2" data-bs-toggle="modal" data-bs-target="#profile">
                    <i class="bi bi-person-circle mb-2"></i>
                    Profile
                </a>
                <a href="#" class="sidebar-item fs-6 mt-2" data-bs-toggle="modal" data-bs-target="#events">
                    <i class="bi bi-calendar3-event mb-2"></i>
                    Event Module
                </a>
                <a href="#" class="sidebar-item fs-6 mt-2" data-bs-toggle="modal" data-bs-target="#poll">
                    <i class="bi bi-1-circle mb-2"></i>
                    Voting Module
                </a>
                <a href="./quizzes-trivia.php" class="sidebar-item fs-6 mt-2">
                    <i class="bi bi-quora mb-2"></i>
                    Trivia Quiz
                </a>
                <a href="#" class="sidebar-item fs-6 mt-2"  data-bs-toggle="modal" data-bs-target="#ranking">
                    <i class="bi bi-trophy mb-2"></i>
                    Quiz Ranking
                </a>
                <a href="" class="sidebar-item fs-6 mt-2 text-light" data-bs-toggle="modal" data-bs-target="#livechat">
                    <i class="bi bi-chat mb-2"></i>
                    Live Chat
                </a>
                <a href="#" class="sidebar-item fs-6 mt-2" data-bs-toggle="modal" data-bs-target="#contact">
                    <i class="bi bi-send"></i>
                    Contact Us
                </a>
                <a href="../sign-out.php" class="sidebar-item fs-6 mt-2">
                    <i class="bi bi-box-arrow-in-left mb-2"></i>
                    Sign Out
                </a>
            </div>
        </div>
        <script>

            const select_category = function(value) {
                axios.get(`./filter-video.php?category=${value}`)
                .then(res => {
                    $("#vid-con").html(res.data);
                });
            }
            select_category('others');
               
            </script>
        <div class="content">
            <div class="bg-light border-bottom border-dark chips-wrapper">
                <div class="bg-primary chip border-0">
                    <form action="javascript:void(0)">
                        <button onclick="select_category('others')" class="bg-primary btnall" name="all">All</button>
                    </form>
                </div>
                <div class="chip bg-primary border-0">
                    <form action="javascript:void(0)">
                        <button onclick="select_category('ml')" class="btnml bg-primary" name="ml">Mobile Legends</button>
                    </form>
                </div>
                <div class="chip bg-primary border-0">
                    <form action="javascript:void(0)">
                        <button onclick="select_category('cod')" class="btncodm bg-primary" name="codm">Call of Duty Mobile</button>
                    </form>
                </div>
            </div>
            <!---- INSERT VIDEOA HERE ----->
            <div id="vid-con" class="video-container overflow-auto bg-light"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- START OF NOTIFICATION TOAST -->
    <div class="toast-container position-fixed top-0 end-0 mt-4">
        <div id="liveToast" class="toast mt-5" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <small><!--INSERT TIMESTAMP HERE-->About a minutes ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            
                <div class="toast-body" id="notif-con">
                    <!--INSERT THE NOTOFICATION CONTENT HERE -->
                </div>
            
        </div>
    </div>
    <!-- END OF NOTIFICATION TOAST -->

    <!-- START OF JAVASCRIPT OF TOAST -->
    <script>
        const toastTrigger = document.getElementById('liveToastBtn')
        const toastLiveExample = document.getElementById('liveToast')
        if (toastTrigger) {
            toastTrigger.addEventListener('click', () => {
                const toast = new bootstrap.Toast(toastLiveExample);
                toast.show();
            })
        }
    </script>
    <!-- END OF JAVASCRIPT OF TOAST -->

    <!-- START OF MODAL POLL-->
<div class="modal fade" id="poll" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Poll</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container overflow-hidden rounded p-4 bg-white border">
                        <!-- INSERT ALL THE AVAILABLE POLL HERE -->
                        <?php
                            $participants = 0;
                            $sql = "SELECT * FROM users WHERE user_type <> 'admin'";
                            if($result = mysqli_query($conn, $sql)) {
                                if(mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_array($result)){
                                       $participants++;
                                    } 
                                       mysqli_free_result($result);
                                }
                            }
                        ?>
                        <?php 
                            $sql = "SELECT * FROM poll WHERE enabled = 'true'";
                            if($result = mysqli_query($conn, $sql))
                            {
                            if(mysqli_num_rows($result) > 0) {
                            $poll = 0;
                                while($row = mysqli_fetch_array($result)){
                                $poll++;
                                $data_arr = explode(',', $row['data']);
                                echo '
                                        <div class="col-md  mb-4 m-3 rounded border p-4">
                                        <span><span class="fas fa-poll-h"></span>&nbsp;&nbsp;Poll</span>
                                        <button type="button" onclick="this.parentElement.style.display=\'none\';" class="btn btn-close float-end"></button>
                                        <form action="'. htmlspecialchars($_SERVER["PHP_SELF"]) .'" method="post">';
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
                                        echo '; z-index: -10; height: 100%; top: 0; left: 0;" class="position-absolute bg-success"></div>
                                          <input required type="radio" name="poll-'.$poll.'" value="'.$data_arr[$i].'"/>';
                                        echo '&nbsp;&nbsp;<label>'.$data_arr[$i].'</label>
                                           <small class="float-end">'.(100 / $participants) * $_match .'%</small>
                                          </div>';
                                        }
                                    }
                                    echo '
                                        <div class="d-grid mt-2">
                                         <input type="hidden" name="unique_id" value="'.$row['unique_id'].'">
                                         <button';
                                    //Disabled button or not
                                    $users_id = explode(',', $row['users_id']);
                                    $l = false;
                                    for($k = 0; $k < count($users_id); $k++) {
                                            if($users_id[$k] == $_SESSION['unique_id']) {
                                                $l = true;
                                            }
                                    }
                                    echo ' class="btn btn-block '.(($l) ? 'btn-light border' : 'btn-primary').'" type="'.(($l) ? 'button' : 'submit').'">'. (($l) ? 'Voted!' : 'Vote now') .'</button>
                                      </div>
                                     </form>
                                    </div>';
                                                }
                                                mysqli_free_result($result);
                                            }
                                        }
                        ?>
                    </div>
                </div>
                <div class="modal-footer ">
                    <div class="search-container d-grid mb-3">
                        <button class="btn btn-primary border ms-1 search" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF MODAL POLL-->

     <!-- START OF MODAL CHANGE PROFILE-->
     <div class="modal fade" id="profile" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    <!-- START OF MODAL EVENTS-->
    <div class="modal fade" id="events" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Events</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="events-con" class="container overflow-hidden rounded p-4 bg-white border">
                        <!-- INSERT ALL THE EVENTS POLL HERE -->
                    </div>
                </div>
                <div class="modal-footer ">
                    <div class="search-container d-grid mb-3">
                        <button class="btn btn-primary ms-1 search" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---- fetch events   --->
            <script>
                setInterval(() => {
                    axios.get('./fetch-events.php')
                    .then(res => {
                        $('#events-con').html(res.data);
                    })
                }, 1000)
            </script>
    <!-- END OF MODAL EVENTS-->

    <!-- START OF MODAL QUIZ RANKING-->
    <div class="modal fade" id="ranking"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Quiz Ranking</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="rank-con" class="container overflow-hidden rounded p-4 bg-white border">
                        <!-- INSERT ALL THE RANKS HERE -->
                    </div>
                </div>
                <div class="modal-footer ">
                    <div class="search-container d-grid mb-3">
                        <button class="btn btn-primary ms-1 search" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---- fetch ranks   --->
            <script>
                setInterval(() => {
                    axios.get('./quiz-ranking.php')
                    .then(res => {
                        $('#rank-con').html(res.data);
                    })
                }, 1000)
            </script>
    <!-- END OF QUIZ RANKNG EVENTS-->


    <!-- START OF MODAL LIVE CHAT-->
    <div class="modal fade" id="livechat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Live Chat</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="msg-container" class="container overflow-auto rounded p-4 bg-white border">
                        <!-- INSERT THE LIVE CHAT CONVERSATION HERE -->
                    </div>
                </div>
                <div class="modal-footer ">
                    <div class="search-container mb-3">
                        <form id="msg-form" action="javascript:void(0)">
                            <input name="message" id="msg" type="text" class="form-control border-secondary" placeholder="Type something!">
                        </form>
                        <button id="send-btn" class="btn btn-primary ms-1 search">Send</i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF MODAL LIVE CHAT-->
    <!-- START OF CONTACT US-->
    <div class="modal fade" id="contact" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Contact Us</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="ms" action="javascript:void(0)" class="ms form-control py-5 border-0">
                        <div class="form-floating ms-4 me-4">
                            <input type="text" class="form-control form-control-lg" name="name" placeholder="Name" id="floatingname">
                            <label for="floatingname">
                                Name
                            </label>
                        </div>
                        <div class="form-floating mt-2 ms-4 me-4">
                            <input type="text" class="form-control form-control-lg" name="email" placeholder="Email" id="floatingemail">
                            <label for="floatingemail">
                                Email
                            </label>
                        </div>
                        <div class="form-floating mt-2 ms-4 me-4">
                            <input type="text" class="form-control form-control-lg" name="subject" placeholder="Subject" id="floatingsubject">
                            <label for="floatingsubject">
                                Subject
                            </label>
                        </div>
                        <div class="form-floating mt-2 ms-4 me-4">
                            <input type="text" class="form-control form-control-lg" name="message" style="height: 100px;" placeholder="Message" id="floatingmessage">
                            <label for="floatingmessage">
                                Message
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer ">
                    <div class="search-container d-grid mb-3">
                        <button id="btn" class="btn btn-primary ms-1 search" type="submit">Submit</i></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <!-- END OF CONTACT-->
        <!-- SUBMIT CONTACT MESSAGE --> 
        <script>
            $(document).ready(() => {
                $('#btn').on('click', () => {
                    $('#btn').prop('disabled', true);
                    $('#floatingsubject').prop('disabled', true);
                    $('#floatingname').prop('disabled', true);
                    $('#floatingmessage').prop('disabled', true);
                    $('#floatingemail').prop('disabled', true);
                    $('#btn').html('Submitting..');

                    emailjs.send("service_25ik2al","template_ovpdrse",{
                        subject: $('#floatingsubject').val(),
                        name: $('#floatingname').val(),
                        message: $('#floatingmessage').val(),
                        email: $('#floatingemail').val()
                    })
                    
                    .then(res => {
                        alert('Your message submitted successfully, thank you for contacting us!');
                        $('#floatingsubject').prop('disabled', false);
                        $('#floatingname').prop('disabled', false);
                        $('#floatingmessage').prop('disabled', false);
                        $('#floatingemail').prop('disabled', false);
                        $('#btn').prop('disabled', false);
                        $('#btn').html('Submit');
                        $('#floatingsubject').val('');
                        $('#floatingname').val('');
                        $('#floatingmessage').val('');
                        $('#floatingemail').val('');
                    })
                    
                    .catch(err => {
                    alert(err);
                    $('#btn').prop('disabled', false);
                    });
                });

               // fetch messages 
               let initial = false;
               const fetchMessages = () => {
                    axios.get('../fetch-message.php')
                    .then(res => {
                        let e = document.getElementById('msg-container');
                        e.innerHTML = res.data;
                        if(!initial) {
                            e.scrollTop = e.scrollHeight;
                        }

                        setTimeout(() => {
                            initial = true;
                        }, 3000);
                        
                    });
                }
                fetchMessages();
                setInterval(fetchMessages, 2000);

                // Send message
                const sendMsg = function(ev) {
                    ev.preventDefault();
                    let e = document.getElementById('msg-container');
                    e.scrollTop = e.scrollHeight;
                    if($('#msg').val().length > 0) {
                        axios.post('../handle-message.php', $("#msg-form").serialize())
                        .then(res => {
                            fetchMessages();
                            $('#msg').val('');
                        })
                        .catch(err => {
                        alert('Send failed!');
                        });
                    }
                    
                    
                }
                $("#send-btn").on("click", sendMsg);
                $("#msg-form").on("submit", sendMsg);

                //fetch notifications
                axios.get("../fetch-notification.php")
                .then(res => {
                    $("#notif-con").html(res.data);
                });
                


            });
      </script>
</body>

</html>