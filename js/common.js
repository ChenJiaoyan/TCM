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
	},
	addAuthor:function(){
		var len=$(".authorl").length;
		var str = "作者"+(len+1);
		var tr = '<tr class="authorl"><td class="lab_a">' + str + '</td><td clss="lab_n">姓名: </td><td class="input_n"><input class="authorn" type="text"></input></td><td class="lab_m">邮箱: </td><td class="input_m"><input class="authorm" type="text"></input></td><td><input class="authord" type="button" value="删除" onclick="editPage.delAuthor('+ len  +')"></input></td></tr>';
		$(".addauthor").before(tr);

	},
	delAuthor:function(index){
		$("#author").children().children().eq(index).remove();
		var len=$(".authorl").length;
		var i;
		for(i=index;i<len;i++){
			var str = "作者"+(i+1);
			$(".lab_a").eq(i).html(str);
			var str2 = "editPage.delAuthor("+i+")";
			$(".authord").eq(i).attr("onclick",str2);
			
		}
		
	},
	addKey:function(){
		var len=$(".keyl").length;
		var str = "关键字"+(len+1);
		var tr = '<tr class="keyl"><td class="tag_k">'+ str +': </td><td class="input_k"><input class="keyinput" type="text"></input></td><td><input class="keydel" type="button" value="删除" onclick="editPage.delKey('+ len +')"></input></td></tr>';
		$(".addkey").before(tr);
	},
	delKey:function(index){
		$("#key").children().children().eq(index).remove();	
		var len=$(".keyl").length;
		var i;
		for(i=index;i<len;i++){
			var str = "关键字" + (i+1);
			$(".tag_k").eq(i).html(str);	
			var str2 = "editPage.delKey("+i+")";
			$(".keydel").eq(i).attr("onclick",str2);
		}
	}
};
