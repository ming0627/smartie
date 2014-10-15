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

mysql_select_db($database_tinder, $tinder);
$query_userQuestion = "SELECT * FROM questions WHERE userid = " . $currentUserId;
$userQuestion = mysql_query($query_userQuestion, $tinder) or die(mysql_error());
$row_userQuestion = mysql_fetch_assoc($userQuestion);
$totalRows_userQuestion = mysql_num_rows($userQuestion);


echo "(Debug Info)<br>";
echo "Potential matches: " . $totalRows_rsPotentialMatches . "<br>";
echo "current potential match ID: " . $currentUserId . "<br>";

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
	background-image: url(../assets/images/interface/tinder.png);
	position: relative;
	overflow: hidden;
	margin-right: auto;
	margin-left: auto;
	margin-top: 0px;
}
#settings {
	height: 25px;
	width: 35px;
	position: absolute;
	left: 3px;
	top: 36px;
}
body {
	margin: 0px;
}

#geo {
	font-size: 12px;
	text-align:center;
}
</style>

<script>


var x;

function getLocation() {
	
    if (navigator.geolocation) {
		
        navigator.geolocation.getCurrentPosition(showPosition);
		
    } else {
		
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function getLocation2() {
	
	var apiurl = 'http://api.ipinfodb.com/v3/ip-city';
$.getJSON(apiurl+'/format=json&callback=?',
    function(data){
        $("#geo").html(data.regionName + ", " + data.countryName);
    }
);

	}

function showPosition(position) {
	
    x.innerHTML = "Your Position: <br> Latitude:" + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude; 
}
</script>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript"> 
  var geocoder;

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
} 
//Get the latitude and the longitude;
function successFunction(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    codeLatLng(lat, lng)
}

function errorFunction(){
    alert("Geocoder failed");
}

  function initialize() {
    geocoder = new google.maps.Geocoder();

  }

  function codeLatLng(lat, lng) {

    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      console.log(results)
        if (results[1]) {
         //formatted address
         //alert(results[0].formatted_address)
		 
		 x.innerHTML = results[0].formatted_address;
		 
        //find country name
             for (var i=0; i<results[0].address_components.length; i++) {
            for (var b=0;b<results[0].address_components[i].types.length;b++) {

            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                    //this is the object you are looking for
                    city= results[0].address_components[i];
                    break;
                }
            }
        }
        //city data
        //alert(city.short_name + " " + city.long_name)


        } else {
          alert("No results found");
        }
      } else {
        alert("Geocoder failed due to: " + status);
      }
    });
  }
</script> 


<script>

var picArray;
var ind; 
var dragged; 
	
	$( document ).ready(function() {
		
		picArray = ["#draggable10","#draggable9","#draggable8","#draggable7","#draggable6","#draggable5","#draggable4","#draggable3","#draggable2"];
		dragged = false;
		ind = 0;
		x = document.getElementById("geo");
		 
		//console.log("ind: "+ind);
		//console.log("picArray: "+picArray);
		
		
		//getLocation2();
		
		initialize();
		
    });
	
	function initSwipe()
	 {
		console.log("count enabled");
		dragged = false;
	}

  $(function() {
    
	 $( "#draggable,#draggable1,#draggable2,#draggable3,#draggable4,#draggable5,#draggable6,#draggable7,#draggable8,#draggable9,#draggable10" ).draggable(
		{ 
			drag: function( event, ui ){
				//console.log("drag");
				var offset = $(this).position();
				var xPos = offset.left;
				var yPos = offset.top;
				var a = yPos - 180;
				//console.log('x: ' + xPos);
				//console.log('y: ' + a);
				//console.log('id: ' + event.target.id);
				x = xPos;
				y = a;
				
				if(xPos > 60)
				{
					//console.log('move offscreen');
					
					$(event.target).animate({
					'left' : "+=1130px"
					});
					
					if(dragged == false)
					{
						ind++;
						console.log("ind swipe right "+ind);
						dragged = true;
						setTimeout('initSwipe()', 500);
					}
				}
				else if(xPos < -60)
				{
					$(event.target).animate({
					'left' : "-=1130px"
					});
					
					if(dragged == false)
					{
						ind++;
						console.log("ind swipe left: "+ind);
						dragged = true;
						setTimeout('initSwipe()', 500);
					}
				}				
			}
		}
	);
	 
	$( "#likeDiv" ).click(function() {
	  
	  $(picArray[ind]).animate({
					'left' : "+=1130px"
					});
	  
	  ind++;
	  console.log("ind likediv: "+ind);
	});
	
	$( "#dislikeDiv" ).click(function() {
	  
	  $(picArray[ind]).animate({
					'left' : "-=1130px"
					});
	  ind++;
	  console.log("ind dislikediv: "+ind);
	});
	 
  });
  
  </script>
  
</head>
<body>
<div id="content">
  <!--<div id="draggable">
<img src="assets/images/interface/pics/1.png" width="297" height="246">
</div>-->

<div id="settings"><a href="../profile.php">Profile</a></div>

<!--<div id="geo">Getting your location....</div>-->

  <div id="draggable2"> <img src="../assets/images/interface/pics/2.png" width="297" height="246"> </div>
  <div id="draggable3"> <img src="../assets/images/interface/pics/3.png" width="297" height="246"> </div>
  
  <div id="likeDiv"></div>
  <div id="dislikeDiv"></div>
  
  
  <div id="questionBox"></div>
  <div id="a1"></div>
  <div id="a2"></div>
  <div id="a3"></div>
  
</div>



</body>
</html>
<?php
mysql_free_result($rsPotentialMatches);

mysql_free_result($userQuestion);
?>
