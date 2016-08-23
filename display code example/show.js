/**
 * 
 */
function show_info (index){
	
	if (window.XMLHttpRequest){
		// code for IE7+, Firefox, Chrome, Opera, Safari
        displayRequest = new XMLHttpRequest();

	}else {
		// code for IE6, IE5
		displayRequest = new ActiveXObject("Microsoft.XMLHTTP");

	}
	
	displayRequest.onreadystatechange = function() {
        if (displayRequest.readyState == 4 && displayRequest.status == 200) {
            document.getElementById("information").innerHTML = displayRequest.responseText;       
            
            $("#information").fadeIn();
            $("#info_button").fadeIn();
            document.getElementById("header").style.display="none";
        	document.getElementById("result").style.display="none";
        }
    };
  
    var url1 = "show_detail.php?f="+index;
    
    displayRequest.open("GET",url1,true);
    displayRequest.send();

}
