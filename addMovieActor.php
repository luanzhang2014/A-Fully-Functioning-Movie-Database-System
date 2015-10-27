<!DOCTYPE html>
<?php require_once('subfunctions.php'); ?>
<html>
<head>
  <title>Movie Database</title>
  <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
<p>
  <h1> Add new Movie/Actor relation </h1>
</p>
    <form action="./addMovieActor.php" method="GET">

      Movie : <select name="movie">
      <?php
      $db_connection = connect();

      if(!$db_connection) {
          $errmsg = mysql_error($db_connection);
          echo "Connection failed: $errmsg <br/>";
          exit(1);
       }

       $q = 'SELECT id, CONCAT(title,"(",year,")") as name FROM Movie';
       $rs = mysql_query($q, $db_connection);
       while ($row = mysql_fetch_row($rs))
       {
          echo "<option value=\"$row[0]\">$row[1]</option>";
       }
       ?>
       </select><br>

       Actor : <select name="actor">
       <?php
       $q = 'SELECT id, CONCAT(first," ",last,"(",dob,")") as name FROM Actor';
       $rs = mysql_query($q, $db_connection);
       while ($row = mysql_fetch_row($rs))
       {
          echo "<option value=\"$row[0]\">$row[1]</option>";
       }       
       ?>
     </select><br>
     Role : <input type="text" name = "role">
      <br>
      <input type="submit" value="Add">
    </form>
    <hr/>
<?php
if ($_GET['movie'])
{
    $mid = $_GET['movie'];
    $aid = $_GET['actor'];
    $role = $_GET['role'];
    $q = "INSERT INTO MovieActor VALUES($mid, $aid, \"$role\")";
    mysql_query($q, $db_connection);
    echo "Add successfully!";
}
mysql_close($db_connection);
?>

</body>
</html>
