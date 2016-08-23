<?php
	include('session_check.php');
?>

<?php
$f = $_GET['index'];

$mysql_statement = "DELETE FROM table where ID='".$f."'";

$result = mysqli_query($mysqlconn, $mysql_statement);

if ($result){
	echo '<script type = "text/javascript">alert("Successfully Delete Personnel!");
										window.location = "../PHP/display.php";
										</script>';
	}else {
		//$error = mysqli_error($mysqlconn);
		$error = mysqli_sqlstate($mysqlconn);
		echo '<script type = "text/javascript">alert("Delete Query Failed!'.$error.'");</script>';
	}
	
mysqli_close($mysqlcon);
?>
