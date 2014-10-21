
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no">
<title>smartiePants</title>
<!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script type="text/javascript" src="http://www.pureexample.com/js/lib/jquery.ui.touch-punch.min.js"></script>-->
<script src="../jquery/jquery-1.11.1.min.js"></script>

<style>

@font-face {
  font-family: 'chalet';
  src: url('assets/fonts/chalet-newyork.ttf');
}

#content {
	font-family: 'chalet', 'Lucida Grande', sans-serif;
	height: 568px;
	width: 320px;
	position: relative;
	overflow: hidden;
	margin-right: auto;
	margin-left: auto;
	margin-top: 0px;
	font-size:12px;
	background-color:#fff;
}

body {
	margin: 0px;
	background-color: #EAEAEA;
}

#geo {
	font-size: 12px;
	text-align:center;
}

#q3 {
	width: 230px;
	height: 20px;
	padding: 0.5em;
	position: absolute;
	left: 10px;
	top: 450px;
}

#RadioGroup1_0 {
	
	position: absolute;
	left: 5px;
	top: 230px;
}

#RadioGroup1_1 {
	
	position: absolute;
	left: 5px;
	top: 300px;
}

#RadioGroup1_2 {
	
	position: absolute;
	left: 5px;
	top: 345px;
}

#settings {
	height: 35px;
	width: 249px;
	position: absolute;
	left: 2px;
	top: 5px;
}

#cancelBtn {
	width: 140px;
	height: 35px;
	position: absolute;
	left: 165px;
	top: 520px;
	background-color: #5eabc9;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	margin-top: 2px;
	margin-left: 2px;
}

#submitBtn {
	width: 140px;
	height: 35px;
	position: absolute;
	left: 10px;
	top: 520px;
	background-color: #5eabc9;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	margin-top: 2px;
	margin-left: 2px;
}

#imageDiv {
	width: 300px;
	height: 129px;
	padding: 0.5em;
	position: absolute;
	left: 5px;
	top: 70px;
	text-align: center;
	background-color: #EAEAEA;
}


#contactTV {
	height: auto;
	width: auto;
}

#info1 {
	width: 100%;
	height: 50px;
	padding: 0.5em;
	position: absolute;
	left: 5px;
	top: 50px;
}

#info2 {
	width: 100%;
	height: 50px;
	padding: 0.5em;
	position: absolute;
	left: 5px;
	top: 130px;
}

#info3 {
	width: 100%;
	height: 50px;
	padding: 0.5em;
	position: absolute;
	left: 5px;
	top: 210px;
}

#info4 {
	width: 100%;
	height: 50px;
	padding: 0.5em;
	position: absolute;
	left: 5px;
	top: 340px;
}

#info5 {
	width: 300px;
	height: 50px;
	padding: 0.5em;
	position: absolute;
	left: 5px;
	top: 510px;
}

</style>

<script>

var potentialMatches;
var pickedAnswer;
var correctAnswer;
var currentUserId;
var isMatch;
var userid = 1;
var potentialMatches = [];
var intvl;
	
$(document).ready(function () {
	
	//button clicks
	
	
			
	$( "#submitBtn" ).click(function() {
		
		submitMessage();
	});
	
	function submitMessage() {
			
		//var username = $('#username').val();
		//var userid = $('#userid').val();
		var userid = 1;
		var username = "You";
		
		if($('#q3').val() != '')
		{
			var message1 = $('#q3').val();
			//insertMessage(roomid,userid,message1);
			//console.log("message: "+message1);
			$('#imageDiv').append('<div>' + username + ": " + message1 + '</div>');
			$('#q3').val('');
			//str = str + ",'7'";
			//messageArray.push("7");
			//SendData(Arg,stateP,array,time);
			$('#sendImageDiv').hide();
			
			insertMessage(1,2,message1);
		}
	}
});
	
	
	
	
	
</script>
  
</head>
<body>
<div id="content">
  <div id="settings"><a href="smarty.html">Home</a> <a href="messages.html">Messages</a> <a href="smartyProfile.html">Profile</a> <a href="settings.html">Settings</a> <a href="contact.html">Account</a></div>
    
    <div id="info1">I am:
      <p>
        <label>
          <input type="radio" name="genderGroup" value="female" id="genderGroup_0">
          Female</label>
        <br>
        <label>
          <input type="radio" name="genderGroup" value="male" id="genderGroup_1">
          Male</label>
      </p>
    </div>
    <div id="info2">Interested In:
      <p>
        <label>
          <input type="radio" name="interestGroup" value="female" id="interestGroup_0">
          Female</label>
        <br>
        <label>
          <input type="radio" name="interestGroup" value="male" id="interestGroup_1">
          Male</label>
        <br>
      </p>
    </div>
    <div id="info3">Ages:
      <p>
        <label>
          <input type="radio" name="agesGroup" value="older" id="agesGroup_0">
          Older</label>
        <br>
        <label>
          <input type="radio" name="agesGroup" value="younger" id="agesGroup_1">
          Younger</label>
        <br>
        <label>
          <input type="radio" name="agesGroup" value="2years" id="agesGroup_2">
          +/- 2 years</label>
        <br>
        <label>
          <input type="radio" name="agesGroup" value="any" id="agesGroup_3">
          Any</label>
        <br>
      </p>
    </div>
    <div id="info4">Notification:
      <p>
        <label>
          <input type="radio" name="notification" value="vibrate" id="notification_0">
          Vibrate</label>
        <br>
        <label>
          <input type="radio" name="notification" value="sound" id="notification_1">
          Make Sound</label>
        <input type="hidden" name="userid" id="userid">
        <br>
      </p>
    </div>
    
    <input name="submitBtn" value="Send" id="submitBtn" type="button">
    <input name="cancelBtn" value="Cancel" id="cancelBtn" type="button">
      
</div>

</body>
</html>