<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>MetroLab Sensor Network Data</title>

	<script src="plugins/plotly-latest.min.js"></script>
	<link href="style/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="navbar navbar-inverse">
		<!--div class="navbar-header"-->
			<a class="navbar-brand" href="#">MetroLab Sensor Network Data</a>
		<!--/div-->
	</div>
	<div class="container">
		<div id="tester" class="row">
<!--		<div id="co" class="col-md-3"></div>
                <div id="temperature" class="col-md-3"></div>
                <div id="pressure" class="col-md-3"></div>
                <div id="humidity" class="col-md-3"></div>
-->		</div>
		<div class="row"><?php include 'table.php';?></div>

		<!-- BOOTSTRAP SCRIPTS -->
		<script
			src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="style/js/bootstrap.min.js"></script>
		<script src="graph.js"></script>
	</div>
</body>
</html>
