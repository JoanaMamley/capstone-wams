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


    public function insert($name, $email, $gender, $phone_number, $fingerprint_id)
    {
        $sql = "INSERT INTO employees (name,email,gender,phone_number,fingerprint_id) VALUES (:name,:email,:gender,:phone_number,:fingerprint_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'gender' => $gender, 'phone_number' => $phone_number,'fingerprint_id' => $fingerprint_id]);
        return true;
    }

    public function read()
    {
        $data = array();
        $sql = "SELECT id,name,email,gender,phone_number,fingerprint_id FROM employees order by id DESC";
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
        $sql = "SELECT id, name,email,gender,phone_number,fingerprint_id FROM employees WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    public function update($id, $name, $email,$gender,$phone_number)
    {
        $sql = "UPDATE employees SET name= :name, email= :email, gender= :gender, phone_number= :phone_number WHERE id= :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['name' => $name, 'email' => $email, 'gender' => $gender, 'phone_number' => $phone_number,'id' => $id]);
        return true;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM employees WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return true;
    }

    public function totalRowCount()
    {
        $sql = "SELECT count(*)  FROM employees";
        $result = $this->conn->prepare($sql);
        $result->execute();
        $number_of_rows = $result->fetchColumn();
        return $number_of_rows;
    }

}
$ob = new Database();
// print_r($ob->insert("Joana Teye","joanateye18@gmail.com","Female","0509642401",3));
// print_r($ob->insert("Naa Adoley","naaadoley46@gmail.com","Female","0501234567",2));
// print_r($ob->read());
// print_r($ob->getUserBiId(2));
// print_r($ob->update(1, "Joana Teye","joanateye2000@gmail.com","Female","0509642401"));
// print_r($ob->totalRowCount());
// print_r($ob->delete(3));