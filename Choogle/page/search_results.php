<!-- Page showing search results after user searches -->
<!DOCTYPE html>
<html lang = "en">
	<head>
		<title>Connect to Chandler - Results</title>
		<meta charset="ISO-8859-1">
		<link rel="stylesheet" href="../style/style.css">
		<script src="../script/script.js">
			window.onload = populateSearch();
		</script>
		<style>			
			div#result_page {
				background-color: white;
				color: blue;
				margin-left: 200px;
				border: 1px groove black;
				padding: 25px;
			}
			
			div#result_page ul {
				list-style-type: none;
			}
			
			div#result_page ul a {
				text-decoration: none;
				font-weight: bold;
			}
			
			div#result_page ul li a:hover {
				color: red;
			}
			
			div#result_page ul li a:visited {
				color: blue;
			}
		</style>
	</head>
	<body>
		<?php
			//Calling reusable code
			require_once("menu.php");
			require_once("search_bar.php");
			require_once("nav.php");
		?>
		<div id="result_page">
			<ul>
				<?php
					//use of prepared statement and htmlentities to protect against XSS and SQL Injection
					$input = $_GET['search_in'];
					$preference = $_GET['preference'];
					
					echo "<h1>Preference: $preference</h1>";
					
					$mysqli = new mysqli("localhost", "root", "", "site_list");
					//in the event that mysql cannot connect to the database
					if (mysqli_connect_error()) {
						echo mysqli_connect_error();
						exit;
					}
					
					$query = "";
					if ($preference == "General") {
						$query = "SELECT * FROM site_list WHERE INSTR(name, ?) > 0 --?";
					}
					else {
						$query = "SELECT * FROM site_list WHERE INSTR(name, ?) > 0 && category = ?";
					}
					
					if($stmt = $mysqli->prepare($query)) {
						$stmt->bind_param('ss', $name, $category);
						$name = strtolower($input);
						$category = strtolower($preference);
						$stmt->execute();
						
						$result = mysqli_stmt_get_result($stmt);
						$elem_count = 0;
						while ($row = mysqli_fetch_array($result)) {
							++$elem_count;
							echo "<li><a href='search_results_page.php?link=" . $row[1] . "'>" . htmlentities($row[0]) . "</a></li>";
						}
						
						if ($elem_count == 0) {
							echo "<li>Sorry! No search results!</li>";
						}
					}
					
					$mysqli->close();
				?>
			</ul>
		</div>
	</body>
</html>