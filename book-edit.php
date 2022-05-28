<?php
session_start();


include('class/database.php');
class profile extends database
{
    public function bookFunction()
    {
        $id = $_GET['id'];
        $sql = "SELECT * from book_tbl where book_id = $id ";
        $res = mysqli_query($this->link, $sql);
        if (mysqli_num_rows($res) > 0) {
            return $res;
        } else {
            return false;
        }
        # code...
    }
    public function updateFunction()
    {
        if (isset($_POST['submit'])) {
            $id = $_GET['id'];
            $name = $_POST['name'];
            $quantity = $_POST['quantity'];
            $categories = $_POST['categories'];
            $img = time() . '_' . $_FILES['image']['name'];
            $target = 'book_img/' . $img;

            if ($_FILES['image']['name'] == '') {
                $sql = "UPDATE book_tbl SET book_name = '$name', book_quantity = '$quantity', book_categories = '$categories' where book_id = $id ";
            } else {
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                $sql = "UPDATE book_tbl SET book_name = '$name', book_quantity = '$quantity', book_categories = '$categories', book_image = '$img' where book_id = $id ";
            }



            $res = mysqli_query($this->link, $sql);
            if ($res) {
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
                header('location:book-details.php');
            } else {
                echo "Not Updated";
            }
        }
        # code...
    }
}
$obj = new profile;
$objEdit = $obj->bookFunction();
$objUpdate = $obj->updateFunction();
$row = mysqli_fetch_assoc($objEdit);



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
                        <h5 class="text-center d-block font-weight-bold" style="color: #05445E">Edit Book
                        </h5>
                        <form method="post" enctype="multipart/form-data">
                            <label for="name" class="font-weight-bold mt-4">Book Name</label>
                            <input type="text" id="name" name="name" value="<?php echo $row['book_name']; ?>"
                                class="form-control  bg-light">
                            <label for="quantity" class="font-weight-bold mt-4">Book Quantity</label>
                            <input type="number" value="<?php echo $row['book_quantity']; ?>" id="quantity"
                                name="quantity" class="form-control  bg-light">
                            <label for="categories" class="font-weight-bold mt-4">Book Category</label>
                            <select name="categories" class="form-control  bg-light" id="">

                                <option value="Classic"
                                    <?php echo ($row['book_categories'] == 'Classic') ? 'selected' : ''; ?>>Classic
                                </option>
                                <option value="Fantasy"
                                    <?php echo ($row['book_categories'] == 'Fantasy') ? 'selected' : ''; ?>>Fantasy
                                </option>
                                <option <?php echo ($row['book_categories'] == 'Horror') ? 'selected' : ''; ?>
                                    value="Horror">Horror</option>
                                <option value="Fiction"
                                    <?php echo ($row['book_categories'] == 'Fiction') ? 'selected' : ''; ?>>Fiction
                                </option>
                            </select>
                            <label for="image" class="font-weight-bold mt-4">Book Image</label><br>
                            <input type="file" accept="image/*" name="image">
                            <button name="submit" type="submit"
                                class="btn btn-block font-weight-bold log_btn btn-lg mt-4">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>
    <script>

    </script>
</body>

</html>