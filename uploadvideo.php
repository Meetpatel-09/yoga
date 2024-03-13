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
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item dropdown active" aria-current="page">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Classes
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item active" aria-current="page" href="live.php">Live</a></li>
              <li><a class="dropdown-item" href="recorded.php">Recoreded</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact Us</a>
          </li>
        </ul>
        <form class="d-flex" role="search" action="#">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
          <a class="btn btn-outline-danger mx-2" type="submit" href="logout.php">Logout</a>
        </form>
      </div>
    </div>
  </nav>

  <main class="container d-flex justify-content-center align-items-center" style="height: 80vh">
    <div class="p-3 card rounded-4 w-50">
      <p class="h4">Upload Video</p>
      <div class="container">
        <form class="" method="POST">
          <div class="mb-3">
            <label for="validationCustom03" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" id="inputTitle" value="<?php echo $title; ?>">
            <div class="form-text text-danger">
              <?php echo $title_error; ?>
            </div>
          </div>
          <div class="mb-3">
            <label for="video" class="form-label">Choose Video</label>
            <input type="file" class="form-control" name="video" id="video" value="<?php echo $video; ?>">
            <div class="form-text text-danger">
              <?php echo $video_error; ?>
            </div>
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Playlist</label>
            <select class="form-select" aria-label="Default select example">
              <option selected>Select Playlist</option>
              <option value="1">Indoor Session</option>
              <option value="2">Outdoor Session</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Description</label>
            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Upload</button>
        </form>
      </div>

    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>