<?php

session_start();

if (!isset ($_SESSION['role']) and $_SESSION['role'] != 'admin') {
    header('location: login.php');
}

ob_start();
require_once "config.php";

$fname_error = $email_error = $pwd_error = $gender_error = "";
$fname = $email = $pwd = $gender = "";


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // if (empty ($_POST['fName'])) {
    //     $fname_error = "Please Enter your full name";
    // } else {
    //     $fname = $_POST['fName'];
    // }

    // if (empty (trim($_POST['email']))) {
    //     $email_error = "Please Enter your Email address";
    // } else {

    //     $stmt = mysqli_prepare($conn, "SELECT account_id FROM accounts WHERE email = ?");

    //     if ($stmt) {

    //         mysqli_stmt_bind_param($stmt, 's', $p_email);

    //         $p_email = $_POST['email'];

    //         if (mysqli_stmt_execute($stmt)) {
    //             mysqli_stmt_store_result($stmt);

    //             if (mysqli_stmt_num_rows($stmt) > 0) {
    //                 $email_error = "Email already registered";
    //             } else {
    //                 $email = $_POST['email'];
    //             }
    //         }
    //     }
    // }

    // if (empty (trim($_POST['password']))) {
    //     $pwd_error = "Please Create a password";
    // } else {
    //     if (strlen($_POST['password']) < 6) {
    //         $pwd_error = "Password length must be between 6 to 12 charactors";
    //     } else {
    //         $pwd = $_POST['password'];
    //     }
    // }

    // if (isset ($_POST['gender'])) {
    //     $gender = $_POST['gender'];
    // } else {
    //     $gender_error = "Select Gender";
    // }


    if (empty ($fname_error) and empty ($email_error) and empty ($pwd_error) and empty ($gender_error)) {

        $image = $_FILES['exampleFormControlFile1']['name'];
        // image file directory
        $target = "imgs/" . basename($image);
        move_uploaded_file($_FILES['exampleFormControlFile1']['tmp_name'], $target);

        $query = "INSERT INTO images(url) VALUES (?)";

        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "s", $p_url);

            $p_url = $image;

            if (mysqli_stmt_execute($stmt)) {
                header("location: manageimages.php");
            } else {
                echo '<script> alert("Someting went wrong") </script>';
            }
        } else {
            echo '<script> alert("Database Error") </script>';
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Image</title>
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
                        <a class="nav-link" href="adminhome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manageclasses.php">Manage Classes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manageinstructor.php">Manage Instructot</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" action="#">
                    <a class="btn btn-outline-danger mx-2" type="submit" href="logout.php">Logout</a>
                </form>
            </div>
        </div>
    </nav>
    <main class="container">
        <div class="container card" style="max-width: 720px;">
            <form class="p-5" method="POST" enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label for="exampleFormControlFile1" class="form-label">Image</label>
                    <input type="file" class="form-control" id="exampleFormControlFile1" name="exampleFormControlFile1">
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>