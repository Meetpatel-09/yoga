<?php

session_start();

require_once "config.php";

if (!isset ($_SESSION['role']) and $_SESSION['role'] != 'admin') {
    header('location: login.php');
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Images</title>
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
        <div style="margin-top: 15px;">
            <h3 style="text-align: center">Images</h3>
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
                                        <th width="9%" scope="col">#</th>
                                        <th width="9%" scope="col">Photo</th>
                                        <th width="9%" scope="col">View</th>
                                        <th width="16%" scope="col">Remove</th>
                                    </tr>
                                    <?php
                                    $sql1 = mysqli_query($conn, "SELECT * FROM images");
                                    $i = 0;
                                    while ($row = mysqli_fetch_array($sql1)) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $i ?>
                                            </td>
                                            <td height="104"><img src="imgs/<?php echo $row['url'] ?>" width="100"
                                                    height="100" alt="" /></td>
                                            <td><a target="_blank" href="imgs/<?php echo $row['url'] ?>" type="button" class="btn btn-primary">View</a></td>
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