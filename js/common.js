var site = "http://localhost/TCM";

$(document).ready(function(){
        $(".edit_form").data("changed",false);
});



function isDate(){
	var tag = true;
	 var str = $("#art_date").val();
	 var a = str.match(/^(\d{0,4})-(\d{0,2})-(\d{0,2})$/);
	 if (a == null){
	 	tag = false;
	 }else if ( a[2]>=13 || a[3]>=32 || a[4]>=24){
	 	tag = false;
	 }
	 if(!tag){
	 	$("#art_date_error").html("&nbsp&nbsp(时间格式有误)");
	 }
}


var editPage={
	replace:function(data,sta_mes){
		var tag = true;;
		if($(".edit_form").data("changed")){
			if(!confirm("您确定放弃吗？")){
				tag=false;
			}
		}
		if(tag){
			$(".edit_form").html(data);
               		$(".edit_form").data("changed",false);
        		$(".edit_form :input").change(function(){
               			$(".edit_form").data("changed",true);
        		});
			$("#sta_content").html(sta_mes);
		}
	},
	newArticle:function(){
		$.post(site + "/includes/editPage.php?action=newArticle",function(data){
			if(data=="fasle"){
				alert("加载表单失败!");
			}else{
				editPage.replace(data,'新文章');	
			}	
		});
	},
	editArticle:function(art_tit){
		$.post(site + "/includes/editPage.php?action=editArticle&art_tit="+art_tit,function(data){
			if(data=="fasle"){
				alert("加载表单失败!");
			}else{
				editPage.replace(data,art_tit);	
			}	
		});
	},
	editChapter:function(art_tit,cha_num){
		$.post(site + "/includes/editPage.php?action=editChapter&art_tit="+art_tit+"&cha_num="+cha_num,function(data){
			if(data=="fasle"){
				alert("加载表单失败!");
			}else{
				editPage.replace(data,art_tit+" | 第"+cha_num+"章");	
			}	
		});
	},
	giveup:function(){
		//重新读出文章
		var tag = true;
		if($(".edit_form").data("changed")){
			if(!confirm("您确定放弃吗？")){
				tag = false;
			}
		}
		if(tag){
			$(".edit_form").html('<div id="edit_mess"><p style="font-size:20px;">欢迎编辑您的文章!</p><br/><p>选择左侧导航编辑您已有文章!</p><p><a href="javascript:editPage.newArticle()">增加新文章</a></p></div>');
			$(".edit_form").data("changed",false);
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
		var tr = '<tr class="cnum"><td class="tag_ch">'+ str +'</td></tr><tr class="ctitle"><td id="chapter_t">标题:</td><td><input type="text"></input></td></tr><tr class="ccont"><td id="chapter_c">内容: </td><td><textarea rows="10" cols="80"></textarea></td></tr><tr><td><input class="chap_up" type="button" value="上移"></input>&nbsp<input class="chap_down" type="button" value="下移"></input></td><td><input class="chap_add" type="button" value="增加" onclick="editPage.addChapter(' + (index+1) + ');"></input>&nbsp<input class="chap_del" type="button" value="删除" onclick="editPage.delChapter(' + (index+1) + ');"></input></td></tr><tr><td></br></td></tr>';
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
	saveArticle:function(published){
		var art_title = $("#atitle input").val();
		var art_categroy = $("#acategory select").val();
		var art_date = $("#adate input").val();
		var art_abstract = $("#abstract textarea").val();
	//	$(".authorl input:eq(3)").val()
		alert(published);
	},
	saveChapter:function(){
	},
};
