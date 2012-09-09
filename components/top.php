<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TCM</title>
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.7.1.min.js" type="text/javascript" ></script>
<script src="js/common.js" type="text/javascript" ></script>
</head>

<body>
<div id="container">
  <div id="header">
  <div id="headerleft">
  </div>
  <div id="headright">
  <div id="utility">
    <ul>
    <a href="">登陆</a> | 
    <a href="">关于</a> | 
    <a href="">帮助</a>
    </ul>
  </div>
  <div id="searchbox">
    <input id="txtSearch" type="text" name="search" maxlength="200" value="" autocomplete="off">
    <select id="optionSearch">
	<option value="Category1">医生</option>
	<option value="Category2">患者</option>
	<option value="Category3">机构</option>
    </select>
    <span id="search_submit">Search</span>
  </div>
  </div>
  </div>
  <div id="menu">
  <ul id="menu_cat">
    <li id="category1" class="current"><a href="">医生</a></li>
    <li id="category2"><a href="">患者</a></li>
    <li id="category3"><a href="">机构</a></li>
  </ul>
  <ul id="menu_action">
    <li id="view"><a href="index.php?action=view">阅读</a></li>
    <li id="edit"><a href="index.php?action=edit">编辑</a></li>
  </ul>
  </div>
