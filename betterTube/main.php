<?php @include ('include/dbconn.php'); 
		if (isset($_COOKIE['loginCookieUser']))
	{
		$outstr = $_COOKIE['loginCookieUser'];
	} else {
		header("Location: include/loginHandler.php");
		exit;
	}

?>



<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Better YouTube Main Page</title>
		<meta name="description" content="Better YouTube">
		<meta name="author" content="Seungmin Lee">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/main.css" />
		<link rel="stylesheet" href="css/videoPage.css" />
	</head>
	<body>
	
<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       <a href="main.php" class="navbar-brand"><span class = "text-primary">BetterTube</span></a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li>
          <a href="main.php">Main Page</a>
        </li>
        <li>
          <a href="firstSetup.php">Add/Modify Interests</a>
        </li>

      </ul>
	  <ul class="nav navbar-nav navbar-right">
		<li>
			<span class="navbar-brand"> Hey there, <?php echo $_COOKIE['loginCookieUser']; ?> </span>
		</li> 
       <li>
          <a href="logout.php">Logout</a>
        </li>
	  </ul>
    </nav>
  </div>
</header>
	
	<h1 class="blaBigger"> <strong> BetterTube's Main Page </strong> </h1>
	<h2 class="bla"> welcome back, <span class = "text-danger"> <?php echo $outstr ?> ! </span></h2><br><br>
	
	<h3> <span class = "text-info"> your interests are: </span></h3>
		<?php
		displayMain();
  
		?>
	</body>
  
</html>

<?php
	Function displayMain() {
		?>
		
		
		
		
		<nav id="menu">

		<form method="get">
		<ul>
		<?php
		//Array of keys that will be used for CSS
		$classKey = array(
			"interest1" => "rocket",
			"interest2" => "wine",
			"interest3" => "burger",
			"interest4" => "comment",
			"interest5" => "sport",
			"interest6" => "earth"
		);
		$i_image = 0;
		
		//die(9 + (16.5 * ($i_image+1) ) );
		$username = $_COOKIE['loginCookieUser'];
		$dbc = connectToDB("leeawg");
		
	for ($i = 0; $i < 6; $i++) //Maximum of 6 interests.
	{
		$x = 'interest'.($i+1);
		$query = "SELECT $x FROM account WHERE user_id = '$username' and $x is not null";
		$result = performQuery($dbc, $query);
		$rowsFound = mysqli_num_rows($result);
		$extractedSQL = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if ( $rowsFound == 1 )
		{
			$location_percent = 9 + (16.5 * ($i_image) );
			echo "<style>.".$classKey[$x].":hover~ .current{ left: $location_percent%; }</style> \n";
			echo "<li class=".$classKey[$x]."> <a href=interestVideos.php?op=$extractedSQL[$x]>".$extractedSQL[$x]."</a></li> \n";
			$i_image++;
		}
	}
	?>
			<div class="current">
			<div class="top-arrow"></div>   
			<div class="current-back"></div>
			<div class="bottom-arrow"></div>
		</div>
		</ul>
		</form>
	</nav>
	<?php
	}
?>