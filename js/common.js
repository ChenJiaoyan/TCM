var jychen=jQuery.noConflict();
var site = "http://localhost/TCM";

jychen(document).ready(function(){
        jychen(".edit_form").data("changed",false);
});

function isDate(){
	var tag = true;
	 var str = jychen("#art_date").val();
	 var a = str.match(/^(\d{0,4})-(\d{0,2})-(\d{0,2})$/);
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
	editArticle:function(articleID){
		jychen.post(site + "/includes/editPage.php?action=editArticle&articleID="+articleID,function(data){
			if(data=="fasle"){
				alert("加载表单失败!");
			}else{
				editPage.replace(data,articleID);	
			}	
		});
	},
	editChapter:function(articleID,chapterRank){
		jychen.post(site + "/includes/editPage.php?action=editChapter&articleID="+articleID+"&chapterRank="+chapterRank, function(data){
			if(data=="fasle"){
				alert("加载表单失败!");
			}else{
//				alert(data);
				editPage.replace(data,articleID+" | 第"+chapterRank+"章");	
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
	saveArticle:function(ln_published){
		var ln_title = jychen("#atitle input").val();
		var ln_categroy = jychen("#acategory select").val();
		var ln_createtime = jychen("#adate input").val();
		var ln_art_abstract = jychen("#abstract textarea").val();
		
		var ln_authorNum = jychen("#author .authorl").size();	//获取作者信息
		var authorArray = {};
		for(var i=1; i<=ln_authorNum; i++)
		{
			authorArray["name"+i] = jychen("#author .authorl:eq("+(i-1)+") input:eq(0)").val();
			authorArray["mail"+i] = jychen("#author .authorl:eq("+(i-1)+") input:eq(1)").val();
			authorArray["rank"+i] = i;
		}
		
		var ln_chapterNum = jychen("#chapter .cnum").size();	//获取章节信息
		var chapterArray = {};
		for(var i=1; i<=ln_chapterNum; i++)
		{
			chapterArray["chaTitle"+i] = jychen("#chapter .ctitle:eq("+(i-1)+") input").val();
			chapterArray["chaContent"+i] = jychen("#chapter .ccont:eq("+(i-1)+") textarea").val();
			chapterArray["chaRank"+i] = i;
		}
		
		var ln_keyNum = jychen("#key .keyl").size();	//获取关键字信息
		var keyArray = {};
		for(var i=1; i<=ln_keyNum; i++)
		{
			keyArray["keyValue"+i] = jychen("#key .keyl:eq("+(i-1)+") input:eq(0)").val();
			keyArray["keyRank"+i] = i;
		}
		
		var url = site + "/includes/saveArticleInfo.php";
		var str_all = {type:"all",title:ln_title,category:ln_categroy,createtime:ln_createtime,art_abstract:ln_art_abstract,published:ln_published};
				
		str_all["authorNum"] = ln_authorNum;
		for(var i=1; i<=ln_authorNum; i++)
		{
			str_all["name"+i] = authorArray["name"+i];
			str_all["mail"+i] = authorArray["mail"+i];
			str_all["rank"+i] = authorArray["rank"+i];
		}
		
		str_all["chapterNum"] = ln_chapterNum;
		for(var i=1; i<=ln_chapterNum; i++)
		{
			str_all["chaTitle"+i] = chapterArray["chaTitle"+i];
			str_all["chaContent"+i] = chapterArray["chaContent"+i];
			str_all["chaRank"+i] = chapterArray["chaRank"+i];
		}
		
		str_all["keyNum"] = ln_keyNum;
		for(var i=1; i<=ln_keyNum; i++)
		{
			str_all["keyValue"+i] = keyArray["keyValue"+i];
			str_all["keyRank"+i] = keyArray["keyRank"+i];
		}
		jychen.post(url,str_all,function(result){
			window.location.reload(); //刷新页面
		});

	},
	
	//更新文章的时候调用
	updateChapter:function(ln_articleID,ln_chaRank)//更新单个章节
	{
		var ln_chaTitle = jychen("#chapter .ctitle input").val();
		var ln_chaContent = jychen("#chapter .ccont textarea").val();

		var url = site + "/includes/updateArticleInfo.php";
		var str_chapter = {type:"chapter",articleID:ln_articleID,chaRank:ln_chaRank,chaTitle:ln_chaTitle,chaContent:ln_chaContent};
		
		jychen.post(url,str_chapter,function(result){
//			alert(result);
			window.location.reload(); //刷新页面
		});	
	},
	
	updateArticle:function(ln_articleID,ln_published)//	更新整篇文章
	{
		var ln_title = jychen("#atitle input").val();
		var ln_categroy = jychen("#acategory select").val();
		var ln_createtime = jychen("#adate input").val();
		var ln_art_abstract = jychen("#abstract textarea").val();
		
		var ln_authorNum = jychen("#author .authorl").size();	//获取作者信息
		var authorArray = {};
		for(var i=1; i<=ln_authorNum; i++)
		{
			authorArray["name"+i] = jychen("#author .authorl:eq("+(i-1)+") input:eq(0)").val();
			authorArray["mail"+i] = jychen("#author .authorl:eq("+(i-1)+") input:eq(1)").val();
			authorArray["rank"+i] = i;
		}
		
		var ln_chapterNum = jychen("#chapter .cnum").size();	//获取章节信息
		var chapterArray = {};
		for(var i=1; i<=ln_chapterNum; i++)
		{
			chapterArray["chaTitle"+i] = jychen("#chapter .ctitle:eq("+(i-1)+") input").val();
			chapterArray["chaContent"+i] = jychen("#chapter .ccont:eq("+(i-1)+") textarea").val();
			chapterArray["chaRank"+i] = i;
		}
		
		var ln_keyNum = jychen("#key .keyl").size();	//获取关键字信息
		var keyArray = {};
		for(var i=1; i<=ln_keyNum; i++)
		{
			keyArray["keyValue"+i] = jychen("#key .keyl:eq("+(i-1)+") input:eq(0)").val();
			keyArray["keyRank"+i] = i;
		}
		
		var url = site + "/includes/updateArticleInfo.php";
		var str_all = {type:"all",title:ln_title,articleID:ln_articleID,category:ln_categroy,createtime:ln_createtime,art_abstract:ln_art_abstract,published:ln_published};
				
		str_all["authorNum"] = ln_authorNum;
		for(var i=1; i<=ln_authorNum; i++)
		{
			str_all["name"+i] = authorArray["name"+i];
			str_all["mail"+i] = authorArray["mail"+i];
			str_all["rank"+i] = authorArray["rank"+i];
		}
		
		str_all["chapterNum"] = ln_chapterNum;
		for(var i=1; i<=ln_chapterNum; i++)
		{
			str_all["chaTitle"+i] = chapterArray["chaTitle"+i];
			str_all["chaContent"+i] = chapterArray["chaContent"+i];
			str_all["chaRank"+i] = chapterArray["chaRank"+i];
		}
		
		str_all["keyNum"] = ln_keyNum;
		for(var i=1; i<=ln_keyNum; i++)
		{
			str_all["keyValue"+i] = keyArray["keyValue"+i];
			str_all["keyRank"+i] = keyArray["keyRank"+i];
		}
		jychen.post(url,str_all,function(result){
//			alert(result);
			window.location.reload(); //刷新页面
		});	
	},
};




