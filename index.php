<?php session_start(); ?>
<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="userstation.css">
</head>

<body>
	<?php	
		// This makes the title of the page show up, if session variable of
		// the total number of users is known.
		if (isset($_GET['userCount'])) {
			$userCount = $_GET['userCount'];
			echo('<div class="title"><h1 class="bold20"># of Users in the Table: '.$userCount.'</h1></div>');
		} else {
			// This is necessary for below when I do get the user count below, so I am not displaying a title twice.
			$userCount = -1;
		}
		// Makes my connection to the database and table of data.
		$database = mysqli_connect("localhost", "gatene_Gatene", "seniorsrule", "gatene_users") or die("Could not connect do database");
		$userInfoQuery = "SELECT * FROM information ORDER BY num";
		$result = mysqli_query($database, $userInfoQuery);
		
		// If $userCount wasn't set as a session variable above, then set the variable below and the 
		// session variable accordingly. Then, display like a title, just as would have above.
		if ($userCount == -1) {
			$userCount = mysqli_num_rows($result);
			$_PUT['userCount'] = $userCount;
			echo ('<div class="title"><h1 class="bold20"># of Users in the Table: '.$userCount.'!</div>');
		}
		echo ('	<div class="titleContent">
						<center>
						<table border=1 padding=0 cellspacing=0>
							<tr>
								<td>&nbsp;User Number&nbsp;</th>
								<td>&nbsp;User Name&nbsp;</th>
								<td>&nbsp;Password&nbsp;</th>
							</tr>
			 
		');
			while ($row = mysqli_fetch_assoc($result)){
			
				echo('
							<tr>
								<td>'.$row["num"].'</td>
								<td>'.$row["username"].'</td>
								<td>'.$row["password"].'</td>
							</tr>
				');
			 
			}
		echo('
						</table>
					</center>
				</div>
		');
	?>
</body>
</html>