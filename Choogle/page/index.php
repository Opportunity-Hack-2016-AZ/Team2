<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Connect to Chandler - Home</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<link rel="stylesheet" href="../style/style.css">
	</head>
	<body>
		<?php
			require_once('menu.php');
		?>
		<form action="search.php" method="get" id="body">
			<div>
				<input type="text" name="search_in">
				<input type="submit" value="Search">
					
				<select name="general_cat">
					<option value=''></option>
					<option value=''></option>
					<option value=''></option>
					<option value=''></option>
				</select>
				
				<select name="specific_cat">
					
				</select>
			</div>
		</form>
	</body>
</html>