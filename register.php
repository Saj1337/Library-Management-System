<?php
session_start();
error_reporting(0);

include('class/database.php');
class signInUp extends database
{
    protected $link;
    public function signUpFunction()
    {
        if (isset($_POST['signup'])) {
            //addslashes take different ascii value and trim will remove start and last white space
            $fname = addslashes(trim($_POST['fname']));
            $lname = addslashes(trim($_POST['lname']));
            $email = addslashes(trim($_POST['email']));
            $phone = addslashes(trim($_POST['phone']));
            // $dob = addslashes(trim($_POST['dob']));

            $pass = trim($_POST['password']);

            //This will hash the password
            $password = password_hash($pass, PASSWORD_DEFAULT);

            $sql = "select * from user_tbl where email = '$email'";
            $res = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($res) > 0) {
                $msg = "Email taken";
                return $msg;
            } else {
                $sql2 = "INSERT INTO `user_tbl` (`id`, `fname`, `lname`, `email`, `phone`, `password`, `created`) VALUES (NULL, '$fname', '$lname', '$email', '$phone', '$password', CURRENT_TIMESTAMP)";
                $res2 = mysqli_query($this->link, $sql2);
                if ($res2) {
                    $img = "placeholder-16-9.jpg";
                    $sql3 = "INSERT INTO `user_info` (`id`, `email`, `phone`, `image`, `created`) VALUES (NULL, '$email', '$phone', '$img', CURRENT_TIMESTAMP)";
                    mysqli_query($this->link, $sql3);
                    //This session['email'] variable will be accessed by all session_start()
                    $_SESSION['email'] = $email;
                    //header function will redirect the user to profile.php page
                    header('location:profile.php');
                    $msg = "Added";
                    return $msg;
                } else {
                    $msg = "Not Added";
                    return $msg;
                }
            }
        }
        # code...
    }
}
$obj = new signInUp;
$objSignUp = $obj->signUpFunction();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('layout/style.php'); ?>

    <style>
    body {
        font-family: 'Lato', sans-serif;

    }

    .navbar-brand {
        width: 7%;
    }

    .bg_color {
        background-color: #fff !important;
    }
    </style>

</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>

    <section>
        <div class="container bg-white pr-4 pl-4  log_section pb-5">

            <div class="row">


                <!-- <form action="" method="post"> -->
                <div class="col-md-6 offset-3 ">
                    <form action="" method="post" data-parsley-validate>

                        <div class="text-center">
                            <h4 class="font-weight-bold pt-5">SIGNUP</h4>

                            <?php if ($objSignUp) { ?>
                            <?php if (strcmp($objSignUp, 'Email taken') == 0) { ?>
                            <div class="alert alert-warning alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Email is already taken!</strong>
                            </div>
                            <?php } ?>
                            <?php if (strcmp($objSignUp, 'Email taken') == 1) { ?>
                            <div class="alert alert-warning alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Invalid Information!</strong>
                            </div>
                            <?php } ?>
                            <?php if (strcmp($objSignUp, 'Added') == 0) { ?>
                            <div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Congratulation!</strong> Profile is created!
                            </div>
                            <?php } ?>

                            <?php } ?>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-4"><input name="fname" type="text"
                                    class="form-control p-4 border-0 bg-light" placeholder="Firstname" required></div>
                            <div class="col-md-6 mt-4"><input name="lname" type="text"
                                    class="form-control p-4 border-0 bg-light" placeholder="Surename" required></div>
                        </div>
                        <input type="email" name="email" class="form-control mt-4 p-4 border-0 bg-light"
                            placeholder="Email Address" required>
                        <input type="text" name="phone" class="form-control mt-4 p-4 border-0 bg-light"
                            placeholder="Phone Number" required>
                        <input type="password" id="passwordField" class="form-control mt-4 p-4 border-0 bg-light"
                            placeholder="Password" data-parsley-minlength="6" required>
                        <input data-parsley-equalto="#passwordField" type="password"
                            class="form-control mt-4 p-4 border-0 bg-light" name="password"
                            placeholder="Confirm Password" required>

                        <button name="signup" type="submit"
                            class="btn btn-block font-weight-bold log_btn btn-lg mt-4">SIGNUP</button>
                        <hr>
                        <small class="font-weight-bold mt-1 text-muted">Already have Account? <a href="login.php"
                                style="color: #05445E;">Sign In</a></small>
                    </form>
                </div>
                <!-- </form> -->
            </div>

        </div>

    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>

    <script src="js/datepicker.js"></script>
    <script>
    $('[data-toggle="datepicker"]').datepicker({
        autoClose: true,
        viewStart: 2,
        format: 'dd/mm/yyyy',

    });
    </script>
</body>

</html>