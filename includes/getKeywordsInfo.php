<?php
$name=$_REQUEST['keyName'];

$wordAttri=array("arrti"=>array("属性1","属性2","属性3","属性4","属性5","属性6"),
                 "value"=>array("美国","植物","滋补养颜","XXXXXXXXXX","XXXXXX","XXXXXXXXXXX"));
$attriNum=6;

echo '<div id="keyWordsTable">
      <div>'.$name.'</div>
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