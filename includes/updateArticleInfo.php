<?php
include_once(dirname(__FILE__).'\saveArticleInfo.php');  
if(isset($_REQUEST['type']))
{
    $type=$_REQUEST['type'];
}
else
{
	return "请指定type";
}
if(isset($_REQUEST['articleID']))
{
	$articleID=$_REQUEST['articleID'];
}
else
{
	echo "请指定articleID";
	return ;
}

switch($type)
{
	case 'all':
		$result = updateArticle($articleID);
	    $result.= updateKeyword($articleID);
		$result.= updateAuthor($articleID);
		$result.= updateAllChapters($articleID); 
		echo $result;
		break;
	case 'article':echo updateArticle($articleID); break;
	case 'author':echo updateAuthor($articleID);  break;
	case 'allChapters':echo updateAllChapters($articleID);break;
	case 'keyword':echo updateKeyword($articleID); break;
	case 'chapter':
		$chapterRank=$_REQUEST['chaRank'];
		echo updateChapter($articleID,$chapterRank); break;
}

function updateArticle($articleID)
{
    $result="";
	if(!isset($_REQUEST['title'])||!isset($_REQUEST['category'])||!isset($_REQUEST['createtime'])||!isset($_REQUEST['published']))
	{
		$result=$result. "请注意文章题目、类别、创建时间、以及是否发布标志均不能为空";
		return $result;
	}
	
	$sql='UPDATE article SET art_title="'.$_REQUEST['title'].'",art_category="'.$_REQUEST['category'].'",art_createtime="'.$_REQUEST['createtime'].'",art_published="'.$_REQUEST['published'].'"';
		
	if(isset($_REQUEST['art_abstract']))
	{
		$sql.=',art_abstract="'.$_REQUEST['art_abstract'].'"';
	}

	$sql.=' WHERE art_id='.$articleID;

	$sqlResult= sqlExecute($sql);
	if($sqlResult["error"]==null)
	   $sqlResult["error"]="No error";
	$result= $result. "UPDATE article sql: ".$sql."<br/>Result: ".$sqlResult["error"]."<br/>";
	
	return $result;
}

function updateChapter($articleID,$chapterRank)
{
	$result="";
	$sql = 'UPDATE chapter SET cha_title="'.$_REQUEST["chaTitle"].'",cha_content="'.$_REQUEST["chaContent"].'" WHERE cha_article='.$articleID.' AND cha_rank='.$chapterRank;
   
	$sqlResult= sqlExecute($sql);
	if($sqlResult["error"]==null)
		$sqlResult["error"]="No error";
	$result= $result. "UPDATE chapter sql: ".$sql ."<br/>Result: ".$sqlResult["error"]."<br/>";
	
	return $result;
}

function updateAuthor($articleID)
{
	$result = deleteAuthor($articleID);
	$result.= saveAuthor($articleID);
	
	return $result;
}
function updateAllChapters($articleID)
{
    $result = deleteAllChapters($articleID);
	$result = $result.saveChapter($articleID);
	
	return $result;
}
function updateKeyword($articleID)
{
   $result = deleteKeyword($articleID);
   $result = $result. saveKeyword($articleID);
   
   return $result;
}

function deleteAuthor($articleID)
{
	
	$sql='DELETE FROM author WHERE ath_article="'.$articleID.'"';
	$sqlResult= sqlExecute($sql);
    if($sqlResult["error"]==null)
	   $sqlResult["error"]="No error";
    $result=  "DELETE author sql: ".$sql ."<br/> Result: ".$sqlResult["error"]."<br/>";
	
	return $result;
}

function deleteAllChapters($articleID)
{
	$sql='DELETE FROM chapter WHERE cha_article="'.$articleID.'"';
	$sqlResult= sqlExecute($sql);
    if($sqlResult["error"]==null)
	   $sqlResult["error"]="No error";
    $result=  "DELETE chapter sql: ".$sql ."<br/> Result: ".$sqlResult["error"]."<br/>";
	
	return $result;
}

function deleteKeyword($articleID)
{
	$sql='DELETE FROM keyword WHERE key_article="'.$articleID.'"';
	$sqlResult= sqlExecute($sql);
    if($sqlResult["error"]==null)
	   $sqlResult["error"]="No error";
    $result= "DELETE keyword sql: ".$sql ."<br/> Result: ".$sqlResult["error"]."<br/>";
	
	return $result;
}

?>