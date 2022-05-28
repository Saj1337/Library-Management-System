<?php
session_start();


include('class/database.php');
class profile extends database
{
    public function showBookFunction()
    {
        $sql = "SELECT * from book_tbl";
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
                <h5 class="text-center d-block font-weight-bold" style="color: #05445E">Search Books
                </h5>
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <label for="search_for" class="font-weight-bold mt-4">Search For</label>
                        <input type="text" id="fname" name="fname" placeholder="Title" class="form-control  bg-light">
                        <!-- <div class="">
                            <form action="" class="form-inline">
                                <input type="text" id="fname" name="fname" class="form-control  bg-light">
                                <input type="submit" class="btn btn-success">
                            </form>
                        </div> -->
                        <label for="search_where" class="font-weight-bold mt-4">Search Where</label>
                        <select name="" class="form-control  bg-light" id="category">
                            <option selected disabled>Select Category</option>
                            <option value="any">Anywhere</option>
                            <option value="Classic">Classic</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Horror">Horror</option>
                            <option value="Fiction">Fiction</option>
                        </select>
                    </div>
                </div>




                <div class="text-center mt-5">



                    <div id="output">

                    </div>


                </div>


            </div>
        </div>

        </div>
    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>
    <script src="js/owl.carousel.min.js"></script>
    <script>
    $(document).ready(function() {

        $.ajax({
            type: "POST",
            url: "ajax-search-for.php",
            data: {

                id: 3
            },

            success: function(data) {
                console.log(data);
                $('#output').fadeIn();
                $('#output').html(data);
            }
        });


        $('#fname').keyup(function() {
            let fname = $(this).val();
            $('#category option:first').prop('selected', true);
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
                $.ajax({
                    type: "POST",
                    url: "ajax-search-for.php",
                    data: {

                        id: 3
                    },

                    success: function(data) {
                        console.log(data);
                        $('#output').fadeIn();
                        $('#output').html(data);
                    }
                });
            }

        });
        $('#category').on('change', function() {
            let lname = $(this).val();
            $('#fname').val('');

            if (lname == 'any') {
                $.ajax({
                    type: "POST",
                    url: "ajax-search-for.php",
                    data: {

                        id: 3
                    },

                    success: function(data) {
                        console.log(data);
                        $('#output').fadeIn();
                        $('#output').html(data);
                    }
                });
            } else {
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
            }
            // console.log(lname);

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