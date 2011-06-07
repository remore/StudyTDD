<?php

/*
問：
三角形の各辺の長さを表す整数を入力として、以下の値を返す関数を作れ。
　・正三角形の場合は1
　・二等辺三角形の場合は2
　・不等辺三角形の場合は3
そして、各辺が三角形を形成しない場合は例外を起こす。
*/

/*
■感想：
・IsTriangular()が出来上がったけど、ふわふわしてる。バグがないかなあと心配。
　⇒テストケースの洗い出しが足りてないかも。
・テストリストを洗い出して、書き方が「明白」でもなく「わからない」でもなく
　「たぶん大丈夫」なものからテストを書いていったけど、このやり方はかなり有効。
・結局、test*_validとtest*_invalidの2パターンのテストが出来た。
　例外を扱う場合と、扱わない場合の2通り。
・途中、テストコードを追加すると思ってもみないところでエラーが出たりしてびびったが、
　その後そのエラーをつぶすというステップを明確に踏めたことで、
　レッド・グリーン・リファクタリングのリズムが回るにつれてコードに対する自信が深まっていくように感じた。

■気を付けたこと：
・テストの関数名はできるだけ長く
・コメントは極力書かない（コードでわかるようにきれいに書くことを心がけた）


*/

function IsTriangular( $a, $b, $c ){
	if ( $a<1 || $b<1 || $c<1 ) {
		throw new Exception('my first exception');
		
	} else if( !is_int($a) || !is_int($b) || !is_int($c) ) {
		throw new Exception('my first exception');
		
	} else if( $a===$b && $b===$c && $c===$a ) {
		return 1;
		
	} else {
		$p = array( $a, $b, $c );
		rsort($p);
		if ($p[0] >= $p[1]+$p[2] ) {
			throw new Exception('Cannot be a triangular');
			
		} else if( $a===$b || $b===$c || $c===$a ) {
			return 2;
			
		} else {
			return 3;
			
		}
	}
}

class TriangularTest extends PHPUnit_Framework_TestCase
{

    protected function setUp() {}
    protected function tearDown() {}
    
    
    /*
    
    正三角形のテスト
    
    */
    
    
    public function testEquilateralTriangular_valid(){
    	$this->assertEquals(1, IsTriangular(1, 1, 1));
    }
    
    public function testEquilateralTriangular_invalid_zero(){
    	try {
    		IsTriangular(0, 0, 0);
    		
    	} catch (Exception $e) {
    		$this->assertTrue(true);
    	}
    	if (!isset($e)) $this->fail('期待通りの例外が発生しませんでした。');
    }
    
    public function testEquilateralTriangular_invalid_pointnumber(){
    	try {
    		IsTriangular(1.5, 1.5, 1.5);
    		
    	} catch (Exception $e) {
    		$this->assertTrue(true);
    	}
    	if (!isset($e)) $this->fail('期待通りの例外が発生しませんでした。');
    }
    
    
    /*
    
    二等辺三角形のテスト
    
    */
    
    
    public function testIsoscelesTriangular_valid(){
    	$this->assertEquals(2, IsTriangular(2, 2, 1));
    	$this->assertEquals(2, IsTriangular(1, 2, 2));
    	$this->assertEquals(2, IsTriangular(2, 1, 2));
    }
    
    public function testIsoscelesTriangular_invalid_pointnumber(){
    	try {
    		IsTriangular(2.5, 1, 2.5);
    		
    	} catch (Exception $e) {
    		$this->assertTrue(true);
    	}
    	if (!isset($e)) $this->fail('期待通りの例外が発生しませんでした。');
    }
    
    public function testIsoscelesTriangular_invalid_zero(){
    	try {
    		IsTriangular(0, 1, 1);
    		
    	} catch (Exception $e) {
    		$this->assertTrue(true);
    	}
    	if (!isset($e)) $this->fail('期待通りの例外が発生しませんでした。');
    }
    
    
    /*
    
    不等辺三角形のテスト
    
    */
    
    
    public function testScaleneTriangular_valid(){
    	$this->assertEquals(3, IsTriangular(10, 5, 7));
    }
    
    public function testScaleneTriangular_invalid(){
    	try {
    		echo IsTriangular(10, 5, 5);
    		
    	} catch (Exception $e) {
    		$this->assertTrue(true);
    	}
    	if (!isset($e)) $this->fail('期待通りの例外が発生しませんでした。');
    }
    
    public function testScaleneTriangular_invalid_nagative(){
    	try {
    		echo IsTriangular(2,-2,15);
    		
    	} catch (Exception $e) {
    		$this->assertTrue(true);
    	}
    	if (!isset($e)) $this->fail('期待通りの例外が発生しませんでした。');
    }
    
    
    /*
    
    その他のテスト
    
    */
    
    
    public function testTriangular_invalid_datatype_string(){
    	try {
    		echo IsTriangular("1",1,1);
    		
    	} catch (Exception $e) {
    		$this->assertTrue(true);
    	}
    	if (!isset($e)) $this->fail('期待通りの例外が発生しませんでした。');
    }
    
    public function testTriangular_invalid_datatype_pointnumber(){
    	try {
    		echo IsTriangular(1,1.0,1);
    		
    	} catch (Exception $e) {
    		$this->assertTrue(true);
    	}
    	if (!isset($e)) $this->fail('期待通りの例外が発生しませんでした。');
    }
    
}

?>