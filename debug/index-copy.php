<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Instagram Test</title>

<!--<script type="text/javascript" src="../hearandplay/assets/js/jquery-mobile.js"></script>-->
<script type="text/javascript" src="../hearandplay/assets/js/jquery-1.8.2.js"></script>

<script type="text/javascript">

$(document).ready(function() {
						   
	$('#start').click(function() {
						   
		init();										
	});
		
});

var likesRunCount = 0;
var likesCompletedCount = 0;
var commentsRunCount = 0;
var commentsCompletedCount = 0;
var randomCommentNumber = 0;
var imagesArray = [];
var commentArray = ["That's dope","That's sweet", "Check out my ** cover video"];

var clientid = "50d0ab16244448bc8700a65a4ee3c217";
var secret = "559002290c9c40d69dc1453c8bc54aef";
var returl = "http://www.ridleymusictutorials.com/instagram/index.php";
var userid = "18905692";
var samplePic = "362087776998415501_191815022";
var token2 = "18905692.50d0ab1.0468207d0e09487ea474d91010188391";

function init() {
	
	var token = "18905692.50d0ab1.0468207d0e09487ea474d91010188391";
			
	//query user's pics
	
	/*$.ajax({
        type: "GET",
        dataType: "jsonp",
        cache: false,
		url: "https://api.instagram.com/v1/users/18905692/media/recent/?access_token=18905692.50d0ab1.0468207d0e09487ea474d91010188391",
        success: function (data){
			
			console.log(data);

		  $.each(data.data, function(index, photo){
		
			thePic = "<img src='"+ photo.images.low_resolution.url + "' class='randallPic' />";
		
			$('#pics').append(thePic);
		  });
		}
		
    });*/
	
	
	//query users by tags
	
	$.ajax({
        type: "GET",
        dataType: "jsonp",
        cache: false,
		url: "https://api.instagram.com/v1/tags/water/media/recent?client_id=50d0ab16244448bc8700a65a4ee3c217&access_token=18905692.50d0ab1.0468207d0e09487ea474d91010188391",
        success: function (data){
			
			console.log(data);

		  $.each(data.data, function(index, photo){
									 									 			
			imagesArray.push(photo.id);
		
			thePic = "<img src='"+ photo.images.low_resolution.url + "' class='randallPic' />";
			$('#pics').append(thePic);
			
		  });
		  
		  $('#comment').html(commentArray[randomCommentNumber]);
	
			likesRunCount = imagesArray.length;
			commentsRunCount = imagesArray.length;
		  
		  console.log(imagesArray);
		  
		}
		
    });
	
	
	//set likes
		
	/*for var i:int = 0; i < imagesArray.length; i++)
	{	
		curl -F 'access_token=18905692.50d0ab1.0468207d0e09487ea474d91010188391' \
		https://api.instagram.com/v1/media/media-id/likes
	}*/
	
	randomCommentNumber = Math.floor(Math.random() * commentArray.length);
	
	//create a comment
		
	/*for var j:int = 0; j < imagesArray.length; j++)
	{
		curl -F 'access_token=18905692.50d0ab1.0468207d0e09487ea474d91010188391' \
		-F 'text=This+is+my+comment' \  
		https://api.instagram.com/v1/media/media-id/comments
	}*/
		
	
	
	
	
	window.setInterval(runLikes, 2000);
	//window.setInterval(runComments, 5000);

}

function runLikes() 
{
	if(likesCompletedCount <= 2)//likesRunCount
	{
		console.log("liking pic" + likesCompletedCount);
		
		$('#runningLike').html("liking pic" + likesCompletedCount + " " + imagesArray[likesCompletedCount]);
		
		<?php

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/media/" + imagesArray[likesCompletedCount] + "/likes/?access_token=18905692.50d0ab1.0468207d0e09487ea474d91010188391");
		curl_setopt($ch, CURLOPT_POST, TRUE);
	
		//$fp = fopen("18905692.50d0ab1.0468207d0e09487ea474d91010188391", "w");
		
		curl_exec($ch);
		curl_close($ch);
		//fclose($fp);
		
		?>
		
		/*var access_token = "https://api.instagram.com/v1/media/" + imagesArray[likesCompletedCount] + "/likes?access_token=18905692.50d0ab1.0468207d0e09487ea474d91010188391"
		var url = 
		$.post(url, {access_token: access_token},
		 function(data) {
		   alert("Data Loaded: " + data);
		}, "json");*/
		
		/*curl -F 'access_token=18905692.50d0ab1.0468207d0e09487ea474d91010188391' \
		https://api.instagram.com/v1/media/imagesArray[likesCompletedCount]/likes*/
	}
	
	likesCompletedCount++;
}

/*function runComments() 
{
	if(commentsCompletedCount <= commentsRunCount)
	{
		console.log("commenting on pic");
		
		curl -F 'access_token=18905692.50d0ab1.0468207d0e09487ea474d91010188391' \
		-F randomCommentNumber \
		https://api.instagram.com/v1/media/imagesArray[commentsCompletedCount]/comments
	}
	
	commentsCompletedCount++;
}*/



		
</script>


<style type="text/css">
<!--
.start {
	width: 300px;
	height: 75px;
	background-color: #09F;
	text-align: center;
	font-size: 42px;
	vertical-align: middle;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: none;
	color: #FFF;
	padding-right: 20px;
	padding-bottom: 20px;
	padding-left: 20px;
	padding-top: 10px;
	margin-top: 25px;
}
.comment {
	border-top-width: thin;
	border-right-width: thin;
	border-bottom-width: thin;
	border-left-width: thin;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	width: 500px;
	height: 30px;
	margin-bottom: 25px;
	margin-top: 25px;
	text-align: center;
	vertical-align: middle;
	padding-top: 10px;
}
.randallPic {
	margin: 5px;
	height: 150px;
	width: 150px;
}
-->
</style>
</head>

<body>

<p>Instagram Test</p>

<div id="comment" class="comment"></div>
<div id="runningLike" class="comment"></div>
<div id="pics"></div>
    <button value="Submit" class="start" id="start" />
    Start
</body>
</html>