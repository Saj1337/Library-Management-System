<?php

class database
{
    // These variables will help with connecting to with the database
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "libraryproj";

    // private $hostname = "remotemysql.com";
    // private $username = "u5CBLhyagE";
    // private $password = "lNOLqk1oAj";
    // private $dbname = "u5CBLhyagE";


    // This $link variable is a part of database class which will helps run all the queries
    protected $link;

    public function __construct()
    {
        $this->connection();
        # code...
    }

    public function connection()
    {

        // This function will connect with the database
        $this->link = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname); //connected with database

        if ($this->link) {
            // echo "connected";
        } else {
            echo "not connected";
        }

        # code...
    }
}

$obj = new database; //database class object