<?php
session_start();


include('class/database.php');
class profile extends database
{
    public function deleteFunction()
    {
        $id = $_GET['id'];
        $sql = "DELETE from book_tbl where book_id = $id ";
        $res = mysqli_query($this->link, $sql);
        if ($res) {
            header('location:book-details.php');
        } else {
            return false;
        }
        # code...
    }
}
$obj = new profile;
$objDelete = $obj->deleteFunction();