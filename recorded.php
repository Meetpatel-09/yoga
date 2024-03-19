<!doctype html>
<?php

session_start();
require_once "config.php";

if (!isset ($_SESSION['account_id'])) {
  header('location: login.php');
}

$id = $_GET['id'];

$sql1 = mysqli_query($conn, "SELECT videos.video_id, videos.title, videos.url, classes.name, accounts.name as instructor_name FROM yoga_db.videos join classes on videos.class_id = classes.class_id join accounts on videos.instructor_id = accounts.account_id where videos.class_id = " . $id);
$i = 0;

$videos = [];
$titles = [];
$names = [];
$iNames = [];
while ($row = mysqli_fetch_array($sql1)) {
  array_push($videos, $row["url"]);
  array_push($titles, $row["title"]);
  array_push($names, $row["name"]);
  array_push($iNames, $row["instructor_name"]);
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recorded</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Online Yoga</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/index.php">Home</a>
          </li>
          <li class="nav-item dropdown active" aria-current="page">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Classes
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/live.php">Live</a></li>
              <li><a class="dropdown-item active" aria-current="page" href="classes.php">Recoreded</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/contact.php">Contact Us</a>
          </li>
        </ul>
        <form class="d-flex" role="search" action="#">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
          <a class="btn btn-outline-danger mx-2" type="submit" href="/logout.php">Logout</a>
        </form>
      </div>
    </div>
  </nav>

  <main class="container">

    <?php if (count($videos) == 0) { ?>
      <h2>There are no recorded sessions of this class</h2>
    <?php } else { ?>

      <div class="row mt-2">
        <div class="col-9">
          <?php
          if ($i == 0 and count($videos) != 0) {
            $i++;
            ?>
            <video controls src="uploads/<?php echo $videos[0] ?>" class="w-100 rounded-4"></video>
            <p class="h3">
              <?php echo $titles[0] ?> <br />-Of Class
              <?php echo $names[0] ?> <br />-By Instructor
              <?php echo $iNames[0] ?>
            </p>
          <?php } ?>

        </div>
        <div class="col-3">
          <?php

          for ($i = 1; $i < count($videos); $i++) {

            ?>
            <video controls src="uploads/<?php echo $videos[$i] ?>" class="w-100 rounded-4"></video>
            <p>
              <?php echo $titles[$i] ?>
            </p>
          <?php } ?>
        </div>
      </div>
    <?php } ?>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>