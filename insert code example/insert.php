<?php
	include('session_check.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../CSS/insert.css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/insert.js"></script>
<title>Welcome to GA Initiatives</title>
</head>
<body>
<?php
	if ($_GET['index']){
		$index = $_GET['index'];

		switch ($index) {
			case '2':
				echo '<style type="text/css">#partner_form{display: none; visibility: hidden;}
						#nongu_partner_form {display: block; visibility: visible;}</style>';
				break;

			case '3':
				echo '<style type="text/css">#partner_form{display: none; visibility: hidden;}
						#coad_partner_form {display: block; visibility: visible;}</style>';
				break;
			
			default:
				# code...
				break;
		}
	}
?>

<?php 
$shortname = $firstname = $middlename = $lastname = "";
$eaddr1 = $eaddr2 = $eaddr3 = $interest1 = $interest2 = "";
$office = $mobile = $fax = $skype = "";
$radmin = $rpadmin = $rcoord = $rteacher = $rtech = 0;
$radminp = $rpadminp = $guclass = "";
$program = $username = $password = "";
$group_tag = "";

if ($_POST){
	
	if ($_POST['submit']){
		$shortname = mysqli_real_escape_string($mysqlconn, trim($_POST['shortname']));
		$firstname = mysqli_real_escape_string($mysqlconn, trim($_POST['firstname']));
		$middlename = mysqli_real_escape_string($mysqlconn, trim($_POST['middlename']));
		$lastname = mysqli_real_escape_string($mysqlconn, trim($_POST['lastname']));	
		$eaddr1 = mysqli_real_escape_string($mysqlconn, trim($_POST['eaddress1']));		
		$eaddr2 = mysqli_real_escape_string($mysqlconn, trim($_POST['eaddress2']));
		$eaddr3 = mysqli_real_escape_string($mysqlconn, trim($_POST['eaddress3']));
		$office = mysqli_real_escape_string($mysqlconn, trim($_POST['office']));
		$mobile = mysqli_real_escape_string($mysqlconn, trim($_POST['mobile']));
		$fax = mysqli_real_escape_string($mysqlconn, trim($_POST['fax']));
		$skype = mysqli_real_escape_string($mysqlconn, trim($_POST['skype']));
		if ($_POST['radmin'] == "on")
			$radmin = "1";
		if ($_POST['rpadmin'] == "on")
			$rpadmin = "1";
		if ($_POST['rcoord'] == "on")
			$rcoord = "1";
		if ($_POST['rteacher'] == "on")
			$rteacher = "1";
		if ($_POST['rtech'] == "on")
			$rtech = "1";
		
		if ($_POST['title_admin'] == "Other"){
			$radminp = mysqli_real_escape_string($mysqlconn, trim($_POST['other_admin']));
		}else{
			$radminp = mysqli_real_escape_string($mysqlconn, trim($_POST['title_admin']));
		}	
		
		if ($_POST['title_padmin'] == "Other"){
			$rpadminp = mysqli_real_escape_string($mysqlconn, trim($_POST['other_padmin']));
		}else{
			$rpadminp = mysqli_real_escape_string($mysqlconn, trim($_POST['title_padmin']));
		}
		$group_tag = mysqli_real_escape_string($mysqlconn, trim($_POST['group_tag']));
		$interest1 = mysqli_real_escape_string($mysqlconn, trim($_POST['interest1']));
		$interest2 = mysqli_real_escape_string($mysqlconn, trim($_POST['interest2']));
		$guclass = mysqli_real_escape_string($mysqlconn, trim($_POST['gu_ident']));
		$program = mysqli_real_escape_string($mysqlconn, trim($_POST['program']));
		$username = mysqli_real_escape_string($mysqlconn, trim($_POST['username']));
		$password = mysqli_real_escape_string($mysqlconn, trim($_POST['pass1']));
		$password = sha1($password);

	
		// MySQL statement of inserting data.
		$insert_statement = "";
		
		// Result of MySQL query
		$insert_result = mysqli_query ( $mysqlconn, $insert_statement );
		if ($insert_result){
			echo '<script type = "text/javascript">alert("Successfully Add a New Person of '.$shortname.'!");</script>';
		}else {
			$error = mysqli_error($mysqlconn);
			echo '<script type = "text/javascript">alert("Insert Query Failed!'.$error.'");</script>';
		}
		
	}

	if ($_POST['nongu_add']){

		if (filter_var($_POST['nongu_email'], FILTER_VALIDATE_EMAIL)){
			$nongu_fname = mysqli_real_escape_string($mysqlconn, trim($_POST['nongu_fname']));
			$nongu_mname = mysqli_real_escape_string($mysqlconn, trim($_POST['nongu_mname']));
			$nongu_lname = mysqli_real_escape_string($mysqlconn, trim($_POST['nongu_lname']));

			if (!empty($nongu_mname)) {
				$nongu_name = $nongu_fname . " " . $nongu_mname . " " . $nongu_lname;
			}else{
				$nongu_name = $nongu_fname . " " . $nongu_lname;
			}

			

			$nongu_institution = mysqli_real_escape_string($mysqlconn, trim($_POST['nongu_institution']));
			$nongu_city = mysqli_real_escape_string($mysqlconn, trim($_POST['nongu_city']));
			$nongu_country = mysqli_real_escape_string($mysqlconn, trim($_POST['nongu_country']));
			$nongu_email = mysqli_real_escape_string($mysqlconn, trim($_POST['nongu_email']));

			$insert_statement = "";

			$insert_result = mysqli_query ( $mysqlconn, $insert_statement);

			if ($insert_result){
						echo '<script type = "text/javascript">alert("Successfully Add a Non-GU Partner Information");</script>';
				}else {
					$error = mysqli_error($mysqlconn);
					echo '<script type = "text/javascript">alert("Insert Query Failed!'.$error.'");</script>';
				}
		}else {
			echo '<script type = "text/javascript">alert("Please correct your email address!");</script>';
		}

		echo "<script>window.location ='../PHP/insert.php?index=2';</script>";
		
	}

	if ($_POST['coad_add']){

		if (filter_var($_POST['coad_email'], FILTER_VALIDATE_EMAIL)){
			$coad_fname = mysqli_real_escape_string($mysqlconn, trim($_POST['coad_fname']));
			$coad_mname = mysqli_real_escape_string($mysqlconn, trim($_POST['coad_mname']));
			$coad_lname = mysqli_real_escape_string($mysqlconn, trim($_POST['coad_lname']));

			if (!empty($coad_mname)) {
				$coad_name = $coad_fname . " " . $coad_mname . " " . $coad_lname;
			}else{
				$coad_name = $coad_fname . " " . $coad_lname;
			}

			$coad_institution = mysqli_real_escape_string($mysqlconn, trim($_POST['coad_institution']));
			$coad_city = mysqli_real_escape_string($mysqlconn, trim($_POST['coad_city']));
			$coad_country = mysqli_real_escape_string($mysqlconn, trim($_POST['coad_country']));
			$coad_email = mysqli_real_escape_string($mysqlconn, trim($_POST['coad_email']));

//echo '<script type = "text/javascript">alert("'.$coad_education.'");</script>';


			$insert_statement = "";

			$insert_result = mysqli_query ( $mysqlconn, $insert_statement);

			if ($insert_result){
						echo '<script type = "text/javascript">alert("Successfully Add a COAD Partner Teacher Information");</script>';
				}else {
					$error = mysqli_error($mysqlconn);
					echo '<script type = "text/javascript">alert("Insert Query Failed!'.$error.'");</script>';
				}
		}else {
			echo '<script type = "text/javascript">alert("Please correct your email address!");</script>';
		}
		echo "<script>window.location ='../PHP/insert.php?index=3';</script>";
	} 
	
}
?>
	<header>
		<h3>Academic Affairs</h3>
		<h1>Global Academic Initiatives</h1>
	</header>

	<div id="menu_bar">
		<table class="menu_bar_table">
			<tr>
				<td>
					<input type="button" id="gu_partner" value="GU Partner Personnel">					
				</td>

				<td>
					<input type="button" id="nongu_partner" value="Non-GU Partner Personnel">
				</td>

				<td>
					<input type="button" id="coad_teacher" value="COAD Partner Teacher">
				</td>

				<td>
					<input type="button" id="back" value="Back to Menu">
				</td>
			</tr>
		</table>
	</div>

	<section>
		<div id="partner_form">
			<h2>GU Partner Personnel</h2>
			<div id="main_form">
				<br> <span class='baricon'>1</span> <span id='bar1' class='process'></span>
				<span class='baricon'>2</span> <span id='bar2' class='process'></span>
				<span class='baricon'>3</span> <span id='bar3' class='process'></span>
				<span class='baricon'>4</span> <span id='bar4' class='process'></span>
				<span class='baricon'>5</span> <span id='verify' class='process'></span>
				<span class='baricon'>verification</span>
				<p>
					<span class='error'>* required field.</span>
				
				
				<form method='post' action='insert.php'>
					<div id='university'>
						<p class='form_head'>Institution of Personnel</p>
						<p>
							<select name='shortname' class="required" id ="shortname">
								<option value="" selected="selected">Select
									your Univ.</option>
									<?php
									$mysqlStatementS = "select sname from partner";
									$resultS = mysqli_query ( $mysqlconn, $mysqlStatementS );
									
									while ( $sn = mysqli_fetch_array ( $resultS ) ) {
										echo '<option>' . $sn ['sname'] . '</option>';
									}
									?>
		    				</select><span class="error">*</span> <br><input
								type="button" value="Next" id ="first_to_second">
					
					</div>

					<div id='general_info'>
						<p class='form_head'>General Information</p>
						<table>
							<tr>
								<td>First(Given) Name:<span class="error">*</span></td>
							</tr>
							<tr>
								<td><input type="text" name='firstname' size='30' maxlength='30'
									class='required'></td>
							</tr>
							<tr class='separate'></tr>
							<tr>
								<td>Middle Name:</td>
							</tr>
							<tr>
								<td><input type="text" name='middlename' size='50' maxlength='30'></td>
							</tr>
							<tr class='separate'></tr>
							<tr>
								<td>Last(Family) Name:<span class="error">*</span></td>
							</tr>
							<tr>
								<td><input type="text" name='lastname' size='40' maxlength='40'
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
									class='required'>
									<input type='button' value ='add' onclick='add_field()'></td>
							</tr>
						</table>
						<table id='rest_contact'>
							<tr class='separate'>
							</tr>
							<tr>
								<td>Phone Number(Office):</td>
							</tr>
							<tr>
								<td><input type="text" name='office' size='40' maxlength='30'></td>
							</tr>
							<tr>
								<td>Phone Number(Mobile):</td>
							</tr>
							<tr>
								<td><input type="text" name='mobile' size='40' maxlength='30'></td>
							</tr>
							<tr>
								<td>Phone Number(Fax):</td>
							</tr>
							<tr>
								<td><input type="text" name='fax' size='40' maxlength='30'></td>
							</tr>
							<tr>
								<td>Skype ID:</td>
							</tr>
							<tr>
								<td><input type="text" name='skype' size='40' maxlength='30'></td>
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
								<td><input type="checkbox" name='radmin' class='required'> Univ. Administrator</td>
							</tr>
							<tr>
								<td><select name="title_admin" class="title_admin">
										<option value="" selected = "selected">Select
											Title</option>
										<option>President</option>
										<option>Rector</option>
										<option>Chancellor</option>
										<option>Other</option>
								</select></td>
								<td><input type="text" name="other_admin" size="30" maxlength="40" class="admin_text"></td>
							</tr>
							<tr height= 5px>
							</tr>
							<tr>
								<td><input type="checkbox" name='rpadmin' class='required'> Program Administrator</td>
							</tr>
							<tr>
								<td><select name="title_padmin" class="title_padmin">
										<option value="" selected="selected">Select
											Title</option>
										<option>Dean of College</option>
										<option>Department Chair</option>
										<option>Other</option>
								</select></td>
								<td><input type="text" name="other_padmin" size="30" maxlength="40" class="padmin_text"></td>
							</tr>
							<tr height= 5px>
							</tr>
							<tr>
								<td><input type="checkbox" name='rcoord' class='required'> GU Coordinator</td>
							</tr>
							<tr height= 5px>
							</tr>
							<tr>
								<td><input type="checkbox" name='rteacher' class='required'> Professor</td>
							</tr>
							<tr height= 5px>
							</tr>
							<tr>
								<td><input type="checkbox" name='rtech' class='required'> Technical Support</td>
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
								<td id="authority">
								</td>
							</tr>
							<tr>
								<td>Involved in: </td>
								<td><select name="gu_ident" class="required">
										<option value="" selected="selected">Please select</option>
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
								<td><input type="text" name='program' size='30' maxlength='20'></td>
							</tr>
							<tr class='separate'></tr>
							<tr>
								<td>Personal Academic Interests - Discipline(s):</td>
							</tr>
							<tr>
								<td><input type="text" name='interest1' size='60' maxlength='30' placeholder = 'e.g., Anthropology, English, Journalism, Psychology ...'></td>
							</tr>
							<tr>
								<td>Personal Academic Interests - Fields of Study/Research:</td>
							</tr>
							<tr>
								<td><input type="text" name='interest2' size='60' maxlength='30' placeholder = 'e.g., intercultural communication, medical anthropology, TESOL '></td>
							</tr>
							<tr class='separate'></tr>
							<tr>
								<td>Username:</td>
							</tr>
							<tr>
								<td><input type="text" name='username' size='30' maxlength='20'></td>
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
						<br> <input type="button" value="Previous" onclick="show_prev('role_ident', 'bar4');"> <input
							type="button" value="Next" id="fifth_to_verify">
					</div>
					<div id="verification"></div>
				</form>
			</div>
		</div>

		<div id="nongu_partner_form">
			<h2>Non-GU Partner Personnel</h2>
			<form method="post" action="insertpersonnel.php">
				<table class="nongu_partner_form_table">
					<tr>
						<th>Teacher Name</th>
					</tr>

					<tr>
						<td>
							First Name:
						</td>

						<td>
							<input type="text" name="nongu_fname" size=20px maxlength="30">
						</td>
					</tr>

					<tr>
						<td>
							Middle Name:
						</td>

						<td>
							<input type="text" name="nongu_mname" size=20px maxlength="30">
						</td>
					</tr>

					<tr>
						<td>
							Last Name:
						</td>

						<td>
							<input type="text" name="nongu_lname" size=20px maxlength="40">
						</td>
					</tr>

					<tr class="divided"></tr>

					<tr>
						<th>Contact Information</th>
					</tr>

					<tr>
						<td>Institution</td>

						<td>
							<input type="text" name="nongu_institution" size=20px maxlength="50">
						</td>
					</tr>

					<tr>
						<td>City</td>

						<td>
							<input type="text" name="nongu_city" size="20px" maxlength="50">
						</td>
					</tr>

					<tr>
						<td>Country</td>

						<td>
							<select name="nongu_country" class="nongu_select">
									<option value="" selected="selected">Select
										Country</option>
							<?php
							//Get data from text file
							if ($filec = @fopen ( '..\dropdownfile\country.txt', 'r' )) {
								while ( ($linec = fgets ( $filec )) != false ) {
									echo '<option>' . $linec . '</option>';
								}
								fclose ( $file );
							}
							?>
								</select>
						</td>
					</tr>

					<tr>
						<td>Email</td>

						<td>
							<input type="text" name="nongu_email" size="20px" maxlength="50">
						</td>
					</tr>
				</table>

				<br>
					<input type="submit" name="nongu_add" value="Add">
			</form>
		</div>

		<div id="coad_partner_form">
			<h2>COAD Partner Personnel</h2>
			<form method="post" action="insertpersonnel.php">
				<table class="nongu_partner_form_table">
					<tr>
						<th>Teacher Name</th>
					</tr>

					<tr>
						<td>
							First Name:
						</td>

						<td>
							<input type="text" name="coad_fname" size=20px maxlength="30">
						</td>
					</tr>

					<tr>
						<td>
							Middle Name:
						</td>

						<td>
							<input type="text" name="coad_mname" size=20px maxlength="30">
						</td>
					</tr>

					<tr>
						<td>
							Last Name:
						</td>

						<td>
							<input type="text" name="coad_lname" size=20px maxlength="40">
						</td>
					</tr>

					<tr class="divided"></tr>

					<tr>
						<th>Contact Information</th>
					</tr>

					<tr>
						<td>Institution</td>

						<td>
							<input type="text" name="coad_institution" size=20px maxlength="50">
						</td>
					</tr>

					<tr>
						<td>City</td>

						<td>
							<input type="text" name="coad_city" size="20px" maxlength="50">
						</td>
					</tr>

					<tr>
						<td>Country</td>

						<td>
							<select name="coad_country" class="coad_select">
									<option value="" selected="selected">Select
										Country</option>
							<?php
							//Get data from text file
							if ($filec = @fopen ( '..\dropdownfile\country.txt', 'r' )) {
								while ( ($linec = fgets ( $filec )) != false ) {
									echo '<option>' . $linec . '</option>';
								}
								fclose ( $file );
							}
							?>
								</select>
						</td>
					</tr>

					<tr>
						<td>Email</td>

						<td>
							<input type="text" name="coad_email" size="20px" maxlength="50"> 
						</td>
					</tr>
				</table>

				<br>
					<input type="submit" name="coad_add" value="Add">
			</form>
		</div>
	</section>

    <footer>
		<br>
			Copyright@ , maintained by Jiabin (Jeremy) Wang
	</footer>	
</body>
</html>