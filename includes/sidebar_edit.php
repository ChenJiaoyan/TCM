<?php
echo '<ul class="acc" id="acc">
    	<li>
    	<a href="javascript:editPage.editArticle()"><h3>第一篇文章</h3></a>
    	 <div class="acc-section">
    	 <div class="acc-content">
    	 <ul class="acc" id="nested">
    	 	<li>
    	 	<h4><a href="javascript:editPage.editChapter()">第一章</a></h4>
    	 	<div class="acc-section">
    	 	<div>
    	 	</li>
    	 	<li>
    	 	<h4><a href="javascript:editPage.editChapter()">第二章</a></h4>
    	 	<div class="acc-section">
    	 	<div class="acc-content">
    	 	<div>
    	 	</li>
    	 </ul>
    	</div>
    	</div>
    	</li>


   	<li>
   	<a href="javascript:editPage.editArticle()"><h3>第二篇文章</h3></a>
    	<div class="acc-section">
     	<div class="acc-content">
     	<ul class="acc" id="nested">
     	<li>
     	<h4><a href="javascript:editPage.editChapter()">第一章</a></h4>
     	<div class="acc-section">
     	<div>
     	</li>
    	</ul>
   	</div>
    	</div>
    	</li>

    </ul>';
?>
