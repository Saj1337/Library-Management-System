<?php
session_start();
include('class/database.php');
class profile extends database
{
    public function showBookFunction()
    {

        $sql = "SELECT * from book_tbl order by book_id DESC";
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
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
            <div class="bg-white p-5">
                <h3 class="text-center d-block font-weight-bold" style="color: #05445E"><span
                        class="text-secondary font-weight-light">Welcome | </span> Admin
                </h3>

                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Copies Left</th>
                            <th>Category</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($objBook) { ?>
                        <?php while ($row = mysqli_fetch_assoc($objBook)) { ?>
                        <tr>
                            <td><img class="w-25" src="book_img/<?php echo $row['book_image']; ?>" alt=""></td>
                            <td><?php echo $row['book_name']; ?></td>
                            <td><?php echo $row['book_quantity']; ?></td>
                            <td><?php echo $row['book_categories']; ?></td>
                            <td>
                                <a href="book-edit.php?id=<?php echo $row['book_id']; ?>"
                                    class="btn btn-info btn-block">Edit</a>
                                <a href="book-delete.php?id=<?php echo $row['book_id']; ?>"
                                    class="btn btn-danger btn-block">Delete</a>
                            </td>

                        </tr>
                        <?php } ?>
                        <?php } ?>
                    </tbody>

                </table>

            </div>

        </div>
    </section>


    <?php include('layout/footer.php'); ?>

    <?php include('layout/script.php') ?>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#example').DataTable();

    });
    </script>
</body>

</html>