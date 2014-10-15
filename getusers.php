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

$_GET[userid] = "1";

mysql_select_db($database_tinder, $tinder);
$query_rsPotentialMatches = "select userid from users where userid != '$_GET[userid]' and userid not IN (SELECT senderid FROM matches UNION ALL SELECT receiverid FROM matches)";
$rsPotentialMatches = mysql_query($query_rsPotentialMatches, $tinder) or die(mysql_error());
$row_rsPotentialMatches = mysql_fetch_assoc($rsPotentialMatches);
$totalRows_rsPotentialMatches = mysql_num_rows($rsPotentialMatches);

$currentUserId = $row_rsPotentialMatches['userid'];


/*$colname_rsUser = "-1";

if (isset($_GET['userid'])) {
  //$colname_rsUser = $_GET['userid'];
  $colname_rsUser = $currentUserId; 
}*/

$colname_rsUser = $currentUserId;

mysql_select_db($database_tinder, $tinder);
$query_rsUser = sprintf("SELECT * FROM users WHERE userid = %s", GetSQLValueString($colname_rsUser, "int"));
$rsUser = mysql_query($query_rsUser, $tinder) or die(mysql_error());
$row_rsUser = mysql_fetch_assoc($rsUser);
$totalRows_rsUser = mysql_num_rows($rsUser);

mysql_select_db($database_tinder, $tinder);
$query_rsMutualFriends = "SELECT p1.friendid  FROM (   SELECT *   FROM friends   WHERE userid = ".$_GET['userid']." ) p1 INNER JOIN (   SELECT *   FROM friends   WHERE userid = ".$currentUserId." ) p2   ON p1.friendid = p2.friendid";
$rsMutualFriends = mysql_query($query_rsMutualFriends, $tinder) or die(mysql_error());
$row_rsMutualFriends = mysql_fetch_assoc($rsMutualFriends);
$totalRows_rsMutualFriends = mysql_num_rows($rsMutualFriends);

mysql_select_db($database_tinder, $tinder);
$query_rsQuestion = "SELECT * FROM questions WHERE userid = " . $currentUserId;
$rsQuestion = mysql_query($query_rsQuestion, $tinder) or die(mysql_error());
//$row_rsQuestion = mysql_fetch_assoc($rsQuestion);
$totalRows_rsQuestion = mysql_num_rows($rsQuestion);



while($row = mysql_fetch_assoc($rsQuestion))
{
	$correctAnswer = $row['answer1'] ;
	$questionArray[] = $row['answer1'];
	$questionArray[] = $row['answer2'];
	$questionArray[] = $row['answer3'];
	$question = $row['question'];
}

shuffle($questionArray);
//echo "<p>".print_r($questionArray)."</p>";

?>
<?php 

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
		echo 'question="' . $question . '" ';
		echo 'correctAnswer="' . $correctAnswer . '" ';
		echo 'questionArray0="' . $questionArray[0] . '" ';
		echo 'questionArray1="' . $questionArray[1] . '" ';
		echo 'questionArray2="' . $questionArray[2] . '" ';
        echo 'username="' . $row_rsUser['username'] . '" ';
        echo 'currentUserId="' . $currentUserId . '" ';
        echo 'age="' . $row_rsUser['age'] . '" ';
        echo 'schools="' . $row_rsUser['schools'] . '" ';
		echo 'totalMutualFriends="' . $totalRows_rsMutualFriends . '" ';
		echo 'potentialMatches="' . $totalRows_rsPotentialMatches . '" ';
		echo '/>';
  
echo '</markers>';


?>
<?php
mysql_free_result($rsUser);
?>
