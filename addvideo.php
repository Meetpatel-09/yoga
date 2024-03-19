<?php

session_start();

if (!isset ($_SESSION['role']) and $_SESSION['role'] != 'instructor') {
    header('location: login.php');
}

ob_start();
require_once "config.php";

$fname_error = $email_error = "";
$fname = $email = "";


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (empty ($_POST['fName'])) {
        $fname_error = "Please Enter name of video";
    } else {
        $fname = $_POST['fName'];
    }

    if ($_POST['inputBranch'] == '') {
        $email_error = "Please Enter select class";
    } else {
        $email = $_POST['inputBranch'];
    }
    if (empty ($fname_error) and empty ($email_error)) {
        $image = $_FILES['exampleFormControlFile1']['name'];
        // image file directory
        $target = "uploads/" . basename($image);
        move_uploaded_file($_FILES['exampleFormControlFile1']['tmp_name'], $target);


        $query = "INSERT INTO videos(title, url, instructor_id, class_id) VALUES (?,?,?, ?)";

        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "ssss", $p_name, $p_email, $p_gender, $p_class_id);

            $p_name = $fname;
            $p_email = $image;
            $p_gender = $_SESSION['account_id'];
            $p_class_id = $email;

            if (mysqli_stmt_execute($stmt)) {
                header("location: instructorvideos.php");
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
    <title>Live</title>
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
        <div class="container card mt-5" style="max-width: 720px;">
            <form class="p-5" method="POST" enctype="multipart/form-data">
                <p class="h2">Add Video</p>
                <div class="mb-3">
                    <label for="validationCustom03" class="form-label">Name</label>
                    <input type="text" class="form-control" name="fName" id="inputFName" value="<?php echo $fname; ?>">
                    <div class="form-text text-danger">
                        <?php echo $fname_error; ?>
                    </div>
                </div>
                <div class="mb-3">
                    <?php
                    $sql1 = mysqli_query($conn, "SELECT classes.*, accounts.name as instructor_name, accounts.profile FROM yoga_db.classes join accounts on classes.instructor_id = accounts.account_id where classes.instructor_id = " . $_SESSION['account_id']);
                    ?>
                    <label for="inputBranch">Select Class</label>
                    <select id="inputBranch" name="inputBranch" class="form-control">
                        <option value="choose" selected>Choose</option>
                        <?php
                        while ($row = mysqli_fetch_array($sql1)) {
                            ?>
                            <option value="<?php echo $row['class_id'] ?>">
                                <?php echo $row['name'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlFile1" class="form-label">Video</label>
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