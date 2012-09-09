<?php
include_once ("components/top.php");
if(isset($_REQUEST["action"])){
	if($_REQUEST["action"]=="edit"){
		include_once ("components/edit.php");
	}else{
		include_once ("components/view.php");
	}
}else{
	include_once ("components/view.php");
}
include_once ("components/foot.php");
?>
