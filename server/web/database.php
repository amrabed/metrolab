<?php
require_once 'config.php';

/*
 * Database operations
 */
class Database
{
  /*
   * Connect to database
   */
  function connect ()
  {
    $db = new mysqli (HOST, USER, PASSWORD, DATABASE, PORT /* Update values in config.php */);
    if ($db->connect_errno)
    {
      die ("Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error);
    }
    return $db;
  }

  /*
   * Read from databse into CSV file
   */
  function readCSV ($query)
  {
    $db = self::connect ();
    if ( $result = $db->query ($query))
    {
      $csv = "timestamp,co,ozone,temperature,pressure,humidity\n";
      foreach ( $result as $row )
      {
        echo '<tr>';
        foreach ( $row as $item )
        {
          echo '<td>' . $item . '</td>';
          $csv .= $item . ",";
        }
        echo '</tr>';
        $csv = substr ($csv, 0 , -1) . "\n";
      }
      $result -> close ();
    }
    $db -> close ();
    $file = fopen ('data.csv', 'w');
    fwrite ($file, $csv);
    fclose ($file);
  }

  /*
   * Read from database into JSON array (Function not currently used)
   */
  function read (/* $query */)
  {
    $query = "SELECT * FROM Blacksburg where datediff(now(), timestamp) <= 7 ORDER BY timestamp DESC";
    $db = self::connect ();
    if ( $result = $db->query ($query))
    {
      $array = json_encode ( $result-> fetch_all ( MYSQLI_ASSOC ));
      $result -> close ();
    }
    $db -> close ();
    return $array;
  }

  /*
   * Insert new values into database
   */
  function insert ($table, $fields, $values)
  {
    // Table, fields, and values received as strings from Raspberry Pi
    $query = "INSERT INTO " . $table . " " . $fields . " VALUES " . $values;
    $db = self::connect ();
    if ($result = $db->query ($query))
    {
      $result -> close ();
    }
    else
    {
      die ("Insert operation failed: " . $db -> error);
    }
    $db -> close ();
  }


  /*
   * Execute a query
   */
  function execute ($query)
  {
    try
    {
      $db = self::connect ();
      if ($result = $db->query ($query))
      {
        $result -> close ();
      }
    }
    catch (Exception $e)
    {
      echo 'Operation failed: ', $e->getMessage(), "\n";
    }
    finally
    {
      $db -> close ();
    }
  }
}


?>
