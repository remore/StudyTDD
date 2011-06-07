<?php
function render($keys, $params){
	header("Content-type:text/html;charset=utf-8");
	echo str_replace($keys, $params, file_get_contents('./views/'.$_GET['action'].'.html'));
}
?>