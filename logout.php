<?php
//unset all the session inside the website
session_start();
session_unset();
header('location:login.php');