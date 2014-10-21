
var xmlhttp;
var stateGlobal;
var debug = false;
var init = true;

function GetMessages(Arg,state,user1,user2) {
		
	xmlhttp=null;
	
	var Url;
	
	stateGlobal = state;
	
	if(debug == true)
	{
		if(state == "messages")
		{
			Url="getmessages.php"  
			//console.log("get messages");
		}
		else
		{
			Url="getconvofeed.php?user1="+user1+"&user2="+user2;
			//console.log("get feed");
		}
	}
	else
	{
		if(state == "messages")
		{
			Url="http://ridleytechconsulting.com/smartie/getmessages.php"  
			//console.log("get messages");
		}
		else
		{
			Url="http://ridleytechconsulting.com/smartie/getconvofeed.php?user1="+user1+"&user2="+user2;
			//console.log("get feed");
		}
	}
	
	//alert(Arg);	

	if (window.XMLHttpRequest) {
	
		xmlhttp=new XMLHttpRequest() ;                   // For all modern browsers
	  	
	} else if (window.ActiveXObject) {
	
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP")   // For (older) IE
	}

	if (xmlhttp!=null)  
	{
		xmlhttp.onreadystatechange=onStateChange;     
		
		//Url=Url+"?Date="+escape(Arg)+"&NoCache="+new Date().getTime()    // "&NoCache"  => Append the timesenddate to avoid cashing
											   // Also escape the input argument  (Arg) to properly url-encode the characters (to be sure)
		
		xmlhttp.open("GET", Url, true);                                                         //  (httpMethod,  URL,  asynchronous)
		
		// xmlhttp.overrideMimeType('text/xml');
			
		xmlhttp.send(null);
	
	/* 
	   // How to send a POST request
		xmlhttp.open("POST", Url, true);                                                         //  (httpMethod,  URL,  asynchronous)
	
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
	
		 xmlhttp.send( "Date=" + escape(Arg) );
	*/
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
			
			$( "#imageDiv" ).html("");
			
			//console.log("clear div");
			
			var html = "";
			var newMessage = false;
			$('#sendImageDiv').hide();
			
			//console.log("count: "+markers.length);
			
			//console.log(markers.length);
			
			var lastday = "";
			
			for (var i = 0; i < markers.length; i++) 
			{
				var message = markers[i].getAttribute("message");
				var username = convert(markers[i].getAttribute("username"));
				var messageid = convert(markers[i].getAttribute("messageid"));
				var senddate = convert(markers[i].getAttribute("senddate"));
				var senderid = convert(markers[i].getAttribute("senderid"));
				
				
				if(message != "")
				{
					//console.log("response state: "+stateGlobal);
					
					if(stateGlobal == "messages")
					{
						html = "<div class='messageRowDiv' id='"+messageid+"' onclick='showMessage("+senderid+")'><div class='userPicDiv1'><img src='assets/userimages/"+senderid+".png' width='60' height='60'></div><div class='usernameDiv'><strong>" + username + "</strong></div><div class='messageDiv'>" + message + "</div></div>";					
					}
					else
					{
						var day = convert(markers[i].getAttribute("day"));
												
						if(day != lastday)
						{
							html = "<div class='convoContainer'><div class='userPicDiv'><img src='assets/userimages/"+senderid+".png' width='40' height='40'></div><div class='convoDiv' id='"+messageid+"'><div class='messageTimeDiv'>"+senddate+"</div><div class='messageDiv2'>" + message + "</div></div>";
						}
						else
						{
							html = "<div class='convoContainer'><div class='userPicDiv'><img src='assets/userimages/"+senderid+".png' width='40' height='40'></div><div class='convoDiv' id='"+messageid+"'><div class='messageDiv3'>" + message + "</div></div>";
						}
						
						lastday = day;
					}
					
					messageArray.push(messageid);
					
					if(init)
					{
						document.getElementById("imageDiv").innerHTML += html;
					}
					else
					{
						$( "#imageDiv" ).prepend(html);
					}
				}
				
				if(i == 0 && markers.length > 0 && message != "")
				{
					lasttime = senddate;
					newMessage = true;
				}
			}	
			
			//console.log("time: "+lasttime);
					
			//console.log(JSON.stringify(messageArray));
			
			/*if(loop > 1 && newMessage)
			{
				console.log("new chat!");
			}*/
		}
		else
		{
			//console.log("no new chats");	
		}

	} else {
	
			alert("statusText: " + xmlhttp.statusText + "\nHTTP status code: " + xmlhttp.status);
	
	}  // End of:   if (xmlhttp.status==200)
  }
}