<?php
include ('dbconn.php')
?>
<!DOCTYPE html>
<html>
<head>
	<title>Check DB</title>
		<link rel="stylesheet" href="../css/register/style.css" />
</head>
<body>

<?php
$join_password = $_POST['password'];
$join_passwordcheck = $_POST['passwordCheck'];
// First check if password retype is valid.
passwordCheck($join_password, $join_passwordcheck);
?>

</body>
</html>


<?php
//Functions
Function passwordCheck($original, $check)
{
	if ($original != $check) {	
	errorform('password');
	} 
	else
		emailcheck();
}

Function emailcheck()
{
	$dbc= connectToDB( "leeawg" );
	$join_name =  $_POST['name'];
	$join_email = $_POST['email'];
	$join_username = $_POST['username'];
	$join_password = $_POST['password'];
	$join_securepw = sha1($join_password);
	$join_age = $_POST['age'];
	
	$q_emailCheck = "SELECT email FROM account WHERE email = '$join_email';";
	$q_usernameCheck = "SELECT user_id FROM account WHERE user_id = '$join_username';";
	
	$emailCheck_result = performQuery($dbc, $q_emailCheck);
	$emailCheck_duplicate = mysqli_fetch_array($emailCheck_result, MYSQLI_ASSOC);

	$usernameCheck_result = performQuery($dbc, $q_usernameCheck);
	$usernameCheck_duplicate = mysqli_fetch_array($usernameCheck_result, MYSQLI_ASSOC);
	
	
	if (mysqli_num_rows($usernameCheck_result) == 0 && mysqli_num_rows($emailCheck_result) == 0 )
	{
		//echo "no duplicate :)";
		$query = "INSERT INTO account (user_id,password,name,age,email)
		VALUES ( '$join_username', '$join_securepw', '$join_name', '$join_age', '$join_email' )";
		insert($dbc, $query);
	}
	
	if (mysqli_num_rows($emailCheck_result) > 0)
	{
		errorform('email');
	}
	
	if  (mysqli_num_rows($usernameCheck_result) > 0)
	{	
		errorform('username');
	}	
}

Function insert($dbc, $query)
{
	$result = performQuery($dbc, $query);
	if (! $result )
	{
		//echo "<br> Registration failed";
		errorform('insert');
	}
	else
		//echo "<br> Insert success - $query";
		successform();
}

Function errorform($reason)
{
	Switch($reason) {
		Case "password":
			$msg =  "Your password did not match. Please try again.";
			break;
		Case "email":
			$msg = "You are already registered with the same email. Please try again.";
			break;
		Case "insert":
			$msg = "Database failed to insert to the system. Please check that you typed in all the fields.";
			break;
		Case "username":
			$msg = "Your username already exists!";
			break;
		default:
			$msg = "unexpected error.";
			break;

	}	
	echo "$msg";
	echo "<br>";
	echo "<a href='register.php'> Go back to registration </a> ";
}

Function successform()
{
	echo "SUCCESS!! You are officially a BetterTube member! <br>";
	echo" <a href='../index.php'>Go back the main page</a> ";
}


?>