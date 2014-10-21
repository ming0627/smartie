
var xmlhttp;
var state;
var debug = false;
var init = true;

function getAccountSettings(Arg,stateP,array,time) {
	
	state = stateP;
	
	xmlhttp=null;
	
	var Url;
	
	if(debug == true)
	{
		if(Arg)
		{
			Url="getaccountsettings.php?userid="+Arg;	
		}
		else
		{
			Url="getaccountsettings.php"      
		}
	}
	else
	{
		if(Arg)
		{
			Url="http://ridleytechconsulting.com/smartie/getaccountsettings.php?userid="+Arg;	
		}
		else
		{
			Url="http://ridleytechconsulting.com/smartie/getaccountsettings.php"      
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
				var invisible = markers[i].getAttribute("invisible");
				var deactivate = convert(markers[i].getAttribute("deactivate"));
				var comments = convert(markers[i].getAttribute("comments"));
				var gender = convert(markers[i].getAttribute("gender"));
				var interest = convert(markers[i].getAttribute("interest"));
				var ages = convert(markers[i].getAttribute("ages"));
				var notification = convert(markers[i].getAttribute("notification"));
				
				if(document.getElementById("goInvisibleCB"))
				{
					if(invisible == 1)
					{
						document.getElementById("goInvisibleCB").checked = true;
					}
				}
				
				if(document.getElementById("deactivateCB"))
				{
					if(deactivate == 1)
					{
						document.getElementById("deactivateCB").checked = true;
					}
				}
				
				if(document.getElementById("genderGroup_0"))
				{
					if(gender == "female")
					{
						document.getElementById("genderGroup_0").checked = true;
					}
					else
					{
						document.getElementById("genderGroup_1").checked = true;
					}
				}
				
				if(document.getElementById("interestGroup_0"))
				{
					if(interest == "female")
					{
						document.getElementById("interestGroup_0").checked = true;
					}
					else
					{
						document.getElementById("interestGroup_1").checked = true;
					}
				}
				
				if(document.getElementById("agesGroup_0"))
				{
					if(interest == "younger")
					{
						document.getElementById("agesGroup_0").checked = true;
					}
					else if(interest == "older")
					{
						document.getElementById("agesGroup_1").checked = true;
					}
					else if(interest == "+/-")
					{
						document.getElementById("agesGroup_2").checked = true;
					}
					else
					{
						document.getElementById("agesGroup_3").checked = true;
					}
				}
				
				if(document.getElementById("notification_0"))
				{
					if(notification == "vibrate")
					{
						document.getElementById("notification_0").checked = true;
					}
					else
					{
						document.getElementById("notification_1").checked = true;
					}
				}
				
				console.log("invisible: " + invisible);
				console.log("deactivate: " + deactivate);
				console.log("gender: " + gender);
				console.log("interest: " + interest);
				console.log("ages: " + ages);
				console.log("notification: " + notification);
				
				//var debugInfo = convert(markers[i].getAttribute("debugInfo"));
				
				/*document.getElementById("name").innerHTML = username;
				
				var image = "<img src='assets/userimages/"+currentUserId+".png' width='150' height='150'>";

				document.getElementById("imageDiv").innerHTML = image;
				document.getElementById("name").innerHTML = username;
				document.getElementById("age").innerHTML = age;
				document.getElementById("schools").innerHTML = schools;
				document.getElementById("mutualFriendsLbl").innerHTML = "Mutual Friends ("+totalMutualFriends+")";*/
				
				
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