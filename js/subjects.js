
var xmlhttp;
var subjectArray;
var request;
var html;
var Url;

function SendDataSubjects(Arg) { 

	console.log("SendDataSubjects");

	request = Arg;
		
	document.getElementById("orgTable").innerHTML = "";

	xmlhttp = null;	
	
	subjectArray = new Array();
	Url="../calls/subjects.php"

	if (window.XMLHttpRequest) 
	{
		xmlhttp = new XMLHttpRequest() ;                          // For all modern browsers
	} 
	else if (window.ActiveXObject) 
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")   // For (older) IE
	}

	if (xmlhttp!=null)  
	{	
		xmlhttp.onreadystatechange=onStateChangeSubjects;   
		xmlhttp.open("GET", Url, true);
		xmlhttp.send(null);
	} 
	else 
	{
		alert("The XMLHttpRequest not supported");
	}
}

function onStateChangeSubjects()  {

	if (xmlhttp.readyState == 4) {
	
	   if (xmlhttp.status == 200) {
		                                        
		var xml = xmlhttp.responseXML; // "xmlDoc" the returned xml object
		
		//alert(xml);
		
        var issues = xml.documentElement.getElementsByTagName("marker");
			
		for (var i = 0; i < issues.length; i++) 
		{
			var subjectOb = new Object();
			subjectOb.subjectid = issues[i].getAttribute("subjectid");
			subjectOb.subjectname = issues[i].getAttribute("subjectname");
			subjectArray.push(subjectOb);
			obsArray.push(postOb);
		}
		
		console.log("subjectArray: " + subjectArray.length);
		
		if(postArray.length > 0 && subjectArray.length > 0)
		{
			for (var i = 0; i < postArray.length; i++) 
			{
				var postOb = postArray[i];
				var title = postOb.title;
				var issue = postOb.issue;
				var issueid = postOb.issueid;
				var subjectid = postOb.subjectid;
				
				html = "<a href='#page2?issueid=" + issueid + "' data-transition='fade'><div style='position:relative;'><img src='../assets/images/pic.png' alt='' width='125' height='125' class='image'/><div style='position:absolute; width: 120px; top: 84px; max-width:120px; height:38px; border-color:#099; border-style:solid;'>"+title+"</div></div></a>"
							
				if(document.getElementById("orgTable"))
				{
					document.getElementById("orgTable").innerHTML += html;
				}
			}
			
			//console.log("obsArray subs: " + obsArray.length);
		}  
		
		 
		
		//document.getElementById("orgTable").innerHTML=html;

	} else {
	
			alert("statusText: " + xmlhttp.statusText + "\nHTTP status code: " + xmlhttp.status);
	
	}  // End of:   if (xmlhttp.status==200)
  }
}