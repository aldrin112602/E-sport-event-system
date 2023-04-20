<?php
include_once('./config.php');
if (isset($_SESSION['unique_id']) && isset($_SESSION['user_type'])) {
    if ($_SESSION['user_type'] === 'admin') {
        header('location: ./admin/admin-page.php');
    } else {
        header('location: ./users/homepage.php');
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>LandingPage</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <style>
        img {
            object-fit: cover;
        }
    </style>
</head>

<body>
    <!-- START OF HEADER NAVIGATION -->
    <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-primary">
        <div class="container">
            <a href="index.php" class="navbar-brand mb-0 h1">
                <img src="img/sun.png" width="30px" height="30px" />
                EEMS
            </a>
            <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#home">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">
                            Features
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#team">
                            Team
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#aboutus">
                            About Us
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END OF HEADER NAVIGATION -->

    <!-- START OF THE HOME CONTENT -->
    <section class="bg-dark text-light p-5 text-sm-start" id="home">
        <div class="conatiner py-5">
            <div class="d-md-flex align-items-center justify-content-between py-5">
                <div class="col-lg-6 ms-5 mb-5">
                    <h2 class="text-light">
                        <span>E-Sports Event Management System</span>
                    </h2>
                    <h5 class="my-4 text-light">
                        Watch E-Sports Tournament that Happening in Morong, Rizal.
                        You can also answer some of the questions
                        we prepared to widen your knowledge about E-Sports.
                    </h5>
                    <button class="btn btn-primary mt-3">
                        <a class="text-decoration-none text-light" href="accountregister.php">
                            Register now
                        </a>
                    </button>
                    <button class="btn btn-light mt-3">
                        <a class="text-decoration-none" href="accountlogin.php">
                            Sign In now
                        </a>
                    </button>
                </div>
                <div class="col-lg-4 me-5">
                    <a href="#">
                        <img src="img/phone.png" class="img-fluid" width="600">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF THE HOME CONTENT -->

    <!-- START OF THE FEATURES CONTENT -->
    <section class="p-5" id="features">
        <div class="container py-5">
            <p class="text-dark fw-bold fs-4 text-center">
                Check our Features
            </p>
            <div class="row text-center g-4">
                <div class="col-lg-4">
                    <div class="card bg-dark text-light p-5">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
                                    <path d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z" />
                                </svg>
                            </div>
                            <h3 class="card-title mb-3">
                                Graph
                            </h3>
                            <p class="card-text">
                            Graphs are used to improve the efficiency of data and to reveal its hidden capabilities. Graphs can help the admin of the system learn how data is related to one another. Apart from that, it offers an effective approach for expressing and comparing large data sets.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-dark text-light p-5">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-quora" viewBox="0 0 16 16">
                                    <path d="M8.73 12.476c-.554-1.091-1.204-2.193-2.473-2.193-.242 0-.484.04-.707.142l-.43-.863c.525-.45 1.373-.808 2.464-.808 1.697 0 2.568.818 3.26 1.86.41-.89.605-2.093.605-3.584 0-3.724-1.165-5.636-3.885-5.636-2.68 0-3.839 1.912-3.839 5.636 0 3.704 1.159 5.596 3.84 5.596.425 0 .811-.046 1.166-.15Zm.665 1.3a7.127 7.127 0 0 1-1.83.244C3.994 14.02.5 11.172.5 7.03.5 2.849 3.995 0 7.564 0c3.63 0 7.09 2.828 7.09 7.03 0 2.337-1.09 4.236-2.675 5.464.512.767 1.04 1.277 1.773 1.277.802 0 1.125-.62 1.179-1.105h1.043c.061.647-.262 3.334-3.178 3.334-1.767 0-2.7-1.024-3.4-2.224Z" />
                                </svg>
                            </div>
                            <h3 class="card-title mb-3">
                                Trivia Quizez
                            </h3>
                            <p class="card-text">
                            With this feature of the system, the user can answer trivia quizzes to increase their knowledge about e-sports. Trivia tests have been shown to have significant cognitive benefits, according to science. 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-dark text-light p-5">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-trophy" viewBox="0 0 16 16">
                                    <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935zM3.504 1c.007.517.026 1.006.056 1.469.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.501.501 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667.03-.463.049-.952.056-1.469H3.504z" />
                                </svg>
                            </div>
                            <h3 class="card-title mb-3">
                                Quiz Ranking
                            </h3>
                            <p class="card-text">
                            There's a Rankings quiz for everyone. Users that take quiz will be display.

                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-dark text-light p-5">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                                    <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                </svg>
                            </div>
                            <h3 class="card-title mb-3">
                                Event Module
                            </h3>
                            <p class="card-text">
                            The system will allow the admin to upload highlighted videos, manage player information, and manage voting and event modules. 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-dark text-light p-5">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-1-circle" viewBox="0 0 16 16">
                                    <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8Zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM9.283 4.002V12H7.971V5.338h-.065L6.072 6.656V5.385l1.899-1.383h1.312Z" />
                                </svg>
                            </div>
                            <h3 class="card-title mb-3">
                                Voting Module
                            </h3>
                            <p class="card-text">
                            The proposed system is useful for identifying trending e-sports games in Morong using the voting module and can help e-sports organizers manage the announcement of events and schedules using the event module.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-dark text-light p-5">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-cast" viewBox="0 0 16 16">
                                    <path d="m7.646 9.354-3.792 3.792a.5.5 0 0 0 .353.854h7.586a.5.5 0 0 0 .354-.854L8.354 9.354a.5.5 0 0 0-.708 0z" />
                                    <path d="M11.414 11H14.5a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.5-.5h-13a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .5.5h3.086l-1 1H1.5A1.5 1.5 0 0 1 0 10.5v-7A1.5 1.5 0 0 1 1.5 2h13A1.5 1.5 0 0 1 16 3.5v7a1.5 1.5 0 0 1-1.5 1.5h-2.086l-1-1z" />
                                </svg>
                            </div>
                            <h3 class="card-title mb-3">
                                Watch Videos
                            </h3>
                            <p class="card-text">
                            User can watch highlighted videos, vote, when there's voting takes place, and play trivia quizzes to gain more knowledge about esports. The user will be notified of everything posted by the admin.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF THE FEATURES CONTENT -->

    <!-- START OF THE TEAM CONTENT -->
    <section class="bg-primary text-light p-5 text-center text-sm-start" id="team">
        <div class="container py-5">
            <p class="text-light fw-bold fs-4 text-center">
                Our Great Team
            </p>
            <div class="row text-center g-4">
                <div class="col-lg-4">
                    <div class="card bg-dark text-light p-5">
                        <div class="card-body text-center">
                            <div class="mb-5">
                                <img src="img/team-1.png" width="150px" height="150px">
                            </div>
                            <h4 class="card-title fs-5">
                                Caballero, Aldrin E.
                            </h4>
                            <span>
                                Full-Stack Web Developer
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-dark text-light p-5">
                        <div class="card-body text-center">
                            <div class="mb-5">
                                <img src="img/team-2.jpg" width="150px" height="150px">
                            </div>
                            <h4 class="card-title fs-5">
                            Vargas, Regine C. 
                            </h4>
                            <span>
                                Graphics Designer
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-dark text-light p-5">
                        <div class="card-body text-center">
                            <div class="mb-5">
                                <img src="img/team-3.jpg" width="150px" height="150px">
                            </div>
                            <h4 class="card-title fs-5">
                            Bolivar, Lea Jane
                            </h4>
                            <span>
                                System Analyst
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-dark text-light p-5">
                        <div class="card-body text-center">
                            <div class="mb-5">
                                <img src="img/team-4.jpg" width="150px" height="150px">
                            </div>
                            <h4 class="card-title fs-5">
                            Legarda, James Alger T.
                            </h4>
                            <span>
                                Front-End Web Developer
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-dark text-light p-5">
                        <div class="card-body text-center">
                            <div class="mb-5">
                                <img src="img/team-5.jpg" width="150px" height="150px">
                            </div>
                            <h4 class="card-title fs-5">
                            Cordial, Arlene Kim V.
                            </h4>
                            <span>
                                Database Administrator
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END OF THE TEAM CONTENT -->

    <!-- START OF ABOUT US -->
    <footer class="page-footer p-5 text-md-left" id="aboutus">
        <div class="container py-5">
            <div class="row g-3">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase fw-bold mb-4">
                        EEMS
                    </h5>
                    <p>
                    Web-Based E-Sports Event Management System in Morong, Rizal
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 mx-auto">
                    <h5 class="text-uppercase fw-bold mb-4">
                        Page Links
                    </h5>
                    <ul class="list-style-none">
                        <li class="mb-1">
                            <a href="#home" class="text-decoration-none">
                                Home
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="#features" class="text-decoration-none">
                                Features
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="#team" class="text-decoration-none">
                                Team
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="#aboutus" class="text-decoration-none">
                                About Us
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 location">
                    <h5 class="text-uppercase fw-bold mb-4">
                        More info
                    </h5>
                    <p class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house text-primary mx-2 lead" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                            <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                        </svg>
                        East System Colleges of Rizal
                    </p>
                    <p class="d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone text-primary mx-2 lead" viewBox="0 0 16 16">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                        </svg>
                        +63512793354
                    </p>
                    <p class="d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope text-primary mx-2 lead" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                        </svg>
                        caballeroaldrin02@gmail.com
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- END OF ABOUT US -->

    <!-- START OF FOOTER -->
    <footer class="bg-primary text-center text-light">
        <div class="container">
            <p class="mb-0">
                Copyright &copy; 2022 EEMS
            </p>
        </div>
    </footer>
    <!-- END OF FOOTER -->
</body>

</html>