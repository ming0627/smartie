<?php require_once('../Connections/ridIG.php'); ?>
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

 $json = '{"access_token":"289768021.b5ab4f3.237dd071a62c4a679fcab4edbd254ea6","user":{"username":"rridley1224","bio":"","website":"","profile_picture":"http:\/\/images.instagram.com\/profiles\/anonymousUser.jpg","full_name":"Ra","id":"289768021"}}';
 
 $obj = json_decode($json);

/*echo "token: " . $obj->access_token . "<br/>";
echo "username: " . $obj->user->username . "<br/>";
echo "id: " . $obj->user->id . "<br/>";*/

$token = $obj->access_token;
$username = $obj->user->username;
$id = $obj->user->id;
$today = date("Y-m-d");

if(isset($_GET['code']))
{	
	mysql_select_db($database_ridIG, $ridIG);
	$query_rsAuthUser = "SELECT iguserid FROM users WHERE iguserid = '" . $id . "'";
	$rsAuthUser = mysql_query($query_rsAuthUser, $ridIG) or die(mysql_error());
	$row_rsAuthUser = mysql_fetch_assoc($rsAuthUser);
	$totalRows_rsAuthUser = mysql_num_rows($rsAuthUser);
	
	if($totalRows_rsAuthUser == 0)
	{
	  $insertSQL = sprintf("INSERT INTO users (iguserid, token, datejoined) VALUES (%s, %s, %s)",
						   GetSQLValueString($id, "text"),
						   GetSQLValueString($token, "text"),
						   GetSQLValueString($today, "text"));
	
	  mysql_select_db($database_ridIG, $ridIG);
	  $Result1 = mysql_query($insertSQL, $ridIG) or die(mysql_error());
	}
	else
	{
	}
}

?>