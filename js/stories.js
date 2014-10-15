var xmlhttp1;
var postArray;
var request1;
var html;
var Url1;
var obsArray = new Array();
var debug = false;

function SendDataStories(Arg) { 

	//console.log("SendDataStories");

	request1 = Arg;	
	
	document.getElementById("listDiv1").innerHTML = "";

	xmlhttp1 = null;	
	
	postArray = new Array();
	
	if(debug == true)
	{
		Url1="../calls/stories.php"
	}
	else
	{
		Url1="http://ridleytechconsulting.com/tierra/calls/stories.php"	
	}

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
			postOb.issueid = issues1[i].getAttribute("issueid");
			postOb.issue = issues1[i].getAttribute("issue");
			postOb.title = issues1[i].getAttribute("title");
			postOb.subjectid = issues1[i].getAttribute("subjectid");
			postOb.issuedate = issues1[i].getAttribute("issuedate");
			postOb.authorid = issues1[i].getAttribute("authorid");
			postOb.company = issues1[i].getAttribute("company");
			postOb.contact = issues1[i].getAttribute("contact");		
			postArray.push(postOb);
		}   
		
		var curDiv = 1;
		//console.log("curDiv: "+curDiv);
		var curDivID = "listDiv"+curDiv;
		//console.log("curDivID: "+curDivID);
		
		if(postArray.length > 0)
		{
			for (var i = 0; i < postArray.length; i++) 
			{
				var postOb = postArray[i];
				var issueid = postOb.issueid;
				var issue = postOb.issue;
				var title = postOb.title;
				var subjectid = postOb.subjectid;
				var issuedate = postOb.issuedate;
				var authorid = postOb.authorid;
				var company = postOb.company;
				var contact = postOb.contact;
				
				if(i % 5)
				{
							
				}
				else
				{
					if(i > 0)
					{
						curDiv++;
						curDivID = "listDiv"+curDiv;
						//console.log("i: "+ i+ " 5 break");
					}
					//console.log("curDivID: "+curDivID);
					
				}
				
				console.log("curDivID: "+curDivID+" issue: "+issueid);
				
				/*if(i < 5)
				{*/
					var id = 'box' + issueid;
										
			html = "<div class='item'><img src='assets/images/"+i+".png' id='"+ id +"'/><div class='caption'>"+ title +"</div></div>"
					if(document.getElementById(curDivID))
					{
						document.getElementById(curDivID).innerHTML += html;
					}
				//}
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