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
$query_rsMessageFeed = "SELECT * FROM messages WHERE receiverid = 99 group by senderid";
$rsMessageFeed = mysql_query($query_rsMessageFeed, $tinder) or die(mysql_error());
$totalRows_rsMessageFeed = mysql_num_rows($rsMessageFeed);

if (!isset($_SESSION)) {
  session_start();
}

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

	do {
		echo '<marker ';
		echo 'message="' . parseToXML($row_rsMessages['message']) . '" ';
		echo 'senderid="' . $row_rsMessages['senderid']. '" ';
		echo 'receiverid="' . $row_rsMessages['receiverid']. '" ';
		echo 'senddate="' . $row_rsMessages['senddate']. '" ';
		echo 'username="' . $row_rsMessages['senderid']. '" ';
		echo 'messageid="' . $row_rsMessages['messageid']. '" ';
		echo '/>';
	  
	} while ($row_rsMessages = mysql_fetch_assoc($rsMessageFeed));
  
echo '</markers>';

?>
<?php
mysql_free_result($rsMessageFeed);
?>
