<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Better YouTube Registration</title>
	<meta name="description" content="Better YouTube">
	<meta name="author" content="Seungmin Lee">
	<link rel="stylesheet" href="../css/register/style.css">
	<script type = "text/javascript" src= "../validate.js"></script>
  </head>

  <body>
  <div class="container">
    <section class="register">
      <h1>BetterTube Registration</h1>
      <form method="post" action="dboperation.php" onsubmit = "return validate();" name ="myform">
      <div class="reg_section personal_info">
      <h3>Your Personal Information</h3>
		<input type="text" name="username" value="" placeholder="Your Desired Username">
		<div id="usernameerror" class="error"></div>
		<input type="text" name="email" value="" placeholder="Your E-mail Address">
		<div id="emailerror" class="error"></div>
		<input type="text" name="name" value="" placeholder="Your Name">
		<div id="nameerror" class="error"></div>
		<input type="text" name="age" value="" placeholder="Your Age" maxlength = "2">
		<div id="ageerror" class="error"></div>
      </div>
      <div class="reg_section password">
      <h3>Your Password</h3>
      <input type="password" name="password" value="" placeholder="Your Password">
	  <div id="pwerror" class="error"></div>
      <input type="password" name="passwordCheck" value="" placeholder="Confirm Password">
	  <div id="pwchkerror" class="error"></div>
      </div>
      <p class="submit"><input type="submit" name="commit" value="Sign Up"></p>
      </form>
    </section>
  </div>
  
  
  </body>
</html>