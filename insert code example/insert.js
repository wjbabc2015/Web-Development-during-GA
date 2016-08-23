/**
 * 
 */

var shortname;
var personName = [];
var contactList = [];
var email = [];
var roleList = [];
var roleTitle = [];
var authority;
var additionInfo = [];

var counte = 1;

$(document).ready(function (){
	
	$("#first_to_second").click(function(){
		first_to_second ();
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

	$("#fifth_to_verify").click(function(){
		fifth_to_verify ('additional_info');
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

	$("#shortname").change(function(){
		var condition = document.getElementById('shortname');
		document.getElementById('authority').innerHTML = "";
//alert(condition.value);
		
		if (condition.value == "ECU") {
			document.getElementById('authority').innerHTML = "<input type='radio' name='group_tag' value='ECU'>Database Admin" + 
															"<input type='radio' name='group_tag' value='Partner'>Partner Admin" +
															"<input type='radio' name='group_tag' value='' checked='checked'>Not Sure";
		}else {
			document.getElementById('authority').innerHTML ="<input type='radio' name='group_tag' value='Partner'>Partner Admin" +
															"<input type='radio' name='group_tag' value='' checked='checked'>Not Sure";
		}
	});

	$("#gu_partner").click(function(){
		show('partner_form');
		disappear('nongu_partner_form');
		disappear('coad_partner_form');
	});

	$("#nongu_partner").click(function(){
		show('nongu_partner_form');
		disappear('partner_form');
		disappear('coad_partner_form');
	});

	$("#coad_teacher").click(function(){
		show('coad_partner_form');
		disappear('partner_form');
		disappear('nongu_partner_form');
	});

	$("#back").click(function(){
		backToIndex();
	});
});
//show_next('role_ident', 'additional_info', 'bar4');
function first_to_second(){
	var element = document.getElementById('university').getElementsByClassName("required");
	
	if (element[0].type == "select-one" && element[0].selectedIndex == 0){
		alert ("Please select at least one university!");
	}else {		
		
		shortname = element[0].value;
		show_next('general_info', 'bar1');
	}
// alert(element.length);
// alert(shortname);
}

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
			} else if (role[r].type == "radio" && role[r].checked){
				authority = role[r].value;
//alert(authority);
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

function fifth_to_verify(id){
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
		verification ();
	}else {
		alert("These passwords don't match, please try again!");
	}
}

function verification(){

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
		+ " Group</td>"
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
		+ "<input type='submit' value='Submit' name='submit'></p></a>";
		
		show_next ('verification', 'verify');
}

function check_required(currentid){
	var element = document.getElementById(currentid).getElementsByClassName("required");
	var error = 0;
	var count = 0;
	
	for (var i = 0; i < element.length; i++) {
		if ((element[i].type == "text" && element[i].value == "")) {
			error++;
		} else if (element[i].type == "select-one" && element[i].selectedIndex == 0) {
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
				+ "' size='40' maxlength='50' placeholder ='email address "
				+ counte
				+ "'><input type='button' value='Remove' onclick=remove_field()>";
		email_content.appendChild(newEmailDiv);
}

function remove_field() {

		if (counte == 4) {
			counte = counte - 1;
		}
		var email_content = document.getElementById('other_email');
		email_content.removeChild(document
				.getElementById('email_text' + counte));
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

function show (id){
	$("#" + id).fadeIn();
	$("#" + id).css({"visibility":"visible","display":"block"});
}

function disappear(id) {
	$("#" + id).fadeOut();
	$("#" + id).css({"visibility":"hidden","display":"none"});
}

function backToIndex (){
	window.location="../PHP/index.php";
}
/*
var email_field = document.getElementsByClassName('email_text');
var counte = email_field.length + 1;

var interest_field = document.getElementsByClassName('interest_text');
var counti = interest_field.length + 1;

var email = [];

function add_field(tag) {

	switch (tag) {

	case "email": {
		counte = counte + 1;

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
				+ "'><input type='button' value='Remove' onclick=remove_field('email');>";
		email_content.appendChild(newEmailDiv);
	}
		break;

	case "interest": {
		counti = counti + 1;

		if (counti > 3) {
			alert("You can't add more interest text field!");
			counti = 4;
			return false;
		}

		var interest_content = document.getElementById("other_interest");
		var newInterestDiv = document.createElement('tr');
		newInterestDiv.setAttribute('id', 'interest_text' + counti);
		newInterestDiv.innerHTML = "<td><input type='text' class='interest_text' name='interest"
				+ counti
				+ "' size='40' maxlength='30' placeholder ='Academic Interest "
				+ counti
				+ "'><input type='button' value='Remove' onclick=remove_field('interest');>";
		interest_content.appendChild(newInterestDiv);
	}
		break;

	}
}

function remove_field(tag) {
	switch (tag) {

	case "email": {
		if (counte == 4) {
			counte = counte - 1;
		}
		var email_content = document.getElementById('other_email');
		email_content.removeChild(document
				.getElementById('email_text' + counte));
		counte = counte - 1;
	}
		break;

	case "interest": {
		if (counti == 4) {
			counti = counti - 1;
		}
		var interest_content = document.getElementById("other_interest");
		interest_content.removeChild(document.getElementById('interest_text'
				+ counti));
		counti = counti - 1;
	}
		break;
	}
}

function show_next(id, nextid, bar) {
	var ele = document.getElementById(id).getElementsByClassName("required");
	var email = document.getElementById(id)
			.getElementsByClassName("email_text");
	var error1 = error2 = count = error3 = 0;
	var checked = true;
alert(email);
	for (var i = 0; i < ele.length; i++) {
		if ((ele[i].type == "text" && ele[i].value == "")) {
			error1++;
		} else if (ele[i].type == "select-one" && ele[i].selectedIndex == 0) {
			error2++;
		} else if (ele[i].type == "checkbox" && !ele[i].checked) {
			count++;
			if (count == 5) {
				checked = false;
			}
		} else if (ele[i].name == "eaddress1") {
			if (!validateEmail(ele[i].value))
				error3++;
		}

		if (email.length > 0) {
			// alert(email[0].value);
			switch (email.length) {
			case 2: {
				if (!validateEmail(email[1].value))
					error3++;
			}
				;
			case 1: {
				if (!validateEmail(email[0].value))
					error3++;
			}
				;
				break;
			}
			// alert(error3);
		}

		// alert(ele[i].tagName);
	}

	var error = error1 + error2 + error3;
	if (error == 0 && checked) {
		document.getElementById("university").style.display = "none";
		document.getElementById("general_info").style.display = "none";
		document.getElementById("contact_info").style.display = "none";
		document.getElementById("role_ident").style.display = "none";
		document.getElementById("additional_info").style.display = "none";
		$("#" + nextid).fadeIn();
		document.getElementById(bar).style.backgroundColor = "#FEC923";
	} else {
		if (error3 > 0) {
			alert("Invalid Email, please correct it!");
			error3 = 0;
		} else {

			alert("Please Fill all the Required details!");
		}
	}
}

function validateEmail(email) {
	var filter = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

	if (!filter.test(email)) {
		return false;
	} else {
		return true;
	}
}

function show_prev(previd, bar) {
email = []; 
	document.getElementById("university").style.display = "none";
	document.getElementById("general_info").style.display = "none";
	document.getElementById("contact_info").style.display = "none";
	document.getElementById("role_ident").style.display = "none";
	document.getElementById("additional_info").style.display = "none";
	document.getElementById("verification").style.display = "none";
	$("#" + previd).fadeIn();
	document.getElementById(bar).style.backgroundColor = "#D8D8D8";
}

function show_verification() {

	var select = document.getElementById("main_form").getElementsByTagName(
			"select");
	var input = document.getElementById("main_form").getElementsByTagName(
			"input");
	if (counte > 1){
		var additional_email = document.getElementsByClassName("email_text");
		alert(additional_email);
		for (var q = 0; q < 2; q++){
			email.push(additional_email[q].value);
		}
	}else {
		email = ["", ""];
	}
	// document.getElementById("main_form").getElementsByClassName("email_text");
	// additional_interest =
	// document.getElementById("main_form").getElementsByClassName("interest_text");
	var ele = [];
	document.getElementById("university").style.display = "none";
	document.getElementById("general_info").style.display = "none";
	document.getElementById("contact_info").style.display = "none";
	document.getElementById("role_ident").style.display = "none";
	//document.getElementById("additional_info").style.display = "none";

	for (var i = 0; i < input.length; i++) {

		switch (input[i].name) {

		case "shortname":
			ele.push(input[i].value);
			break;
		case "firstname":
			ele.push(input[i].value);
			break;
		case "middlename":
			ele.push(input[i].value);
			break;
		case "lastname":
			ele.push(input[i].value);
			break;
		case "eaddress1":
			ele.push(input[i].value);
			break;
		case "office":
			ele.push(input[i].value);
			break;
		case "mobile":
			ele.push(input[i].value);
			break;
		case "fax":
			ele.push(input[i].value);
			break;
		case "skype":
			ele.push(input[i].value);
			break;
		case "radmin": {
			if (input[i].checked) {
				if (select[1].selectedIndex == 0) {
					ele.push("Yes");
				} else {
					ele.push(select[1].value);
				}
			} else {
				ele.push("No");
			}
		}
			break;
		case "rpadmin": {
			if (input[i].checked) {
				if (select[2].selectedIndex == 0) {
					ele.push("Yes");
				} else {
					ele.push(select[2].value);
				}
			} else {
				ele.push("No");
			}
		}
			break;
		case "rcoord": {
			if (input[i].checked) {
				ele.push("Yes");
			} else {
				ele.push("No");
			}
		}
			break;
		case "rteacher": {
			if (input[i].checked) {
				ele.push("Yes");
			} else {
				ele.push("No");
			}
		}
			break;
		case "rtech": {
			if (input[i].checked) {
				ele.push("Yes");
			} else {
				ele.push("No");
			}
		}
			break;
		case "interest1":
			ele.push(input[i].value);
			break;
		case "program":
			ele.push(input[i].value);
			break;
		case "username":
			ele.push(input[i].value);
			break;
		case "pass1":
			ele.push(input[i].value);
			break;
		case "pass2":
			ele.push(input[i].value);
			break;
		}

	}

	if (ele[16] == ele[17]) {
		alert(ele);
		document.getElementById("additional_info").style.display = "none";
		document.getElementById("verification").innerHTML = "<p class='form_head'>Verify Information</p>"
				+ "<p>Short Name(Univ.): "
				+ select[0].value
				+ "</p>"
				+ "<p>Personnel Name: "
				+ ele[0]
				+ " "
				+ ele[1]
				+ " "
				+ ele[2]
				+ "</p>"
				+ "<p>Email 1: "
				+ ele[3]
				+ "</p>"
				+
				 "<p>Email 2: " + email[0] + "</p>" +
				 "<p>Email 3: " + email[1] + "</p>" +
				"<p>Office Number: "
				+ ele[4]
				+ "</p>"
				+ "<p>Phone Number: "
				+ ele[5]
				+ "</p>"
				+ "<p>Fax: "
				+ ele[6]
				+ "</p>"
				+ "<p>Skype ID: "
				+ ele[7]
				+ "</p>"
				+ "<p>Univ. Admin: "
				+ ele[8]
				+ "</p>"
				+ "<p>Program Admin: "
				+ ele[9]
				+ "</p>"
				+ "<p>Coordinator: "
				+ ele[10]
				+ "</p>"
				+ "<p>Professor: "
				+ ele[11]
				+ "</p>"
				+ "<p>Tech: "
				+ ele[12]
				+ "</p>"
				+ "<p>Interest 1: "
				+ ele[13]
				+ "</p>"
				+
				// "<p>Interest 2: " + interest[0] + "</p>" +
				// "<p>Interest 3: " + interest[1] + "</p>" +
				"<p>Program: "
				+ ele[14]
				+ "</p>"
				+ "<p>User Name: "
				+ ele[15]
				+ "</p>"
				+ "<p><input type='button' value='Previous' onclick=show_prev('additional_info','verify');>"
				+ "<input type='submit' value='Submit' name='submit'>";
		$("#verification").fadeIn();
		document.getElementById('verify').style.backgroundColor = "#FEC923";
	}else {
		alert ("The password you enter are not match!");
	}
	if (additional_email == null){
		email = ["none" , "none"];
	}else{
		for (var q = 0; q < 2; q++){
			email.push(additional_email[q].value);
		}
	}
	
	if (additional_interest ==null){
		interest = ["none" , "none"];
	}else{
		for (var p = 0; p < 2; p++){
			email.push(additional_interest[p].value);
		}
	}

	//alert(ele);
}

*/