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

    public function read()
    {
        $data = array();
        $sql = "SELECT attendance_records.id, employees.name, employees.email, attendance_records.finger_id, attendance_records.date, 
        attendance_records.time_in, attendance_records.time_out FROM attendance_records INNER JOIN employees
        ON attendance_records.finger_id = employees.id ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $data[] = $row;
        }
        return $data;
    }


    public function getUserBiId($id)
    { 
        $sql = "SELECT id, finger_id, date,time_in,time_out FROM attendance_records WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function totalRowCount()
    {
        $sql = "SELECT count(*)  FROM attendance_records";
        $result = $this->conn->prepare($sql);
        $result->execute();
        $number_of_rows = $result->fetchColumn();
        return $number_of_rows;
    }

}
$ob = new Database();
// print_r($ob->read());
// print_r($ob->getUserBiId(2));
// print_r($ob->totalRowCount());