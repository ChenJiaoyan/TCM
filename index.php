<?php
include_once ("top.html");
if(isset($_REQUEST["action"])){
	if($_REQUEST["action"]=="edit"){
		include_once ("edit.html");
	}else{
		include_once ("view.html");
	}
}else{
	include_once ("view.html");
}
include_once ("foot.html");
?>
