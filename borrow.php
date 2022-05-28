<?php
session_start();
if (isset($_SESSION['email'])) {
} else {
    header('location:login.php');
}

include('class/database.php');
class profile extends database
{
    public function showBookFunction()
    {
        $id = $_GET['id'];
        $sql = "SELECT * from book_tbl where book_id = '$id'";
        $res = mysqli_query($this->link, $sql);

        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function bookFunction()
    {
        if (isset($_POST['submit'])) {
            $book_id = $_GET['id'];
            $email = $_SESSION['email'];
            $due_date = $_POST['due_date'];

            $sqlFind = "SELECT * from book_tbl where book_id = '$book_id'";
            $resFind = mysqli_query($this->link, $sqlFind);
            $row = mysqli_fetch_assoc($resFind);
            $number = $row['book_quantity'] - 1;

            $sql = "INSERT INTO `borrow_tbl` (`borrow_id`, `email`, `book_id`, `due_date`) VALUES (NULL, '$email', '$book_id', '$due_date')";
            $res = mysqli_query($this->link, $sql);

            $sqlUpdate = "UPDATE book_tbl SET book_quantity = $number where book_id = $book_id ";
            mysqli_query($this->link, $sqlUpdate);



            if ($res) {
                return 'Added';
            } else {
                return false;
            }
        }

        # code...
    }
    public function checkBorrowed()
    {
        $book_id = $_GET['id'];

        $email = $_SESSION['email'];
        $sql = "SELECT * from book_tbl INNER JOIN borrow_tbl on book_tbl.book_id = borrow_tbl.book_id where borrow_tbl.email = '$email' AND borrow_tbl.book_id = $book_id AND borrow_tbl.returned = 0";
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
$objBook = $obj->showBookFunction();
$objInsert = $obj->bookFunction();
$objCheck = $obj->checkBorrowed();
$row = mysqli_fetch_assoc($objBook);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('layout/style.php'); ?>
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <style>
    /* .book-img {
        height: 450px;
        width: 200px;
        object-fit: cover;
        margin: 10px auto;
        cursor: pointer;
    } */



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
        font-family: 'Raleway', sans-serif;
    }
    </style>

</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>


    <section>
        <div class="container">
            <div class="bg-white p-5">
                <h3 class="text-center d-block font-weight-bold" style="color: #05445E">Borrow Books
                </h3>
                <form method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <?php if ($objInsert) { ?>
                            <?php if ($objInsert == 'Added') { ?>
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Borrowed!</strong>
                            </div>
                            <?php } ?>
                            <?php } ?>
                            <h5 class="text-center d-block font-weight-bold" style="color: #05445E">
                                <?php echo $row['book_name']; ?></h5>
                            <p class="lead text-center">Copies Left: <strong
                                    class="text-bold"><?php echo $row['book_quantity']; ?></strong>
                            </p>
                            <div class="text-center">
                                <img class="w-50" src="./book_img/<?php echo $row['book_image']; ?>" alt="">
                            </div>



                        </div>
                        <div class="col-md-6 text-left">
                            <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
                            <label for="" class="mt-4">Return Date</label>
                            <input type="date" name="due_date" id="txtDate" class="form-control bg-light" required>
                            <div class="text-left mt-3">
                                <?php if ($objCheck) { ?>

                                <button class="btn btn-danger" disabled>Borrowed</button>
                                <?php } else { ?>
                                <?php if ($row['book_quantity'] == 0) { ?>
                                <button class="btn btn-danger" disabled>No Copy Left</button>
                                <?php } else { ?>
                                <input type="submit" value="Borrow" name="submit" class="btn log_btn">
                                <?php } ?>

                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </form>







            </div>
        </div>

        </div>
    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>
    <script src="js/owl.carousel.min.js"></script>
    <script>
    $(function() {
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;

        // or instead:
        // var maxDate = dtToday.toISOString().substr(0, 10);

        $('#txtDate').attr('min', maxDate);
    });

    var dateToday = new Date();
    $('[data-toggle="datepicker"]').datepicker({
        autoClose: true,
        viewStart: 2,
        format: 'dd/mm/yyyy',

    });
    </script>
    <script>
    $(document).ready(function() {



        $('#fname').keyup(function() {
            let fname = $(this).val();
            if (fname != '') {
                $.ajax({
                    type: "POST",
                    url: "ajax-search-for.php",
                    data: {
                        fname: fname,
                        id: 1
                    },

                    success: function(data) {
                        console.log(data);
                        $('#output').fadeIn();
                        $('#output').html(data);
                    }
                });
            } else {
                $('#output').fadeOut();
                $('#output').html("");
            }

        });
        $('#category').on('change', function() {
            let lname = $(this).val();
            // console.log(lname);
            $.ajax({
                type: "POST",
                url: "ajax-search-for.php",
                data: {
                    lname: lname,
                    id: 2
                },

                success: function(data) {
                    console.log(data);
                    $('#output').fadeIn();
                    $('#output').html(data);
                }
            });
        });



        $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        })
    })
    </script>
</body>

</html>