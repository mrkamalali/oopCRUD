<?php


class Database
{
    private $added = "Your Record Added Successfully";
    private $updated = "Your Record Updated Successfully";
    private $deleted = "Your Record Deleted Successfully";


    private $serverName = "Localhost";
    private $dbName = "oopcrud";
    private $username = "root";
    private $password = "";
    private $conn;


    public function __construct()
    {
        $this->conn = mysqli_connect($this->serverName, $this->username,
            $this->password, $this->dbName);
        if (!$this->conn)
        {
            die(
                "Error : " . mysqli_connect_error()
            );
        }
    }

    public function passwordHash($password)
    {
        return sha1($password);
    }

//    Insert Into Database Here..........
    public function insert($sql)
    {
        if (mysqli_query($this->conn, $sql)) {
            return $this->added;
        } else {
            die("Error : " . mysqli_connect_error($this->conn));

        }
    }


//    Show Data
    public function show($table)
    {
        $sql = "SELECT * FROM $table ";
        $result = mysqli_query($this->conn, $sql);
        $data = [];

        if ($result) {
            if (mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
            }
            return $data;
        } else {
            die("Error " . mysqli_error($this->conn));
        }

    }


    public function edit($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE `id` = $id";
        $result = mysqli_query($this->conn , $sql);

        if ($result)
        {
            if (mysqli_num_rows($result))
            {
                return mysqli_fetch_assoc($result);
            }
            return false;
        }
        else
        {
            die("Error " . mysqli_error($this->conn));

        }

    }

    public function update($sql)
    {
        $result = mysqli_query($this->conn,$sql);
        if(mysqli_query($this->conn,$sql))
        {
            return $this->updated;
        }
        else
        {
            return die("Error : ".mysqli_error($this->conn));
        }
    }




//    Delete Record if We Have It
    public function delete($table,$id)
    {
        $sql = "DELETE FROM $table WHERE `id`='$id' ";
//        $result = mysqli_query($this->conn,$sql);
        if(mysqli_query($this->conn,$sql))
        {
            return $this->deleted;
        }
        else
        {
            return die("Error : ".mysqli_error($this->conn));
        }
    }


    private function dieNow()
    {
        return die("Error : ".mysqli_error($this->conn));
    }



}