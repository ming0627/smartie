var debug = false;

function updatesettings(userid,genderGroup,interestGroup,agesGroup,notification) {
		
	if (window.XMLHttpRequest) {
	
		xmlhttp=new XMLHttpRequest() ;                   // For all modern browsers
	  	
	} else if (window.ActiveXObject) {
	
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP")   // For (older) IE
	}

	if (xmlhttp!=null)  
	{	 
	   // How to send a POST request

		if(debug == true)
		{
			xmlhttp.open("POST", "updateSettings.php", true);
		}
		else
		{
			xmlhttp.open("POST", "http://ridleytechconsulting.com/smartie/updateSettings.php", true);
		}
		
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
		xmlhttp.send( 
		"userid=" + escape(userid) + 
		"&genderGroup=" + escape(genderGroup) + 
		"&interestGroup=" + escape(interestGroup) + 
		"&agesGroup=" + agesGroup + 
		"&notification=" + notification);
	} 
	else 
	{
		alert("The XMLHttpRequest not supported");
	}
}