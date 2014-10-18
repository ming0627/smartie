<?php require_once('../Connections/tinder.php');

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

$insertSQL = sprintf("INSERT INTO messages (message, senderid,receiverid,unread) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['message'], "text"),
                       GetSQLValueString($_POST['senderid'], "int"),
					   GetSQLValueString($_POST['receiverid'], "int"),
					   GetSQLValueString(0, "int"));

  mysql_select_db($database_tinder, $tinder);
  $Result1 = mysql_query($insertSQL, $tinder) or die(mysql_error());
  
?>
