<?php
    	//<a href="javascript:editPage.editArticle(\'第一篇文章\')"><h3>第一篇文章</h3></a>
   	//<a href="javascript:editPage.editArticle(\'第二篇文章\')"><h3>第二篇文章</h3></a>
echo '<ul class="acc" id="acc">
    	<li>
    	<h3>第一篇文章<span><a href="javascript:editPage.editArticle(\'第一篇文章\')">编辑</a></span></h3>
    	 <div class="acc-section">
    	 <div class="acc-content">
    	 <ul class="acc" id="nested">
    	 	<li>
    	 	<h4><a href="javascript:editPage.editChapter(\'第一篇文章\', 1)">第一章</a></h4>
    	 	<div class="acc-section">
    	 	<div>
    	 	</li>
    	 	<li>
    	 	<h4><a href="javascript:editPage.editChapter(\'第一篇文章\', 2)">第二章</a></h4>
    	 	<div class="acc-section">
    	 	<div class="acc-content">
    	 	<div>
    	 	</li>
    	 </ul>
    	</div>
    	</div>
    	</li>


   	<li>
    	<h3>第二篇文章<span><a href="javascript:editPage.editArticle(\'第二篇文章\')">编辑</a></span></h3>
    	<div class="acc-section">
     	<div class="acc-content">
     	<ul class="acc" id="nested">
     	<li>
     	<h4><a href="javascript:editPage.editChapter(\'第二篇文章\', 1)">第一章</a></h4>
     	<div class="acc-section">
     	<div>
     	</li>
    	</ul>
   	</div>
    	</div>
    	</li>

    </ul>';
?>
