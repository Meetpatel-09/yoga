<?php

ob_start();

require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_POST['name']))
    $name = $_POST['name'];
  if (isset($_POST['email']))
    $email = $_POST['email'];
  if (isset($_POST['message']))
    $message = $_POST['message'];
  if (isset($_POST['subject']))
    $subject = $_POST['subject'];
  if ($name === '') {
    echo '<script> if (window.confirm("Name cannot be empty."))
        {
        }
        else
        {
        } </script>';
  }
  if ($email === '') {
    echo '<script> if (window.confirm("Email cannot be empty."))
        {
        }
        else
        {
        } </script>';
  } else {
   
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo '<script> if (window.confirm("Email format invalid."))
      {
      }
      else
      {
      } </script>';
    }
  }
  if ($subject === '') {
    echo '<script> if (window.confirm("Subject cannot be empty."))
        {
        }
        else
        {
        } </script>';
  }
  if ($message === '') {
    echo '<script> if (window.confirm("Message cannot be empty."))
        {
        }
        else
        {
        } </script>';
  }

  $query = "INSERT INTO contactus(name, email, message, subject) VALUES (?,?,?,?)";

  $stmt = mysqli_prepare($conn, $query);

  if ($stmt) {

    mysqli_stmt_bind_param($stmt, "ssss", $p_name, $p_email, $p_message, $p_subject);

    $p_name = $name;
    $p_email = $email;
    $p_message = $message;
    $p_subject = $subject;

    if (mysqli_stmt_execute($stmt)) {
      echo '<script> if (window.confirm("From Submitted Successfully"))
        {
          window.location = "contact.php";
        }
        else
        {
          window.location = "contact.php";
        } </script>';
    } else {
      echo '<script> alert("Someting went wrong") </script>';
    }
  } else {
    echo '<script> alert("Database Error") </script>';
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact Us</title>
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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Classes
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="live.php">Live</a></li>
              <li><a class="dropdown-item" href="recorded.php">Recoreded</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Contact Us</a>
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

  <main class="container">
    <section class="mb-4">

      <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
      <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us
        directly. Our team will come back to you within
        a matter of hours to help you.</p>

      <div class="row">

        <div class="col-md-12 mb-md-0 mb-5">
          <form class="" method="POST">

            <div class="row">

              <div class="col-md-6">
                <div class="md-form mb-0">
                  <label for="name" class="">Your name</label>
                  <input type="text" id="name" name="name" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="md-form mb-0">
                  <label for="email" class="">Your email</label>
                  <input type="text" id="email" name="email" class="form-control">
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="md-form mb-0">
                  <label for="subject" class="">Subject</label>
                  <input type="text" id="subject" name="subject" class="form-control">
                </div>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12">

                <div class="md-form">
                  <label for="message">Your message</label>
                  <textarea type="text" id="message" name="message" rows="2"
                    class="form-control md-textarea"></textarea>
                </div>

              </div>
            </div>
            <div class="text-center text-md-left my-3">
              <button class="btn btn-primary" type="submit" >Send</button>
            </div>
          </form>
          <div class="status"></div>
        </div>

      </div>

    </section>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>