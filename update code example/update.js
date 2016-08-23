/**
 * 
 */
var personName = [];
var contactList = [];
var email = [];
var roleList = [];
var roleTitle = [];
var additionInfo = [];
var authority;

var counte = 1;

var pre_email_content;

$(document).ready(function (){
	
	$("#first_to_second").click(function(){
		show_next('general_info', 'bar1');;
	});
	
	$("#second_to_third").click(function(){
		second_to_third ('general_info');
	});
	
	$("#third_to_fourth").click(function(){
		third_to_fourth ('contact_info');
	});
	
	$("#fourth_to_fifth").click(function(){
		fourth_to_fifth ('role_ident');
	});
	
	$(".title_admin").change(function(){
		var condition = document.getElementById("role_ident").getElementsByClassName('title_admin');	
//alert("you changed to " + condition[0].selectedIndex);
		if (condition[0].selectedIndex == 4){
			$(".admin_text").css("display", "inline");
		}else {
			$(".admin_text").css("display", "none");
		}

	});
	
	$(".title_padmin").change(function(){
		var condition = document.getElementById("role_ident").getElementsByClassName('title_padmin');	
//alert("you changed to " + condition[0].selectedIndex);
		if (condition[0].selectedIndex == 3){
			$(".padmin_text").css("display", "inline");
		}else {
			$(".padmin_text").css("display", "none");
		}

	});
});
//show_next('role_ident', 'additional_info', 'bar4');

function second_to_third(id){
	personName = [];
	var error = check_required(id);
	
	if (error > 0){
		alert("First name or last name is required!");
	}else {
		var input = document.getElementById(id).getElementsByTagName('input');
		show_next ('contact_info', 'bar2');
		for (var i = 0; i < input.length; i ++){
			
			if (input[i].type == "text"){
				personName.push(input[i].value);
//alert(personName[i]);			
			}			
		}
//alert(input.length);
	}
//	var emailinput = document.getElementById("other_email").getElementsByClassName("email_text");
//	counte += emailinput.length;
}

function third_to_fourth(id){
	contactList = [];
	email = [];
	var error = check_required(id);
	var errorEmail = 0;
	
	if (error > 0){
		alert("Please provide email address!");
	}else {
		var officialEmail = document.getElementById("other_email").getElementsByClassName('required');
		
		var input = document.getElementById('rest_contact').getElementsByTagName('input');
		
		if (validateEmail(officialEmail[0].value)){
			contactList.push(officialEmail[0].value);

			for (var i = 0; i < input.length; i ++){
				
				if (input[i].type == "text"){
					contactList.push(input[i].value);
//alert("Contact List: " + contactList[i]);			
				}			
			}
		}else {
			errorEmail ++ ; 
		}
		
		if (counte > 1){
			var additional_email = document.getElementById("other_email").getElementsByClassName('email_text');
//alert("There are " + additional_email.length + "Emails");			
			for (var e = 0; e<additional_email.length; e ++){
				
				if (validateEmail(additional_email[e].value)){
					email.push(additional_email[e].value);
				}else {
					errorEmail ++;
				}
//alert("Email Address: " + email[e]);
			}
		}
		
		switch (email.length){
		case 0:{
				email.push("");
				email.push("");
		}break;
		
		case 1:{
			email.push("");
		}break;
		case 2:
			break;
		}
		
		if (errorEmail == 0){
			show_next ('role_ident', 'bar3');
		}else {
			alert("Invalid Email Address!");
		}
//alert("Contact field: " + contactList.length);
	}
	var pre_role_one = document.getElementById("role_ident").getElementsByClassName("title_admin");
//alert(pre_role_one[0].value);
	if (pre_role_one[0].value == "Other"){
		$(".admin_text").css("display", "inline");
	}else {
		$(".admin_text").css("display", "none");
	}
	
	var pre_role_two = document.getElementById("role_ident").getElementsByClassName("title_padmin");
	if (pre_role_two[0].value == "Other"){
		$(".padmin_text").css("display", "inline");
	}else {
		$(".padmin_text").css("display", "none");
	}
		
}

function fourth_to_fifth(id){
	roleList = [];
	roleTitle = [];
	var error = check_required(id);

	if (error == 0){
		var role = document.getElementById(id).getElementsByTagName('input');
		var title = document.getElementById(id).getElementsByTagName('select');
		
		show_next ('additional_info', 'bar4');
		
//alert(role.length);		
		for (var r = 0; r<role.length ; r ++){
			
			if (role[r].type == "checkbox"){
				
				if (role[r].checked){
					roleList.push("Yes");
				}else{
					roleList.push("No");
				}		
//alert(role[r].checked);
			}else if (role[r].type == "radio" && role[r].checked){
				authority = role[r].value;
			}
		}
			
			if (roleList[0] == "Yes"){
				if (title[0].value == "Other"){
					roleTitle.push(role[1].value);
				}else{
					roleTitle.push(title[0].value);
				}
			}else {
				roleTitle.push("");
			}
			
			if (roleList[1] == "Yes"){
				if (title[1].value == "Other"){
					roleTitle.push(role[3].value);
				}else{
					roleTitle.push(title[1].value);
				}
			}else {
				roleTitle.push("");
			}
			
			roleTitle.push(title[2].value);
	} else {
		alert ("Please fill all required information!");
	}
//alert(roleList);
//alert(roleTitle);
}

function fifth_to_verify(id, shortname){
	additionInfo = [];
	
	var pass = [];
	
	var info = document.getElementById(id).getElementsByTagName('input');
	
	for (var i = 0; i < info.length; i ++){
		
		if (info[i].type == "text")
			additionInfo.push(info[i].value);
		
		if (info[i].type == "password")
			pass.push(info[i].value);
	}
//alert(additionInfo);
	
	
	if (pass[0] == pass[1]){
		verification (shortname);
	}else {
		alert("These passwords don't match, please try again!");
	}
}

function verification(shortname){

	document.getElementById("verification").innerHTML = "<p class='form_head'>Confirm Information</p>"
		+ "<table class='verify'>"
		+ "<tr>"
		+ "<td>Short Name(Univ.): </td><td>"
		+ shortname
		+ "</td>"
		+ "</tr><tr>"
		+ "<td>Personnel Name: </td><td>"
		+ personName[0]
		+ " "
		+ personName[1]
		+ " "
		+ personName[2]
		+ "</td>"
		+ "</tr><tr>"
		+ "<td>Official Email Address: </td><td>"
		+ contactList[0]
		+ "</td>"
		+ "</tr><tr>"
		+
		 "<td>Additional Email Address: </td><td>" + email[0] + "</td></tr><tr>" +
		 "<td>Additional Email Address: </td><td>" + email[1] + "</td></tr><tr>" +
		"<td>Office Number: </td><td>"
		+ contactList[1]
		+ "</td>"
		+ "</tr><tr>"
		+ "<td>Phone Number: </td><td>"
		+ contactList[2]
		+ "</td>"
		+ "</tr><tr>"
		+ "<td>Fax: </td><td>"
		+ contactList[3]
		+ "</td>"
		+ "</tr><tr>"
		+ "<td>Skype ID: </td><td>"
		+ contactList[4]
		+ "</td>"
		+ "</tr><tr>"
		+ "<td>Univ. Admin: </td><td>"
		+ roleList[0]
		+ "</td>"
		+ "</tr><tr>"
		+ "<td>Univ. Admin Title: </td><td>"
		+ roleTitle[0]
		+ "</td>"
		+ "</tr><tr>"
		+ "<td>Program Admin: </td><td>"
		+ roleList[1]
		+ "</td>"
		+ "</tr><tr>"
		+ "<td>Program Admin Title: </td><td>"
		+ roleTitle[1]
		+ "</td>"
		+ "</tr><tr>"
		+ "<td>GPE Coordinator: </td><td>"
		+ roleList[2]
		+ "</td>"
		+ "</tr><tr>"
		+ "<td>Professor: </td><td>"
		+ roleList[3]
		+ "</td>"
		+ "</tr><tr>"
		+ "<td>Technical Support: </td><td>"
		+ roleList[4]
		+ "</td>"
		+ "</tr><tr>"
		+ "<td>Authorization:</td><td>"
		+ authority
		+ "</td>"
		+ "</tr><tr>"
		+ "<td>Involved in: </td><td>" 
		+ roleTitle[2]
		+ "</td>"
		+ "</tr><tr>"
		+ "<td>Program involved in GPE: </td><td>"
		+ additionInfo[0]
		+ "</td>"
		+ "</tr><tr>"
		+ "<td>Interests-Discipline(s):</td><td>"
		+ additionInfo[1]
		+ "</td>"
		+ "</tr><tr>"
		+ "<td>Interests-Fields of Study/Research:</td><td> "
		+ additionInfo[2]
		+ "</td>"
		+ "</tr><tr>"
		+ "<td>User Name: </td><td>"
		+ additionInfo[3]
		+ "</td>"
		+ "</tr></table>"
		+ "<a><p><input type='button' value='Previous' onclick=show_prev('additional_info','verify');>"
		+ "<input type='submit' value='Update' name='submit'></p></a>";
		
		show_next ('verification', 'verify');
}

function check_required(currentid){
	var element = document.getElementById(currentid).getElementsByClassName("required");
	var error = 0;
	var count = 0;
	
	for (var i = 0; i < element.length; i++) {
		if ((element[i].type == "text" && element[i].value == "")) {
			error++;
		} else if (element[i].type == "checkbox" && !element[i].checked) {
			count++;
			if (count == 5) {
				error ++;
			}
		}
	}
	return error;
}
		
function show_next(nextid, bar){
	document.getElementById("university").style.display = "none";
	document.getElementById("general_info").style.display = "none";
	document.getElementById("contact_info").style.display = "none";
	document.getElementById("role_ident").style.display = "none";
	document.getElementById("additional_info").style.display = "none";
	$("#" + nextid).fadeIn();
	document.getElementById(bar).style.backgroundColor = "#FEC923";
}

function show_prev(previd, bar) {
		document.getElementById("university").style.display = "none";
		document.getElementById("general_info").style.display = "none";
		document.getElementById("contact_info").style.display = "none";
		document.getElementById("role_ident").style.display = "none";
		document.getElementById("additional_info").style.display = "none";
		document.getElementById("verification").style.display = "none";
		$("#" + previd).fadeIn();
		document.getElementById(bar).style.backgroundColor = "#D8D8D8";
}

function add_field() {

		counte = counte + 1;
//alert(counte);
		if (counte > 3) {
			alert("You can't add more email text field!");
			counte = 4;
			return false;
		}

		var email_content = document.getElementById("other_email");
		var newEmailDiv = document.createElement('tr');
		newEmailDiv.setAttribute('id', 'email_text' + counte);
		newEmailDiv.innerHTML = "<td><input type='text' class='email_text' name='eaddress"
				+ counte
				+ "' size='40' maxlength='30' placeholder ='email address "
				+ counte
				+ "'><input type='button' value='Remove' onclick=remove_field()>";
		email_content.appendChild(newEmailDiv);
//alert(newEmailDiv);
}

function set_pre_email_field(value){
	counte = counte + 1;		

			var email_content = document.getElementById("other_email");
			var newEmailDiv = document.createElement('tr');
			newEmailDiv.setAttribute('id', 'email_text' + counte);
			newEmailDiv.innerHTML = "<td><input type='text' class='email_text' name='eaddress"
					+ counte
					+ "' size='40' maxlength='30' placeholder ='email address "
					+ counte
					+ "' value='" + value
					+ "'><input type='button' value='Remove' onclick=remove_field()>";
			email_content.appendChild(newEmailDiv);
	//alert(newEmailDiv);
}

function remove_field() {

		if (counte == 4) {
			counte = counte - 1;
		}
		var email_content = document.getElementById('other_email');
		email_content.removeChild(document.getElementById('email_text' + counte));
		counte = counte - 1;
}

function validateEmail(email) {
	var filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

	if (!filter.test(email)) {
		return false;
	} else {
		return true;
	}
}