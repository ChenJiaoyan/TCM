<?php
if(isset($_REQUEST["action"])){
	$type=$_REQUEST["action"];
}else{
	echo "false";
}
switch ($type){
	case "newArticle";
		echo '<table id="article">
			<tr id="atitle"><td class="lab_title">文章题目: </td><td><input type="text"></input></td></tr>
			<tr id="acategory"><td class="lab_title">文章分类: </td><td><select><option value="Category1">医生</option><option value="Category2">患者</option><option value="Category3">机构</option></select></td></tr>
			<tr id="adate"><td class="lab_title">完成日期: </td><td><input type="text" id="year"></input>年<input type="text" id="month"></input>月<input type="text" id="day"></input>日</td></tr>
			</table>
			<hr/>
			<br/>
			<table id="author">
			<tr class="authorl"><td class="lab_a">作者1</td><td clss="lab_n">姓名: </td><td class="input_n"><input class="authorn" type="text"></input></td><td class="lab_m">邮箱: </td><td class="input_m"><input class="authorm" type="text"></input></td><td><input class="authord" type="button" value="删除" onclick="editPage.delAuthor(0);"></input></td></tr>
			<tr class="addauthor"><td><input type="button" value="增加作者" onclick="editPage.addAuthor();"></input></td></tr>
			</table>
			<hr/>
			<br/>
			<table id="key">
			<tr class="keyl"><td class="tag_k">关键字1: </td><td class="input_k"><input class="keyinput" type="text"></input></td><td><input class="keydel" type="button" value="删除" onclick="editPage.delKey(0)"></input></td></tr>
			<tr class="addkey"><td><input type="button" value="增加关键字" onclick="editPage.addKey();"></input></td></tr>
			</table>
			<hr/>
			<br/>
			<table id="abstract">
			<tr><td id="tag_a">摘要:</td><td><textarea rows="5" cols="100"></textarea></td></tr>
			<tr></tr>
			</table>
			<hr/>
			<br/>
			<table id="chapter">
			<tr class="cnum"><td class="tag_ch">第1章</td></tr>
			<tr class="ctitle"><td id="chapter_t">标题:</td><td><input type="text"></input></td></tr>
			<tr class="ccont"><td id="chapter_c">内容: </td><td><textarea rows="10" cols="100"></textarea></td></tr>
			<tr><td><input class="chap_up" type="button" value="上移"></input>&nbsp<input class="chap_down" type="button" value="下移"></input></td><td><input class="chap_add" type="button" value="增加" onclick="editPage.addChapter(0);"></input>&nbsp<input class="chap_del" type="button" value="删除" onclick="editPage.delChapter(0);"></input></td></tr>
			<tr><td></br></td></tr>
			</table>
			<hr/>
			<br/>
			<table>
			<tr><td>上传pdf文件</td></tr>
			</table>
			<hr/>
			<br/>
			<table id="edit_button">
			<tr><td><input type="button" value="预览"></input><input type="button" value="保存至草稿箱"></input><input type="button" value="保存并发布"></input><input type="button" value="放弃"></input></td></tr>
			</table>';
		break;
	case "";
		break;
}
?>
