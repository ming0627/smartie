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

$_GET['userid'] = "2";

$colname_rsQuestion = "-1";
if (isset($_GET['userid'])) {
  $colname_rsQuestion = $_GET['userid'];
}
mysql_select_db($database_tinder, $tinder);
$query_rsQuestion = sprintf("SELECT * FROM questions WHERE userid = %s", GetSQLValueString($colname_rsQuestion, "int"));
$rsQuestion = mysql_query($query_rsQuestion, $tinder) or die(mysql_error());
$row_rsQuestion = mysql_fetch_assoc($rsQuestion);
$totalRows_rsQuestion = mysql_num_rows($rsQuestion);

$colname_rsUser = "-1";
if (isset($_GET['userid'])) {
  $colname_rsUser = $_GET['userid'];
}
mysql_select_db($database_tinder, $tinder);
$query_rsUser = sprintf("SELECT * FROM users WHERE userid = %s", GetSQLValueString($colname_rsUser, "int"));
$rsUser = mysql_query($query_rsUser, $tinder) or die(mysql_error());
$row_rsUser = mysql_fetch_assoc($rsUser);
$totalRows_rsUser = mysql_num_rows($rsUser);
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
	top: 430px;
}

#q2 {
	width: 270px;
	height: 20px;
	padding: 0.5em;
	position: absolute;
	left: 25px;
	top: 475px;
}

#q3 {
	width: 270px;
	height: 20px;
	padding: 0.5em;
	position: absolute;
	left: 25px;
	top: 520px;
}

#questionBox {
	width: 270px;
	height: 35px;
	padding: 0.5em;
	position: absolute;
	left: 25px;
	top: 370px;
}

#RadioGroup1_0 {
	position: absolute;
	left: 3px;
	top: 431px;
}

#RadioGroup1_1 {
	position: absolute;
	left: 4px;
	top: 476px;
}

#RadioGroup1_2 {
	position: absolute;
	left: 4px;
	top: 521px;
}



#questionLbl {
	
	position: absolute;
	left: 5px;
	top: 45px;
}

#settings {
	height: 35px;
	width: 249px;
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

#imageDiv {
	width: 150px;
	height: 150px;
	padding: 0.5em;
	position: absolute;
	left: 10px;
	top: 70px;
}

#name {
	width: 120px;
	height: 15px;
	padding: 0.5em;
	position: absolute;
	left: 180px;
	top: 70px;
}

#age {
	width: 120px;
	height: 15px;
	padding: 0.5em;
	position: absolute;
	left: 180px;
	top: 105px;
}

#schools {
	width: 120px;
	height: 15px;
	padding: 0.5em;
	position: absolute;
	left: 180px;
	top: 140px;
}

#mutualFriendsLbl {
	
	height: 15px;
	padding: 0.5em;
	position: absolute;
	left: 5px;
	top: 260px;
}

#mutualFriends {
	width: 300px;
	height: 50px;
	padding: 0.5em;
	position: absolute;
	left: 5px;
	top: 290px;
	background-color:#09C;
}


</style>
  
</head>
<body>
<div id="content">
<div id="settings"><a href="smarty.php">Home</a> <a href="messages.php">Messages</a> <a href="matches.php">Matches</a></div>
<div id="imageDiv"><img src="images/evoke-bg@2x.png" width="150" height="150"></div>

<input name="name" type="text" id="name" value="<?php echo $row_rsUser['username']; ?>" placeholder="Name">
<input name="name" type="text" id="age" value="<?php echo $row_rsUser['age']; ?>" placeholder="Age">
<input name="schools" type="text" id="schools" value="<?php echo $row_rsUser['schools']; ?>" placeholder="Schools">

<div id="mutualFriendsLbl">Mutual Friends</div>
<div id="mutualFriends"></div>

<form name="form1" method="post" action="">
<!--<div id="rightAnswer">Right Answer:</div>-->
<input name="q1" type="text" id="q1" value="<?php echo $row_rsQuestion['answer1']; ?>" placeholder="e.g. Harper Lee">
<!--<div id="wrongAnswer">Two Wrong Answers:</div>-->
<input name="q2" type="text" id="q2" value="<?php echo $row_rsQuestion['answer2']; ?>" placeholder="e.g. George Washington">
<input name="q3" type="text" id="q3" value="<?php echo $row_rsQuestion['answer3']; ?>" placeholder="e.g. Tom Cruise">

<input name="userid" type="hidden" value="<?php echo $_GET['userid']; ?>">
    <!--<input type="radio" name="RadioGroup1" value="1" id="RadioGroup1_0">

    <input type="radio" name="RadioGroup1" value="2" id="RadioGroup1_1">
 
    <input type="radio" name="RadioGroup1" value="3" id="RadioGroup1_2">
<label id="questionLbl">1. A Multiple Choice Question</label>-->
<textarea name="questionBox" id="questionBox" cols="" rows=""><?php echo $row_rsQuestion['question']; ?></textarea>
<!--<input name="" value="Save and Start Searching!" id="submitBtn" type="button">-->










    <input type="radio" name="RadioGroup1" value="1" id="RadioGroup1_0">

    <input type="radio" name="RadioGroup1" value="2" id="RadioGroup1_1">
 
    <input type="radio" name="RadioGroup1" value="3" id="RadioGroup1_2">






</form>
</div>

</body>
</html>
<?php
mysql_free_result($rsQuestion);

mysql_free_result($rsUser);
?>
