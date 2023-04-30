<?php

function get_alert_html($error){
	return '<div class="alert alert-danger" role="alert">'. $error. '</div>';
}

function get_color_by_category($category){
	switch ($category) {
		case '1':
		$color = "LightGreen";
		break;
		case '2':
		$color = "Orange";
		break;
		case '3':
		$color = "LightCoral";
		break;
		default:
		$color = "LightBlue";
		break;
	}

	return $color;
}

function show_header($result){
	echo "<tr>";

		for ($i=0; $i < mysqli_num_fields($result); $i++) {
			$title = mysqli_fetch_field($result);
			$name = $title->name;
			echo "<th> $name </th>";
		}

	echo "</tr>";
}

function show_rows($result){
	while ($row = mysqli_fetch_row($result)) {

		$color = get_color_by_category($row[2]);
		echo "<tr style='background-color: $color'>";

		foreach ($row as $cell) {
			echo "<td>$cell</td>";
		}

		echo "</tr>";
	}
}


function show_query_results($result){
	echo '<table class="table">';

	show_header($result);

	show_rows($result);

	echo "</table>";
}

?>


<html>
	<head>
		<meta charset="utf-8">
		<title>Rankings results</title>
		<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
		<link rel="stylesheet" href="./bootstrap.min.css">
		<link rel="stylesheet" href="./style.css">
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Rankings results</a>
    </nav>
		<div class="container">
			<div class="custom-template">
		<?php
		
		//VALIDATE FORM PARAMETERS

		if (!isset($_REQUEST['CodC']) or
			!isset($_REQUEST['CodS']))
		 {
			print(get_alert_html('Error: missing data in the form'));
			die();
		}

		if (!is_numeric($_REQUEST['CodS'])) {
			print(get_alert_html('Error: data format not correct'));
			die();
		}
		if ($_REQUEST['CodS'] <= 0) {
			print(get_alert_html('Error: stage code number should only be positive.'));
			die();
		}
		//CONNECT TO DATABASE
		$con = mysqli_connect('localhost','root','','exercise1'); //set your username and password
		if (mysqli_connect_errno())
		{
			$error_message = 'Failed to connect to MySQL: ' . mysqli_connect_error();
			print(get_alert_html($error_message));
			die();
		}
		// EXECUTE QUERY
		
		$sql = "SELECT Name, Surname, NameT AS Team_Name, Edition, CodS AS Stage_code
		FROM Cyclist AS C, Team AS T, Individual_classification AS IC
		WHERE C.CodC = IC.CodC
		AND C.CodT = T.CodT
		AND C.CodC = '".$_REQUEST['CodC']."'
		AND IC.CodS = '".$_REQUEST['CodS']."'
		ORDER BY Edition ASC";

		$result = mysqli_query($con,$sql);
		if( !$result ){
			$error_message = 'Query error: ' . mysqli_error($con);
			print(get_alert_html($error_message));
			die();
		}

		//SHOW RESULTS
		if(mysqli_num_rows($result) > 0){
			show_query_results($result);
		} else {
			echo '<div class="alert alert-warning" role="alert">
					No results!
		  		</div>';
		}
		?>
			</div>
		</div>
	</body>
</html>
