<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Report | SDSU Marathon</title>
    <link rel="stylesheet" type="text/css" href="report.css" />
</head>
<body>
    <h2>SDSU Marathon Registration Report - 2016</h2>
<?php
	$server = 'opatija.sdsu.edu:3306';
    $user = 'jadrn041';
    $password = 'pamphlet';
    $database = 'jadrn041';
	if(!($db = mysqli_connect($server, $user, $password, $database)))
		echo "ERROR in connection" .mysqli_error($db);
	else {
		$sql = "SELECT * FROM person ORDER BY lname ASC";
		$result = mysqli_query($db, $sql);
		if(!$result)
			echo "ERROR in query" .mysqli_error($db);
		echo "<table>\n";
		echo "<tr><th>Last name</th><th>First name</th><th>Image</th><th>Age</th><th>Experience</th></tr>";
		while($row = mysqli_fetch_array($result)) {
			$dob = $row['dob'];
			$birthdate = new DateTime($dob);
			$today   = new DateTime('today');
			$age = $birthdate->diff($today)->y;
			$fileName = $row['image'];
			echo "<tr> <td>$row[lname]</td><td>$row[fname]</td><td><img src=\"proj3pics/$fileName\""." width='100px' /></td><td>$age</td><td>$row[experience]</td></tr>";
    }
		mysqli_close($db);
	}
?>
</table>
</body>
</html>