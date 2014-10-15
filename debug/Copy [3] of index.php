<?php require_once('../../Connections/tinder.php'); ?>
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

$_SESSION[userid] = "1";

mysql_select_db($database_tinder, $tinder);
$query_rsPotentialMatches = "select userid from users where userid != '$_SESSION[userid]' and userid not IN (SELECT senderid FROM matches UNION ALL SELECT receiverid FROM matches)";
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
$query_rsMutualFriends = "SELECT p1.friendid  FROM (   SELECT *   FROM friends   WHERE userid = ".$_SESSION['userid']." ) p1 INNER JOIN (   SELECT *   FROM friends   WHERE userid = ".$currentUserId." ) p2   ON p1.friendid = p2.friendid";
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


echo "<div class='debugDiv'><strong>(Database - Debug Info)</strong><br>";
echo "Potential matches: " . $totalRows_rsPotentialMatches . "<br>";
echo "my user ID: " . $_SESSION[userid] . "<br>";
echo "potential match user ID: " . $currentUserId . "<br>";
echo "correct answer: " . $correctAnswer . "<br>";


if(isset($_POST['chosenAnswer']))
{
	echo "chosen answer: " . $_POST['chosenAnswer'] . "<br>";
}

echo "</div>";

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no">
<title>Tinder Sample</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script type="text/javascript" src="http://www.pureexample.com/js/lib/jquery.ui.touch-punch.min.js"></script>
<script src="../../jquery/jquery-1.11.1.min.js"></script>
<script src="../getUsers.js"></script>
<script>

/*.container-outer { overflow: scroll; width: 500px; height: 210px; }
.container-inner { width: 10000px; }*/

</script>

<script>

	$(document).ready(function () {
																
    $("input[name=RadioGroup1]:radio").change(function () {
														
		var ind = $(this).val();
															   
        if (ind == 0) 
		{
           $('#chosenAnswer').val($('#q1').html());
        }
        else if (ind == 1) 
		{
			$('#chosenAnswer').val($('#q2').html());
        }
		else
		{
			$('#chosenAnswer').val($('#q3').html());
		}
		
		//alert($('#chosenAnswer').val());
    })
});
	
	function submitAnswer() {
			
		var username = $('#username').val();
		var userid = $('#userid').val();
		var roomid = $('#roomid').val();
		
		if($('#chatbox').val() != '')
		{
			var message1 = $('#chatbox').val();
			//insertMessage(roomid,userid,message1);
			console.log("message: "+message1);
			//$('#chatfeedDiv').append('<div>' + username + ": " + $('#chatbox').val() + '</div>');
			$('#chatbox').val('');
			//str = str + ",'7'";
			//messageArray.push("7");
			
			//SendData(Arg,stateP,array,time);
		}
	}
	
</script>

<!--http://gromo.github.io/jquery.scrollbar/demo/basic.html-->

<link href="../assets/css/home.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="content">
<div id="settings"><a href="../index.php">Home</a> <a href="../messages.php">Messages</a> <a href="../matches.php">Matches</a></div>
<div id="imageDiv"><img src="assets/userimages/<?php echo $currentUserId; ?>.png" width="150" height="150"></div>

<div id="name"><?php echo $row_rsUser['username']; ?></div>
<div id="age"><?php echo $row_rsUser['age']; ?></div>
<div id="schools"><?php echo $row_rsUser['schools']; ?></div>

<div id="mutualFriendsLbl">Mutual Friends (<?php echo $totalRows_rsMutualFriends; ?>)</div>
<div id="mutualFriends"><div class="container">
<img src="../assets/userimages/3.png" width="50" height="50">
<img src="../assets/userimages/4.png" width="50" height="50">
</div></div>

<form name="form1" method="post" action="">
<div id="q1"><?php echo $questionArray[0]; ?></div>
<div id="q2"><?php echo $questionArray[1]; ?></div>
<div id="q3"><?php echo $questionArray[2]; ?></div>
<div id="submitDiv">
  <label>
    <input type="submit" name="button" id="button" value="Submit">
  </label>
</div>

<div id="questionBox"><?php echo $question; ?></div>
<input type="radio" name="RadioGroup1" value="0" id="RadioGroup1_0">
<input type="radio" name="RadioGroup1" value="1" id="RadioGroup1_1">
<input type="radio" name="RadioGroup1" value="2" id="RadioGroup1_2">
<input name="userid" type="hidden" value="<?php echo $_GET['userid']; ?>">
<input name="chosenAnswer" id="chosenAnswer" type="hidden" value="">






</form>
</div>

</body>
</html>
<?php
mysql_free_result($rsQuestion);
mysql_free_result($rsUser);

mysql_free_result($rsMutualFriends);
mysql_free_result($rsPotentialMatches);
?>
