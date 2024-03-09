<?php
$title = "Log In";

require_once "config.php";

$email_error = $password_error = "";

$email = $password = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (empty(trim($_POST['email']))) {
        $email_error = "Please enter your email";
    } else {
        $email = $_POST['email'];
    }


    if (empty(trim($_POST['password']))) {
        $password_error = "Please enter your password";
    } else {
        $password = $_POST['password'];
    }


    if (empty($email_error) and empty($password_error)) {

        $sql = "SELECT account_id, email, password FROM accounts WHERE email = ?";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, 's', $param_email);

        $param_email = $email;

        if (mysqli_stmt_execute($stmt)) {

            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) == 1) {

                mysqli_stmt_bind_result($stmt, $account_id, $email, $hashed_password);

                if (mysqli_stmt_fetch($stmt)) {
                    if (password_verify($password, $hashed_password)) {

                        session_start();

                        $_SESSION['email'] = $email;
                        $_SESSION['account_id'] = $account_id;
                        $_SESSION['isLoggedIn'] = true;

                        header("location: index.php");
                    } else {
                        $password_error = "Incorrect Password";
                    }
                }
            } else {
                $email_error = "Email not registered";
            }
        }
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="height: 100vh;" class="d-flex justify-content-center align-items-center">

    <div class="container card" style="max-width: 720px;">
        <form class="p-5" method="POST">
            <p class="h2">Online Yoga</p>
            <p>Login to continue</p>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="inputEmail4" value="<?php echo $email; ?>">
                <div class="form-text text-danger">
                    <?php echo $email_error; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="inputPassword4"
                    value="<?php echo $pwd; ?>">
                <div class="form-text text-danger">
                    <?php echo $pwd_error; ?>
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember Me</label>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <p class="my-3">Not having an account? <a href="register.php">Register Now</a></p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>