<?php
require_once('./model.php');
require_once('./view.php');

function getlist(){
	$data = simplexml_load_file("http://japanese.engadget.com/rss.xml");
	foreach ($data->channel->item as $arr) {
		$list .= sprintf("<a href='%s'>%s</a><br/>",$arr->link, $arr->title );
	}
	echo render(array("___LIST___"),  array($list) );
}

function getdetail(){
	$data = simplexml_load_file("http://japanese.engadget.com/rss.xml");
	$detail = sprintf("<a href='%s'><h1>%s</h1></a><br/><div>%s</div>", $data->channel->item[0]->link, $data->channel->item[0]->title, $data->channel->item[0]->description );
	echo render(array("___DETAIL___"),  array($detail) );
}

?>