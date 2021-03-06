
var xmlhttp;
var state;
var debug = false;
var init = true;

function getUsers(Arg,stateP,array,time) {
	
	state = stateP;
	
	xmlhttp=null;
	
	var Url;
	
	if(debug == true)
	{
		if(Arg)
		{
			Url="getusers.php?userid="+Arg;	
		}
		else
		{
			Url="getusers.php"      
		}
	}
	else
	{
		if(Arg)
		{
			Url="http://ridleytechconsulting.com/smartie/userid.php?userid="+Arg;	
		}
		else
		{
			Url="http://ridleytechconsulting.com/smartie/userid.php"      
		}
	}

	if (window.XMLHttpRequest) {
	
		xmlhttp=new XMLHttpRequest() ;                   // For all modern browsers
	  	
	} else if (window.ActiveXObject) {
	
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP")   // For (older) IE
	}

	if (xmlhttp!=null)  
	{
		xmlhttp.onreadystatechange=onStateChange;
		
		xmlhttp.open("GET", Url, true);             
			
		xmlhttp.send(null);
	} 
	else 
	{
		alert("The XMLHttpRequest not supported");
	}
}

function convert(str) 
{ 
	var xmlStr = str.replace('&lt;','<');
	xmlStr = xmlStr.replace('&gt;','>'); 
	xmlStr = xmlStr.replace('&quot;','"'); 
	xmlStr = xmlStr.replace('&#39;',"'"); 
	xmlStr = xmlStr.replace('&amp;',"&"); 
	return xmlStr; 
} 

function onStateChange()  {

	if (xmlhttp.readyState == 4) {                                                   
	
	   if (xmlhttp.status == 200) {                                                   
				
		var xml = xmlhttp.responseXML;
		
		//console.log(xml);
		
		if(xml)
		{
			var markers = xml.documentElement.getElementsByTagName("marker");
			
			var html = "";
			var newMessage = false;
			
			//console.log("count: "+markers.length);
			
			//console.log(markers.length);
			
			for (var i = 0; i < markers.length; i++) 
			{
				var question = markers[i].getAttribute("question");
				correctAnswer = convert(markers[i].getAttribute("correctAnswer"));
				var questionArray0 = convert(markers[i].getAttribute("questionArray0"));
				var questionArray1 = convert(markers[i].getAttribute("questionArray1"));
				var questionArray2 = convert(markers[i].getAttribute("questionArray2"));
				var username = convert(markers[i].getAttribute("username"));
				var age = convert(markers[i].getAttribute("age"));
				var schools = convert(markers[i].getAttribute("schools"));
				var totalMutualFriends = convert(markers[i].getAttribute("totalMutualFriends"));
				currentUserId = convert(markers[i].getAttribute("currentUserId"));
				potentialMatches = convert(markers[i].getAttribute("potentialMatches"));
				
				if(totalMutualFriends == 0)
				{
					$('#mutualFriends').hide();
				}
				else
				{
					$('#mutualFriends').show();
				}
				
				//var debugInfo = convert(markers[i].getAttribute("debugInfo"));
				
				document.getElementById("name").innerHTML = username;
				
				var image = "<img src='assets/userimages/"+currentUserId+".png' width='150' height='150'>";

				document.getElementById("imageDiv").innerHTML = image;
				document.getElementById("name").innerHTML = username;
				document.getElementById("age").innerHTML = age;
				document.getElementById("schools").innerHTML = schools;
				document.getElementById("mutualFriendsLbl").innerHTML = "Mutual Friends ("+totalMutualFriends+")";
				
				document.getElementById("q1").innerHTML = questionArray0;
				document.getElementById("q2").innerHTML = questionArray1;
				document.getElementById("q3").innerHTML = questionArray2;
				document.getElementById("questionBox").innerHTML = question;
				//document.getElementById("potentialMatches").innerHTML = potentialMatches;
				
				var debugInfo = "<strong>(Database - Debug Info)</strong><br> Potential matches: " 
				+ potentialMatches + "<br> my user ID: " + "1" + "<br> potential match user ID: " 
				+ currentUserId + "<br> correct answer: " + correctAnswer + "<br>";
				
				document.getElementById("debugDiv").innerHTML = debugInfo;
			}	
			
			//console.log("time: "+lasttime);
					
			//console.log(JSON.stringify(messageArray));
		}
		else
		{
			//console.log("no new chats");	
			console.log("no xml");	
			document.getElementById("content").innerHTML = "No more matches. Check back later.";
		}

	} else {
	
			alert("statusText: " + xmlhttp.statusText + "\nHTTP status code: " + xmlhttp.status);
	
	}  // End of:   if (xmlhttp.status==200)
  }
}