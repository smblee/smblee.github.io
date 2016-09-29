<?php
@include ('include/dbconn.php');
		if (isset($_COOKIE['loginCookieUser']))
	{
		$outstr = "<h1 class = 'bla'>";
		$outstr .= "<strong>Welcome, <span class = 'text-danger'>  ".$_COOKIE['loginCookieUser'].'</span>';
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
		<title>Better YouTube Setup Interest</title>

		<meta name="description" content="Better YouTube">
		<meta name="author" content="Seungmin Lee">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/videoPage.css" />
	</head>
	<body>
	<?php
	displayMain($outstr);
	if (isset($_POST['submitted'])) {
		addInterestToDB($_COOKIE['loginCookieUser']);
	}
	?>  
</html>

<?php

Function displayMain ($outstr)
{
?>
		<?php echo $outstr; ?>
		</strong></h1>

		
<div class='bla'>

<h2> Please pick your interests! </h2>

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



		<fieldset>
		<form method = "post">
		
		<!-- Squared TWO -->

			<h3>
			Science <input type = "checkbox" name = "interest1" value = "science" /> <br>
			Entertainment <input type = "checkbox" name = "interest2" value = "entertainment" /> <br>
			Food <input type = "checkbox" name = "interest3" value = "food" /> <br>
			Music <input type = "checkbox" name = "interest4" value = "music" /> <br>
			Sports <input type = "checkbox" name = "interest5" value = "sports" /> <br>
			Popular <input type = "checkbox" name = "interest6" value = "popular" /> <br><br>
			<input type = "Submit" name = "submitted" value = "Pick interests!" /></h3>
		</form>
		</fieldset>
  
	</body>
<?php
}

Function addInterestToDB ($username)
{
	
	$dbc = connectToDB("leeawg");
	// pull interests out from $_POST and add to DB.
	for ($i = 0; $i < 6; $i++) //Maximum of 6 interests.
	{
		$x = 'interest'.($i+1);
		if ( isset($_POST[$x]) )
		{
			$query = "UPDATE account SET $x = '$_POST[$x]' WHERE user_id = '$username'";
			performQuery($dbc, $query);
		}	
		else
		{
			$query = "UPDATE account SET $x = NULL WHERE user_id = '$username'";
			performQuery($dbc, $query);
		}
	}
	$query = "UPDATE account SET first_time = 0 WHERE user_id = '$username'";
	performQuery($dbc, $query);
	mysqli_close($dbc);
	echo "<h2>Your interests have been added!</h2>";
	?>
	<p>You will be redirected to the main page in <span id="counter">5</span> second(s).</p>
	
	<script type="text/javascript">
	function countdown() {
		var i = document.getElementById('counter');
		if (parseInt(i.innerHTML)<=0) {
			location.href = 'login.php';
		}
		i.innerHTML = parseInt(i.innerHTML)-1;
	}
	
	setInterval(function(){ countdown(); },1000);
	</script>
	
	<meta http-equiv="refresh" content="5;URL='main.php'" />
	<?php
}