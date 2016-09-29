<table class="table table-hover table-striped">
  <thead>
    <!-- TODO: Read table headers from database -->
    <tr>
      <th>Timestamp</th>
      <th>CO</th>
      <th>Ozone</th>
      <th>Temperature</th>
      <th>Pressure</th>
      <th>Humidity</th>
    </tr>
  </thead>
  <tbody>
  <?php
   require_once 'database.php';
   $db = new Database;
   // ToDo: customize query based on user input
   $query = "SELECT * FROM Blacksburg where datediff(now(), timestamp) <= 7 ORDER BY timestamp DESC";
   $db -> readCSV ($query);
  ?>
  </tbody>
</table>

