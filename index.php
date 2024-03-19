<?php

session_start();

require_once "config.php";

if (!isset($_SESSION['account_id'])) {
  header('location: login.php');
}

$sql1 = mysqli_query($conn, "SELECT * FROM yoga_db.images;"); 

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Yoga</title>
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
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Classes
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="live.php">Live</a></li>
              <li><a class="dropdown-item" href="classes.php">Recoreded</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact Us</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
          <a class="btn btn-outline-danger mx-2" type="submit" href="logout.php">Logout</a>
        </form>
      </div>
    </div>
  </nav>

  <main class="container">
    <img class="w-100" src="yoga-banner.jpg" alt="">

    <!-- <div class="mt-4">
      <div class="d-flex gap-3 justify-content-between">
        <h3>Videos of yoga classes</h3>
        <a href="">View more</a>
      </div>
      <div class="d-flex gap-3 justify-content-between">
        <video src="videos/1.mp4" class="rounded-4" controls height="215"></video>
        <video src="videos/2.mp4" class="rounded-4" controls height="215"></video>
        <video src="videos/3.mp4" class="rounded-4" controls height="215"></video>
      </div>
    </div> -->

    <div class="my-3">
      <div class="d-flex gap-3 justify-content-between">
        <h3>Images of yoga classes</h3>
        <!-- <a href="">View more</a> -->
      </div>
      <div class="d-flex flex-wrap justify-content-between">
        <?php 
          while ($row = mysqli_fetch_array($sql1)) {
        ?>  
      <img height="200"
          src="<?php echo "imgs/" . $row['url']; ?>"
          alt="" class="mt-4">
        <?php } ?>
      </div>
    </div>

  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>