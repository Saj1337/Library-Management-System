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
        $sql = "SELECT user_tbl.fname, user_tbl.lname, count(*) as total FROM `borrow_tbl` INNER JOIN user_tbl ON borrow_tbl.email = user_tbl.email GROUP BY borrow_tbl.email ORDER BY total DESC limit 10;";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new profile;
$objLeader = $obj->showProfile();



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
                            class="text-secondary font-weight-light">Welcome to </span>
                        Leaderboard
                    </h3>

                    <div class="account bg-white mt-5 p-5 rounded">

                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <ul class="list-group shadow">
                                    <?php if ($objLeader) { ?>
                                    <?php while ($row = mysqli_fetch_assoc($objLeader)) { ?>
                                    <li
                                        class="list-group-item d-flex font-weight-bold justify-content-between align-items-center list-group-item-action">
                                        <?php echo $row['fname'] . ' ' . $row['lname']; ?>
                                        <span
                                            class="text-secondary">(<?php
                                                                                $borrow = $row['total'];
                                                                                echo ($borrow >= 100) ? 'Master Reader' : (($borrow < 100 && $borrow >= 50) ? 'Intermediate reader' : (($borrow < 50 && $borrow >= 10) ? 'Junior Reader' : 'No Title')); ?>)</span>
                                        <span
                                            class="badge badge-primary badge-pill"><?php echo $row['total'] * 10; ?></span>
                                    </li>

                                    <?php } ?>
                                    <?php } ?>


                                </ul>
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