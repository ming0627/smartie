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

if (isset($_POST["userid"])) {
	
  $updateSQL = sprintf("UPDATE settings SET gender=%s, interest=%s, ages=%s, notification=%s WHERE userid=%s",
                       GetSQLValueString($_POST['genderGroup'], "text"),
                       GetSQLValueString($_POST['interestGroup'], "text"),
                       GetSQLValueString($_POST['agesGroup'], "text"),
                       GetSQLValueString($_POST['notification'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  mysql_select_db($database_tinder, $tinder);
  $Result1 = mysql_query($updateSQL, $tinder) or die(mysql_error());
}
?>