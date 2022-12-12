<?php
include_once('./config.php');
if (isset($_SESSION['unique_id']) && isset($_SESSION['user_type'])) {
    if ($_SESSION['user_type'] === 'admin') {
        header('location: ./admin/admin-page.php');
    } else {
        header('location: ./users/homepage.php');
    }
}
$username = $password = $success_msg = $error_msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $sql = mysqli_query($conn, "SELECT * FROM users where username = '{$username}' and password = '{$password}'");
    $row = mysqli_fetch_array($sql);
    
    if (empty($username && $password)) {
        $error_msg = "Username and Password are required.";
    } else if ($row["username"] == $username && $row["password"] == $password) {
        $error_msg = "";
        $success_msg = "You're now Signed In!";
        $_SESSION["unique_id"] = $row['unique_id'];
        $_SESSION["user_type"] = $row["user_type"];
        if ($_SESSION['user_type'] === 'admin') {
            header('location: ./admin/admin-page.php');
        } else {
            header('location: ./users/homepage.php');
        }
    } else {
        $success_msg = "";
        $error_msg = "Invalid username or password!";
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
            <!--START OF LOGIN ACCOUNT -->
            <div class="col-lg-7">
                <div class="form-box register-form mt-3 border rounded bg-light">
                    <div class="form-title pt-5">
                        <h2 class="fw-bold text-center text-primary">
                            Login
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
                            <input type="text" class="form-control form-control-lg" value="<?php echo $username; ?>" name="username" placeholder="Username" id="floatingUsername">
                            <label for="floatingUsername">Username</label>
                        </div>
                        <div class="form-floating mt-3 ms-4 me-4">
                            <input type="password" class="form-control form-control-lg" value="<?php echo $password; ?>" name="password" placeholder="Password" id="floatingPassword">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="d-grid mt-3 ms-4 me-4">
                            <button class="btn btn-primary btn-lg mb-4" type="submit">Login</button>
                        </div>
                    </form>
                    <div class=" mb-5 flex text-center">
                        <span>
                            Don't have an account?
                        </span>
                        <button class="p-0 border-0 bg-transparent text-primary">
                            <a href="accountregister.php" class="text-decoration-none">
                                Register
                            </a>
                        </button>
                    </div>
                </div>
                <!--END OF LOGIN ACCOUNT -->
            </div>
        </div>
    </div>

</body>

</html>