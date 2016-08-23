<?php
	include('session_check.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>GPE Award Search</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../CSS/displayaward.css">
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/showaward.js"></script>
</head>
<body>
	<header>
		<h3>Academic Affairs</h3>
		<h1>Global Academic Initiatives</h1>
	</header>

	<section>
		<form action="displayaward.php" method="post">
			<h1>GPE Award Search</h1>
			<div id="search_condition">
				<h2>Search Option:</h2>
				<h3>Tips: Only one option can be choose at the same time!</h3>
				<table class="condition_table">

					<tr>
						<td>Year:</td>
						<td>General Award</td>
						<td>Other Award</td>

					</tr>

					<tr>

						<td>
							<select>
								<option value="" selected="selected">Conference Year</option>
								<?php  
									$sql = "select distinct year from awardmanage order by year DESC";
									$result = mysqli_query ($mysqlconn, $sql);
									while ($line = mysqli_fetch_array($result)) {
										echo "<option>" . $line['year'] . "</option>";
									}
								?>
							</select>
						</td>

						<td>
							<select>
								<option value="" selected="selected">General Award</option>
								<option>Institution</option>
								<option>Teacher</option>
								<option>Tech</option>
							</select>
						</td>

						<td>
							<select>
								<option value="" selected="selected">Other Award</option>
								<?php  
									$sql = "select distinct name from awardmanage where not name = 'Institution'
											and not name = 'Teacher'
											and not name = 'Tech'";
									$result = mysqli_query ($mysqlconn, $sql);
									while ($line = mysqli_fetch_array($result)) {
										echo "<option>" . $line['name'] . "</option>";
									}
								?>
							</select>
						</td>
					</tr>

					<tr class="divided"></tr>

					<tr>
						<td>Partner:</td>
						<td>Teacher Awardee</td>
						<td>Tech Awardee</td>
					</tr>

					<tr>

						<td>
							<select>
								<option value="" selected="selected">Partner</option>
								<?php
									$partner_list = array();  
									$sql = "select distinct awardee from instituteaward order by awardee";
									$result = mysqli_query ($mysqlconn, $sql);
									while ($line = mysqli_fetch_array($result)) {
										if (!in_array($line['awardee'], $partner_list))
											array_push($partner_list, $line['awardee']);
									}

									$sql = "select distinct institution from teacheraward order by institution";
									$result = mysqli_query ($mysqlconn, $sql);
									while ($line = mysqli_fetch_array($result)) {
										if (!in_array($line['institution'], $partner_list))
											array_push($partner_list, $line['institution']);
									}

									$sql = "select distinct institution from techaward order by institution";
									$result = mysqli_query ($mysqlconn, $sql);
									while ($line = mysqli_fetch_array($result)) {
										if (!in_array($line['institution'], $partner_list))
											array_push($partner_list, $line['institution']);
									}

									$sql = "select distinct institution from otheraward order by institution";
									$result = mysqli_query ($mysqlconn, $sql);
									while ($line = mysqli_fetch_array($result)) {
										if (!in_array($line['institution'], $partner_list))
											array_push($partner_list, $line['institution']);
									}

									asort($partner_list);
									foreach ($partner_list as $value) {
										echo "<option>" . $value . "</option>";
									}
								?>

							</select>
						</td>

						<td>
							<select>
								<option value="" selected="selected">Teacher Name</option>
									<?php  
										$sql = "select distinct name from teacheraward";
										$result = mysqli_query ($mysqlconn, $sql);
										while ($line = mysqli_fetch_array($result)) {
											echo "<option>" . $line['name'] . "</option>";
										}
									?>
							</select>
						</td>

						<td>
							<select>
								<option value="" selected="selected">Tech Name</option>
									<?php  
										$sql = "select distinct name from techaward";
										$result = mysqli_query ($mysqlconn, $sql);
										while ($line = mysqli_fetch_array($result)) {
											echo "<option>" . $line['name'] . "</option>";
										}
									?>
							</select>
						</td>
					</tr>
				</table>

				<br>
					<input type="button" id="search_by_option" value="Search By Option">
					<input type="button" id="search_all" value="Search All">
				<br>
					<input type="button" id="reset" value="Reset Search Options">
					<input type="button" id="back" value="Back to Menu">
			</div>

			<div id="search_result">
				<h1>GPE Award Search Result</h1>

				<br>
				<div id="search_result_more"></div>
			</div>

			<div id="show_detail"></div>
		</form>
	</section>

	<footer>
		<br>
			Copyright@ Global Academic Initiatives, maintained by Jiabin (Jeremy) Wang
	</footer>
</body>
</html>