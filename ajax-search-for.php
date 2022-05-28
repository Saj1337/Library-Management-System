<?php
session_start();

include('class/database.php');
class profile extends database
{
    protected $link;

    public function insertProfileInfo()
    {
        $slide = '';
        $slide .= '<div class="row">';



        if ($_POST['id'] == 1) {
            $name = $_POST['fname'];
            $sql = "SELECT * from book_tbl where book_name like '%$name%'";
            $res = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($res) > 0) {

                while ($row = mysqli_fetch_assoc($res)) {
                    $slide .= '<div class="col-md-3"><a class="text-decoration-none" href="borrow.php?id=' . $row['book_id'] . '">
                    <img src="book_img/' . $row['book_image'] . '" class="book-img" alt="">
                    <h5 class="text-center d-block font-weight-bold text-decoration-none" style="color: #05445E">' . $row['book_name'] . '</h5></a>
                </div>';
                }
            } else {
                return false;
            }
        }
        if ($_POST['id'] == 2) {
            $name = $_POST['lname'];
            $sql = "SELECT * from book_tbl where book_categories = '$name'";
            $res = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($res) > 0) {

                while ($row = mysqli_fetch_assoc($res)) {
                    $slide .= '<div class="col-md-3"><a class="text-decoration-none" href="borrow.php?id=' . $row['book_id'] . '">
                    <img src="book_img/' . $row['book_image'] . '" class="book-img" alt="">
                    <h5 class="text-center d-block font-weight-bold text-decoration-none" style="color: #05445E">' . $row['book_name'] . '</h5></a>
                </div>';
                }
            } else {
                return false;
            }
        }
        if ($_POST['id'] == 3) {

            $sql = "SELECT * from book_tbl";
            $res = mysqli_query($this->link, $sql);
            if (mysqli_num_rows($res) > 0) {

                while ($row = mysqli_fetch_assoc($res)) {
                    $slide .= '<div class="col-md-3"><a class="text-decoration-none" href="borrow.php?id=' . $row['book_id'] . '">
                    <img src="book_img/' . $row['book_image'] . '" class="book-img" alt="">
                    <h5 class="text-center d-block font-weight-bold text-decoration-none" style="color: #05445E">' . $row['book_name'] . '</h5></a>
                </div>';
                }
            } else {
                return false;
            }
        }

        $slide .= '</div>';
        return $slide;



        # code...
    }
}
$obj = new profile;
echo $obj->insertProfileInfo();