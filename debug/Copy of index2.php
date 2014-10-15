<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Instagram Test</title>

<!--<script type="text/javascript" src="../hearandplay/assets/js/jquery-mobile.js"></script>-->
<script type="text/javascript" src="../hearandplay/assets/js/jquery-1.8.2.js"></script>

<script type="text/javascript">

/*

5000 requests/hour limit

seconds	likes/hour
2		3000
3		2000
4		1500
5		1200
6		1000
7		857
8		750
9		667
10		600
11		545
12		500
13		462
14		429
15		400

*/

var a = 0;
var likesRunCount = 0;
var likesCompletedCount = 0;
var commentsRunCount = 0;
var commentsCompletedCount = 0;
var randomCommentNumber = 0;
var imagesArray = [];
var likeId;
var commentId;
var fadePicId;
var commentArray = ["That's dope", "That's sweet", "Nice", "Sweet", "Hot", "Dope", "Cool", "That's real cool"];
var commentArray2 = [];
var intervalArray = [5000,6000,7000,8000,9000,10000];

var clientId = "50d0ab16244448bc8700a65a4ee3c217";
var secret = "559002290c9c40d69dc1453c8bc54aef";
var returl = "http://www.ridleymusictutorials.com/instagram/index.php";
var userid = "18905692";
var samplePic = "362087776998415501_191815022";
var token = "18905692.50d0ab1.0468207d0e09487ea474d91010188391";
var theTag = "";
var maxId, minId;
var long, lat, distance;


$(document).ready(function() {
						   
	$("#likes").fadeTo("fast", 0.5);
	$("#comments").fadeTo("fast", 0.5);
						   	
	$('#getData').click(function() {
		init();   
	});
						   
	$('#likes').click(function() {
		likeId = startLikes();   
	});
	
	$('#comments').click(function() {
		commentId = startComments();				   
	});
	
	$("#commentArray_txt").keyup(function(event){
		if(event.keyCode == 13){
			
			var comment = $("#commentArray_txt").val();
			
			if(comment.length > 1)
			{
				commentArray2.push(comment);
				$("#commentList").append($('<option>', { 
					value: comment,
					text : comment 
				}));
				
				
				$("#commentArray_txt").val('');
				
				console.log("coment array length: " + commentArray2.length);
				console.log("coment array: " + commentArray2);
			}
			
		}
	});
	
	$("#tag").keyup(function(event){
								
		theTag = $('#tag').val();
								 
		if(event.keyCode == 13){
			
			init();
			
		}
	});
		
});

/*var endpointUrls = ["user" => "https://api.instagram.com/v1/users/"+userid+"/?access_token="+token,
        "user_feed" => "https://api.instagram.com/v1/users/self/feed?%s",
        "user_recent" => "https://api.instagram.com/v1/users/%s/media/recent/?access_token="+token+"&max_id="+maxId+"&max_id="+maxId+"&max_timestamp=%s&min_timestamp=%s",
        "user_search" => "https://api.instagram.com/v1/users/search?q=%s&access_token="+token,
        "user_follows" => "https://api.instagram.com/v1/users/%d/follows?access_token="+token+"&cursor=%s",
        "user_followed_by" => "https://api.instagram.com/v1/users/%d/followed-by?access_token="+token,
        "user_requested_by" => "https://api.instagram.com/v1/users/self/requested-by?access_token="+token,
        "user_relationship" => "https://api.instagram.com/v1/users/%d/relationship?access_token="+token,
        "modify_user_relationship" => "https://api.instagram.com/v1/users/%d/relationship?action=%s&access_token="+token,
        "media" => "https://api.instagram.com/v1/media/%d?access_token="+token,
        "media_search" => "https://api.instagram.com/v1/media/search?lat="+lat+"&lng="+long+"&max_timestamp=%s&min_timestamp=%s&distance="+distance+"&access_token="+token,
        "media_popular" => "https://api.instagram.com/v1/media/popular?access_token="+token,
        "media_comments" => "https://api.instagram.com/v1/media/%d/comments?access_token="+token,
        "post_media_comment" => "https://api.instagram.com/v1/media/%d/comments?access_token="+token,
        "delete_media_comment" => "https://api.instagram.com/v1/media/%d/comments?comment_id=%d&access_token="+token,
        "likes" => "https://api.instagram.com/v1/media/%d/likes?access_token="+token,
        "post_like" => "https://api.instagram.com/v1/media/%s/likes",
        "remove_like" => "https://api.instagram.com/v1/media/%d/likes?access_token="+token,
        "tags" => "https://api.instagram.com/v1/tags/%s?access_token="+token,
        "tags_recent" => "https://api.instagram.com/v1/tags/%s/media/recent?max_id="+maxId+"&max_id="+maxId+"&access_token="+token,
        "tags_search" => "https://api.instagram.com/v1/tags/search?q=%s&access_token="+token,
        "locations" => "https://api.instagram.com/v1/locations/%d?access_token="+token,
        "locations_recent" => "https://api.instagram.com/v1/locations/%d/media/recent/?max_id="+maxId+"&max_id="+maxId+"&max_timestamp=%s&min_timestamp=%s&access_token="+token,
        "locations_search" => "https://api.instagram.com/v1/locations/search?lat=%s&lng=%s&foursquare_id=%s&distance=%s&access_token="+token];*/


function setTag() {
	
	theTag = $('#tag').val();
	
	//$('#selectedTag').html(theTag);
	
}

function setCommentArray() {
	
	commentArray2 = [];
	
	var theString = $('#commentArray_txt').val();
			
	$.each(theString.split(" #"), function(index, item) {
		//console.log(item); 
		if(item.length > 1)
		{
			commentArray2.push(item);
		}
		 
	});
	
	console.log("coment array length: " + commentArray2.length);
	console.log("coment array: " + commentArray2);
	
}

function clearField() {
		
	$('#tag').val("");
	
}

function init() {
	
	window.clearInterval(likeId);
	window.clearInterval(commentId);
	
	$('#pics').html("");
	$('#runningLike').html("");
	$('#runningComment').html("");
	//$('#info').html("");
	imagesArray = [];
	likesRunCount = 0;
	likesCompletedCount = 0;
	commentsRunCount = 0;
	commentsCompletedCount = 0;
	randomCommentNumber = 0;	
	
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
	
	$("#likes").fadeTo("fast", 0.5);
	$("#comments").fadeTo("fast", 0.5);
	$("#likes").attr("disabled","disabled");
	$("#comments").attr("disabled","disabled");
	
	
	
	$.ajax({
        type: "GET",
        dataType: "jsonp",
        cache: false,
		url: "https://api.instagram.com/v1/tags/" + theTag + "/media/recent?client_id=" + clientId + "&access_token=" + token,
        success: function (data){
			
			console.log(data);
			
			$.each(data.data, function(index, photo){
																				
			imagesArray.push(photo.id);
			
			var picId = "pic" + index;
			
			thePic = "<img src='"+ photo.images.low_resolution.url + "' class='randallPic' + id="+picId+" />";
			
			
			$('#pics').fadeTo("fast", 0.0);
			$('#pics').append(thePic);
			
			//$('#pics').hide(thePic);
			//$(thePic).appendTo("#pics").delay(800*index).animate({opacity:1},800);
			
		  });
						
			var $images = $('#pics img');
			var preloaded = 0;
			total = $images.length;
		$images.load(function() {
			if (++preloaded === total) {
				// Done!
				//alert("done");
				
				fadeInPics();
			}
		});
		
		
		$("#likes").fadeTo("fast", 1.0);
		$("#comments").fadeTo("fast", 1.0);
		$("#likes").attr("disabled",false);
		$("#comments").attr("disabled",false);
		  		
		likesRunCount = imagesArray.length;
		commentsRunCount = imagesArray.length;		
		console.log(imagesArray);
		
		}
		
    });

}

function fadeInPics()
{
		//window.setInterval(ab, 2000);
		$("#pics").css("visibility", "visible");
		$('#pics').fadeTo("fast", 1.0);
		
		//$('#pics img').each(function( index ) {
				//$('#pics img').hide(this);
				//$(this).fadeTo("fast", 0.0);
				//$(this).fadeTo("fast", 2.0);
				
		//});
}

function ab()
{
	if (a < 1)
	{
		
		/*$('#pics img').each(function( index ) {
				$(this).fadeTo("fast", 0.0);
				$(this).fadeTo("fast", 2.0);
		});*/
		
		$('#pics img').each(function(index) {
			$(this).delay(400*index).fadeIn(600);
		});
	
	
	
	}
	
	a++;
	console.log("a: "+a);
}


function animateImage() {
    //currIdx = (currIdx < 3) ? currIdx + 1 : 0;
    setTimeout(function() {
        //$images.css('z-index', 1);
        $images.fadeIn(1000, function() {
            //$images.not(this).hide();
			$images.fadeIn();
            //animateImage();
        });
    }, 1000)

}

function startLikes()
{
	$("#likes").fadeTo("fast", 0.5);
	$("#likes").attr("disabled","disabled");
	return window.setInterval(sendLikes, 1000);
}

function startComments()
{
	$("#comments").fadeTo("fast", 0.5);
	$("#comments").attr("disabled","disabled");
	return window.setInterval(sendComments, 1000);
}

function startPicFade()
{
	return window.setInterval(fadePic, 100);
}

function sendLikes() 
{
	if(likesCompletedCount < 3)//<= likesRunCount
	{
		console.log("liking pic" + likesCompletedCount);
		
		//$('#runningLike').html("liking pic" + likesCompletedCount + " " + imagesArray[likesCompletedCount]);
		
		$('#info').append(imagesArray[likesCompletedCount] + " was liked<br/>");
		
		var mediaId = imagesArray[likesCompletedCount];
		
		//callPage('post/like.php?mediaId=' + mediaId +'&'+'token=' + token);
	}
	
	likesCompletedCount++;
}

function sendComments() 
{
	if(commentsCompletedCount < 3)//<= commentsRunCount
	{
		console.log("commenting on pic");
		
		randomCommentNumber = Math.floor(Math.random() * commentArray2.length);
		
		//$('#comment').html(commentArray[randomCommentNumber]);
		
		//$('#runningComment').html("commenting on pic" + commentsCompletedCount + " " + imagesArray[commentsCompletedCount]);
		
		$('#info').append(imagesArray[likesCompletedCount] + " got the comment: \"" + commentArray2[randomCommentNumber] + "\"<br/>");
		
		var mediaId = imagesArray[commentsCompletedCount];
		var comment = commentArray2[randomCommentNumber];
		
		//callPage('post/comment.php?mediaId=' + mediaId +'&comment=' + comment +'token=' + token);		
	}
	
	commentsCompletedCount++;
}


function AjaxCaller(){
    var xmlhttp=false;
    try{
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }catch(e){
        try{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }catch(E){
            xmlhttp = false;
        }
    }

    if(!xmlhttp && typeof XMLHttpRequest!='undefined'){
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function callPage(url){
    ajax=AjaxCaller(); 
    ajax.open("GET", url, true); 
    ajax.onreadystatechange=function(){
        if(ajax.readyState==4){
            if(ajax.status==200){
                //div.innerHTML = ajax.responseText;
            }
        }
    }
    ajax.send(null);
}

		
</script>
<link href="assets/styles/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="contentDiv">

<p>&nbsp;</p>

<table width="480" border="0" id="searchTable">
  <tr>
    <td><input type="text" class="input" id="tag" /></td>
    <!--<td><button value="Submit" class="start" id="getData">Get Data</button></td>-->
    <td><img src="assets/images/clearField.png" id="getData"/></td>
  </tr>
  <tr>
  <td><input type="text" class="inputComment" id="commentArray_txt"/></td>
  <td></td>
  </tr>
  <tr>
    <td>
      <select name="commentList" size="5" multiple="multiple" id="commentList"></select>
    </td>
    <td></td>
  </tr>
</table>
<br />

<table border="0" cellspacing="3" id="buttonTable">
  <tr>
    <td><!--<button class="start" disabled="disabled" id="likes">Like</button>--><img src="assets/images/like.png" width="178" height="44" id="likes" disabled="disabled"/></td>
    <td><!--<button class="start" disabled="disabled" id="comments">Comment</button>--><img src="assets/images/comment.png" width="178" height="44" id="comments"disabled="disabled"/></td>
  </tr>
</table>
<!--<div id="selectedTag" class="comment"></div>
<div id="runningLike" class="comment"></div>
<div id="runningComment" class="comment"></div>-->
<div id="picsDiv" class="picsDiv"><div id="pics"></div></div>
<div id="info" class="info"></div>
<!--<textarea id="info" class="info" cols="" rows=""></textarea>-->

</div>


</body>
</html>