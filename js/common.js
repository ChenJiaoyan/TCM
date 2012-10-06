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
	editArticle:function(art_tit){
		$.post(site + "/includes/editPage.php?action=editArticle&art_tit="+art_tit,function(data){
			if(data=="fasle"){
				alert("加载表单失败!");
			}else{
				$("#content2").html(data);
			}	
		});
	},
	editChapter:function(art_tit,cha_num){
		$.post(site + "/includes/editPage.php?action=editChapter&art_tit="+art_tit+"&cha_num="+cha_num,function(data){
			if(data=="fasle"){
				alert("加载表单失败!");
			}else{
				$("#content2").html(data);
			}	
		});
	},
	giveup:function(){
		//重新读出文章
		tag = confirm("您确定放弃吗？");
		if(tag){
			$("#content2").html('<div id="edit_mess"><p style="font-size:20px;">欢迎编辑您的文章!</p><br/><p>选择左侧导航编辑您已有文章!</p><p><a href="javascript:editPage.newArticle()">增加新文章</a></p></div>');
		}
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
	},
	addChapter:function(index){
		var str="第"+(index+2)+"章";
		var tr = '<tr class="cnum"><td class="tag_ch">'+ str +'</td></tr><tr class="ctitle"><td id="chapter_t">标题:</td><td><input type="text"></input></td></tr><tr class="ccont"><td id="chapter_c">内容: </td><td><textarea rows="10" cols="100"></textarea></td></tr><tr><td><input class="chap_up" type="button" value="上移"></input>&nbsp<input class="chap_down" type="button" value="下移"></input></td><td><input class="chap_add" type="button" value="增加" onclick="editPage.addChapter(' + (index+1) + ');"></input>&nbsp<input class="chap_del" type="button" value="删除" onclick="editPage.delChapter(' + (index+1) + ');"></input></td></tr><tr><td></br></td></tr>';
		$("#chapter").children().children().eq(index*5+4).after(tr);
		var len=$(".cnum").length;
		var i;
		for(i=index+2;i<len;i++){
			var str = "第" + (i+1) + "章";
			$(".tag_ch").eq(i).html(str);
			var str2 = "editPage.delChapter("+i+")";
			$(".chap_del").eq(i).attr("onclick",str2);
			var str3 = "editPage.addChapter("+i+")";
			$(".chap_add").eq(i).attr("onclick",str3);
		}
	},
	delChapter:function(index){
		var i;
		for(i=0;i<5;i++){
			$("#chapter").children().children().eq(index*5).remove();	
		}
		var len=$(".cnum").length;
		for(i=index;i<len;i++){
			var str = "第" + (i+1) + "章";
			$(".tag_ch").eq(i).html(str);
			var str2 = "editPage.delChapter("+i+")";
			$(".chap_del").eq(i).attr("onclick",str2);
			var str3 = "editPage.addChapter("+i+")";
			$(".chap_add").eq(i).attr("onclick",str3);
		}
	},
};
var dbAction={
	saveArticle:function(tag){
		alert(tag);
	},
	saveChapter:function(){
	},
};
