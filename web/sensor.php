<?php
require_once 'database.php';

const ERROR = "Required data not provided";

if (!empty ($_POST))
{
  $query = $_REQUEST['query'];
  if (! empty ($query))
  {
    $db = new Database;
    $db -> execute ($query);
  }
  else
  {
    $table = $_REQUEST['table'];
    $fields = $_REQUEST['fields'];
    $values = $_REQUEST['values'];

    if (empty ($table) || empty ($fields) || empty ($values))
    {
      die (ERROR);
    }
    $db = new Database;
    $db -> insert ($table, $fields, $values);
  }
}
else
{
  die (ERROR);
}


?>
