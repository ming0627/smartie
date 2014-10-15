<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>

<script type="text/javascript" src="../hearandplay/assets/js/jquery-1.8.2.js"></script>

<script type="text/javascript">

$(document).ready(function() {
		
		init();
});

var runCount = 0;


function yo() 
{
	if(runCount < 3)
	{
		console.log("hi" + runCount);
	}
	
	runCount++;
}


function init() {

$('#start').click(function() {
						   
		window.setInterval(yo, 3000);										
	});

}







		
</script>
<style type="text/css">
<!--
.start {
	width: 300px;
	height: 75px;
	background-color: #09F;
	text-align: center;
	font-size: 42px;
	vertical-align: middle;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	color: #FFF;
	padding-right: 20px;
	padding-bottom: 20px;
	padding-left: 20px;
	padding-top: 10px;
}
-->
</style>
</head>

<body>
    <button value="Submit" class="start" id="start" />Start
</body>
</html>