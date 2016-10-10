<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="refresh" content="1200">
	<meta charset="utf-8">
	<!--meta http-equiv="X-UA-Compatible" content="IE=edge"-->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>MetroLab Sensor Network Data</title>

	<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
	<link href="style/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">MetroLab Sensor Network Data</a>
		</div>
	</nav>
	<div class="container">
		<div id="graph" class="container" style="height: 1000px;"></div>
		<div class="row"><?php include 'table.php';?></div>

		<!-- BOOTSTRAP SCRIPTS -->
		<script src="graph.js"></script>
		<script
			src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="style/js/bootstrap.min.js"></script>
	</div>
</body>
</html>
