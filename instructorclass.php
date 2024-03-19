<?php

session_start();

require_once "config.php";

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
        <div style="margin-top: 15px;">
            <h3 style="text-align: center">Classes Details</h3>
        </div>
        <div class="form-design">
            <div class="container">
                <div class="row">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">
                        <div style="text-align: center">
                            <table width="100%" border="1" class="table">
                                <tbody>
                                    <tr>
                                        <!-- <th width="9%" scope="col">Instructor Photo</th> -->
                                        <th width="15%" scope="col">Name</th>
                                        <th width="75%" scope="col">Description</th>
                                        <!-- <th width="15%" scope="col">Instructor</th> -->
                                        <th width="10%" scope="col">Remove</th>
                                    </tr>
                                    <?php
                                    $sql1 = mysqli_query($conn, "SELECT classes.*, accounts.name as instructor_name, accounts.profile FROM yoga_db.classes join accounts on classes.instructor_id = accounts.account_id where classes.instructor_id = ". $_SESSION['account_id']);
                                    while ($row = mysqli_fetch_array($sql1)) {
                                        ?>
                                        <tr>
                                            <!-- <td height="104"><img src="instructor/<?php //echo $row['profile'] ?>" width="100"
                                                    height="100" alt="" /></td> -->
                                            <td>
                                                <?php echo $row['name'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['description'] ?>
                                            </td>
                                            <!-- <td>
                                                <?php //echo $row['instructor_name'] ?>
                                            </td> -->
                                            <td><button type="button" class="btn btn-danger">Remove</button></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-1">
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