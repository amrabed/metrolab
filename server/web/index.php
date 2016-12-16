<?php
require_once 'database.php';
$db = new Database;

if (isset($_GET['device']) && isset($_GET['start']) && isset($_GET['end'])) {
    $device = $_REQUEST['device'];
    $start = $_REQUEST['start'];
    $end = $_REQUEST['end'];
    $query = "SELECT * FROM " . $device . " WHERE timestamp BETWEEN '" . $start . "' AND '" . $end . "'";
} else {
    $query = "SELECT * FROM Blacksburg WHERE datediff(now(), timestamp) <= 7";
}
$query .= " ORDER BY timestamp DESC";

function _date($shift = 0)
{
    $d = new DateTime("now", new DateTimeZone("EST"));
    $d->sub(new DateInterval('P' . $shift . 'D'));
    return $d->format('Y-m-d\TH:i');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="refresh" content="1200">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MetroLab Sensor Network Data</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">MetroLab Sensor Network Data</a>
    </div>
</nav>

<div class="container" style="margin-top: 50px">
    <form class="form-inline" action="index.php" method="get">
        <div class="form-group">
            <label for="device">Device</label>
            <select name="device" class="form-control" id="device">
                <?php $tables = $db->getTables();
                // ToDo: show last selected device
                foreach ($tables as $table) echo '<option value="' . $table[0] . '">' . $table[0] . '</option>';
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="start">From</label>
            <input id="start" name="start" class="form-control" type="datetime-local"
                   value="<?php echo isset($start) ? $start : _date(7); ?>">
        </div>
        <div class="form-group">
            <label for="end">To</label>
            <input id="end" name="end" class="form-control" type="datetime-local"
                   value="<?php echo isset($end) ? $end : _date() ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <div id="graph" class="row" style="height: 1000px;"></div>
    <div class="row">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <?php $fields = $db->connect()->query($query)->fetch_fields();
                foreach ($fields as $field) echo '<th>' . ucfirst($field->name) . '</th>';
                ?>
            </tr>
            </thead>
            <tbody>
            <?php $db->readCSV($query); ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script src="graph.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js"></script>
</body>
</html>
