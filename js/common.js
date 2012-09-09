var site = "http://localhost/TCM";
var editPage={
	newArticle:function(){
		$.post(site + "/includes/editPage.php?action=newArticle",function(data){
			if(data=="fasle"){
				alert("加载表单失败!");
			}else{
				$("#content2").html(data);
			}	
		});
	}
};
