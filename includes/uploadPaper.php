<?php
$file_path="../files/";
if(is_dir($file_path)!=TRUE)
	mkdir($file_path,0664);
$ext_arr = array("pdf","doc","docx");
if(empty($_FILES)===false){
	if($_FILES["file"]["size"] > 20971520){
		echo '<script type="text/javascript">alert("对不起，您上传的文件大于20M")</script>';
	}else if($_FILES["file"]["error"]>0){
		echo '<script type="text/javascript">alert("对不起，文件上传发生错误")</script>';
	}else{
		$temp_arr = explode(".",$_FILES["file"]["name"]);
		$file_ext = array_pop($temp_arr);
		$file_ext = trim($file_ext);
		$file_ext = strtolower($file_ext);
		if(in_array($file_ext,$ext_arr) === false){
			echo '<script type="text/javascript">alert("对不起，您只能上传pdf/doc/docx/类型的文件")</script>';
		}else{
			$new_name = $_FILES["file"]["tmp_name"];
			move_uploaded_file($_FILES["file"]["tmp_name"],$file_path,$new_name);
			echo '<script type="text/javascript">alert("上传文件成功!")</script>';
		}
	}
}else{
	echo '<script type="text/javascript">alert("无正确的文件上传")</script>';
}
?>
