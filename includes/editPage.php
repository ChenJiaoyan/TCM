<?php
include(dirname(__FILE__).'\getArticleInfo.php');
if(isset($_REQUEST["action"])){
	$type=$_REQUEST["action"];
}else{
	echo "false";
}
switch ($type){
	case "newArticle";
		echo '<table id="article">
			<tr id="atitle"><td class="lab_title">文章题目: </td><td><input type="text"></input></td></tr>
			<tr id="acategory"><td class="lab_title">文章分类: </td><td><select><option selected="selected" value="doctor">医生</option><option value="patient">患者</option><option value="organization">机构</option></select></td></tr>
			<tr id="adate"><td class="lab_title">完成日期: </td><td><input id="art_date" value="0000-00-00" onmouseout="isDate()"></input><span id="art_date_error"></span></td></tr>
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
			<tr><td id="tag_a">摘要:</td><td><textarea rows="5" cols="80"></textarea></td></tr>
			<tr></tr>
			</table>
			<hr/>
			<br/>
			<table id="chapter">
			<tr class="cnum"><td class="tag_ch">第1章</td></tr>
			<tr class="ctitle"><td id="chapter_t">标题:</td><td><input type="text"></input></td></tr>
			<tr class="ccont"><td id="chapter_c">内容: </td><td><textarea rows="10" cols="80"></textarea></td></tr>
			<tr><td><input class="chap_up" type="button" value="上移"></input>&nbsp<input class="chap_down" type="button" value="下移"></input></td><td><input class="chap_add" type="button" value="增加" onclick="editPage.addChapter(0);"></input>&nbsp<input class="chap_del" type="button" value="删除" onclick="editPage.delChapter(0);"></input></td></tr>
			<tr><td></br></td></tr>
			</table>
			<hr/>
			<br/>
			<table id="edit_button">
			<tr><td><input type="button" value="保存至草稿箱" onclick="dbAction.saveArticle(0)"></input><input type="button" value="保存并发布" onclick="dbAction.saveArticle(1)"></input><input type="button" value="放弃" onclick="editPage.giveup()"></input></td></tr>
			</table>';
		break;
	case "editArticle";
//读出内容，显示
		$articleID=$_REQUEST["articleID"];
		$articleInfo = getArticle($articleID);
		if($articleInfo["published"]==0)
		{
			$content = '<table id="article">
				<tr><td>文章编号：</td><td>'.$articleInfo["articleID"].'<span>&nbsp&nbsp(草稿)</span></td></tr>
				<tr id="atitle"><td class="lab_title">文章题目: </td><td><input type="text" value="'.$articleInfo["title"].'"></input></td></tr>';
		}
		else
		{
			$content = '<table id="article">
				<tr><td>文章编号：</td><td>'.$articleInfo["articleID"].'<span>&nbsp&nbsp(已发布)</span></td></tr>
				<tr id="atitle"><td class="lab_title">文章题目: </td><td><input type="text" value="'.$articleInfo["title"].'"></input></td></tr>';
		}
		if(strcmp($articleInfo["category"],"doctor")==0)
		{
			$content .= '<tr id="acategory"><td class="lab_title">文章分类: </td><td><select><option selected="selected" value="doctor">医生</option><option value="patient">患者</option><option value="organization">机构</option></select></td></tr>
			<tr id="adate"><td class="lab_title">完成日期: </td><td><input id="art_date" value="'.$articleInfo["createtime"].'" onmouseout="isDate()"></input><span id="art_date_error"></span></td></tr>
			</table>';
		}
		else if(strcmp($articleInfo["category"],"patient")==0)
		{
			$content .= '<tr id="acategory"><td class="lab_title">文章分类: </td><td><select><option value="doctor">医生</option><option selected="selected" value="patient">患者</option><option value="organization">机构</option></select></td></tr>
			<tr id="adate"><td class="lab_title">完成日期: </td><td><input id="art_date" value="'.$articleInfo["createtime"].'" onmouseout="isDate()"></input><span id="art_date_error"></span></td></tr>
			</table>';
		}
		else if(strcmp($articleInfo["category"],"organization")==0)
		{
			$content .= '<tr id="acategory">
			<td class="lab_title">文章分类: </td>
			<td><select><option value="doctor">医生</option>
				<option value="patient">患者</option>
				<option selected="selected" value="organization">机构</option></select>
			</td></tr>
			<tr id="adate"><td class="lab_title">完成日期: </td>
			<td><input id="art_date" value="'.$articleInfo["createtime"].'" onmouseout="isDate()"></input><span id="art_date_error"></span></td></tr>
			</table>';
		}
		$content .= '
			<hr/>
			<br/>
			<table id="author">';
		$authorInfo = getAuthor($articleID);
		for($i=1; $i<=$authorInfo["header"]["authorNum"]; $i++)
		{
			$name = $authorInfo["author".$i]["name"];
			$mail = $authorInfo["author".$i]["mail"];
			$content .= '<tr class="authorl">
			<td class="lab_a">作者'.$i.'</td>
			<td clss="lab_n">姓名:</td>
			<td class="input_n"><input class="authorn" type="text" value="'.$name.'"></input></td>
			<td class="lab_m">邮箱: </td>
			<td class="input_m"><input class="authorm" type="text" value="'.$mail.'"></input></td>
			<td><input class="authord" type="button" value="删除" onclick="editPage.delAuthor('.($i-1).');"></input></td>
			</tr>';
		}
		$content .=	'<tr class="addauthor"><td><input type="button" value="增加作者" onclick="editPage.addAuthor();"></input></td></tr>
			</table>';
			
		$content .= '
			<hr/>
			<br/>
			<table id="key">';
		$keyInfo = getKeyword($articleID);
		for($i=1; $i<=$keyInfo["header"]["keyNum"]; $i++)
		{
			$key = $keyInfo["key".$i]["keyValue"];
			$content .= '<tr class="keyl">
			<td class="tag_k">关键字'.$i.': </td>
			<td class="input_k"><input class="keyinput" type="text" value="'.$key.'"></input></td>
			<td><input class="keydel" type="button" value="删除" onclick="editPage.delKey('.($i-1).')"></input></td>
			</tr>';
		}
		$content .= '<tr class="addkey"><td><input type="button" value="增加关键字" onclick="editPage.addKey();"></input></td></tr>
			</table>';
			
		$content .= '<hr/>
			<br/>
			<table id="abstract">
			<tr><td id="tag_a">摘要:</td><td><textarea rows="5" cols="80">'.$articleInfo["art_abstract"].'</textarea></td></tr>
			<tr></tr>
			</table>
			<hr/>
			<br/>
			<table id="chapter">';
		
		$chapterInfo = getAllChapters($articleID);
		for($i=1; $i<=$chapterInfo["header"]["chapterNum"]; $i++)
		{
			$chaTitle = $chapterInfo["chapter".$i]["chaTitle"];
			$chaContent = $chapterInfo["chapter".$i]["chaContent"];
			$content .= '<tr class="cnum"><td class="tag_ch">第'.$i.'章</td></tr>
			<tr class="ctitle"><td id="chapter_t">标题:</td><td><input type="text" value="'.$chaTitle.'"></input></td></tr>
			<tr class="ccont"><td id="chapter_c">内容: </td><td><textarea rows="10" cols="80">'.$chaContent.'</textarea></td></tr>
			<tr><td><input class="chap_up" type="button" value="上移"></input>&nbsp<input class="chap_down" type="button" value="下移"></input></td>
				<td><input class="chap_add" type="button" value="增加" onclick="editPage.addChapter('.($i-1).');"></input>&nbsp<input class="chap_del" type="button" value="删除" onclick="editPage.delChapter('.($i-1).');"></input></td>
			</tr>
			<tr><td></br></td></tr>';
		}
		$content .= '</table>
			<hr/>
			<br/>
			<table id="edit_button">';
			
		if($articleInfo["published"]==0)
		{	
			$content .= '<tr><td><input type="button" value="保存至草稿箱" onclick="dbAction.updateArticle('.$articleID.',0)"></input><input type="button" value="保存并发布" onclick="dbAction.updateArticle('.$articleID.',1)"></input><input type="button" value="放弃" onclick="editPage.giveup()"></input></td></tr>
			</table>';
		}
		else
		{
			$content .= '<tr><td><input type="button" value="保存" onclick="dbAction.updateArticle('.$articleID.',1)"></input><input type="button" value="放弃" onclick="editPage.giveup()"></input></td></tr>
			</table>';
		}
		echo $content;
		break;
	case "editChapter";	//读取某一章节信息
		$articleID=$_REQUEST["articleID"];
		$chapterRank=$_REQUEST["chapterRank"];
		$chaInfo = getChapter($articleID,$chapterRank);
		$artInfo = getArticle($articleID);
		if($artInfo["published"] == 0)
		{
			$content = '<table id="article">
				<tr><td>文章编号：</td><td>'.$articleID.'<span>&nbsp&nbsp(草稿)</span></td></tr>
				<tr id="atitle"><td class="lab_title">文章题目: </td>..<td><input type="text" readonly="readonly" value="'.$artInfo["title"].'"></input></td></tr>
				</table>';
		}
		else
		{
			$content = '<table id="article">
				<tr><td>文章编号：</td><td>'.$articleID.'<span>&nbsp&nbsp(已发布)</span></td></tr>
				<tr id="atitle"><td class="lab_title">文章题目: </td><td><input type="text" readonly="readonly" value="'.$artInfo["title"].'"></input></td></tr></table>';
		}
		$content .= '
				<hr/>
				<table id="chapter">
				<tr class="cnum"><td class="tag_ch">第'.$chapterRank.'章</td></tr>
				<tr class="ctitle"><td id="chapter_t">标题:</td><td><input type="text" value="'.$chaInfo["chaTitle"].'"></input></td></tr>
				<tr class="ccont"><td id="chapter_c">内容: </td><td><textarea rows="10" cols="80">'.$chaInfo["chaContent"].'</textarea></td></tr>
				<tr><td></br></td></tr>
				</table>
				<table id="edit_button">';
		$content .= '<tr><td><input type="button" value="保存" onclick="dbAction.updateChapter('.$articleID.','.$chapterRank.')"></input><input type="button" value="放弃" onclick="editPage.giveup()"></input></td></tr>
			</table>';
		echo $content;
		break;
}
?>
