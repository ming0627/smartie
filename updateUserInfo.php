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


/*$_POST["name"] = "randall ridley";
$_POST["age"] = "32";
$_POST["schools"] = "w";
$_POST["userid"] = "99";*/

if (isset($_POST["userid"])) {
		
  $updateSQL = sprintf("UPDATE users SET username=%s, schools=%s, age=%s WHERE userid=%s",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['schools'], "text"),
                       GetSQLValueString($_POST['age'], "text"),
                       GetSQLValueString($_POST['userid'], "int"));

  mysql_select_db($database_tinder, $tinder);
  $Result1 = mysql_query($updateSQL, $tinder) or die(mysql_error());
  
  $updateSQL2 = sprintf("UPDATE questions SET answer1=%s, answer2=%s, answer3=%s, question=%s WHERE userid=%s",
                       GetSQLValueString($_POST['q1'], "text"),
                       GetSQLValueString($_POST['q2'], "text"),
                       GetSQLValueString($_POST['q3'], "text"),
					   GetSQLValueString($_POST['question'], "text"),
					   GetSQLValueString($_POST['userid'], "text"));

  mysql_select_db($database_tinder, $tinder);
  $Result2 = mysql_query($updateSQL2, $tinder) or die(mysql_error());
}
?>