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