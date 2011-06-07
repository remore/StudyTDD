<?php

/*
「問：
三角形の各辺の長さを表す整数を入力として、以下の値を返す関数を作れ。
　・正三角形の場合は1
　・二等辺三角形の場合は2
　・不等辺三角形の場合は3
そして、各辺が三角形を形成しない場合は例外を起こす。」

について、ケントベックが「テスト駆動開発入門」で示したコード
（smalltalkで書かれていたコードにできるだけ近くなるようにphpで表現）

*/

function IsTriangular( $a, $b, $c ){
	$p = array($a, $b, $c);
	sort($p);
	if ($p[0]<=0) {
		throw new Exception('my first exception');
		
	}
	if ($p[0]+$p[1]<=$p[2]) {
		throw new Exception('my first exception');
	}
	if( $a===$b && $b===$c && $c===$a ) {
		return 1;
		
	} else if( $a===$b || $b===$c || $c===$a ) {
		return 2;
		
	} else {
		return 3;
		
	}
}

class TriangularTest extends PHPUnit_Framework_TestCase
{

    protected function setUp() {}
    protected function tearDown() {}
    
    public function testEquilateral(){
    	$this->assertEquals(1, IsTriangular(2, 2, 2));
    }
    
    public function testIsosceles(){
    	$this->assertEquals(2, IsTriangular(1, 2, 2));
    }
    
    public function testScalene(){
    	$this->assertEquals(3, IsTriangular(2, 3, 4));
    }
    
    public function testIrrational(){
    	try {
    		echo IsTriangular(1, 2, 3);
    		
    	} catch (Exception $e) {
    		$this->assertTrue(true);
    	}
    	if (!isset($e)) $this->fail('期待通りの例外が発生しませんでした。');
    }
    
    public function testNegative(){
    	try {
    		echo IsTriangular(-1,2,2);
    		
    	} catch (Exception $e) {
    		$this->assertTrue(true);
    	}
    	if (!isset($e)) $this->fail('期待通りの例外が発生しませんでした。');
    }
    
    public function testStrings(){
    	try {
    		echo IsTriangular("a","b","c");
    		
    	} catch (Exception $e) {
    		$this->assertTrue(true);
    	}
    	if (!isset($e)) $this->fail('期待通りの例外が発生しませんでした。');
    }
    
}

?>