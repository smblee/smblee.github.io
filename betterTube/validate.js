	function validate() {
		var nameValid = validateName();
		var usernameValid = validateUsername();
		var emailValid = validateEmail();
		var pwValid = validatePw();
		var ageValid = validateAge();
		var pwchkValid = validatePwchk();
		if (nameValid && usernameValid && emailValid && ageValid && pwValid && pwchkValid)
			return true;
		return false;
	}

	function validateName() {
		var name = document.forms["myform"]["name"].value;
		if (name.length < 1) {
			var errorrpt = document.getElementById("nameerror");
			errorrpt.innerHTML = "Please enter your name";
			return false;
		}
		var errorrpt = document.getElementById("nameerror");
		errorrpt.innerHTML = "";
		return true;
	}
	
	function validateUsername() {
		var username = document.forms["myform"]["username"].value;
		if (username.length < 1) {
			var errorrpt = document.getElementById("usernameerror");
			errorrpt.innerHTML = "Please enter your Username";
			return false;
		}
		var errorrpt = document.getElementById("usernameerror");
		errorrpt.innerHTML = "";
		return true;
	}
	
	function validateAge() {
		var age = document.forms["myform"]["age"].value;
		if (age < 10) {
			var errorrpt = document.getElementById("ageerror");
			errorrpt.innerHTML = "You should be older to sign up!";
			return false;
		}
		else if (age > 80) {
			var errorrpt = document.getElementById("ageerror");
			errorrpt.innerHTML = "Aren't you too old?";
			return false;
		}
		var errorrpt = document.getElementById("ageerror");
		errorrpt.innerHTML = "";
		return true;
	}
	
	function validateEmail() {
		var email = document.forms["myform"]["email"].value;
		var emailRegex = /^\S+@\S+\.\S+$/;
		if (email.length < 1) {
			var errorrpt = document.getElementById("emailerror");
			errorrpt.innerHTML = "Please enter your email";
			return false;
		}		
		if (!emailRegex.test(email))
		{
			var errorrpt = document.getElementById("emailerror");
			errorrpt.innerHTML = "Please enter valid email";
			return false;
		}
		return true;
		
	}
	
	function validatePw() {
		var pw = document.forms["myform"]["password"].value;
		if (pw.length < 1) {
			var errorrpt = document.getElementById("pwerror");
			errorrpt.innerHTML = "Please enter your password.";
			return false;
		}
		if (pw.length < 5) {
			var errorrpt = document.getElementById("pwerror");
			errorrpt.innerHTML = "Your password is too short! The length must be greater than 5.";
			return false;
		}
		var errorrpt = document.getElementById("pwerror");
		errorrpt.innerHTML = "";
		return true;
	}

	function validatePwchk() {
		var pwchk = document.forms["myform"]["passwordCheck"].value;
		if (pwchk.length < 1) {
			var errorrpt = document.getElementById("pwchkerror");
			errorrpt.innerHTML = "Please enter your password check.";
			return false;
		}
		var errorrpt = document.getElementById("pwchkerror");
		errorrpt.innerHTML = "";
		return true;
	}