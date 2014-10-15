<script type="text/javascript" src="../hearandplay/assets/js/jquery-1.8.2.js"></script>

<script type="text/javascript">

$(document).ready(function() {
						   
		init();										
		
});

var randomCommentNumber = 0;

function init()
{
	var commentArray = ["That's dope", "That's sweet", "Nice", "Sweet", "Hot", "Dope", "Cool", "That's real cool"];
	randomCommentNumber = Math.floor(Math.random() * commentArray.length);

	$('#comment').html(commentArray[randomCommentNumber]);
}







</script>


<div id="comment"></div>