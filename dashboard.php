<?php
session_start();

if (isset($_SESSION['email'])) {
} else {
    header('location:login.php');
}
include('class/database.php');
class profile extends database
{
    protected $link;
    public function showProfile()
    {
        $email = $_SESSION['email'];
        $sql = "select * from user_tbl where email = '$email' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }

    //Show all the records inside user_info table
    public function showProfileInfo()
    {
        $email = $_SESSION['email'];
        $sql = "select * from user_info where email = '$email' ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function borrowFunction()
    {
        $email = $_SESSION['email'];

        $sql = "SELECT count(*) as tot from book_tbl INNER JOIN borrow_tbl on book_tbl.book_id = borrow_tbl.book_id where borrow_tbl.email = '$email' ";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            return $res;
        } else {
            return 0;
        }
    }
    public function returnFunction()
    {
        $email = $_SESSION['email'];

        $sql = "SELECT count(*) as tot from book_tbl INNER JOIN return_tbl on book_tbl.book_id = return_tbl.book_id where return_tbl.email = '$email' ";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            return $res;
        } else {
            return 0;
        }
    }
    public function borrowBook()
    {
        $email = $_SESSION['email'];

        $sql = "SELECT * from book_tbl INNER JOIN borrow_tbl on book_tbl.book_id = borrow_tbl.book_id where borrow_tbl.email = '$email' order by borrow_tbl.borrow_id DESC";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            return $res;
        } else {
            return 0;
        }
    }
    public function returnBook()
    {
        $email = $_SESSION['email'];

        $sql = "SELECT * from book_tbl INNER JOIN return_tbl on book_tbl.book_id = return_tbl.book_id where return_tbl.email = '$email' order by return_tbl.return_id DESC";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            return $res;
        } else {
            return 0;
        }
    }
}
$obj = new profile;
$objShow = $obj->showProfile();
$objShowInfo = $obj->showProfileInfo();
$objBorrow = $obj->borrowFunction();
$objReturn = $obj->returnFunction();
$objBook1 = $obj->borrowBook();
$objBook2 = $obj->returnBook();
// $objInsertInfo = $obj->insertProfileInfo();
$row = mysqli_fetch_assoc($objShow);
$rowInfo = mysqli_fetch_assoc($objShowInfo);

$row2 = mysqli_fetch_assoc($objBorrow);
$borrow = $row2['tot'];
$Book1 = mysqli_fetch_assoc($objBook1);

$row3 = mysqli_fetch_assoc($objReturn);
$return = $row3['tot'];
$Book2 = mysqli_fetch_assoc($objBook2);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('layout/style.php'); ?>
    <style>
    .profileImage {
        height: 200px;
        width: 200px;
        object-fit: cover;
        border-radius: 50%;
        margin: 10px auto;
        cursor: pointer;

    }



    .upload_btn {
        background-color: #EEA11D;
        color: #05445E;
        transition: 0.7s;
    }

    .upload_btn:hover {
        background-color: #05445E;
        color: #EEA11D;
    }

    .navbar-brand {
        width: 7%;
    }

    .bg_color {
        background-color: #fff !important;
    }

    .gap {
        margin-bottom: 95px;
    }

    body {
        font-family: 'Lato', sans-serif;
    }
    </style>

</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>


    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <h3 class="float-left d-block font-weight-bold" style="color: #05445E"><span
                            class="text-secondary font-weight-light">Welcome |</span>
                        <?php echo $row['fname'] ?>
                        (<?php echo ($borrow >= 100) ? 'Master Reader' : (($borrow < 100 && $borrow >= 50) ? 'Intermediate reader' : (($borrow < 50 && $borrow >= 10) ? 'Junior Reader' : 'No Title')); ?>)
                    </h3>

                    <div class="account bg-white mt-5 p-5 rounded">


                        <h3 class="font-weight-bold mb-5" style="color: #05445E">Dashboard

                        </h3>

                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="float-left d-block font-weight-bold" style="color: #05445E"><span
                                        class="text-secondary font-weight-light">Borrowed Books Amount :</span>
                                    <?php echo $borrow; ?>
                                </h3>
                                <h3 class="float-left d-block font-weight-bold" style="color: #05445E"><span
                                        class="text-secondary font-weight-light">Recent Borrowed Book :</span>
                                    <?php echo (isset($Book1['book_name'])) ? $Book1['book_name'] : 'No Book Found'; ?>
                                </h3>

                                <h3 class="float-left d-block font-weight-bold mt-4" style="color: #05445E"><span
                                        class="text-secondary font-weight-light">Total Points :</span>
                                    <?php echo $borrow * 10; ?>
                                </h3>
                            </div>
                            <div class="col-md-6">
                                <h3 class="float-left d-block font-weight-bold" style="color: #05445E"><span
                                        class="text-secondary font-weight-light">Returned Books Amount :</span>
                                    <?php echo $return; ?>
                                </h3>
                                <h3 class="float-left d-block font-weight-bold" style="color: #05445E"><span
                                        class="text-secondary font-weight-light">Recent Returned Book :</span>
                                    <?php echo (isset($Book2['book_name'])) ? $Book2['book_name'] : 'No Book Found'; ?>
                                </h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>
    <script>
    //This ajax call will take the user info to update.php
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "update.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#output').fadeIn().html(response);
                    setTimeout(() => {
                        $('#output').fadeOut('slow');
                    }, 2000);
                }
            });

        });
    })
    </script>
</body>

</html>