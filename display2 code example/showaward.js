$(document).ready(function(){

	$("#search_by_option").click(function(){
		show_by_option();
	});

	$("#search_all").click(function(){
		show_all_record();
	});

	$("#back").click(function(){
		window.location = "../PHP/index_eadmin.php";
	});

	$('#reset').click(function(){
		location.reload();
	});
});

function show_all_record () {
	if (window.XMLHttpRequest){
		// code for IE7+, Firefox, Chrome, Opera, Safari
        displayRequest = new XMLHttpRequest();

	}else {
		// code for IE6, IE5
		displayRequest = new ActiveXObject("Microsoft.XMLHTTP");
		
	}

	displayRequest.onreadystatechange = function() {
        if (displayRequest.readyState == 4 && displayRequest.status == 200) {
        	document.getElementById('search_result_more').innerHTML = "";
            document.getElementById('search_result_more').innerHTML = displayRequest.responseText;  
        }
    };

    var url1 = "display_award_helper.php?tag=all";

    displayRequest.open("GET",url1,true);
    displayRequest.send();
}

function show_detail(id, project) {
	if (window.XMLHttpRequest){
		// code for IE7+, Firefox, Chrome, Opera, Safari
        displayRequest = new XMLHttpRequest();

	}else {
		// code for IE6, IE5
		displayRequest = new ActiveXObject("Microsoft.XMLHTTP");
		
	}

	displayRequest.onreadystatechange = function() {
        if (displayRequest.readyState == 4 && displayRequest.status == 200) {
        	document.getElementById('show_detail').innerHTML = "";
            document.getElementById('show_detail').innerHTML = displayRequest.responseText; 

            $("#show_detail").fadeIn();
			$("#show_detail").css({"visibility":"visible","display":"block"});
			$("#search_condition").css({"visibility":"hidden","display":"none"});
			$("#search_result").css({"visibility":"hidden","display":"none"});
        }
    };

    var url1 = "display_award_helper.php?tag=detail&id="+id+"&project="+project;

    displayRequest.open("GET",url1,true);
    displayRequest.send();
}

function delete_record (year, tag, host) {

	if (confirm("Do you want to DELETE this Partner Information?")){

		window.location = "../PHP/delete_award_record.php?year="+year+"&tag="+tag+"&host="+host+"&logo=all";

	}
}

function show_by_option (){
	var select_content = document.getElementById('search_condition').getElementsByTagName('select');
	var condition_content = [];
	var count = 0;

	for (var i = 0; i < select_content.length; i++) {
		condition_content.push (select_content[i].value);

		if (select_content[i].value != "") count ++;
	}

	if (count > 1){
		alert("Too many options, please reset them first!");
	}else if (count == 0){
		alert("PLease use Search All Function!");
	}else{
		search_by_condition (condition_content);
	}
}

function search_by_condition (condition) {
	//alert(condition.length);

	if (window.XMLHttpRequest){
		// code for IE7+, Firefox, Chrome, Opera, Safari
        displayRequest = new XMLHttpRequest();

	}else {
		// code for IE6, IE5
		displayRequest = new ActiveXObject("Microsoft.XMLHTTP");
		
	}

	displayRequest.onreadystatechange = function() {
        if (displayRequest.readyState == 4 && displayRequest.status == 200) {
        	document.getElementById('search_result_more').innerHTML = "";
            document.getElementById('search_result_more').innerHTML = displayRequest.responseText;  
        }
    };

    var url = "";
 
    if (condition[0] != ""){
    	url = "display_award_helper.php?tag=year&condition="+condition[0];
    }else if (condition[1] != ""){
    	url = "display_award_helper.php?tag=general&condition="+condition[1];
    }else if (condition[2] != ""){
    	url = "display_award_helper.php?tag=other&condition="+condition[2];
    }else if (condition[3] != "") {
		url = "display_award_helper.php?tag=partner&condition="+condition[3];
	}else if (condition[4] !="" ){
		url = "display_award_helper.php?tag=teacher&condition="+condition[4];
	}else if (condition[5] !="" ){
		url = "display_award_helper.php?tag=tech&condition="+condition[5];
	}

	displayRequest.open("GET", url, true);
	displayRequest.send();
}

function delete_teacher (id, name){
	if (confirm("Do you want to DELETE this Partner Information?")){		

		window.location = "../PHP/delete_award_record.php?logo=teacher&id="+id+"&name="+name;
	}
}

function delete_tech (id, name){
	if (confirm("Do you want to DELETE this Partner Information?")){		

		window.location = "../PHP/delete_award_record.php?logo=tech&id="+id+"&name="+name;
	}
}

function delete_project(id, name){
	if (confirm("Do you want to DELETE this Partner Information?")){		

		window.location = "../PHP/delete_award_record.php?logo=project&id="+id+"&name="+name;
	}
}

function delete_person(id, name){
	if (confirm("Do you want to DELETE this Partner Information?")){		

		window.location = "../PHP/delete_award_record.php?logo=person&id="+id+"&name="+name;
	}
}

function delete_institution(id, name){
	if (confirm("Do you want to DELETE this Partner Information?")){		

		window.location = "../PHP/delete_award_record.php?logo=institution&id="+id+"&name="+name;
	}
}

function back_to_search(){
	$("#search_condition").fadeIn();
	$("#search_result").fadeIn();
	$("#show_detail").css({"visibility":"hidden","display":"none"});
	$("#search_condition").css({"visibility":"visible","display":"block"});
	$("#search_result").css({"visibility":"visible","display":"block"});
}