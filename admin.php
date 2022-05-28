<?php
session_start();


include('class/database.php');
class profile extends database
{
}




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
        font-family: 'Raleway', sans-serif;
    }
    </style>

</head>

<body class="bg-light">
    <?php include('layout/navbar.php'); ?>


    <section>
        <div class="container">
            <div class="bg-white p-5">
                <h3 class="text-center d-block font-weight-bold" style="color: #05445E"><span
                        class="text-secondary font-weight-light">Welcome | </span> Admin
                </h3>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <h5 class="text-center d-block font-weight-bold" style="color: #05445E">Add Books
                        </h5>
                        <div id="output"></div>
                        <form id="myForm">
                            <label for="name" class="font-weight-bold mt-4">Book Name</label>
                            <input type="text" id="name" name="name" class="form-control  bg-light">
                            <label for="quantity" class="font-weight-bold mt-4">Book Quantity</label>
                            <input type="number" id="quantity" name="quantity" class="form-control  bg-light">
                            <label for="categories" class="font-weight-bold mt-4">Book Category</label>
                            <select name="categories" class="form-control  bg-light" id="">
                                <option value="" selected disabled>Choose categories</option>
                                <option value="Classic">Classic</option>
                                <option value="Fantasy">Fantasy</option>
                                <option value="Horror">Horror</option>
                                <option value="Fiction">Fiction</option>
                            </select>
                            <label for="image" class="font-weight-bold mt-4">Book Image</label><br>
                            <input type="file" accept="image/*" name="image">
                            <button type="submit"
                                class="btn btn-block font-weight-bold log_btn btn-lg mt-4">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>
    <script>
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "ajaxBookAdd.php",
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
            this.reset();
        });
    })
    </script>
</body>

</html>