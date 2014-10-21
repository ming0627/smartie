function updateaccount(senderid,receiverid,message) {
		
	if (window.XMLHttpRequest) {
	
		xmlhttp=new XMLHttpRequest() ;                   // For all modern browsers
	  	
	} else if (window.ActiveXObject) {
	
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP")   // For (older) IE
	}

	if (xmlhttp!=null)  
	{	 
	   // How to send a POST request
		xmlhttp.open("POST", "updateAccount.php", true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
		xmlhttp.send( "userid=" + escape(userid) + "&goInvisibleCB=" + escape(goInvisibleCB) + "&deactivateCB=" + deactivateCB + "&comments=" + contactTV);
	} 
	else 
	{
		alert("The XMLHttpRequest not supported");
	}
}