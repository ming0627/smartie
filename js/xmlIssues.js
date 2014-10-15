
var xmlhttp1;
var postArray;
var request1;
var html;
var Url1;
var obsArray = new Array();

function SendDataPosts(Arg) { 

	console.log("SendDataPosts");

	request1 = Arg;	
	
	document.getElementById("orgTable").innerHTML = "";

	xmlhttp1 = null;	
	
	postArray = new Array();
	Url1="../calls/queryIssues.php"

	if (window.XMLHttpRequest) 
	{
		xmlhttp1 = new XMLHttpRequest();                          // For all modern browsers
	} 
	else if (window.ActiveXObject) 
	{
		xmlhttp1 = new ActiveXObject("Microsoft.XMLHTTP")   // For (older) IE
	}

	if (xmlhttp1!=null)  
	{	
		xmlhttp1.onreadystatechange=onStateChangePosts;   
		xmlhttp1.open("GET", Url1, true);
		xmlhttp1.send(null);
	} 
	else 
	{
		alert("The XMLHttpRequest not supported");
	}
}

function onStateChangePosts()  {

	if (xmlhttp1.readyState == 4) {
	
	   if (xmlhttp1.status == 200) {
		                                        
		var xml1 = xmlhttp1.responseXML; // "xmlDoc" the returned xml object
		
		//alert(xml);
		
        var issues1 = xml1.documentElement.getElementsByTagName("marker");
			
		for (var i = 0; i < issues1.length; i++) 
		{
			var postOb = new Object();
			postOb.title = issues1[i].getAttribute("title");
			postOb.issue = issues1[i].getAttribute("issue");
			postOb.issueid = issues1[i].getAttribute("issueid");
			postOb.subjectid = issues1[i].getAttribute("subjectid");
			postArray.push(postOb);
			obsArray.push(postOb);
		}   
		
		console.log("postArray: " + postArray.length);
		
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
			
			//console.log("obsArray posts: " + obsArray.length);
		}   
		
		//document.getElementById("orgTable").innerHTML=html;

	} else {
	
			alert("statusText: " + xmlhttp1.statusText + "\nHTTP status code: " + xmlhttp1.status);
	
	}  // End of:   if (xmlhttp.status==200)
  }
}

function getData() {
	
	console.log("obsArray posts: " + obsArray.length);
}