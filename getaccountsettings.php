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

$_GET['userid'] = 2;

//$colname_rsAccountSettings = "2";
if (isset($_GET['userid'])) {
  $colname_rsAccountSettings = $_GET['userid'];
}

mysql_select_db($database_tinder, $tinder);
$query_rsAccountSettings = sprintf("SELECT * FROM settings WHERE userid = %s", GetSQLValueString($colname_rsAccountSettings, "int"));
$rsAccountSettings = mysql_query($query_rsAccountSettings, $tinder) or die(mysql_error());
$row_rsAccountSettings = mysql_fetch_assoc($rsAccountSettings);
$totalRows_rsAccountSettings = mysql_num_rows($rsAccountSettings);



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
		echo 'invisible="' . $row_rsAccountSettings['invisible'] . '" ';
		echo 'deactivate="' . $row_rsAccountSettings['deactivate'] . '" ';
		echo 'comments="' . $row_rsAccountSettings['comments'] . '" ';
		echo 'gender="' . $row_rsAccountSettings['gender'] . '" ';
		echo 'interest="' . $row_rsAccountSettings['interest'] . '" ';
		echo 'ages="' . $row_rsAccountSettings['ages'] . '" ';
		echo 'notification="' . $row_rsAccountSettings['notification'] . '" ';
		
		echo '/>';
  
echo '</markers>';


?>
<?php
mysql_free_result($rsAccountSettings);
?>
