<?php

session_start();

if (!isset ($_SESSION['role']) and $_SESSION['role'] != 'instructor') {
    header('location: login.php');
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instructor Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Online Yoga</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="instructorhome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="instructorclass.php">Manage Classes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="instructorvideos.php">Manage Videos</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" action="#">
                    <a class="btn btn-outline-danger mx-2" type="submit" href="logout.php">Logout</a>
                </form>
            </div>
        </div>
    </nav>

    <main class="container">
        <div style="padding:15px;">
            <div style="margin-top: 15px;">
                <h3 style="text-align: center">Welcome</h3>
            </div>
            <div class="row row-cols-1 row-cols-md-2 g-4 d-flex justify-content-center" style="margin-top: 15px; ">
                <div class="col-md-4 text-center" style="padding:15px;">
                    <div class="card">
                        <img src="images/classes.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="addclass.php" class="btn btn-primary">Add Class</a>
                            <a href="instructorclass.php" class="btn btn-primary">Manage Classes</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center" style="padding:15px;">
                    <div class="card">
                        <img src="images/video.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="addvideo.php" class="btn btn-primary">Add Video</a>
                            <a href="instructorvideos.php" class="btn btn-primary">View Videos</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center" style="padding:15px;">
                    <div class="card">
                        <img src="images/video.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="addlive.php" class="btn btn-primary">Add Live Session</a>
                            <a href="instructorlive.php" class="btn btn-primary">View Live Sessions</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>