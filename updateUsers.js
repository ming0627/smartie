var debug = false;

function updateUsers(useridP,currentUserIdP,isMatchP) {
		
	if (window.XMLHttpRequest) {
	
		xmlhttp=new XMLHttpRequest() ;                   // For all modern browsers
	  	
	} else if (window.ActiveXObject) {
	
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP")   // For (older) IE
	}
		
	if(isMatchP == true)
	{
		isMatchP = 1;
	}
	else
	{
		isMatchP = 0;
	}
	
	/*console.log("useridP: " + useridP);
	console.log("currentUserIdP: " + currentUserIdP);
	console.log("isMatchP: " + isMatchP);*/

	if (xmlhttp!=null)  
	{	 
	   // How to send a POST request
	   
		if(debug == true)
		{
			xmlhttp.open("POST", "updateusers.php", true);
		}
		else
		{
			xmlhttp.open("POST", "http://ridleytechconsulting.com/smartie/updateusers.php", true);
		}
		
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
		xmlhttp.send( "userid=" + escape(useridP) + "&currentUserId=" + escape(currentUserIdP) + "&isMatch=" + isMatchP);
	} 
	else 
	{
		alert("The XMLHttpRequest not supported");
	}
}