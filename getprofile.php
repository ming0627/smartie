<?php header('Content-type: application/xml'); ?>
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

$_GET['userid'] = "1";

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



$username = $row_rsUser['username']; 
$age = $row_rsUser['age']; 
$schools = $row_rsUser['schools']; 

$answer1 = $row_rsQuestion['answer1']; 
$answer2 = $row_rsQuestion['answer2']; 
$answer3 = $row_rsQuestion['answer3']; 
$question = $row_rsQuestion['question']; 


function parseToXML($htmlStr) 
{ 
	$xmlStr=str_replace('<','&lt;',$htmlStr); 
	$xmlStr=str_replace('>','&gt;',$xmlStr); 
	$xmlStr=str_replace('"','&quot;',$xmlStr); 
	$xmlStr=str_replace("'",'&#39;',$xmlStr); 
	$xmlStr=str_replace("&",'&amp;',$xmlStr); 
	return $xmlStr; 
} 

echo '<?xml version="1.0" encoding="ISO-8859-1"?><markers>';

		echo '<marker ';
		echo 'username="' . $username . '" ';
		echo 'age="' . $age . '" ';
		echo 'schools="' . $schools . '" ';
		echo 'answer1="' . $answer1 . '" ';
		echo 'answer2="' . $answer2 . '" ';
        echo 'answer3="' . $answer3 . '" ';
        echo 'question="' . $question . '" ';
		echo '/>';
  
echo '</markers>';


?>
<?php
mysql_free_result($rsUser);
?>
