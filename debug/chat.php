<?php require_once('../Connections/chatroom.php'); ?>
<?php

session_start();

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

$colname_rsRoomID = "-1";
if (isset($_SESSION['roomname'])) {
  $colname_rsRoomID = $_SESSION['roomname'];
}
mysql_select_db($database_chatroom, $chatroom);
$query_rsRoomID = sprintf("SELECT roomid FROM rooms WHERE roomname = %s", GetSQLValueString($colname_rsRoomID, "text"));
$rsRoomID = mysql_query($query_rsRoomID, $chatroom) or die(mysql_error());
$row_rsRoomID = mysql_fetch_assoc($rsRoomID);
$totalRows_rsRoomID = mysql_num_rows($rsRoomID);

/*mysql_select_db($database_chatroom, $chatroom);
$query_rsRoomUsers = "SELECT *, count(userid) as 'count' FROM roomusers WHERE roomid = " . $row_rsRoomID['roomid'];
$rsRoomUsers = mysql_query($query_rsRoomUsers, $chatroom) or die(mysql_error());
$row_rsRoomUsers = mysql_fetch_assoc($rsRoomUsers);
$totalRows_rsRoomUsers = mysql_num_rows($rsRoomUsers);*/

mysql_select_db($database_chatroom, $chatroom);
$query_rsUserInfo = "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'";
$rsUserInfo = mysql_query($query_rsUserInfo, $chatroom) or die(mysql_error());
$row_rsUserInfo = mysql_fetch_assoc($rsUserInfo);
$totalRows_rsUserInfo = mysql_num_rows($rsUserInfo);

echo "roomid: " . $row_rsRoomID['roomid'] . "<br>";
echo "user: " . $row_rsUserInfo['username'] . "<br>";
echo "userid: " . $row_rsUserInfo['userid'] . "<br>";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no">
<!--<link rel="stylesheet" href="theme2/themes/r.min.css" />
<link rel="stylesheet" href="theme2/themes/jquery.mobile.icons.min.css" />
<link rel="stylesheet" href="../jquery-mobile142/jquery.mobile.structure-1.4.2.min.css" />-->
<script src="../jquery/jquery-1.11.1.min.js"></script>
<!--<script src="../jquery-mobile142/jquery.mobile-1.4.2.min.js"></script>-->
<script language="javascript" type="text/javascript" src="getUsers.js"></script>
<script language="javascript" type="text/javascript" src="sendmessage.js"></script>
<script language="javascript" type="text/javascript" src="zeroclipboard/dist/ZeroClipboard.js"></script>
<script>

	var myName = "";
	var messageArray = [];
	var lasttime;
	var runit = true;
	
	var loop = 0;
	
	$( document ).ready(function() {
								 
		var username = $('#username').val();
		var userid = $('#userid').val();
		var roomid = $('#roomid').val();
		
		 var clip = new ZeroClipboard( document.getElementById('copy') );
								 
		SendData(roomid,"home",null,null);
		
		if(runit)
		{
			setInterval(function() {
							
			if(loop < 100)
			{
				//console.log("getUpdates");
				if( userIdleTime <= maxIdleTime ) {
					getUpdates();
					loop++;
				}
			}
			
		}, 3000);
		
		}
		
	
	});  
	
	function sendMessage() {
			
		var username = $('#username').val();
		var userid = $('#userid').val();
		var roomid = $('#roomid').val();
		
		if($('#chatbox').val() != '')
		{
			var message1 = $('#chatbox').val();
			insertMessage(roomid,userid,message1);
			console.log("message: "+message1);
			//$('#chatfeedDiv').append('<div>' + username + ": " + $('#chatbox').val() + '</div>');
			$('#chatbox').val('');
			//str = str + ",'7'";
			//messageArray.push("7");
		}
	}
	
	function getUpdates() {
		
		var str = JSON.stringify(messageArray);
		var roomid = $('#roomid').val();
		
		str = str.replace(/"/g, "'");
		str = str.replace(/\[/g, "");
		str = str.replace(/]/g, "");
		
		//console.log("str: "+str);
		//console.log("query: messageid not in (" + str + ") order by stamp desc");
					
		//SendData("1","home",str,null);
		SendData(roomid,"home",null,lasttime);
		//console.log("SendData("+roomid+",home,null,"+lasttime+")");
		//console.log("query: messageid not in (" + str + ") order by stamp desc");
	}
	
	function ClipBoard() 
	{
		/*roomURL.innerText = copytext.innerText;
		Copied = holdtext.createTextRange();
		Copied.execCommand("Copy");*/
		
		
	}
	
	
	var userIdleTime = 0;
	//var maxIdleTime = 60 * 60 * 60; // 1 hour represented in seconds
	var maxIdleTime = 60*15; // 5 seconds
	var intvl;
	
	$(function() {
		
		$(document).on("mousemove", clearIdleTime);
				
		intvl = setInterval(checkIdleTimeOut, 1000);		

	});
	
	function clearIdleTime() {
		userIdleTime = 0;
		$("#idlediv").html("idle time: "+userIdleTime );
	}
	
	function checkIdleTimeOut() {
		userIdleTime++;
		if( userIdleTime >= maxIdleTime ) {
			//alert("Reached max User Idle Time");
			clearInterval(intvl);
		}
		$("#idlediv").html("idle time: "+userIdleTime );
	}
	
</script>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no">
<title>Ridley Tech Messenger</title>
<style type="text/css">
<!--

#container {
	width: auto;
	/*min-height: 300px;*/
	min-width:300px;
}
#chatfeed {
	height: 300px;
	width: 100%;
	min-width:200px;
	resize: none;
}
#roominfo {
	margin: 5px;
}
#chatfeedDiv {
	height: 300px;
	width: 95%;
	min-width:200px;
	border: 1px solid #CCC;
	padding: 5px;
	margin-top: 10px;
	margin-bottom: 5px;
	overflow:scroll;
}
#sendBtn {
	width: 100%;
	min-height: 35px;
}
#chatboxDiv {
	width: 96%;
	margin: auto;
}
#filterTxt {
	width: 95%;
	padding: 5px;
	margin-bottom: 5px;
}
#chatbox {
	width: 95%;
	padding: 5px;
	margin-bottom: 5px;
}
#idlediv {
	width: 35px;
	background-color: #090;
	height: 20px;
	display: inline;
	margin-left: 15px;
}
-->
</style>
</head>

<body>
<div id="container">
<div id="roominfo">
  <strong>Room:</strong> <?php echo $_SESSION['roomname']; ?>
  <input name="userid" type="hidden" id="userid" value="<?php echo $row_rsUserInfo['userid']; ?>" />
  <input type="hidden" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" />
  <input type="hidden" name="roomid" id="roomid" value="<?php echo $row_rsRoomID['roomid'] ?>"/>
  <input name="roomURL" type="hidden" id="roomURL" value="http://ridleytechconsulting.com/chatroom/index.php?roomname=<?php echo $_SESSION['roomname'];?>" />
  <!--<div id="idlediv"></div>-->
  
  <a href="#" id="copy" data-clipboard-text="http://ridleytechconsulting.com/chatroom/index.php?roomname=<?php echo $_SESSION['roomname'];?>">Copy Link and Invite Friends</a>
  <div id="chatboxDiv">
  <div id="chatfeedDiv"></div>
  <!--<textarea name="chatfeed" cols="45" rows="5" readonly="readonly" id="chatfeed"></textarea>-->

  <input type="text" name="chatbox" id="chatbox" />
  <input type="button" name="button" id="sendBtn" value="Send" onclick="sendMessage();" />
   <!--<input type="text" name="filterTxt" id="filterTxt" />-->
  </div>
</div>
</body>
</html>
<?php
/*mysql_free_result($rsRoomInfo);
mysql_free_result($rsRoomUsers);*/
mysql_free_result($rsRoomID);
mysql_free_result($rsUserInfo);
?>
