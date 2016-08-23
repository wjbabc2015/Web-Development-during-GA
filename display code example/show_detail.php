<?php
	include('session_check.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
</head>
<body>

<?php


if ($_GET){

	if ($_GET['s']){
		$s = $_GET['s'];
//echo $_GET['s'];

		$sql="SELECT * FROM partner WHERE sname = '".$s."'";
		$result = mysqli_query($mysqlconn,$sql);
		
		while($row = mysqli_fetch_array($result)) {
		
			$timezone = $row['timezone'];
		
			if ($timezone > 0 ){
				$timezone = "+".$timezone;
			}
		
			echo "<p class='form_head'>Detail Information</p>";
			echo "<table class='itable'>";
			echo "<tr><td>Partner Name: </td><td>"  . $row['sname'] . "</td></tr>";
			echo "<tr><td>Full Name: </td><td>" . $row['fname'] . "</td></tr>";
			echo "<tr><td>Address: </td><td>" . $row['addr1'] . " " . $row['addr2'] . "</td></tr>";
			echo "<tr><td>State or Relgion: </td><td>" . $row['state'] . "</td></tr>";
			echo "<tr><td>Country: </td><td>" . $row['country'] . "</td></tr>";
			echo "<tr><td>Continent: </td><td>" . $row['continent'] . "</td></tr>";
			echo "<tr><td>Time Zone: </td><td>" . $timezone . $row['timezoneext'] . "</td></tr>";
			echo "<tr><td>Join Time: </td><td>" . $row['year'] . " " . $row['semester'] . "</td></tr>";
			echo "<tr><td>Official Web: </td><td>" . $row['website'] . "</td></tr>";
			echo "</table>";
			echo "<a class='info_button'><input type=button value=Close onclick=backButton()>
					<input type=button value=Update onclick=updateButton('".$s."')>
					<input type=button value=Delete onclick=deleteButton('".$s."')></a>";
		}
		mysqli_close($mysqlconn);
	}
	
	if ($_GET['f']){
		$f = $_GET['f'];
//echo $_GET['f'];
		$sql="SELECT * FROM ppersonnel WHERE ID = '".$f."'";
		$result = mysqli_query($mysqlconn,$sql);
		
		while($row = mysqli_fetch_array($result)) {
			
			$admin = $row ['radmin'];
			$padmin = $row['rpadmin'];
			$coord = $row ['rcoord'];
			$teacher = $row ['rteacher'];
			$tech = $row ['rtech'];
			
			$radp = $row ['radminp'];
			$rpadp = $row ['rpadminp'];
			
			if ($admin == 1) {
				if ($teacher == 1 || $coord == 1 || $tech == 1 || $padmin == 1) {
					$role1 = "".$radp."/";
				} else {
					$role1 = $radp;
				}
			} else {
				$role1 = "";
			}
				
			if ($padmin == 1) {
				if ($teacher == 1 || $coord == 1 || $tech == 1 ){
					$role2 = "".$rpadp."/";
				}else {
					$role2 = "".$rpadp;
				}
			} else {
				$role2 = "";
			}
				
			if ($coord == 1) {
				if ($teacher == 1 || $tech == 1) {
					$role3 = "Coord/";
				} else {
					$role3 = "Coord";
				}
			} else {
				$role3 = "";
			}
				
			if ($teacher == 1 && $tech == 1) {
				$role4 = "Prof/";
			} else if ($teacher == 1) {
				$role4 = "Prof";
			} else {
				$role4 = "";
			}
				
			if ($tech == 1) {
				$role5 = "Tech";
			} else {
				$role5 = "";
			}
				
			$role = $role1 . $role2 . $role3 . $role4 . $role5;
		
			echo "<p class='form_head'>Detail Information</p>";
			echo "<table class='itable'>";
			echo "<tr><td>Short Name: </td><td>"  . $row['sname'] . "</td></tr>";
			echo "<tr><td>Personnel Name: </td><td>" . $row['fname'] . " ". $row['mname']. " " . $row['lname'] ."</td></tr>";
			echo "<tr><td>Official Email: </td><td>" . $row['eaddr1'] . "</td></tr>";
			echo "<tr><td>Optional Email: </td><td>" . $row['eaddr2'] . "</td></tr>";
			echo "<tr><td>Optional Email: </td><td>" . $row['eaddr3'] . "</td></tr>";
			echo "<tr><td>Office Number: </td><td>" . $row['office'] . "</td></tr>";
			echo "<tr><td>Phone Number: </td><td>" . $row['mobile'] . "</td></tr>";
			echo "<tr><td>Fax: </td><td>" . $row['fax'] . "</td></tr>";
			echo "<tr><td>Skype ID: </td><td>" . $row['skype'] . "</td></tr>";
			echo "<tr><td>Role: </td><td>" . $role . "</td></tr>";
			echo "<tr><td>Authorization: </td><td>" . $row['tag'] . "</td></tr>";
			echo "<tr><td>Involved in: </td><td>". $row['guclass']."</td></tr>";
			echo "<tr><td>Program: </td><td>" . $row['program'] . "</td></tr>";
			echo "<tr><td>Interests-Discipline(s): </td><td>" . $row['interest1'] . "</td></tr>";
			echo "<tr><td>Interests-Fields of Study/Research: </td><td>" . $row['interest2'] . "</td></tr>";
			echo "</table>";
			echo "<a class='info_button'><input type=button value=Close onclick=backButton()>
					<input type=button value=Update onclick=updateButton('".$f."')>
					<input type=button value=Delete onclick=deleteButton('".$f."')></a>";
		}
		mysqli_close($mysqlconn);
	}
}

?>

</body>
</html>