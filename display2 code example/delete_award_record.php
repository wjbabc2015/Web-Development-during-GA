<?php
	include('session_check.php');
?>

<?php
$logo = $_GET['logo'];


	if ($logo == "all") {
		$year = $_GET['year'];
		$tag = $_GET['tag'];
		$host = $_GET['host'];

		$mysql_pre_statement = "select id, name from awardmanage where year='" . $year . "' and gpetag='" . $tag . "' and gpehost ='" . $host . "'";

		$pre_result = mysqli_query ($mysqlconn, $mysql_pre_statement);

		while ($row = mysqli_fetch_array($pre_result)) {
			
			if ($row['name'] == "Institution") {
				$mysql_delete = "delete from instituteaward where id='" . $row['id'] . "'";
			}else if ($row['name'] == "Teacher"){
				$mysql_delete = "delete from teacheraward where id='" . $row['id'] . "'";
			}else if ($row['name'] == "Tech"){
				$mysql_delete = "delete from techaward where id='" . $row['id'] . "'";
			}else {
				$mysql_delete = "delete from otheraward where id='" . $row['id'] . "'";
			}

			$sub_result = mysqli_query ($mysqlconn, $mysql_delete);
		}

		$mysql_statement = "DELETE FROM awardmanage WHERE year='" . $year . "' and gpetag='" . $tag . "' and gpehost ='" . $host . "'";

		$result = mysqli_query($mysqlconn, $mysql_statement);

		if ($delete_result){
			echo '<script type = "text/javascript">alert("Successfully Delete a GPE Conference Record!");
												window.location = "../PHP/displayaward.php";
												</script>';
		}else {
			$error = mysqli_sqlstate($mysqlconn);
			echo '<script type = "text/javascript">alert("Delete Query Failed!'.$error.'");</script>';
		}

		mysqli_close($mysqlconn);
	}

	if ($logo == "institution"){
		$id = $_GET['id'];
		$name = $_GET['name'];

		$mysql_statement = "DELETE FROM instituteaward WHERE id='" . $id . "' and awardee ='" . $name . "'";

		$delete_result = mysqli_query ($mysqlconn, $mysql_statement);

		if ($delete_result){
			echo '<script type = "text/javascript">alert("Successfully Delete a Institution Record!");
												window.location = "../PHP/displayaward.php";
												</script>';
		}else {
			$error = mysqli_sqlstate($mysqlconn);
			echo '<script type = "text/javascript">alert("Delete Query Failed!'.$error.'");</script>';
		}

		mysqli_close($mysqlconn);
	}

	if ($logo == "teacher") {

		$id = $_GET['id'];
		$name = $_GET['name'];

		$mysql_statement = "DELETE FROM teacheraward WHERE id='" . $id . "' and name ='" . $name . "'";

		$delete_result = mysqli_query ($mysqlconn, $mysql_statement);

		if ($delete_result){
			echo '<script type = "text/javascript">alert("Successfully Delete a Teacher Record!");
												window.location = "../PHP/displayaward.php";
												</script>';
		}else {
			$error = mysqli_sqlstate($mysqlconn);
			echo '<script type = "text/javascript">alert("Delete Query Failed!'.$error.'");</script>';
		}

		mysqli_close($mysqlconn);
	}

	if ($logo == "tech") {

		$id = $_GET['id'];
		$name = $_GET['name'];

		$mysql_statement = "DELETE FROM techaward WHERE id='" . $id . "' and name ='" . $name . "'";

		$delete_result = mysqli_query ($mysqlconn, $mysql_statement);

		if ($delete_result){
			echo '<script type = "text/javascript">alert("Successfully Delete a Tech Record!");
												window.location = "../PHP/displayaward.php";
												</script>';
		}else {
			$error = mysqli_sqlstate($mysqlconn);
			echo '<script type = "text/javascript">alert("Delete Query Failed!'.$error.'");</script>';
		}

		mysqli_close($mysqlconn);
	}

	if ($logo == "project") {

		$id = $_GET['id'];
		$name = $_GET['name'];

		$mysql_statement = "DELETE FROM otheraward WHERE id='" . $id . "' and project ='" . $name . "'";

		$delete_result = mysqli_query ($mysqlconn, $mysql_statement);

		if ($delete_result){
			echo '<script type = "text/javascript">alert("Successfully Delete a Project Record in Other Award!");
												window.location = "../PHP/displayaward.php";
												</script>';
		}else {
			$error = mysqli_sqlstate($mysqlconn);
			echo '<script type = "text/javascript">alert("Delete Query Failed!'.$error.'");</script>';
		}

		mysqli_close($mysqlconn);
	}

	if ($logo == "person") {

		$id = $_GET['id'];
		$name = $_GET['name'];

		$mysql_statement = "DELETE FROM otheraward WHERE id='" . $id . "' and name ='" . $name . "'";

		$delete_result = mysqli_query ($mysqlconn, $mysql_statement);

		if ($delete_result){
			echo '<script type = "text/javascript">alert("Successfully Delete a Personnel Record in Other Award!");
												window.location = "../PHP/displayaward.php";
												</script>';
		}else {
			$error = mysqli_sqlstate($mysqlconn);
			echo '<script type = "text/javascript">alert("Delete Query Failed!'.$error.'");</script>';
		}

		mysqli_close($mysqlconn);
	}

?>