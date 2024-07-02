<?php

class Database
{
    private $conn;

    public function __construct($servername, $username, $password, $dbname)
    {
        $this->conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function query($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function execute($sql)
    {
        return mysqli_query($this->conn, $sql);
    }

    public function insertAndReturnId($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        if ($result === false) {
            throw new Exception("Error al ejecutar la consulta SQL: " . mysqli_error($this->conn));
        }else{
            return mysqli_insert_id($this->conn);
        }
    }


    public function __destruct()
    {
        mysqli_close($this->conn);
    }
}

