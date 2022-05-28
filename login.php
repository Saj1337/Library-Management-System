<?php
session_start();

include('class/database.php');
class signInUp extends database
{
    protected $link;

    public function signInFunction()
    {
        if (isset($_POST['signIn'])) {
            $email = $_POST['emailLogIn'];
            $password = $_POST['passwordLogIn'];

            $sql = "select * from user_tbl where email = '$email' ";
            $res = mysqli_query($this->link, $sql);

            $sqlAdmin = "SELECT * from admin where name = '$email' ";
            $resAdmin = mysqli_query($this->link, $sqlAdmin);
            if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
                $pass = $row['password'];

                if (password_verify($password, $pass) == true) {
                    $_SESSION['email'] = $email;
                    header('location:profile.php');
                    return $res;
                } else {
                    $msg = "Wrong password";
                    return $msg;
                }
            } else if (mysqli_num_rows($resAdmin) > 0) {
                $row = mysqli_fetch_assoc($resAdmin);
                $pass = $row['password'];

                if (password_verify($password, $pass) == true) {
                    $_SESSION['admin'] = $email;
                    header('location:admin.php');
                    return $res;
                } else {
                    $msg = "Wrong password";
                    return $msg;
                }
            } else {
                $msg = "Invalid Information";
                return $msg;
            }
        }
        # code...
    }
}
$obj = new signInUp;
$objSignIn = $obj->signInFunction();

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
        font-family: 'Raleway', sans-serif;
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
                <div class="col-md-6 offset-3 ">
                    <form action="" method="post" data-parsley-validate>

                        <div class="text-center">
                            <h4 class="font-weight-bold pt-5 pb-4">LOGIN</h4>

                            <?php if ($objSignIn) { ?>
                            <?php if (strcmp($objSignIn, 'Wrong password') == 0) { ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Wrong Password!</strong>
                            </div>
                            <?php } ?>
                            <?php if (strcmp($objSignIn, 'Invalid Information') == 0) { ?>
                            <div class="alert alert-warning alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Please Sign Up!</strong>
                            </div>
                            <?php } ?>

                            <?php } ?>
                        </div>
                        <input type="email" name="emailLogIn" class="form-control p-4  border-0 bg-light"
                            placeholder="Enter your email address" required>
                        <input type="password" class="form-control mt-4 p-4 border-0 bg-light" name="passwordLogIn"
                            placeholder="Enter your password" required>


                        <button type="submit" name="signIn"
                            class="btn btn-block font-weight-bold log_btn btn-lg mt-4">LOGIN</button>
                        <small class="font-weight-bold mt-1 text-muted"><a href="register.php"
                                style="color: #05445E;">Register Now</a></small>
                        <!-- <hr>
                        <small class="font-weight-bold mt-1 text-muted">Don't have an account? <a href="register.php"
                                style="color: #05445E;">Forget Password</a></small> -->

                    </form>
                </div>

                <!-- <form action="" method="post"> -->

                <!-- </form> -->
            </div>

        </div>

    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>
</body>

</html>