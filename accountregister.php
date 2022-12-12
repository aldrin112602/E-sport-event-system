<?php
        include_once('./config.php');
        if (isset($_SESSION['unique_id']) && isset($_SESSION['user_type'])) {
            if ($_SESSION['user_type'] === 'admin') {
                header('location: ./admin/homepage.php');
            } else {
                header('location: ./users/homepage.php');
            }
        }
        $username = $email = $password = $confirm = $success_msg = $error_msg = "";
        $unique_id = md5(uniqid());
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = ($_POST["username"]);
            $email = ($_POST["email"]);
            $password = ($_POST["password"]);
            $confirm = ($_POST['confirm']);
            $emailcheck = mysqli_query($conn, "SELECT email FROM users where email = '{$email}'");
            $usernamecheck = mysqli_query($conn, "SELECT username FROM users where username = '{$username}'");

            if (empty($username && $email && $password)) {
                $error_msg = "All the fields are required.";
            } else if (strlen($password) < 6) {
                $error_msg = "Password must at least 6 characters!";
            } else if ($password !== $confirm) {
                $error_msg = "Confirm password did not match!";
            } else if (mysqli_num_rows($emailcheck) > 0) {
                $error_msg = "Email is already exist.";
            } else if (mysqli_num_rows($usernamecheck) > 0) {
                $error_msg = "Username is already exist.";
            } else {
                $error_msg = "";
                $user_type = 'user';
                $sql = "INSERT INTO users (username, email, password, user_type, unique_id) VALUES ('$username', '$email', '$password', '$user_type', '$unique_id')";
                $sql2 = "INSERT INTO quiz_score (unique_id, username) VALUES ('$unique_id', '$username')";
                if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
                    $success_msg = "Registered successfully!";
                    $_SESSION["unique_id"] = $unique_id;
                    $_SESSION["user_type"] = $user_type;
                    header('location: ./users/homepage.php');
                }
            }
        }
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="container p-5 m-auto">
        <div class="row justify-content-center align-items-center">
            <!--START OF REGISTER ACCOUNT -->
            <div class="col-lg-7">
                <div class="form-box register-form mt-3 border rounded bg-light">
                    <div class="form-title pt-5">
                        <h2 class="fw-bold text-center text-primary">
                            Register
                        </h2>
                    </div>
                    <form action="" method="POST">
                        <div class="form-floating mt-3 ms-4 me-4">
                          <?php
                                if(!empty($error_msg)) {
                                    echo '
                                    <div class="alert p-3 text-center alert-danger" role="alert"> 
                                        <b>'
                                        . $error_msg .
                                        '</b>
                                </div>';
                                } else if (!empty($success_msg)) {
                                    echo '
                                    <div class="alert p-3 text-center alert-success" role="alert"> 
                                        <b>'
                                        . $success_msg .
                                        '</b>
                                    </div>';
                                }
                            ?>
                        </div>
                        <div class="form-floating mt-3 ms-4 me-4">
                            <input required type="text" class="form-control form-control-lg" value="<?php echo $username; ?>" name="username" placeholder="Username" id="floatingUsername">
                            <label for="floatingUsername">Username</label>
                        </div>
                        <div class="form-floating mt-3 ms-4 me-4">
                            <input required type="email" class="form-control form-control-lg" value="<?php echo $email; ?>" name="email" placeholder="Email" id="floatingEmail">
                            <label for="floatingEmail">Email</label>
                        </div>
                        <div class="form-floating mt-3 ms-4 me-4">
                            <input required type="password" class="form-control form-control-lg" value="<?php echo $password; ?>" name="password" placeholder="Password" id="floatingPassword">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="form-floating mt-3 ms-4 me-4">
                            <input required type="password" class="form-control form-control-lg" value="<?php echo $confirm; ?>" name="confirm" placeholder="Confirm Password" id="floatingCPassword">
                            <label for="floatingCPassword">Confirm Password</label>
                        </div>
                        <div class="d-grid mt-3 ms-4 me-4">
                            <button class="btn btn-primary btn-lg mb-4" type="submit">Register</button>
                        </div>
                    </form>
                    <div class=" mb-5 flex text-center">
                        <span>
                            Already have an account?
                        </span>
                        <button class="p-0 border-0 bg-transparent text-primary">
                            <a href="accountlogin.php" class="text-decoration-none">
                                Login
                            </a>
                        </button>
                    </div>
                </div>
                <!--END OF REGISTER ACCOUNT -->
            </div>
        </div>
    </div>

</body>

</html>