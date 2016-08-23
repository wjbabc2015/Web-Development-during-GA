<?php
	include('session_check.php');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="../CSS/insert.css">
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/updatepersonnel.js"></script>
		<title>Update Partner Personnel Information</title>
	</head>
	
	<body>
<?php 
	$f = $_GET['index'];
//echo $_GET['index'];
	
	
	$sql_statement = "";
	
	$result = mysqli_query($mysqlconn, $sql_statement);
	
	$shortname = $firstname = $middlename = $lastname = "";
	$eaddr1 = $eaddr2 = $eaddr3 = "";
	$office = $mobile = $fax = $skype = "";
	$radmin = $padmin = $rcoord = $rteacher = $rtech = 0;
	$radminp = $rpadminp = $guclass = "";
	$program = $interest1 = $interest2 = $user = $pass = "";
	$group_tag = "";
	
	while ($row = mysqli_fetch_array($result)){
		
		$shortname = $row['sname'];
		$firstname = $row['fname'];
		$middlename = $row['mname'];
		$lastname = $row['lname'];
		$eaddr1 = $row['eaddr1'];
		$eaddr2 = $row['eaddr2'];
		$eaddr3 = $row['eaddr3'];
		$office = $row['office'];
		$mobile = $row['mobile'];
		$fax = $row['fax'];
		$skype = $row['skype'];
		$radmin = $row['radmin'];
		$padmin = $row['rpadmin'];
		$rcoord = $row['rcoord'];
		$rteacher = $row['rteacher'];
		$rtech = $row['rtech'];
		$program = $row['program'];
		$interest1 = $row['interest1'];
		$interest2 = $row['interest2'];
		$user = $row['username'];
		$pass = $row['password'];
		$radminp = $row['radminp'];
		$rpadminp = $row['rpadminp'];

//echo '<script type = "text/javascript">alert("'.$rpadminp.'");</script>';
		$guclass = $row['guclass'];	
		$group_tag = $row['tag'];
		
	}
	
	mysqli_close($mysqlconn);
	
	if ($_POST){
		if ($_POST['back']){
			header('Location:displaypersonnel.php');
		}
		
		if ($_POST['submit']){
			
			
			//Capture all data from input
		$firstname = mysqli_real_escape_string($mysqlcon, trim($_POST['firstname']));
		$middlename = mysqli_real_escape_string($mysqlcon, trim($_POST['middlename']));
		$lastname = mysqli_real_escape_string($mysqlcon, trim($_POST['lastname']));	
		$eaddr1 = mysqli_real_escape_string($mysqlcon, trim($_POST['eaddress1']));		
		$eaddr2 = mysqli_real_escape_string($mysqlcon, trim($_POST['eaddress2']));
		$eaddr3 = mysqli_real_escape_string($mysqlcon, trim($_POST['eaddress3']));
		$office = mysqli_real_escape_string($mysqlcon, trim($_POST['office']));
		$mobile = mysqli_real_escape_string($mysqlcon, trim($_POST['mobile']));
		$fax = mysqli_real_escape_string($mysqlcon, trim($_POST['fax']));
		$skype = mysqli_real_escape_string($mysqlcon, trim($_POST['skype']));

		$radmin = $padmin = $rcoord = $rteacher = $rtech = 0;

		if ($_POST['radmin'] == "on")
			$radmin = "1";
		if ($_POST['rpadmin'] == "on")
			$padmin = "1";
		if ($_POST['rcoord'] == "on")
			$rcoord = "1";
		if ($_POST['rteacher'] == "on")
			$rteacher = "1";
		if ($_POST['rtech'] == "on")
			$rtech = "1";
		
		if ($radmin == "0"){
			$radminp = "";
		}else if ($_POST['title_admin'] == "Other"){
			$radminp = mysqli_real_escape_string($mysqlcon, trim($_POST['other_admin']));
		}else{
			$radminp = mysqli_real_escape_string($mysqlcon, trim($_POST['title_admin']));
		}	
		
		if ($padmin == "0"){
			$rpadminp = "";
		}else if ($_POST['title_padmin'] == "Other"){
			$rpadminp = mysqli_real_escape_string($mysqlcon, trim($_POST['other_padmin']));
		}else{
			$rpadminp = mysqli_real_escape_string($mysqlcon, trim($_POST['title_padmin']));
		}
		$group_tag = mysqli_real_escape_string($mysqlcon, trim($_POST['group_tag']));
		$interest1 = mysqli_real_escape_string($mysqlcon, trim($_POST['interest1']));
		$interest2 = mysqli_real_escape_string($mysqlcon, trim($_POST['interest2']));
		$guclass = mysqli_real_escape_string($mysqlcon, trim($_POST['gu_ident']));
		$program = mysqli_real_escape_string($mysqlcon, trim($_POST['program']));
		$user = mysqli_real_escape_string($mysqlcon, trim($_POST['username']));
		
		if (!empty($_POST['pass1'])){
			$pass = mysqli_real_escape_string($mysqlcon, trim($_POST['pass1']));
			$pass = sha1($pass);
		}
/*
 echo $firstname." ".$middlename." ".$lastname;
 echo "<br>";
 echo $eaddr1;
 echo "<br>";
 echo $eaddr2;
 echo "<br>";
 echo $eaddr3;
 echo "<br>";
 echo $office;
 echo "<br>";
 echo $mobile;
 echo "<br>";
 echo $fax;
 echo "<br>";
 echo $skype;
 echo "<br>";
 echo $radmin + $rpadmin + $rcoord + $rteacher + $rtech;
 echo "<br>";
 echo $guclass;
*/
		// MySQL statement of inserting data.
		$insert_statement = "UPDATE ppersonnel SET fname='" . $firstname . "',
								mname='" .$middlename . "',
 								lname='" .$lastname . "',
								eaddr1='" .$eaddr1 . "',
								eaddr2='" .$eaddr2 . "',
								eaddr3='" .$eaddr3 . "',
								office='" .$office . "',
								mobile='" .$mobile . "',
								fax='" .$fax ."',
								skype='" .$skype . "',
								radmin='" .$radmin . "',
								rpadmin='" .$padmin . "',
 								rcoord='" .$rcoord . "',
								rteacher='" .$rteacher . "',
								rtech='" .$rtech . "',
								program='" .$program . "',
								interest1='" .$interest1 . "',
								username='" .$user . "',
								password='" .$pass ."',
								radminp='" .$radminp . "',
								rpadminp='" .$rpadminp . "',
								interest2='" .$interest2 . "',
								tag = '" .$group_tag . "',
								guclass='" .$guclass . "' WHERE ID='" .$f ."'";
		
		// Result of MySQL query
		$insert_result = mysqli_query ( $mysqlcon, $insert_statement );
		//Display the result both from sucess and error
		if ($insert_result){
			echo '<script type = "text/javascript">alert("Successfully Update Personnel!");
										window.location = "../PHP/displaypersonnel.php";
										</script>';
		}else {
			//$error = mysqli_error($mysqlconn);
			$error = mysqli_sqlstate($mysqlconn);
			echo '<script type = "text/javascript">alert("Update Query Failed!'.$error.'");</script>';
		}
		
		mysqli_close($mysqlcon);
		}
	}
?>
	<header>
		<h3>Academic Affairs</h3>
		<h1>Global Academic Initiatives</h1>
	</header>

	<section>
		<div id="partner_form">
			<h2>GU Partner Personnel Update</h2>
			<div id='main_form'>
				<br> <span class='baricon'>1</span> <span id='bar1' class='process'></span>
				<span class='baricon'>2</span> <span id='bar2' class='process'></span>
				<span class='baricon'>3</span> <span id='bar3' class='process'></span>
				<span class='baricon'>4</span> <span id='bar4' class='process'></span>
				<span class='baricon'>5</span> <span id='verify' class='process'></span>
				<span class='baricon'>verification</span>
				<p>
					<span class='error'>* required field.</span>
				</p>
				
				<form method='post' action=''>
					<div id='university'>
						<p class='form_head'>You are updating the personnel of <?php echo $shortname?> !</p>
						<br> <input type="submit" value="Back" name="back"> <input
								type="button" value="Next" id ="first_to_second">
					
					</div>

					<div id='general_info'>
						<p class='form_head'>General Information</p>
						<table>
							<tr>
								<td>First(Given) Name:<span class="error">*</span></td>
							</tr>
							<tr>
								<td><input type="text" name='firstname' value ="<?php echo $firstname?>" size='30' maxlength='20'
									class='required'></td>
							</tr>
							<tr class='separate'></tr>
							<tr>
								<td>Middle Name:</td>
							</tr>
							<tr>
								<td><input type="text" name='middlename' size='50' maxlength='40' value ="<?php echo $middlename?>"></td>
							</tr>
							<tr class='separate'></tr>
							<tr>
								<td>Last(Family) Name:<span class="error">*</span></td>
							</tr>
							<tr>
								<td><input type="text" name='lastname' size='40' maxlength='30' value ="<?php echo $lastname?>"
									class='required'></td>
							</tr>
						</table>
						<br> <input type="button" value="Previous" onclick="show_prev('university', 'bar1');"> <input
							type="button" value="Next" id="second_to_third">
					</div>

					<div id='contact_info'>
						<p class='form_head'>Contact Information</p>
						<table id='other_email'>
							<tr>
								<td>Email Address:<span class="error">*</span></td>
							</tr>
							<tr>
								<td><input type="text" name='eaddress1' size='40' maxlength='50' placeholder="Official email address"
									class='required' value ="<?php echo $eaddr1?>">
									<input type='button' value ='add' onclick='add_field()'></td>
							</tr>
							<?php 
							if ($eaddr2 != ""){
								echo "<script type='text/javascript'>set_pre_email_field('".$eaddr2."')</script>";
							}
							
							if ($eaddr3 != ""){
								echo "<tr id=email_text3>
										<td><input type='text' class='email_text' name='eaddress3' size='40' maxlength='50' placeholder ='email address 3' value='".$eaddr3."'>
										<input type='button' value='Remove' onclick=remove_field()>";
							}
							?>
						</table>
						<table id='rest_contact'>
							<tr class='separate'>
							</tr>
							<tr>
								<td>Phone Number(Office):</td>
							</tr>
							<tr>
								<td><input type="text" name='office' size='40' maxlength='30' value ="<?php echo $office?>"></td>
							</tr>
							<tr>
								<td>Phone Number(Mobile):</td>
							</tr>
							<tr>
								<td><input type="text" name='mobile' size='40' maxlength='30' value ="<?php echo $mobile?>"></td>
							</tr>
							<tr>
								<td>Phone Number(Fax):</td>
							</tr>
							<tr>
								<td><input type="text" name='fax' size='40' maxlength='30' value ="<?php echo $fax?>"></td>
							</tr>
							<tr>
								<td>Skype ID:</td>
							</tr>
							<tr>
								<td><input type="text" name='skype' size='40' maxlength='30' value ="<?php echo $skype?>"></td>
							</tr>
						</table>
						<br> <input type="button" value="Previous" onclick="show_prev('general_info', 'bar2');"> <input
							type="button" value="Next" id="third_to_fourth">
					</div>

					<div id='role_ident'>
						<p class='form_head'>Role in Your University</p>
						<p><span class="error">* At least one role should be selected!</span></p>
					<fieldset class="field_line">
						<table class='checkbox'>
							<tr>
								<td>Please Identify the Role:</td>
							</tr>
							<tr height= 20px>
							</tr>
							<tr>
								<td><input type="checkbox" name='radmin' class='required' <?php 
									if ($radmin == 1) echo 'checked="checked"'
								?>> Univ. Administrator</td>
							</tr>
							<tr>
								<td><select name="title_admin" class="title_admin">
										<option selected = "selected"><?php 
										if($radminp == "President" ||$radminp == "Rector" ||$radminp == "Chancellor" || $radminp ==""){
											echo $radminp;
										}else {
											echo "Other";
										}
										?></option>
										<option>President</option>
										<option>Rector</option>
										<option>Chancellor</option>
										<option>Other</option>
								</select></td>
								<td><input type="text" name="other_admin" size="30" maxlength="40" class="admin_text" value="<?php echo $radminp?>"></td>
							</tr>
							<tr height= 5px>
							</tr>
							<tr>
								<td><input type="checkbox" name='rpadmin' class='required' <?php 
									if ($padmin == 1) echo 'checked="checked"'
								?>> Program Administrator</td>
							</tr>
							<tr>
								<td><select name="title_padmin" class="title_padmin">
										<option selected="selected"><?php 
											if ($rpadminp == "Dean of College" || $rpadminp == "Department Chair" || $rpadminp == ""){			
												echo $rpadminp;
											}else {
												echo "Other";
											}
										?></option>
										<option>Dean of College</option>
										<option>Department Chair</option>
										<option>Other</option>
								</select></td>
								<td><input type="text" name="other_padmin" size="30" maxlength="40" class="padmin_text" value="<?php echo $rpadminp;?>"></td>
							</tr>
							<tr height= 5px>
							</tr>
							<tr>
								<td><input type="checkbox" name='rcoord' class='required' <?php 
									if ($rcoord == 1) echo 'checked="checked"'
								?>> GU Coordinator</td>
							</tr>
							<tr height= 5px>
							</tr>
							<tr>
								<td><input type="checkbox" name='rteacher' class='required' <?php 
									if ($rteacher == 1) echo 'checked="checked"'
								?>> Professor</td>
							</tr>
							<tr height= 5px>
							</tr>
							<tr>
								<td><input type="checkbox" name='rtech' class='required' <?php 
									if ($rtech == 1) echo 'checked="checked"'
								?>> Technical Support</td>
							</tr>
							<tr height= 5px>
							</tr>
						</table>
					</fieldset>
						<table>
							<tr height= 10px>
							</tr>
							<tr>
								<td>Authorization:</td>
								<td>
									<?php
										if ($shortname == "ECU") {
											echo "<input type='radio' name='group_tag' value='ECU'";
												if ($group_tag == "ECU") {
													echo "checked='checked'";
												}
											
											echo ">Database Admin";
										}
									?>

									<input type="radio" name="group_tag" value="Partner" <?php 
										if ($group_tag == "Partner") {
											echo "checked='checked'";
										}
									?>>Partner Admin
									<input type="radio" name="group_tag" value="" <?php 
										if ($group_tag == "") {
											echo "checked='checked'";
										}
									?>>Not Sure
								</td>
							</tr>

							<tr>
								<td>Involved in: </td>
								<td><select name="gu_ident" class="required">
										<option value="<?php echo $guclass?>" selected="selected"><?php echo $guclass?></option>
										<option>GU Class</option>
										<option>Non-GU Class</option>
										<option>GU and Non-GU Class</option>
									</select><span class="error">*</span></td>
							</tr>
						</table>
						<br> <input type="button" value="Previous" onclick="show_prev('contact_info', 'bar3');"> <input
							type="button" value="Next" id="fourth_to_fifth">
					</div>

					<div id='additional_info'>
						<p class='form_head'>Additional Information</p>
						<table>
							<tr>
								<td>Your Programs involved in GPE:</td>
							</tr>
							<tr>
								<td><input type="text" name='program' size='30' maxlength='20' value ="<?php echo $program?>"></td>
							</tr>
							<tr class='separate'></tr>
							<tr>
								<td>Personal Academic Interests - Discipline(s):</td>
							</tr>
							<tr>
								<td><input type="text" name='interest1' size='60' maxlength='30' placeholder = 'e.g., Anthropology, English, Journalism, Psychology ...' value ="<?php echo $interest1?>"></td>
							</tr>
							<tr>
								<td>Personal Academic Interests - Fields of Study/Research:</td>
							</tr>
							<tr>
								<td><input type="text" name='interest2' size='60' maxlength='30' placeholder = 'e.g., intercultural communication, medical anthropology, TESOL' value ="<?php echo $interest2?>"></td>
							</tr>
							<tr class='separate'></tr>
							<tr>
								<td>Username:</td>
							</tr>
							<tr>
								<td><input type="text" name='username' size='30' maxlength='20' value ="<?php echo $user?>"></td>
							</tr>
							<tr class='separate'></tr>
							<tr>
								<td>Password:</td>
							</tr>
							<tr>
								<td><input type='password' name='pass1' size='30'></td>
							</tr>
							<tr class='separate'></tr>
							<tr>
								<td>Confirm Password:</td>
							</tr>
							<tr>
								<td><input type='password' name='pass2' size='30'></td>
							</tr>
						</table>
						<br> <input type="button" value="Previous" onclick="show_prev('role_ident', 'bar4');"> 
						<input type="button" onclick = "fifth_to_verify('additional_info', '<?php echo $shortname; ?>');" value="Next">
					</div>
					<div id="verification"></div>
				</form>
			</div>
		</div>
	</section>

	<footer>
		<br>
			Copyright@ Global Academic Initiatives, maintained by Jiabin (Jeremy) Wang
	</footer>		
	</body>
</html>