var jychen=jQuery.noConflict();
var site = "http://localhost/TCM";

jychen(document).ready(function(){
        jychen(".edit_form").data("changed",false);
});



function isDate(){
	var tag = true;
	 var str = jychen("#art_date").val();
	 var a = str.match(/^(\d{0,4})-(\d{0,2})-(\d{0,2})jychen/);
	 if (a == null){
	 	tag = false;
	 }else if ( a[2]>=13 || a[3]>=32 || a[4]>=24){
	 	tag = false;
	 }
	 if(!tag){
	 	jychen("#art_date_error").html("&nbsp&nbsp(时间格式有误)");
	 }
}


var editPage={
	replace:function(data,sta_mes){
		var tag = true;;
		if(jychen(".edit_form").data("changed")){
			if(!confirm("您确定放弃吗？")){
				tag=false;
			}
		}
		if(tag){
			jychen(".edit_form").html(data);
               		jychen(".edit_form").data("changed",false);
        		jychen(".edit_form :input").change(function(){
               			jychen(".edit_form").data("changed",true);
        		});
			jychen("#sta_content").html(sta_mes);
		}
	},
	newArticle:function(){
		jychen.post(site + "/includes/editPage.php?action=newArticle",function(data){
			if(data=="fasle"){
				alert("加载表单失败!");
			}else{
				editPage.replace(data,'新文章');	
			}	
		});
	},
	editArticle:function(art_tit){
		jychen.post(site + "/includes/editPage.php?action=editArticle&art_tit="+art_tit,function(data){
			if(data=="fasle"){
				alert("加载表单失败!");
			}else{
				editPage.replace(data,art_tit);	
			}	
		});
	},
	editChapter:function(art_tit,cha_num){
		jychen.post(site + "/includes/editPage.php?action=editChapter&art_tit="+art_tit+"&cha_num="+cha_num,function(data){
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
		if(jychen(".edit_form").data("changed")){
			if(!confirm("您确定放弃吗？")){
				tag = false;
			}
		}
		if(tag){
			jychen(".edit_form").html('<div id="edit_mess"><p style="font-size:20px;">欢迎编辑您的文章!</p><br/><p>选择左侧导航编辑您已有文章!</p><p><a href="javascript:editPage.newArticle()">增加新文章</a></p></div>');
			jychen(".edit_form").data("changed",false);
		}
	},
	addAuthor:function(){
		var len=jychen(".authorl").length;
		var str = "作者"+(len+1);
		var tr = '<tr class="authorl"><td class="lab_a">' + str + '</td><td clss="lab_n">姓名: </td><td class="input_n"><input class="authorn" type="text"></input></td><td class="lab_m">邮箱: </td><td class="input_m"><input class="authorm" type="text"></input></td><td><input class="authord" type="button" value="删除" onclick="editPage.delAuthor('+ len  +')"></input></td></tr>';
		jychen(".addauthor").before(tr);

	},
	delAuthor:function(index){
		jychen("#author").children().children().eq(index).remove();
		var len=jychen(".authorl").length;
		var i;
		for(i=index;i<len;i++){
			var str = "作者"+(i+1);
			jychen(".lab_a").eq(i).html(str);
			var str2 = "editPage.delAuthor("+i+")";
			jychen(".authord").eq(i).attr("onclick",str2);
			
		}
		
	},
	addKey:function(){
		var len=jychen(".keyl").length;
		var str = "关键字"+(len+1);
		var tr = '<tr class="keyl"><td class="tag_k">'+ str +': </td><td class="input_k"><input class="keyinput" type="text"></input></td><td><input class="keydel" type="button" value="删除" onclick="editPage.delKey('+ len +')"></input></td></tr>';
		jychen(".addkey").before(tr);
	},
	delKey:function(index){
		jychen("#key").children().children().eq(index).remove();	
		var len=jychen(".keyl").length;
		var i;
		for(i=index;i<len;i++){
			var str = "关键字" + (i+1);
			jychen(".tag_k").eq(i).html(str);	
			var str2 = "editPage.delKey("+i+")";
			jychen(".keydel").eq(i).attr("onclick",str2);
		}
	},
	addChapter:function(index){
		var str="第"+(index+2)+"章";
		var tr = '<tr class="cnum"><td class="tag_ch">'+ str +'</td></tr><tr class="ctitle"><td id="chapter_t">标题:</td><td><input type="text"></input></td></tr><tr class="ccont"><td id="chapter_c">内容: </td><td><textarea rows="10" cols="80"></textarea></td></tr><tr><td><input class="chap_up" type="button" value="上移"></input>&nbsp<input class="chap_down" type="button" value="下移"></input></td><td><input class="chap_add" type="button" value="增加" onclick="editPage.addChapter(' + (index+1) + ');"></input>&nbsp<input class="chap_del" type="button" value="删除" onclick="editPage.delChapter(' + (index+1) + ');"></input></td></tr><tr><td></br></td></tr>';
		jychen("#chapter").children().children().eq(index*5+4).after(tr);
		var len=jychen(".cnum").length;
		var i;
		for(i=index+2;i<len;i++){
			var str = "第" + (i+1) + "章";
			jychen(".tag_ch").eq(i).html(str);
			var str2 = "editPage.delChapter("+i+")";
			jychen(".chap_del").eq(i).attr("onclick",str2);
			var str3 = "editPage.addChapter("+i+")";
			jychen(".chap_add").eq(i).attr("onclick",str3);
		}
	},
	delChapter:function(index){
		var i;
		for(i=0;i<5;i++){
			jychen("#chapter").children().children().eq(index*5).remove();	
		}
		var len=jychen(".cnum").length;
		for(i=index;i<len;i++){
			var str = "第" + (i+1) + "章";
			jychen(".tag_ch").eq(i).html(str);
			var str2 = "editPage.delChapter("+i+")";
			jychen(".chap_del").eq(i).attr("onclick",str2);
			var str3 = "editPage.addChapter("+i+")";
			jychen(".chap_add").eq(i).attr("onclick",str3);
		}
	},
};
var dbAction={
//增加新文章的时候调用这个函数
	saveArticle:function(published){
		var art_title = jychen("#atitle input").val();
		var art_categroy = jychen("#acategory select").val();
		var art_date = jychen("#adate input").val();
		var art_abstract = jychen("#abstract textarea").val();
	//	jychen(".authorl input:eq(3)").val()
		alert(published);
	},
//编辑文章的时候调用
	editChapter:function(){
	},
	editArticle:function(){
	},
};
