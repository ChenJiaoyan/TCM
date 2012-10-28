<?php

include_once (dirname(__FILE__).'/getArticleInfo.php');

$article_list = getArticleList();

echo '<ul class="acc" id="acc">';

for($i=1; $i<=$article_list["article_num"]; $i++)
{
echo'   <li>
    	<h3>'.$article_list[$i]["article_title"].'<span><a href="javascript:editPage.editArticle('.$article_list[$i]["article_id"].')">编辑</a></span></h3>
    	<div class="acc-section">
    	<div class="acc-content">
    	<ul class="acc" id="nested"> ';
		for($j=1; $j<=$article_list[$i]["chapter_num"]; $j++)
		{
    echo'   <li>
    	 	<h4><a href="javascript:editPage.editChapter('.$article_list[$i]["article_id"].', '.$j.')">'.$article_list[$i]["chapter".$j].'</a></h4>
    	 	<div class="acc-section">
    	 	<div>
    	 	</li>';
		}
    echo'</ul>
    	</div>
    	</div>
    	</li>    ';
}

echo '</ul>';

?>