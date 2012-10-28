<?php
include(dirname(__FILE__).'\dbAction.php');
if(isset($_REQUEST['type']))
    $type=$_REQUEST['type'];
switch($type)
{
	case 'all':
		$result=saveArticle();
	    $articleID=getArticleID($_REQUEST['title']);
	    $result.saveKeyword($articleID);
		$result.saveAuthor($articleID);
		$result.saveChapter($articleID); 
		echo $result;
		break;
	case 'article':echo saveArticle(); break;
	case 'author':echo saveAuthor();  break;
	case 'chapter':echo saveChapter();break;
	case 'keyword':echo saveKeyword(); break;
}


function saveArticle()
{
	$sql="insert article (";
	$item="";
	$values="";
	$result="";
	if(!isset($_REQUEST['title'])||!isset($_REQUEST['category'])||!isset($_REQUEST['createtime'])||!isset($_REQUEST['published']))
	{
		$result. "请注意文章题目、类别、创建时间、以及是否发布标志均不能为空";
		return ;
	}
	 $title=$_REQUEST['title'];
	 $item.="art_title,art_category,art_createtime,art_published";
	 $values.='"'.$title.'","'.$_REQUEST['category'].'","'.$_REQUEST['createtime'].'","'.$_REQUEST['published'].'"';
		
	if(isset($_REQUEST['art_abstract']))
	{
	$item.=",art_abstract";
	$values.=',"'.$_REQUEST['art_abstract'].'"';
	}
	//$file=$_REQUEST['file']; //下载地址，，编辑界面没有
  $sql=$sql.$item.") values (" .$values." );";

   $sqlResult= sqlExecute($sql);
   if($sqlResult["error"]==null)
	   $sqlResult["error"]="No error";
   $result= $result. "save article sql: ".$sql ."<br/> Result: ".$sqlResult["error"]."<br/>";
  return $result;
}

function saveAuthor($articleID=null)
{
	$sql="insert author (";
	$item="";
	$values="";
	$result="";
	$authorNum=0;
	if($articleID==null)
	{
		if(!isset($_REQUEST['title']))
		{
			$result. "作者关联的文章不能为空！";
			return $result;
		}
		$articleID = getArticleID($_REQUEST['title']);
		if($articleID==null)
			return "作者所关联的文章ID为空";
	}
    
	$item.="ath_article,ath_name,ath_rank,ath_mail";

	if(isset($_REQUEST['authorNum']))
	   $authorNum=$_REQUEST['authorNum'];
	else
		return "authorNum is 0";
	for($i=1; $i<=$authorNum; $i++)
	{

		if(!isset($_REQUEST['name'.$i.''])||!isset($_REQUEST['rank'.$i.'']))
		{
			echo "作者姓名和作者次序不能为空！";
			return;
		}
		
		$values .= '("'.$articleID.'","'.$_REQUEST['name'.$i.''].'","'.$_REQUEST['rank'.$i.''].'"';
		if(isset($_REQUEST['mail'.$i.'']))
			$mail=$_REQUEST['mail'.$i.''];
		else
			$mail="";
		if($i<$authorNum)
			$values .= ',"'.$mail.'"),';
		else
			$values .= ',"'.$mail.'")';

		
	}
	$sql = $sql.$item.") values ".$values;
	
    $sqlResult = sqlExecute($sql);
	if($sqlResult["error"]==null)
		$sqlResult["error"]="No error";
	$result = $result. "save Author sql: ".$sql ."<br/> Result: ".$sqlResult["error"]."<br/>";
	return $result;
}


function saveChapter($articleID=null)
{
    $sql="INSERT chapter (";
	$item="";
	$values="";
	$result="";
	$chapterNum=0;
    if($articleID==null)
	{
		if(!isset($_REQUEST['title']))
		{
			$result. "作者关联的文章不能为空！";
			return $result ;
		}
		$articleID=getArticleID($_REQUEST['title']);
		if($articleID==null)
			return "章节所关联的文章ID为空";
	}

    $item.="cha_article,cha_title,cha_rank,cha_content";

	if(isset($_REQUEST['chapterNum']))
	   $chapterNum=$_REQUEST['chapterNum'];
	else
		return "chapterNum is 0";
    for($i=1;$i<=$chapterNum;$i++)
   {
	 
	    if(!isset($_REQUEST['chaTitle'.$i.''])||!isset($_REQUEST['chaRank'.$i.'']))
			{
				return  "章节名称和章节次序不能为空！";;
			}
			
			$values.='("'.$articleID.'","'.$_REQUEST['chaTitle'.$i.''].'","'.$_REQUEST['chaRank'.$i.''].'"';
			if(isset($_REQUEST['chaContent'.$i.'']))
				$content=$_REQUEST['chaContent'.$i.''];
			else
				$content="";
			if($i<$chapterNum)
			$values.=',"'.$content.'"),';
			else
			$values.=',"'.$content.'")';
   }
   $sql = $sql.$item.") values ".$values;
   
   $sqlResult= sqlExecute($sql);
   if($sqlResult["error"]==null)
	   $sqlResult["error"]="No error";
   $result= $result. "save Chapter sql: ".$sql ."<br/> Result: ".$sqlResult["error"]."<br/>";
  return $result;
}

function saveKeyword($articleID=null)
{
    $sql="INSERT keyword (";
	$item="";
	$values="";
	$result="";
	$keyNum=0;
    if($articleID==null)
	{
		if(!isset($_REQUEST['title']))
		{
			$result. "作者关联的文章不能为空！";
			return $result;
		}
		$articleID=getArticleID($_REQUEST['title']);
		if($articleID==null)
			return "keyword所关联的文章ID为空";
	}

    $item.="key_article,key_value,key_rank";
    if(isset($_REQUEST['keyNum']))  
		$keyNum=$_REQUEST['keyNum'];
	else
		return "keyNum is 0";
	for($i=1;$i<=$keyNum;$i++)
	{
	  
	   if(!isset($_REQUEST['keyValue'.$i.'']) || !isset($_REQUEST['keyRank'.$i.'']))
		{
			return "关键字值和关键字次序不能为空！";;
		}
		$values .= '("'.$articleID.'","'.$_REQUEST['keyValue'.$i.''].'","'.$_REQUEST['keyRank'.$i.''].'"';
				
		if($i<$keyNum)
		   $values.='),';
		else
			$values.=')';
	}
	$sql=$sql.$item.") values ".$values;

	$sqlResult = sqlExecute($sql);
	if($sqlResult["error"]==null)
	   $sqlResult["error"]="No error";
	$result= $result. "save keyWord sql: ".$sql ."<br/> Result: ".$sqlResult["error"]."<br/>";
	return $result;
}

function getArticleID($titleName)
{
    $result = sqlExecute('SELECT * FROM article WHERE art_title="'.$titleName.'"');
	if($result["result"]==null)
		return null;
	$row=mysql_fetch_array($result["result"]);
	return $row["art_id"];
}

?>