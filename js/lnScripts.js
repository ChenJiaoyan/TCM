var ln=jQuery.noConflict();
ln(document).ready(function()
{
  //查看全文
  ln("#viewArticle").click(function(){
	 var url="http://localhost/TCM/includes/getArticle.php";
	 ln.get(url,{articleName:"",action:"all"},function(result){
			if(result=="liuna")
			{
				alert("获取全文失败");
				//nextText();
			}
			else
			{
				result=result+'<span id="foldArticle"><a  href="#">收起全文</a></span></p><br/>';
				ln("#lnContent").html(result);
		}
	});
  });
  //收起全文
   ln("#foldArticle").click(function(){
	  var url="http://localhost/TCM/includes/getArticle.php";
	  ln.get(url,{articleName:"1234",action:"part"},function(result){
			if(result=="liuna")
			{		
			alert("获取全文失败");
			//nextText();
			}
		  else
		  {
			  result=result+'<a id="viewArticle" href="">查看全文</a></p><br/>';
			ln("#lnContent").html(result);
		  }
	  });
   
  });

  //收起全文
   ln(".keyWords").click(function(){
	  var url="http://localhost/TCM/includes/getKeywordsInfo.php";
	  var name=ln(this).val();
	  ln.get(url,{keyName:name},function(result){
			if(result=="liuna")
			{		
			alert("获取关键字信息失败");
			//nextText();
			}
		  else
		  {
			ln("#keyWordsTable").html(result);
		  }
	  });
   
  });

   });
  



