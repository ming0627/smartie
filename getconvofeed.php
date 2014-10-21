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



mysql_select_db($database_tinder, $tinder);
$query_rsConvoFeed = "SELECT * FROM messages where senderid = $_GET[user1] and receiverid = $_GET[user2] 
or receiverid = $_GET[user1] and senderid = $_GET[user2] order by senddate desc";
$rsConvoFeed = mysql_query($query_rsConvoFeed, $tinder) or die(mysql_error());
//$row_rsConvoFeed = mysql_fetch_assoc($rsConvoFeed);
$totalRows_rsConvoFeed = mysql_num_rows($rsConvoFeed);



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

	do {//Oct 15, 2014, 10:48 pm
		$time = strtotime($row_rsConvoFeed['senddate']);
		echo '<marker ';
		echo 'message="' . parseToXML($row_rsConvoFeed['message']) . '" ';
		echo 'senderid="' . $row_rsConvoFeed['senderid']. '" ';
		echo 'receiverid="' . $row_rsConvoFeed['receiverid']. '" ';
		echo 'senddate="' . date('M',$time). " ".date('d',$time).", ". date('Y',$time).", ".  date('h',$time).":". date('i',$time). " ". date('A',$time).'" ';
		
	//	echo 'senddate="' . date('M',$time). " ".date('d',$time) ."". date('h',$time).":". date('i',$time). " ". date('A',$time).'" ';
		echo 'username="' . $row_rsConvoFeed['senderid']. '" ';
		echo 'messageid="' . $row_rsConvoFeed['messageid']. '" ';
		echo 'day="' . date('d',$time). '" ';
		echo '/>';
	  
	} while ($row_rsConvoFeed = mysql_fetch_assoc($rsConvoFeed));
  
echo '</markers>';

?>
<?php
mysql_free_result($rsConvoFeed);
?>
