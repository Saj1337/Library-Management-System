<?php
session_start();

include('class/database.php');
class signInUp extends database
{
    protected $link;
    public function signUpFunction()
    {

        $email = $_SESSION['email'];
        $sqlFind = "SELECT * from user_tbl where email = '$email' ";
        $resFind = mysqli_query($this->link, $sqlFind);
        if (mysqli_num_rows($resFind) > 0) {
            $row = mysqli_fetch_assoc($resFind);
            $company = $row['company'];
        }

        $sql = "SELECT id,pid,name,company,title,age,img,email,phone,created from user_tbl where company = '$company' ";
        $res = mysqli_query($this->link, $sql);

        $arr = array();

        foreach ($res as $row) {
            $arr[] = $row;
        }
        return $arr;
        # code...
    }
}
$obj = new signInUp;
$objSignUp = $obj->signUpFunction();
echo json_encode($objSignUp);