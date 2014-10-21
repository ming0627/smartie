function updateUserInfo(name,age,schools,q1,q2,q3,question,userid) {
	
	console.log("name: "+name);
	console.log("age: "+age);
	console.log("schools: "+schools);
	console.log("q1: "+q1);
	console.log("q2: "+q2);
	console.log("q3: "+q3);
	console.log("question: "+question);
	console.log("userid: "+userid);
		
	if (window.XMLHttpRequest) {
	
		xmlhttp=new XMLHttpRequest() ;                   // For all modern browsers
	  	
	} else if (window.ActiveXObject) {
	
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP")   // For (older) IE
	}

	if (xmlhttp!=null)  
	{	 
		xmlhttp.open("POST", "updateUserInfo.php", true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
		xmlhttp.send( 
		  "name=" + escape(name) 
		+ "&age=" + escape(age) 
		+ "&schools=" + escape(schools) 
		+ "&q1=" + escape(q1) 
		+ "&q2=" + escape(q2) 
		+ "&q3=" + escape(q3) 
		+ "&question=" + escape(question) 
		+ "&userid=" + escape(userid)
		);
	} 
	else 
	{
		alert("The XMLHttpRequest not supported");
	}
}