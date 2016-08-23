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
		$tag = $_GET['tag'];


		if ($tag == 'all') {

			$mysql_statement_1 = "select * from awardmanage order by year DESC, id";

			$statement_result_1 = mysqli_query ($mysqlconn, $mysql_statement_1);

			$year = $gpetag = $host = "";
			$other_award_content = "";

			echo "<table class='result_content_table'>";
			echo '<tr class="result_title_tr">';
			echo "<td width='1%'></td>";
			echo "<td width='19%'>Conference Info</td>";
			echo "<td width='15%'>Institution Award</td>";
			echo "<td width='20%'>Teacher Award</td>";
			echo "<td width='20%'>Tech Award</td>";
			echo "<td width='25%'>Other Award</td></tr>";

			while ($row = mysqli_fetch_array($statement_result_1)) {

				$award_id = $row['id'];
				$award_name = $row['name'];

				if ($row['year'] != $year || $row['gpetag'] != $gpetag || $row['gpehost'] != $host){

					if (!empty($year) || !empty($gpetag) || !empty($host)) {

						echo "<td class = 'other_award_content_element'>" . $other_award_content . "</td></tr>";
						$other_award_content = "";
					} 

					$year = $row['year'];
					$gpetag = $row['gpetag'];
					$host = $row['gpehost'];

					echo "<tr><td class = 'other_award_content_element_right'><input type=button value=Delete onclick=delete_record('" . $year . "','" . $gpetag . "','" . $host . "')></td>";

					echo "<td class = 'other_award_content_element_right'>" . $year . " (" . $gpetag . "--" . $host . ")</td>";
						
					$mysql_statement_2 = "select * from instituteaward where id ='" . $award_id . "'";

					$statement_result_2 = mysqli_query ($mysqlconn, $mysql_statement_2);

					echo "<td class='other_award_content_element_right'>";

					while ($line1 = mysqli_fetch_array ($statement_result_2)) {

						echo $line1['awardee'] . ", " . $line1['country'] . "<br/>";
					}

					echo "</td>";

				} else {


					if ($award_name == 'Teacher') {
						
						$mysql_statement_3 = "select * from teacheraward where id ='" . $award_id . "'";

						$statement_result_3 = mysqli_query ($mysqlconn, $mysql_statement_3);

						echo "<td class='other_award_content_element_right'>";

						while ($line2 = mysqli_fetch_array ($statement_result_3)) {

							echo $line2['name'] . "<br/>(" . $line2['institution'] . ", " . $line2['country'] . ")<br/>";
						}

						echo "</td>";
					}else if ($award_name == 'Tech') {
						
						$mysql_statement_3 = "select * from techaward where id ='" . $award_id . "'";

						$statement_result_3 = mysqli_query ($mysqlconn, $mysql_statement_3);

						echo "<td class='other_award_content_element_right'>";

						while ($line2 = mysqli_fetch_array ($statement_result_3)) {

							echo $line2['name'] . "<br/>(" . $line2['institution'] . ", " . $line2['country'] . ")<br/>";
						}

						echo "</td>";
					}else {
						
						$mysql_statement_3 = "select * from otheraward where id ='" . $award_id . "'";

						$statement_result_3 = mysqli_query ($mysqlconn, $mysql_statement_3);

						$other_award_temp = "";
						$other_award_project = "";


						while ($line2 = mysqli_fetch_array ($statement_result_3)) {

							if ($line2['project'] != $other_award_project) {

								$other_award_project = $line2['project'];

								$other_award_temp = $other_award_temp . 
									$award_name . ': ' . $other_award_project . 
									'<input type="button" value="detail" onclick="show_detail(\'' . $award_id . '\',\'' . $other_award_project . '\')"><br/>';
							}
						}

						$other_award_content = $other_award_content . $other_award_temp;
					}
				}
			}
						echo '<td>' . $other_award_content . '</td></tr>';
						echo "</table>";
		}

		if ($tag == 'year'){
			$conference_year = $_GET['condition'];

			$mysql_pre_statement = "select * from awardmanage where year = '" . $conference_year . "' order by id";

			$pre_result = mysqli_query ($mysqlconn, $mysql_pre_statement);

			$tag = $host = "";

			echo "<table class='result_condition1_table'>";

			while ($pre_row = mysqli_fetch_array($pre_result)) {
				
				if ($pre_row['gpetag'] != $tag && $pre_row['gpehost'] != $host){

					$tag = $pre_row['gpetag'];
					$host = $pre_row['gpehost'];

					echo "<tr><td>" . $conference_year . " (" . $tag . " -- " . $host . ")</td></tr>";

					echo "<tr class='divided'></tr>";
				}

				if ($pre_row['name'] == 'Institution'){

					echo "<tr class='result_condition1_table_tr'><td>Institution Award</td><td></td></tr>";

					$mysql_statement = "select * from instituteaward where id ='" . $pre_row['id'] . "'";

					$search_result = mysqli_query($mysqlconn, $mysql_statement);

					while ($row = mysqli_fetch_array($search_result)) {
						echo "<tr><td>" . $row['awardee'] . "</td><td>" . $row['country'] . "</td></tr>";
					}

					echo "<tr class='divided'></tr>";

				}else if ($pre_row['name'] == 'Teacher') {
					
					echo "<tr class='result_condition1_table_tr'><td>Teacher Award</td><td></td></tr>";

					$mysql_statement = "select * from teacheraward where id ='" . $pre_row['id'] . "'";

					$search_result = mysqli_query($mysqlconn, $mysql_statement);

					while ($row = mysqli_fetch_array($search_result)) {
						echo "<tr><td>" . $row['name'] . "</td><td>" . $row['institution'] . ", " . $row['country'] . "</td></tr>";
					}

					echo "<tr class='divided'></tr>";

				}else if ($pre_row['name'] == 'Tech') {

					echo "<tr class='result_condition1_table_tr'><td>Tech Award</td><td></td></tr>";

					$mysql_statement = "select * from techaward where id ='" . $pre_row['id'] . "'";

					$search_result = mysqli_query($mysqlconn, $mysql_statement);

					while ($row = mysqli_fetch_array($search_result)) {
						echo "<tr><td>" . $row['name'] . "</td><td>" . $row['institution'] . ", " . $row['country'] . "</td></tr>";
					}

					echo "<tr class='divided'></tr>";

				}else {

					echo "<tr class='result_condition1_table_tr'><td>" . $pre_row['name'] . " Award</td><td></td></tr>";

					$mysql_statement = "select * from otheraward where id ='" . $pre_row['id'] . "'";

					$search_result = mysqli_query($mysqlconn, $mysql_statement);

					while ($row = mysqli_fetch_array($search_result)) {
						echo "<tr><td>Project: " . $row['project'] . "</td><td>" . $row['name'] . " (" . $row['institution'] . ", " . $row['country'] . ")</td></tr>";
					}

					echo "<tr class='divided'></tr>";
				}
			}

			echo "</table>";
		}

		if ($tag == 'general') {
			$general_award = $_GET['condition'];

			$tag = $host = $year = "";

			switch ($general_award) {
				case 'Institution':
					$mysql_statement = "select year, gpetag, gpehost, awardee, country, a2.id as delete_id from awardmanage as a1 join instituteaward as a2 on a1.id = a2.id order by year DESC";
					break;

				case 'Teacher':
					$mysql_statement = "select year, gpetag, gpehost, a2.name as pname, institution, country from awardmanage as a1 join teacheraward as a2 on a1.id = a2.id order by year DESC";
					break;

				case 'Tech':
					$mysql_statement = "select year, gpetag, gpehost, a2.name as pname, institution, country from awardmanage as a1 join techaward as a2 on a1.id = a2.id order by year DESC";
					break;
				
				default:
					# code...
					break;
			}

			echo "<table class='result_condition1_table'>";
			echo "<tr class='result_condition1_table_tr'><td>" . $general_award . " Award</td></tr>";
			echo "<tr class='result_condition1_table_tr'><td>Conference Infomation</td><td>Award Information</td></tr>";

			$mysql_result = mysqli_query ($mysqlconn, $mysql_statement);

			if ($general_award == "Institution"){

				while ($row = mysqli_fetch_array($mysql_result)) {
					$delete_id = $row['delete_id'];

					echo "<tr><td>" . $row['year'] . " (" . $row['gpetag'] . " -- " . $row['gpehost'] . ")</td><td>" . $row['awardee'] . ", " . $row['country'];
					echo '<input type="button" value="delete" onclick="delete_institution(\'' . $delete_id . '\',\'' . $row['awardee'] . '\')"></td></tr>';
				}
			}else {

				while ($row = mysqli_fetch_array($mysql_result)) {

					if ($row['year'] != $year || $row['gpetag'] != $tag || $row['gpehost'] != $host){

						if (!empty($tag) || !empty($year) || !empty($host)) {
							echo "</td></tr><tr class='divided'></tr>";
						}

						$year = $row['year'];
						$tag = $row['gpetag'];
						$host = $row['gpehost'];
						$end_tag = true;

						echo "<tr><td>" . $row['year'] . " (" . $row['gpetag'] . " -- " . $row['gpehost'] . ")</td>
						<td>" . $row['pname'] . " (" . $row['institution'] . ", " . $row['country'] . ")<br/>";
					}else {
						echo $row['pname'] . " (" . $row['institution'] . ", " . $row['country'] . ")<br/>";
					}
				}

				echo "</td></tr></table>";
			}
		}

		if ($tag == 'other') {
			$other_award = $_GET['condition'];

			$tag = $host = $year = $project = "";

			$mysql_statement = "select a2.id as award_id, year, gpetag, gpehost, project, a2.name as pname, institution, country from awardmanage as a1 join otheraward as a2 on a1.id = a2.id where a1.name ='" . $other_award . "' order by year DESC";

			echo "<table class='result_condition1_table'>";
			echo "<tr class='result_condition1_table_tr'><td>" . $other_award . " Award</td></tr>";
			echo "<tr class='result_condition1_table_tr'><td>Conference Infomation</td><td>Award Information</td></tr>";

			$mysql_result = mysqli_query ($mysqlconn, $mysql_statement);

			while ($row = mysqli_fetch_array($mysql_result)) {

				$pname = $row['pname'];
				$institution = $row['institution'];
				$country = $row['country'];

				if ($row['year'] != $year || $row['gpetag'] != $tag || $row['gpehost'] != $host || $row['project'] != $project){

					if (!empty($tag) || !empty($year) || !empty($host)) {
						echo "</td></tr><tr class='divided'></tr>";
					}

					$year = $row['year'];
					$tag = $row['gpetag'];
					$host = $row['gpehost'];
					$project = $row['project'];
					$award_id = $row['award_id'];

					echo '<tr><td>' . $year . ' (' . $tag . ' -- ' . $host . ')</td><td>' . $project . ' (project): <input type="button" value="Delete Project" onclick="delete_project(\'' . $award_id . '\',\'' . $project . '\')"><br/>' . $pname . ' (' . $institution . ', ' . $country . ')<input type=button value=Delete onclick="delete_person(\'' . $award_id . '\',\'' . $pname . '\')"><br/>';
				}else {
					echo $pname . ' (' . $institution . ', ' . $country . ')<input type=button value=Delete onclick="delete_person(\'' . $award_id . '\',\'' . $pname . '\')"><br/>';
				}
			}

			echo "</td></tr></table>";

		}

		if ($tag == 'partner') {
			
			$condition_1 = $_GET['condition'];

			$mysql_pre_statement = "select country from partner where sname = '" . $condition_1 . "'";

			$pre_result = mysqli_query ($mysqlconn, $mysql_pre_statement);

			if ($pre_row = mysqli_fetch_array($pre_result)) {
				$condition_country = $pre_row['country'];
			}

			echo "<table class = 'result_condition1_table'>";
			echo "<tr><td>" . $condition_1 . ", " . $condition_country . "</td><td></td></tr>";
			echo "<tr class='divided'></tr>";
			echo "<tr class='result_condition1_table_tr'><td>Conference Information</td><td>Award Information</td></tr>";
			echo "<tr class='divided'></tr>";

			$mysql_institution_search_pre = "select id from instituteaward where awardee ='" . $condition_1 . "'";

			$mysql_institution_pre_result = mysqli_query ($mysqlconn, $mysql_institution_search_pre);

			if (mysqli_num_rows($mysql_institution_pre_result) != 0) {
				
				echo "<tr class='result_condition1_table_tr'><td>Institution Award</td><td></td></tr>";

				while ($row_ins = mysqli_fetch_array($mysql_institution_pre_result)) {
					
					$mysql_institution_search = "select year, gpetag, gpehost from awardmanage where id = '" . $row_ins['id'] . "' order by year DESC";

					$mysql_institution_search_result =mysqli_query ($mysqlconn, $mysql_institution_search);

					while ($line_ins = mysqli_fetch_array($mysql_institution_search_result)) {
						echo "<tr><td>" . $line_ins['year'] . "</td><td>" . $line_ins['gpetag'] . "--" . $line_ins['gpehost'] . "</td></tr>";
					}
				}
			}

			echo "<tr class='divided'></tr>";

			$mysql_teacher_search_pre = "select * from teacheraward where institution ='" . $condition_1 . "'";

			$mysql_teacher_pre_result = mysqli_query ($mysqlconn, $mysql_teacher_search_pre);

			if (mysqli_num_rows($mysql_teacher_pre_result) != 0) {
				
				echo "<tr class='result_condition1_table_tr'><td>Teacher Award</td><td></td></tr>";

				while ($row_tea = mysqli_fetch_array($mysql_teacher_pre_result)) {
					
					$mysql_teacher_search = "select year, gpetag, gpehost from awardmanage where id = '" . $row_tea['id'] . "' order by year DESC";

					$mysql_teacher_search_result =mysqli_query ($mysqlconn, $mysql_teacher_search);

					while ($line_tea = mysqli_fetch_array($mysql_teacher_search_result)) {
						echo "<tr><td>" . $line_tea['year'] . " (" . $line_tea['gpetag'] . "--" . $line_tea['gpehost'] .")</td><td>" . $row_tea['name'] . ", " . $row_tea['country'] . "</td></tr>";
					}
				}
			}

			echo "<tr class='divided'></tr>";

			$mysql_tech_search_pre = "select * from techaward where institution ='" . $condition_1 . "'";

			$mysql_tech_pre_result = mysqli_query ($mysqlconn, $mysql_tech_search_pre);

			if (mysqli_num_rows($mysql_tech_pre_result) != 0) {
				
				echo "<tr class='result_condition1_table_tr'><td>Tech Award</td><td></td></tr>";

				while ($row_tec = mysqli_fetch_array($mysql_tech_pre_result)) {
					
					$mysql_tech_search = "select year, gpetag, gpehost from awardmanage where id = '" . $row_tec['id'] . "' order by year DESC";

					$mysql_tech_search_result =mysqli_query ($mysqlconn, $mysql_tech_search);

					while ($line_tec = mysqli_fetch_array($mysql_tech_search_result)) {
						echo "<tr><td>" . $line_tec['year'] . " (" . $line_tec['gpetag'] . "--" . $line_tec['gpehost'] .")</td><td>" . $row_tec['name'] . ", " . $row_tec['country'] . "</td></tr>";
					}
				}
			}

			echo "<tr class='divided'></tr>";

			$mysql_other_search_pre = "select id, project from otheraward where institution ='" . $condition_1 . "'";

			$mysql_other_pre_result = mysqli_query ($mysqlconn, $mysql_other_search_pre);

			if (mysqli_num_rows($mysql_other_pre_result) > 0) {
				
				echo "<tr class='result_condition1_table_tr'><td>Other Award</td><td></td></tr>";

				while ($row_oth = mysqli_fetch_array($mysql_other_pre_result)) {
					
					$mysql_other_search = "select year, gpetag, gpehost, name from awardmanage where id = '" . $row_oth['id'] . "' order by year DESC";

					$mysql_other_search_result =mysqli_query ($mysqlconn, $mysql_other_search);

					while ($line_oth = mysqli_fetch_array($mysql_other_search_result)) {
						echo '<tr><td>' . $line_oth['year'] . ' (' . $line_oth['gpetag'] . '--' . $line_oth['gpehost'] . ')</td><td>' . $line_oth['name'] . ': ' . $row_oth['project'] . '<input type="button" value="detail" onclick="show_detail(\'' . $row_oth['id'] . '\',\'' . $row_oth['project'] . '\')"></td></tr>';
					}
				}
			}

			echo "</table>";
		}

		if ($tag == 'teacher') {

			$teacher_name = $_GET['condition'];

			$institution = $country = "";

			$mysql_statement = "select institution, country, year, gpehost, gpetag, a2.id as teacher_id from awardmanage as a1 join teacheraward as a2 on a1.id = a2.id where a2.name = '" . $teacher_name . "' order by year DESC";

			$search_result = mysqli_query ($mysqlconn, $mysql_statement);

			echo "<table class = 'result_condition1_table'>";
			echo "<tr class='result_condition1_table_tr'><td>Teacher Award</td><td></td></tr>";
			echo "<tr class='divided'></tr>";

			while ($row = mysqli_fetch_array($search_result)){

				$id = $row['teacher_id'];

				if (empty($institution) && empty($country)){

					$institution = $row['institution'];
					$country = $row['country'];

					echo "<tr class='result_condition1_table_tr'><td>" . $teacher_name . "</td><td>" . $institution .  ", " . $country . "</td></tr>";
					echo "<tr class='divided'></tr>";
					echo "<tr class='result_condition1_table_tr'><td></td><td>Award Information</td></tr>";
					echo "<tr class='divided'></tr>";
				}

				echo "<tr><td></td><td>" . $row['year'] . " (" . $row['gpetag'] . " -- " . $row['gpehost'] . ")";
				echo '<input type=button value=Delete onclick="delete_teacher(\'' . $id . '\',\'' . $teacher_name . '\')"></td></tr>';	
			}

			echo "</table>";		
		}

		if ($tag == 'tech') {

			$tech_name = $_GET['condition'];

			$institution = $country = "";

			$mysql_statement = "select institution, country, year, gpehost, gpetag, a2.id as tech_id from awardmanage as a1 join techaward as a2 on a1.id = a2.id where a2.name = '" . $tech_name . "' order by year DESC";

			$search_result = mysqli_query ($mysqlconn, $mysql_statement);

			echo "<table class = 'result_condition1_table'>";
			echo "<tr class='result_condition1_table_tr'><td>Tech Award</td><td></td></tr>";
			echo "<tr class='divided'></tr>";

			while ($row = mysqli_fetch_array($search_result)){

				$id = $row['tech_id'];

				if (empty($institution) && empty($country)){

					$institution = $row['institution'];
					$country = $row['country'];

					echo "<tr class='result_condition1_table_tr'><td>" . $tech_name . "</td><td>" . $institution .  ", " . $country . "</td></tr>";
					echo "<tr class='divided'></tr>";
					echo "<tr class='result_condition1_table_tr'><td></td><td>Award Information</td></tr>";
					echo "<tr class='divided'></tr>";
				}

				echo "<tr><td></td><td>" . $row['year'] . " (" . $row['gpetag'] . " -- " . $row['gpehost'] . ")";
				echo '<input type=button value=Delete onclick="delete_tech(\'' . $id . '\',\'' . $tech_name . '\')"></td></tr>';
			}

			echo "</table>";		
		}

		if ($tag == "detail"){
			$id = $_GET['id'];
			$project = $_GET['project'];

			$mysql_pre = "select * from awardmanage where id='" . $id . "'";

			$pre_result = mysqli_query ($mysqlconn, $mysql_pre);

			while ($row = mysqli_fetch_array($pre_result)){

				echo "<h2>" . $row['name'] . " Award</h2>";
				echo "<table class='detail_table'>";
				echo "<tr class='detail_table_tr'><td>" . $row['year'] . " (" . $row['gpetag'] . " -- " . $row['gpehost'] .")</td><td>Project: ". $project . "</td></tr>";
				echo "<tr class='divided'></tr>";
			}

			$mysql_statement = "select * from otheraward where id='" . $id . "' and project = '" . $project . "'";

			$result = mysqli_query($mysqlconn, $mysql_statement);

			while ($line = mysqli_fetch_array($result)) {
				echo "<tr><td>" . $line['name'] . "</td><td>" . $line['institution'] . ", " . $line['country'] . "</td></tr>";
			}

			echo "</table>";
			echo "<br><input type=button value=Close onclick=back_to_search()>";
		}

	?>
</body>
</html>
