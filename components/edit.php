  <div id="mainContent">
    <div id="status">
    	<span id="sta_label">您正在编辑: </span>&nbsp&nbsp
	<span id="sta_content">第一篇文章 | 第一章</span>    
    </div>
    <div id="sidebar">
	<div class="border"></div>
 <!--   	<a href="javascript:parentAccordion.pr(1)">Exand All</a> | <a href="javascript:parentAccordion.pr(-1)">Collapse All</a>
-->
	<?php include_once(dirname(__FILE__)."/../includes/sidebar_edit.php")?>
    	
    <span><a href="javascript:editPage.newArticle()">增加新文章</a></span>
    </div>
    <div id="content">
	<div class="border"></div>
	<div id="content2">
	<div id="edit_mess">
	<p style="font-size:20px;">欢迎编辑您的文章!</p>
	<br/>
	<p>选择左侧导航编辑您已有文章!</p>
	<p><a href="javascript:editPage.newArticle()">增加新文章</a></p>
	</div>
	</div>
    </div>
  </div>
 
