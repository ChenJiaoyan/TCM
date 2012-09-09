<?php
include_once ("top.php");
if(isset($_REQUEST["action"])){
	if($_REQUEST["action"]=="edit"){
		include_once ("edit.php");
	}else{
		include_once ("view.php");
	}
}else{
	include_once ("view.php");
}
include_once ("foot.php");
?>
