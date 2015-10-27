<!DOCTYPE html>
<?php require_once('subfunctions.php'); ?>
<html>
<head>
	<title>Movie Database</title>
  <link rel="stylesheet" type="text/css" href="mystyle.css">
  <style>
    table, td, th {
        border: 1px solid green;
    }

    th {
        background-color: green;
        color: white;
    }

    ul {
    list-style-type: square;
    }
  </style>
</head>
<body>
<p>
	<h1> Moive Infromation </h1>
</p>
<?php
$id = $_GET['mid'] ? $_GET['mid'] : '0';

$db_connection = connect();

      if(!$db_connection) {
          $errmsg = mysql_error($db_connection);
          echo "Connection failed: $errmsg <br />";
          exit(1);
       }
       $q = "SELECT title, year, company, rating FROM Movie WHERE id = $id LIMIT 1";

       $director_q = "SELECT Director.first, Director.last FROM Director,MovieDirector 
       WHERE MovieDirector.did = Director.id AND MovieDirector.mid = $id";

       $cast_q = "SELECT Actor.id, Actor.first, Actor.last, MovieActor.role FROM Actor, MovieActor
       WHERE MovieActor.mid = $id AND Actor.id = MovieActor.aid";

       $genre_q = "SELECT DISTINCT(genre) FROM MovieGenre WHERE mid = $id";

       $avg_rating_q = "SELECT AVG(rating), count(*) FROM Review WHERE mid = $id";

       $comments_q = "SELECT name, rating, comment, time FROM Review WHERE mid = $id ORDER BY time DESC";

       $rs = mysql_query($q, $db_connection);
       $row = mysql_fetch_row($rs);
                echo"<ul>";
                echo "<li>Title: $row[0] ($row[1])</li>";
                echo "<li>Producer: $row[2]</li>";
                echo "<li>MPAA Rating: $row[3]</li>";
                echo "<li>Director: ";
                $rs = mysql_query($director_q, $db_connection);
                $isfirst = true;
                while ($row = mysql_fetch_row($rs))
                {
                  if ($isfirst) {echo "$row[0] $row[1]"; $isfirst =false;}
                  else {echo ", $row[0] $row[1]";}
                }
                echo "</li>";
                echo "<li>Genre: ";
                $rs = mysql_query($genre_q, $db_connection);
                $isfirst = true;
                while ($row = mysql_fetch_row($rs))
                {
                  if ($isfirst) {echo "$row[0]"; $isfirst =false;}
                  else {echo ", $row[0]";}
                }
                echo"</li>";
                echo"</ul>";

          echo "<h2>CAST</h2>";
          $rs = mysql_query($cast_q, $db_connection);
          echo "<table>";
          echo "<tr><th>Actor</th><th>Role</th></tr>";
          while ($row = mysql_fetch_row($rs))
          {
                  echo "<tr><td><a href=\"showActor.php?aid={$row[0]}\">$row[1] $row[2]</a></td>";
                  echo "<td>$row[3]</td></tr>";
          }          
          echo "</table>";
          echo "<h2>Reviews</h2>";

          $rs = mysql_query($avg_rating_q, $db_connection);
          $row = mysql_fetch_row($rs);
          echo "Average Rating: $row[0]/5 by $row[1] review(s)  ";
          echo "<a href=\"./addReview.php?movie=$id\" target=\"main\">Add review to this movie!</a><br>";
          echo "All Comments:<br>";
          $rs = mysql_query($comments_q, $db_connection);
          while ($row = mysql_fetch_row($rs))
          {
                  echo "In $row[3], $row[0] rates $row[1] points: $row[2]<br>";
          }   

            mysql_close($db_connection);
?>
</body>
</html>