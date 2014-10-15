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
<style>

#draggable2 {
	width: 297px;
	height: 246px;
	padding: 0.5em;
	position: absolute;
	left: 2px;
	top: 102px;
	z-index:0;
}
#draggable3 {
	width: 297px;
	height: 246px;
	padding: 0.5em;
	position: absolute;
	left: 2px;
	top: 102px;
	z-index:1;
}
#draggable4 {
	width: 297px;
	height: 246px;
	padding: 0.5em;
	position: absolute;
	left: 2px;
	top: 102px;
	z-index:2;
}
#draggable5 {
	width: 297px;
	height: 246px;
	padding: 0.5em;
	position: absolute;
	left: 2px;
	top: 102px;
	z-index:3;
}
#draggable6 {
	width: 297px;
	height: 246px;
	padding: 0.5em;
	position: absolute;
	left: 2px;
	top: 102px;
	z-index:4;
}
#draggable7 {
	width: 297px;
	height: 246px;
	padding: 0.5em;
	position: absolute;
	left: 2px;
	top: 102px;
	z-index:5;
}
#draggable8 {
	width: 297px;
	height: 246px;
	padding: 0.5em;
	position: absolute;
	left: 2px;
	top: 102px;
	z-index:6;
}
#draggable9 {
	width: 297px;
	height: 246px;
	padding: 0.5em;
	position: absolute;
	left: 2px;
	top: 102px;
	z-index:7;
}
#draggable10 {
	width: 297px;
	height: 246px;
	padding: 0.5em;
	position: absolute;
	left: 2px;
	top: 102px;
	z-index:8;
}

#geo {
	width: 297px;
	height: 14px;
	padding: 0.5em;
	position: absolute;
	left: 4px;
	top: 71px;
	z-index:8;
}

#likeDiv {
	width: 50px;
	height: 50px;
	padding: 0.5em;
	position: absolute;
	left: 183px;
	top: 401px;
	z-index:8;
}
#dislikeDiv {
	width: 50px;
	height: 50px;
	padding: 0.5em;
	position: absolute;
	left: 71px;
	top: 401px;
	z-index:8;
}
#content {
	height: 568px;
	width: 320px;
	position: relative;
	overflow: hidden;
	margin-right: auto;
	margin-left: auto;
	margin-top: 0px;
}
body {
	margin: 0px;
}

#geo {
	font-size: 12px;
	text-align:center;
}

#q1 {
	width: 270px;
	height: 20px;
	padding: 0.5em;
	position: absolute;
	left: 25px;
	top: 430px;
}

#q2 {
	width: 270px;
	height: 20px;
	padding: 0.5em;
	position: absolute;
	left: 25px;
	top: 475px;
}

#q3 {
	width: 230px;
	height: 20px;
	padding: 0.5em;
	position: absolute;
	left: 18px;
	top: 467px;
}

#questionBox {
	width: 270px;
	height: 35px;
	padding: 0.5em;
	position: absolute;
	left: 20px;
	top: 428px;
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



#questionLbl {
	
	position: absolute;
	left: 5px;
	top: 45px;
}

#settings {
	height: 35px;
	width: 249px;
	position: absolute;
	left: 2px;
	top: 5px;
}

#rightAnswer {
	height: 25px;
	width: 235px;
	position: absolute;
	left: 2px;
	top: 200px;
}

#wrongAnswer {
	height: 25px;
	width: 235px;
	position: absolute;
	left: 2px;
	top: 270px;
}

#submitBtn {
	width: 50px;
	height: 50px;
	padding: 0.5em;
	position: absolute;
	left: 265px;
	top: 465px;
}

#imageDiv {
	width: 277px;
	height: 355px;
	padding: 0.5em;
	position: absolute;
	left: 10px;
	top: 70px;
}

#name {
	width: 120px;
	height: 15px;
	padding: 0.5em;
	position: absolute;
	left: 180px;
	top: 70px;
}

#age {
	width: 120px;
	height: 15px;
	padding: 0.5em;
	position: absolute;
	left: 180px;
	top: 105px;
}

#schools {
	width: 120px;
	height: 15px;
	padding: 0.5em;
	position: absolute;
	left: 180px;
	top: 140px;
}

#mutualFriendsLbl {
	
	height: 15px;
	padding: 0.5em;
	position: absolute;
	left: 5px;
	top: 260px;
}

#mutualFriends {
	width: 300px;
	height: 50px;
	padding: 0.5em;
	position: absolute;
	left: 5px;
	top: 290px;
	background-color:#09C;
}


</style>
  
</head>
<body>
<div id="content">
  <div id="content2">
    <div id="content3">
      <div id="content4">
        <div id="settings"><a href="smarty.php">Home</a> <a href="messages.php">Messages</a> <a href="matches.php">Matches</a></div>
        <div id="imageDiv"></div>
        <!--<input type="radio" name="RadioGroup1" value="1" id="RadioGroup1_0">

    <input type="radio" name="RadioGroup1" value="2" id="RadioGroup1_1">
 
    <input type="radio" name="RadioGroup1" value="3" id="RadioGroup1_2">
<label id="questionLbl">1. A Multiple Choice Question</label>-->
        <!--<input name="" value="Save and Start Searching!" id="submitBtn" type="button">-->
      </div>
    </div>
  </div>
</div>
</body>
</html>