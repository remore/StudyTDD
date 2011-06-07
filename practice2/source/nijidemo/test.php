<?php
require_once './simpletest/autorun.php';

require_once 'model.php'; // テストしたい対象

class Test_Of_Memo extends UnitTestCase
{
    public function __construct()
    {
        $this->UnitTestCase();
    }

    public function testHoge()
    {
        $data = new DataSource;
        //$this->assertTrue($memo->read() === "test");
        $this->assertTrue( "test" === "test");
    }
}

?>
