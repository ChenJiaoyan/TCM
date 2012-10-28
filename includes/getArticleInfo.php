<?php
include(dirname(__FILE__).'\dbAction.php');    

if(isset($_REQUEST['type']))
    $type=$_REQUEST['type'];
else
{
	 return "请指定type";
}
if(isset($_REQUEST['articleID']))
    $articleID=$_REQUEST['articleID'];
else
{
	echo "请指定文章ID";
	return;
}
switch($type)
{
	case 'article':
		echo json_encode(getArticle($articleID)); break;
	case 'author':
		echo json_encode(getAuthor($articleID));  break;
	case 'allChapters':
		echo json_encode(getAllChapters($articleID));break;
	case 'chapter':
		if(isset($_REQUEST['chapterRank']))
	    {
			$chapterRank=$_REQUEST['chapterRank'];
	    }
		else
	    {
			echo "请指定chapterRank";
			return ;
	    }
	    echo json_encode(getChapter($articleID,$chapterRank));break;
	case 'keyword':
		echo json_encode(getKeyword($articleID)); break;
}

//获取文章信息
function getArticle($articleID)
{
	$queryResult=sqlExecute('SELECT * FROM article WHERE art_id='.$articleID);
	$result=$queryResult["result"];
	$row = mysql_fetch_array($result);
	$articleInfo = Array(
		"articleID"=>$row['art_id'],
		"title"=>$row['art_title'],
		"category"=>$row['art_category'],
		"createtime"=>$row['art_createtime'],
		"art_abstract"=>$row['art_abstract'],
		"file"=>$row['art_file'],
		"published"=>$row['art_published'],
		);
	return $articleInfo;
}
//获取所有的作者信息
function getAuthor($articleID)
{
	$queryResult=sqlExecute('SELECT * FROM author WHERE ath_article = "'.$articleID.'" ORDER BY ath_rank;');
	$result=$queryResult["result"];
	$authorInfo=Array();
    $i=1;
	$authorInfo['header']=Array(
		           "articleID"=>$articleID,
	               "authorNum"=>$i,
		);
	while($row = mysql_fetch_array($result))
    {
		$authorInfo['author'.$i.'']=Array(
		"id"=>$row['ath_id'],
		"name"=>$row['ath_name'],
		"mail"=>$row['ath_mail'],
		"rank"=>$row['ath_rank'],
		);
		$i++;
     }
	$authorInfo['header']['authorNum']=$i-1;
	
	return $authorInfo;
}
//获取所有的章节信息
function getAllChapters($articleID)
{
	$queryResult = sqlExecute('SELECT * FROM chapter WHERE cha_article = "'.$articleID.'" ORDER BY cha_rank;');
	$result=$queryResult["result"];
	$chapterInfo=Array();
    $i=1;
   $chapterInfo['header']=Array(
		           "articleID"=>$articleID,
	               "chapterNum"=>$i,
		);
	while($row = mysql_fetch_array($result))
    {
		$chapterInfo['chapter'.$i.'']=Array(
		"id"=>$row['cha_id'],
		"chaTitle"=>$row['cha_title'],
	    "chaContent"=>$row['cha_content'],
		"chaRank"=>$row['cha_rank'],
		);
		$i++;
     }
	$chapterInfo['header']['chapterNum']=$i-1;
	
	return $chapterInfo;
}
//获取特定的某一章节信息
function getChapter($articleID,$chapterRank)
{
	$queryResult=sqlExecute('SELECT * FROM chapter WHERE cha_article='.$articleID.' AND cha_Rank='.$chapterRank.';');
	//echo 'SELECT * FROM chapter WHERE cha_article='.$articleID.' AND cha_Rank='.$chapterRank.';';
	$result=$queryResult["result"];
	$row = mysql_fetch_array($result);
	$chapterInfo=Array(
		"id"=>$row['cha_id'],
		"chaTitle"=>$row['cha_title'],
	    "chaContent"=>$row['cha_content'],
		"chaRank"=>$row['cha_rank'],
		);
		
	return $chapterInfo;
}
//获取所有的关键字
function getKeyword($articleID)
{
	$queryResult=sqlExecute('SELECT * FROM keyword WHERE key_article = "'.$articleID.'" ORDER BY key_rank;');
	$result=$queryResult["result"];
	$keyInfo=Array();
    $i=1;
   $keyInfo['header']=Array(
		           "articleID"=>$articleID,
	               "keyNum"=>$i,
		);
	while($row = mysql_fetch_array($result))
    {
		$keyInfo['key'.$i.'']=Array(
			"id"=>$row['key_id'],
			"keyValue"=>$row['key_value'],
			"keyRank"=>$row['key_rank'],
		  );
		  $i++;
     }
	$keyInfo['header']['keyNum']=$i-1;
	
	return $keyInfo;
}

//Likun
function getArticleList()
{
	$sql = 'SELECT * FROM article ORDER BY art_id;';
	$queryResult = sqlExecute($sql);
	$result=$queryResult["result"];
	$article_list = Array();
	$i = 1;
	while($article = mysql_fetch_array($result))
	{
		$article_list[$i] = Array();
		$article_list[$i]['article_id'] = $article['art_id'];
		$article_list[$i]['article_title'] = $article['art_title'];
		
		$sql2 = 'SELECT * FROM chapter WHERE cha_article='.$article["art_id"].' ORDER BY cha_rank;';
		$queryResult = sqlExecute($sql2);
	    $result2=$queryResult["result"];
		$j = 1;
		while($chapter = mysql_fetch_array($result2))
		{
			$article_list[$i]['chapter'.$j] = $chapter['cha_title'];
			$j++;
		}
		$article_list[$i]['chapter_num'] = $j-1;
		$i++;
	}
	$article_list["article_num"] = $i-1;
	
	return $article_list;
}


?>