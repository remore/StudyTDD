<?php
class DataSource
{
	function read( $url ){
		return simplexml_load_file($url);
		//return new test();
	}
	
	function getcontents( $url, $mode ){
		if ($mode==="list") {
			$list = "";
			$data = $this->read($url);
			if ($data==!false) {
				foreach ($data->channel->item as $arr) {
					$list .= sprintf("<a href='%s'>%s</a><br/>",$arr->link, $arr->title );
				}
			}
			return $list;
			
		} else if ($mode==="detail") {
			$data = $this->read($url);
			if ($data) {
				return sprintf("<a href='%s'><h1>%s</h1></a><br/><div>%s</div>", $data->channel->item[0]->link, $data->channel->item[0]->title, $data->channel->item[0]->description );
			} else {
				return "";
			}
		
		} else {
			return "";
		}
	}
}

class test { function __construct(){$this->title="engadget";}}

?>