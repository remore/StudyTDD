<?php
require_once './simpletest/autorun.php';

require_once 'model.php'; // テストしたい対象

class Test_Of_DataSource extends UnitTestCase
{
    public function __construct()
    {
        $this->UnitTestCase();
    }

    public function setUp() {
    	error_reporting(E_ALL);
        $this->data = new DataSource;
    }
	
	/*
		read()メソッドのテスト
	*/
    public function test_read_ok()
    {
    	$test = $this->data->read("http://japanese.engadget.com/rss.xml");
    	// 件名を正常に取得できていること
        $this->assertEqual( "Engadget Japanese", $test->channel->title);

        // エンガジェットの場合、デフォルトで40件の記事が取得できる
        $this->assertEqual( 40, count($this->data->read("http://japanese.engadget.com/rss.xml")->channel->item));
    }
    
    public function test_read_ng()
    {
    	error_reporting(0); // これを入れておかないとExceptionがえらいことになる
    	$this->assertEqual( false, $this->data->read("http://www.yahoo.co.jp/"));
    }
    
	/*
		getcontents()メソッドのテスト
	*/
    public function test_getcontents_ok_list()
    {
        $this->assertTrue( strlen($this->data->getcontents("http://japanese.engadget.com/rss.xml", "list")) > 0 );
    }
    
    public function test_getcontents_ok_detail()
    {
        $this->assertTrue( strlen($this->data->getcontents("http://japanese.engadget.com/rss.xml", "detail")) > 0 );
        $this->assertTrue( strpos($this->data->getcontents("http://japanese.engadget.com/rss.xml", "detail"), "div") > 0 );
    }
    
    public function test_getcontents_ng_list()
    {
    	error_reporting(0); // これを入れておかないとExceptionがえらいことになる
        $this->assertEqual( "", $this->data->getcontents("http://www.yahoo.co.jp/", "list"));
    }
    
    public function test_getcontents_ng_detail()
    {
    	error_reporting(0); // これを入れておかないとExceptionがえらいことになる
        $this->assertEqual( "",  $this->data->getcontents("http://www.yahoo.co.jp/", "detail"));
    }
    
    public function test_getcontents_ng_wrongmode()
    {
        $this->assertEqual( "",  $this->data->getcontents("http://japanese.engadget.com/rss.xml", "hogehoge"));
    }
}

?>
