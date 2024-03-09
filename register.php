<?php


ob_start();
require_once "config.php";

$fname_error = $email_error = $pwd_error = $gender_error = "";
$fname = $email = $pwd = $gender = "";


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (empty($_POST['fName'])) {
        $fname_error = "Please Enter your full name";
    } else {
        $fname = $_POST['fName'];
    }

    if (empty(trim($_POST['email']))) {
        $email_error = "Please Enter your Email address";
    } else {

        $stmt = mysqli_prepare($conn, "SELECT account_id FROM accounts WHERE email = ?");

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, 's', $p_email);

            $p_email = $_POST['email'];

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $email_error = "Email already registered";
                } else {
                    $email = $_POST['email'];
                }
            }
        }
    }

    if (empty(trim($_POST['password']))) {
        $pwd_error = "Please Create a password";
    } else {
        if (strlen($_POST['password']) < 6) {
            $pwd_error = "Password length must be between 6 to 12 charactors";
        } else {
            $pwd = $_POST['password'];
        }
    }

    if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
    } else {
        $gender_error = "Select Gender";
    }


    if (empty($fname_error) and empty($email_error) and empty($pwd_error) and empty($gender_error)) {

        $query = "INSERT INTO accounts(name, email, gender, password) VALUES (?,?,?,?)";

        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "ssss", $p_name, $p_email, $p_gender, $p_password);

            $p_name = $fname;
            $p_email = $email;
            $p_gender = $gender;
            $p_password = password_hash($pwd, PASSWORD_DEFAULT);

            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
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
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="height: 100vh;" class="d-flex justify-content-center align-items-center">

    <div class="container card" style="max-width: 720px;">
        <form class="p-5" method="POST">
            <p class="h2">Online Yoga</p>
            <p>Register to get started</p>
            <div class="mb-3">
                <label for="validationCustom03" class="form-label">Name</label>
                <input type="text" class="form-control" name="fName" id="inputFName" value="<?php echo $fname; ?>">
               <div class="form-text text-danger"><?php echo $fname_error; ?></div>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="inputEmail4" value="<?php echo $email; ?>">
               <div class="form-text text-danger"><?php echo $email_error; ?></div>
            </div>
            <div class="mb-3">
            <label for="inputGender" class="form-label">Gender&nbsp;<span
                         class="form-text text-danger"><?php echo $gender_error; ?></span></label>
               <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="Male" id="inputGenderMale"
                         <?php echo $gender ==  "Male" ? "checked" : ""; ?>>
                    <label class="form-check-label" for="inputGenderMale">
                         Male
                    </label>
               </div>
               <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="Female" id="inputGenderFemale"
                         <?php echo $gender ==  "Femail" ? "checked" : ""; ?>>
                    <label class="form-check-label" for="inputGenderFemale">
                         Female
                    </label>
               </div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="inputPassword4"
                    value="<?php echo $pwd; ?>">
               <div class="form-text text-danger"><?php echo $pwd_error; ?></div>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <p class="my-3">Already having an account? <a href="login.php">Login Now</a></p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>