<?php

class Database
{

   // private $dsn = "sqlsrv:Server=localhost;Database=test";    // Conect with SQLServer
    private $dsn = "mysql:host=localhost;dbname=wams";   // Conect with MySQL
    private $username = "root";
    private $pass = "";
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO($this->dsn, $this->username, $this->pass);
            // echo "Succesfully Conected!";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function checkIn($finger_id)
    {
        $sql1 = "SELECT check_in FROM attendance_records WHERE finger_id=:finger_id";
        $stmt1 = $this->conn->prepare($sql1);
        $stmt1->execute(['finger_id' => $finger_id]);
        $result = $stmt1->fetch(PDO::FETCH_ASSOC);
        // return $result;


        if ($result['check_in']  == 1){
            // insert into CurDateDemo values(curdate())
            $sql = "insert into attendance_records(finger_id, date, time_in, check_in) values(finger_id, ?, ?, 0)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
    
        }
        elseif($result['check_in'] == 0) {
            $sql1 = "insert into attendance_records(time_out) values(?)";
            $sql2 = "UPDATE attendance_records SET check_in=1 WHERE finger_id = $finger_id";
            $stmt1 = $this->conn->prepare($sql1);
            $stmt2 = $this->conn->prepare($sql2);
            $stmt1->execute();
            $stmt2->execute();    
        }

        else{
            $sql = "insert into attendance_records(finger_id, date, time_in) values(finger_id, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
    
        }
        return $result;
    } 

}
$ob = new Database();