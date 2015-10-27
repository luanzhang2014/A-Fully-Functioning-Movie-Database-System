
<html>
<head>
  <title>Navigation</title>
  <link rel="stylesheet" type="text/css" href="mystyle.css">
  <style>
    body{
      background-image: url("background.png");
      color: blue;
      font-size: 20px;
      font-family: "Times New Roman";
    }

    ul {
        font-size: 18px;
    }

    div {
        position: fixed;
        bottom: 0;
        right: 0;
        width: 300px;
        border: 3px solid #8AC007;
    }
  </style>
</head>	
	<body>
    Search Interface :
      <ul>
        <li><a href="./search.php" target="main">Search Actor/Movie</a></li>
      </ul>
    Add New Content :
      <ul>
    	  <li><a href="./addPerson.php" target="main">Add New Actor/Director</a></li>
        <li><a href="./addMovie.php" target="main">Add New Movie Information</a></li>
        <li><a href="./addMovieActor.php" target="main">Add Movie and Actor Relation</a></li>
        <li><a href="./addMovieDirector.php" target="main">Add Movie and Director Relation</a></li>
        <li><a href="./addReview.php" target="main">Add Your Review</a></li>
      </ul>
	 Browsering Content :
	   <ul>
      <li><a href="./showActor.php?aid=52794" target="main">Show Actor Information</a></li>
      <li><a href="./showMovie.php?mid=2632" target="main">Show Movie Information</a></li>	    
    </ul>



  <div>
    Declariation:
    <ul>
      <li>Database project</li>
      <li>Developed by Luan Zhang</li>
    </ul>
  </div>
</body>
</html>
