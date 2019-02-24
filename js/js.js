function telebuttonShare() { 

	var wp_ts = confirm("Do you want to share this page in the telegram?"); 

	if (wp_ts == true) { 
		window.location.replace('https://telegram.me/share/url?text=Custom+Text&url='+window.location.href); 
	} 
	
} 
