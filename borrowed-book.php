<?php
session_start();
if (isset($_SESSION['email'])) {
} else {
    header('location:login.php');
}

include('class/database.php');
class profile extends database
{


    public function checkBorrowed()
    {
        $email = $_SESSION['email'];
        $sql = "SELECT * from book_tbl INNER JOIN borrow_tbl on book_tbl.book_id = borrow_tbl.book_id where borrow_tbl.email = '$email' ";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
}
$obj = new profile;

$objCheck = $obj->checkBorrowed();





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
        font-family: 'Lato', sans-serif;
    }
    </style>

</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>


    <section>
        <div class="container">
            <div class="bg-white p-5">
                <h3 class="text-center d-block font-weight-bold" style="color: #05445E">Borrowed Books
                </h3>

                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Book Name</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Return</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($objCheck) { ?>
                        <?php while ($row = mysqli_fetch_assoc($objCheck)) { ?>
                        <tr>
                            <td><?php echo $row['book_name']; ?></td>
                            <td><?php echo $row['due_date']; ?></td>
                            <td>
                                <?php if ($row['returned'] == 1) { ?>
                                <a href="#" class="btn btn-danger">Returned</a>
                                <?php } else { ?>
                                <a href="return-book.php?id=<?php echo $row['borrow_id']; ?>"
                                    class="btn btn-info">Return</a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <p>No Returned Book</p>
                        <?php } ?>


                    </tbody>
                </table>








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