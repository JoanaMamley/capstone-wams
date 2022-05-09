<?php

class UsersTest extends \PHPUnit\Framework\TestCase{

    public function testDelete(){
        require 'manage-users.php';

        $Database = new Database;

        $result = $Database->delete(11);

        $this->assertEquals(1, $result);
    }

    public function testInsert(){
        require 'manage-users.php';

        $db2 = new Database;

        $result = $db2->insert("Cho Chang", "chang@gmail.com", "Female","02412345678", 18);

        $this->assertEquals(1, $result);
    }

    public function testUserUpdate(){
        require 'manage-users.php';

        $db3 = new Database;

        $result = $db3->update(1, "Joana Mamley Teye", "joanateye2000@gmail.com","Female","02412345678");

        $this->assertEquals(1, $result);
    }

    public function testNumberOfRows(){
        require 'manage-users.php';

        $db4 = new Database;

        $result = $db4->totalRowCount();

        $this->assertEquals(9, $result);
    }
}

?>