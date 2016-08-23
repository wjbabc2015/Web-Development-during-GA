/**
 * 
 */
function backButton (){
	document.getElementById("information").innerHTML = "";
	 $("#header").fadeIn();
	 $("#result").fadeIn();
	 document.getElementById("information").style.display="none";
}

function updateButton (index){

		window.location = '../PHP/updatepersonnel.php?index='+index;
}

function deleteButton (index){
	if (confirm("Do you want to DELETE this Partner Personnel Information?")){
		
			window.location = '../PHP/delete_personnel.php?index='+index;
			//alert("Successfully Delete!");
	}
}

function updateButton_nonecu (index){

		window.location = '../PHP/updatepersonnel_nonecu.php?index='+index;
}

function deleteButton_nonecu (index){
	if (confirm("Do you want to DELETE this Partner Personnel Information?")){
		
			window.location = '../PHP/delete_personnel_nonecu.php?index='+index;
			//alert("Successfully Delete!");
	}
}