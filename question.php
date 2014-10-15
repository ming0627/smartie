<?php require_once('../Connections/tinder.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
if (!isset($_SESSION)) {
  session_start();
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO questions (userid, question, answer1, answer2, answer3) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['userid'], "int"),
                       GetSQLValueString($_POST['questionBox'], "text"),
                       GetSQLValueString($_POST['q1'], "text"),
                       GetSQLValueString($_POST['q2'], "text"),
                       GetSQLValueString($_POST['q3'], "text"));

  mysql_select_db($database_tinder, $tinder);
  $Result1 = mysql_query($insertSQL, $tinder) or die(mysql_error());
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no">
<title>Tinder Sample</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script type="text/javascript" src="http://www.pureexample.com/js/lib/jquery.ui.touch-punch.min.js"></script>
<style>

#draggable2 {
	width: 297px;
	height: 246px;
	padding: 0.5em;
	position: absolute;
	left: 2px;
	top: 102px;
	z-index:0;
}
#draggable3 {
	width: 297px;
	height: 246px;
	padding: 0.5em;
	position: absolute;
	left: 2px;
	top: 102px;
	z-index:1;
}
#draggable4 {
	width: 297px;
	height: 246px;
	padding: 0.5em;
	position: absolute;
	left: 2px;
	top: 102px;
	z-index:2;
}
#draggable5 {
	width: 297px;
	height: 246px;
	padding: 0.5em;
	position: absolute;
	left: 2px;
	top: 102px;
	z-index:3;
}
#draggable6 {
	width: 297px;
	height: 246px;
	padding: 0.5em;
	position: absolute;
	left: 2px;
	top: 102px;
	z-index:4;
}
#draggable7 {
	width: 297px;
	height: 246px;
	padding: 0.5em;
	position: absolute;
	left: 2px;
	top: 102px;
	z-index:5;
}
#draggable8 {
	width: 297px;
	height: 246px;
	padding: 0.5em;
	position: absolute;
	left: 2px;
	top: 102px;
	z-index:6;
}
#draggable9 {
	width: 297px;
	height: 246px;
	padding: 0.5em;
	position: absolute;
	left: 2px;
	top: 102px;
	z-index:7;
}
#draggable10 {
	width: 297px;
	height: 246px;
	padding: 0.5em;
	position: absolute;
	left: 2px;
	top: 102px;
	z-index:8;
}

#geo {
	width: 297px;
	height: 14px;
	padding: 0.5em;
	position: absolute;
	left: 4px;
	top: 71px;
	z-index:8;
}

#likeDiv {
	width: 50px;
	height: 50px;
	padding: 0.5em;
	position: absolute;
	left: 183px;
	top: 401px;
	z-index:8;
}
#dislikeDiv {
	width: 50px;
	height: 50px;
	padding: 0.5em;
	position: absolute;
	left: 71px;
	top: 401px;
	z-index:8;
}
#content {
	height: 568px;
	width: 320px;
	position: relative;
	overflow: hidden;
	margin-right: auto;
	margin-left: auto;
	margin-top: 0px;
}
body {
	margin: 0px;
}

#geo {
	font-size: 12px;
	text-align:center;
}

#q1 {
	width: 270px;
	height: 20px;
	padding: 0.5em;
	position: absolute;
	left: 25px;
	top: 225px;
}

#RadioGroup1_0 {
	
	position: absolute;
	left: 5px;
	top: 230px;
}

#q2 {
	width: 270px;
	height: 20px;
	padding: 0.5em;
	position: absolute;
	left: 25px;
	top: 295px;
}

#RadioGroup1_1 {
	
	position: absolute;
	left: 5px;
	top: 300px;
}

#q3 {
	width: 270px;
	height: 20px;
	padding: 0.5em;
	position: absolute;
	left: 25px;
	top: 340px;
}

#RadioGroup1_2 {
	
	position: absolute;
	left: 5px;
	top: 345px;
}

#questionBox {
	width: 290px;
	height: 100px;
	padding: 0.5em;
	position: absolute;
	left: 10px;
	top: 80px;
}

#questionLbl {
	
	position: absolute;
	left: 5px;
	top: 45px;
}

#settings {
	height: 35px;
	width: 35px;
	position: absolute;
	left: 2px;
	top: 5px;
}

#rightAnswer {
	height: 25px;
	width: 235px;
	position: absolute;
	left: 2px;
	top: 200px;
}

#wrongAnswer {
	height: 25px;
	width: 235px;
	position: absolute;
	left: 2px;
	top: 270px;
}

#submitBtn {
	width: 170px;
	height: 25px;
	padding: 0.5em;
	position: absolute;
	left: 75px;
	top: 385px;
}

#remember {
	width: 300px;
	height: 95px;
	padding: 0.5em;
	position: absolute;
	left: 20px;
	top: 425px;
}

</style>
  
</head>
<body>
<div id="content">
<div id="settings"><a href="profile.php">Profile</a></div>

<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
<div id="rightAnswer">Right Answer:</div>
<input name="q1" type="text" id="q1" value="Harper Lee" placeholder="e.g. Harper Lee">
<div id="wrongAnswer">Two Wrong Answers:</div>
<input name="q2" type="text" id="q2" value="George Washington" placeholder="e.g. George Washington">
<input name="q3" type="text" id="q3" value="Tom Cruise" placeholder="e.g. Tom Cruise">


    <input type="radio" name="RadioGroup1" value="1" id="RadioGroup1_0">

    <input type="radio" name="RadioGroup1" value="2" id="RadioGroup1_1">
 
    <input type="radio" name="RadioGroup1" value="3" id="RadioGroup1_2">
<label id="questionLbl">1. A Multiple Choice Question</label>
<textarea name="questionBox" id="questionBox" cols="" rows="">e.g. Who wrote to Kill a Mockingbird?</textarea>
<input name="" value="Save and Start Searching!" id="submitBtn" type="submit">
  <input type="hidden" name="userid" id="userid" value="1">
  <input type="hidden" name="MM_insert" value="form1">
</form>
 
  <div id="remember">Remember your question can be about anything and everything. We recommend basing it on a topic of interest to you, so that people answering can get a sense of what you are interested in. You can keep changing your question, so don't overthing it now!</div>
  
</div>
</body>
</html>