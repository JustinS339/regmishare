function attemptLogin(){

	var	username = document.login.username.value;
	var	password = document.login.password.value;
	
	var uExp = /^[\w]+$/;
	var pExp = /^[\x00-\x7F]+$/;

	if(username.length < 6 || username.length > 16 || !username.match(uExp)){
		confirm("Incorrect Username");
		return false;
	}
	
	if(password.length < 6 || password.length > 16 || !password.match(pExp)){
		confirm("Incorrect Password");
		return false;
	}
	password = encodeURIComponent(password);

	$.ajax({
	  type: "POST",
	  url: "scripts/verifyLogin.php",
	  data: 'postusername='+username+'&postpassword='+password,
	  datatype: "html",
	  async: false,
	  success: function(result){

	      if(result == 1){
	      		window.location = "../home.php";
			} else{
				confirm(result);
			}  
	      }
  	})

	return false;
}

function attemptAccountCreation(){

	var	username = document.login.username.value;
	var	password = document.login.password.value;
	var password2 = document.login.retypedPassword.value;
	
	var uExp = /^[\w]+$/;
	var pExp = /^[\x00-\x7F]+$/;

	if(username.length < 6 || username.length > 16 || !username.match(uExp)){
		confirm("Username must be alphanumeric (underscores allowed) and 6 to 16 characters in length");
		return false;
	}
	
	if(password.length < 6 || password.length > 16 || !password.match(pExp)){
		confirm("Password must be 6 to 16 characters in length");
		return false;
	}

	if(password !== password2){
		confirm("Passwords do not match");
		return false;
	}

	password = encodeURIComponent(password);
	password2 = encodeURIComponent(password2);

	$.ajax({
	  type: "POST",
	  url: "scripts/createAccount.php",
	  data: 'postusername='+username+'&postpassword='+password+'&postpassword2='+password2,
	  datatype: "html",
	  async: false,
	  success: function(result){

	      if(result == 1){
				window.location = "../home.php";
				confirm("New Account Created With Entered Credentials");
			} else{
				confirm(result);
			}  
	      }
  	})

	return false;
}

function attemptPasswordChange(){

	var	password1 = document.passChange.password1.value; //Old password
	var password2 = document.passChange.password2.value; //New password
	var password3 = document.passChange.password3.value; //Retyped new password
	
	var pExp = /^[\x00-\x7F]+$/;
	
	if(password2.length < 6 || password2.length > 16 || !password2.match(pExp)){
		confirm("New password must be 6 to 16 characters in length");
		return false;
	}

	if(password2 !== password3){
		confirm("New passwords do not match");
		return false;
	}

	password1 = encodeURIComponent(password1);
	password2 = encodeURIComponent(password2);
	password3 = encodeURIComponent(password3);

	$.ajax({
	  type: "POST",
	  url: "scripts/passChange.php",
	  data: 'postpassword1='+password1+'&postpassword2='+password2+'&postpassword3='+password3,
	  datatype: "html",
	  async: false,
	  success: function(result){

	      if(result == 1){
				window.location = "../home.php";
				confirm("Password changed successfully");
			} else{
				confirm(result);
			}  
	      }
  	})

	return false;
}