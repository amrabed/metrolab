<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th>Timestamp</th>
			<th>CO</th>
			<th>Temperature</th>
			<th>Humidity</th>
			<th>Pressure</th>
		</tr>
	</thead>
	<tbody>
  <?php
  $db = new mysqli ( "172.17.0.2", "sensor", "M3troL@b", "metrolab", 3306 );
  if ($db->connect_errno) {
   echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
  }
  $res = $db->query ( "SELECT * FROM Blacksburg ORDER BY timestamp DESC" );
  $res->data_seek ( 0 );
  while ( $row = $res->fetch_assoc () ) {
   echo '<tr>';
   echo '<td>' . $row ['timestamp'] . '</td>';
   echo '<td>' . $row ['carbonMonoxide'] . '</td>';
   echo '<td>' . $row ['temperature'] . '</td>';
   echo '<td>' . $row ['humidity'] . '</td>';
   echo '<td>' . $row ['pressure'] . '</td>';
   echo '</tr>';
  }
  ?>
  </tbody>
</table>

