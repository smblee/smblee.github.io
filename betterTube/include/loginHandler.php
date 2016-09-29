<?php
@include ('dbconn.php');

if ( isset ($_COOKIE['loggedOut']) )
{
	setcookie("loginError", "You have been logged out! Please relogin.", time()+1, '/');
	header("Location: ../index.php");
	exit;
}

if ( ! isset( $_POST['username'] ) or  
	 ! isset( $_POST['password'] ) or
	( 0 == checklogin( $_POST['username'], $_POST['password'] ) ) ) {
		setcookie("loginError", "You have entered wrong username/password.", time()+1, '/');
		header("Location: ../index.php");
} else { 
		//If it's the user's first time, send him to firstSetup.php
	if (checkFirstTime ($_POST ['username'], $_POST['password'] ) == true)
	{
		setcookie('loginCookieUser', $_POST['username'], time()+3600*24, '/');
		header("Location: ../firstSetup.php");
	}
	else
	{
		// Store the login information in cookies	
		setcookie('loginCookieUser', $_POST['username'], time()+3600*24, '/');	
		header("Location: ../main.php");
	}
}


// checklogin sees if an entry exists with the name password pair passed.
// returns true if so, false otherwise.
function checklogin($username, $passwd){
	$dbc = connectToDB("leeawg");
	$encodepw = sha1($passwd);
	$query = "select * FROM account where user_id='$username' and password='$encodepw'";
	$result = performQuery($dbc, $query);
	$matches = mysqli_num_rows($result);
	disconnectFromDB($dbc, $result);
	return($matches == 1);
}

function checkFirstTime($username, $passwd) {
	$dbc = connectToDB("leeawg");
	$encodepw = sha1($passwd);
	$query = "select * FROM account where user_id='$username' and password='$encodepw'";
	$result = performQuery($dbc,$query);
	$extractedSQL = mysqli_fetch_assoc($result);
	$firstTimeStatus = $extractedSQL['first_time'];
	disconnectFromDB($dbc, $result);
	if ($firstTimeStatus == 1)
		return true;
	else
		return false;
}


?>