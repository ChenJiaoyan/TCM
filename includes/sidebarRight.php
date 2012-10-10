<?php
$keyWordsNum=20;
$keyWords=array("关键字1","关键字2","长关键字3","更长的关键字4","keyWord5",
"关键字6","关键字7","长关键字8","更长的关键字9","Word10",
"关键字11","关键字12","长关键字13","更长的关键字14","keyWord15",
"关键字16","关键字17","长关键字18","更长的关键字19","keyWord20",
);
$wordAttri=array("arrti"=>array("属性1","属性2","属性3","属性4","属性5","属性6"),
                 "value"=>array("中国","草本植物","祛痰止咳","XXXXXXXXXX","XXXXXX","XXXXXXXXXXX"));
$attriNum=6;

echo '<div id="keyWords">
<ul>';
for($i=0;$i<$keyWordsNum;$i++)
{
	echo '<li class="keyWords" value='.$keyWords[$i].'><a href="#"><h3>'.$keyWords[$i].'
	    </h3></a></li>'; 
}
echo "</ul>
     </div>";

echo '<div id="keyWordsTable">
      <div>'.$keyWords[0].'</div>
      <table id="keyWordsAttri"> '; 
for($i=0;$i<$attriNum;$i++)
{
	echo '<tr>
	  <td>'.$wordAttri["arrti"][$i].'</td>
	  <td>'.$wordAttri["value"][$i].'</td>
		  </tr>'; 
}
echo "</table>
       </div>";

?>