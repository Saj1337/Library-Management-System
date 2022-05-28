<?php
session_start();


include('class/database.php');
class profile extends database
{
    public function deleteFunction()
    {
        $email = $_SESSION['email'];
        $id = $_GET['id'];
        $year = date("Y-m-d");

        if ($id) {


            $sql3 = "SELECT * from borrow_tbl where borrow_id = $id ";
            $res3 = mysqli_query($this->link, $sql3);
            $row = mysqli_fetch_assoc($res3);
            $book_id = $row['book_id'];

            $sql = "INSERT INTO `return_tbl` (`return_id`, `email`, `return_date`, `book_id`) VALUES (NULL, '$email', '$year', '$book_id')";
            mysqli_query($this->link, $sql);

            $sql4 = "SELECT * from book_tbl where book_id = $book_id ";
            $res4 = mysqli_query($this->link, $sql4);
            $row2 = mysqli_fetch_assoc($res4);
            $book_quantity = $row2['book_quantity'];
            $update = $book_quantity + 1;

            $sqlUpdate = "UPDATE book_tbl SET book_quantity = $update where book_id = $book_id ";
            mysqli_query($this->link, $sqlUpdate);

            $sqlUpdate2 = "UPDATE borrow_tbl SET returned = 1 where borrow_id = $id ";
            mysqli_query($this->link, $sqlUpdate2);

            header('location:borrowed-book.php');
        } else {
            return false;
        }
        # code...
    }
}
$obj = new profile;
$objDelete = $obj->deleteFunction();