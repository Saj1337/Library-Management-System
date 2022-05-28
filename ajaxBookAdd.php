<?php
session_start();

include('class/database.php');
class profile extends database
{
    protected $link;

    public function insertProfileInfo()
    {

        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $categories = $_POST['categories'];
        $img = time() . '_' . $_FILES['image']['name'];
        $target = 'book_img/' . $img;

        $sql = "INSERT INTO `book_tbl` (`book_id`, `book_name`, `book_quantity`, `book_categories`, `book_image`) VALUES (NULL, '$name', '$quantity', '$categories','$img')";

        $res = mysqli_query($this->link, $sql);
        if ($res) {
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            echo '<div class="alert alert-success">
                <strong>Successfully Uploaded!</strong>
            </div>';
        } else {
            echo "Not added";
        }

        # code...
    }
}
$obj = new profile;
$objInsertInfo = $obj->insertProfileInfo();