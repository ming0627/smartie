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
#content {
	height: 480px;
	width: 320px;
	background-image: url(../assets/images/interface/tinder.png);
	position: relative;
	overflow: hidden;
	margin-right: auto;
	margin-left: auto;
}
</style>
<script>
  $(function() {
    
	 $( "#draggable,#draggable1,#draggable2,#draggable3,#draggable4,#draggable5,#draggable6,#draggable7,#draggable8,#draggable9,#draggable10" ).draggable(
		{ 
			drag: function( event, ui ){
				var offset = $(this).position();
				var xPos = offset.left;
				var yPos = offset.top;
				var a = yPos - 180;
				//console.log('x: ' + xPos);
				//console.log('y: ' + a);
				//console.log('id: ' + event.target.id);
				x = xPos;
				y = a;
				
				if(xPos > 100)
				{
					//console.log('move offscreen');
					
					$(event.target).animate({
					'left' : "+=1130px" //moves down
					});
				}
				else if(xPos < -100)
				{
					$(event.target).animate({
					'left' : "-=1130px" //moves down
					});
				}				
			}
		}
	);
	 
  });
  </script>
</head>
<body>
<div id="content">
  <!--<div id="draggable">
<img src="assets/images/interface/pics/1.png" width="297" height="246">
</div>-->
  <div id="draggable2"> <img src="../assets/images/interface/pics/2.png" width="297" height="246"> </div>
  <div id="draggable3"> <img src="../assets/images/interface/pics/3.png" width="297" height="246"> </div>
  <div id="draggable4"> <img src="../assets/images/interface/pics/4.png" width="297" height="246"> </div>
  <div id="draggable5"> <img src="../assets/images/interface/pics/5.png" width="297" height="246"> </div>
  <div id="draggable6"> <img src="../assets/images/interface/pics/6.png" width="297" height="246"> </div>
  <div id="draggable7"> <img src="../assets/images/interface/pics/7.png" width="297" height="246"> </div>
  <div id="draggable8"> <img src="../assets/images/interface/pics/8.png" width="297" height="246"> </div>
  <div id="draggable9"> <img src="../assets/images/interface/pics/9.png" width="297" height="246"> </div>
  <div id="draggable10"> <img src="../assets/images/interface/pics/10.png" width="297" height="246"> </div>
</div>
</body>
</html>