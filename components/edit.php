  <div id="mainContent">
    <div id="status">
    	<span>您正在编辑文章</span>&nbsp&nbsp|&nbsp&nbsp
	<a href="">第一篇文章</a>   
	<a href="">第一章</a>    
    </div>
    <div id="sidebar">
	<div class="border"></div>
 <!--   	<a href="javascript:parentAccordion.pr(1)">Exand All</a> | <a href="javascript:parentAccordion.pr(-1)">Collapse All</a>
-->
	<?php include_once(dirname(__FILE__)."/../includes/sidebar.php")?>
    	
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
 
