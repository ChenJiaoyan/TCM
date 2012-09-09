<?php
include_once (dirname(__FILE__)."/components/top.php");
if(isset($_REQUEST["action"])){
	if($_REQUEST["action"]=="edit"){
		include_once (dirname(__FILE__)."/components/edit.php");
	}else{
		include_once (dirname(__FILE__)."/components/view.php");
	}
}else{
	include_once (dirname(__FILE__)."/components/view.php");
}
include_once (dirname(__FILE__)."/components/foot.php");
?>
