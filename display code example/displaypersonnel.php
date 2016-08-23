<?php
	include('session_check.php');
?>
<!DOCTYPE HTML>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../CSS/display.css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/showpersonnel.js"></script>
<script type="text/javascript" src="../js/personneloperation.js"></script>
<title>Search Information</title>
</head>

<body>
<?php
// Connect to database


// Initiate search condition variable
$shortname_condition = $country_condition = "";
$sname_dis = $country_dis = false;

if ($_POST && $_POST ['back']){
	header ( 'Location: index_eadmin.php' );
}

$total = 0;
$mysql_count_statement = "select count(*) as total from ppersonnel";

$count_result = mysqli_query($mysqlconn, $mysql_count_statement);

?>

<header>
		<h3>Academic Affairs</h3>
		<h1>Global Academic Initiatives</h1>
</header>

<section>
	<h1>Search Partner Personnel</h1>
		<div id='header'>
			<h3>Please select "Search by University" or "Search by Country", then press Search button.</h3>
			<h3>If no search criteria is selected, all records will be displayed. </h3>
			<h3>You may narrow down your selection by selecting the roles.</h3>
			<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
				method="POST">
				<table class='htable'>
					<tr>
						<td>Search by University</td>
						<td>Search by Country</td>
					</tr>
					<tr>
						<td><select name="shortname">
								<option value="" selected="selected">Select a Univ.</option>
							<?php
							$mysql_statement = "select sname from partner";
							$result = mysqli_query ( $mysqlconn, $mysql_statement );
							
							while ( $line = mysqli_fetch_array ( $result ) ) {
								echo '<option>' . $line ['sname'] . '</option>';
							}
							?>
						</select></td>
						<td><select name="country">
								<option value="" selected="selected">Select a Country</option>
							<?php
							$mysql_statement = "select country from partner order by country";
							$result = mysqli_query ( $mysqlconn, $mysql_statement );
							$compare = "";
							
							while ( $line = mysqli_fetch_array ( $result ) ) {
								if ($line ['country'] != $compare) {
									echo '<option>' . $line ['country'] . "</option>";
									$compare = $line ['country'];
								}
							}
							?>
						</select></td>
					</tr>
				</table>
				<p>Please select roles(You can select multiple roles):</p>
				<table class='htable'>
					<tr>
						<td width="25%">Univ. Admin <input type="checkbox" name="radmin"
							value="1"></td>
						<td width="25%">Program Admin <input type="checkbox" name="rpadmin"
							value="1"></td>
					</tr><tr>
						<td width="25%">Coordinator <input type="checkbox"
							name="rcoordinator" value="1"></td>
						<td width="25%">Teacher <input type="checkbox" name="rteacher"
							value="1"></td>
						<td width="25%">Technical Support <input type="checkbox" name="rtech"
							value="1"></td>
					</tr>
					<tr height="60">
						<td><input type="submit" name="search" value="Search"> <input
							type="submit" name="back" value="Return to Menu"></td>
					</tr>
				</table>
			</form>

		</div>

		<h1>Partner Personnel List</h1>
		
		<div id ='result'>
			
			<fieldset>
				<table class='dtable'>
					<tr>
						<td width="15%">Personnel</td>
						<td width="21%">University</td>
						<td width="21%">Email Address</td>
						<td width="11%">Role(s)</td>
						<td width="16%">Involve</td>
						<td width="11%">Academic Interests</td>
						<td width="5%">Detail Info</td>
					</tr>
	<?php
	include "partner_dis_help.php";
	$searchHelp = new displayResult();

	$count = 0;

	$admin_condition = 0;
	$padmin_condition = 0;
	$coord_condition = 0;
	$teacher_condition = 0;
	$tech_condition = 0;

	if ($_SERVER ["REQUEST_METHOD"] == "POST" && $_POST ['search']) {
		
		while ($number = mysqli_fetch_array($count_result)){
			$total = $number['total'];
		}
		
		//Initialize role variable
		if ($_POST ['radmin'] )
			$admin_condition = 1;
		
		if ($_POST ['rcoordinator'] )
			$coord_condition = 1;
		
		if ($_POST ['rteacher'])
			$teacher_condition = 1;
		
		if ($_POST ['rtech'])
			$tech_condition = 1;
		
		if ($_POST['rpadmin'])
			$padmin_condition = 1;

	//echo $admin_condition;
	//echo $padmin_condition;
	//echo $coord_condition;
	//echo $teacher_condition;
	//echo $tech_condition;
		
		$condition_array = array($admin_condition, $padmin_condition, $coord_condition, $teacher_condition, $tech_condition);
		
		if (!empty ( $_POST ['shortname'] )){
			$count = $searchHelp->searchPersonnel(1, "partner.sname", $_POST ['shortname'], $condition_array, $mysqlconn);
		}else if (!empty($_POST['country'])){
			$count = $searchHelp->searchPersonnel(1, "country", $_POST ['country'], $condition_array, $mysqlconn);
		}else {
			$count = $searchHelp->searchPersonnel(0, null, null, $condition_array, $mysqlconn);
		}
	}

	?>
	</table>
	</fieldset>
	<?php 
	echo "<br><h3 class='count'>Result: ".$count." out of total ".$total." Personnel</h3>";
	?>
	</div>


	<div id="information">
	</div>
</section>

<footer>
		<br>
			Copyright@ Global Academic Initiatives, maintained by Jiabin (Jeremy) Wang
</footer>
</body>
</html>