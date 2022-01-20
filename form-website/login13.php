<!DOCTYPE html>
<html>
    <head>
        <title>Space Catering Company</title>
        <meta http-equiv="Content-Type" content="text.html; charset=UTF-8"/>
        <link rel="stylesheet" href= "login10.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
    </head>
    <body>
        <div class="container">
            <header class="header">
                <div>
                    <img class="logo" src = "./img/logo.png">
                </div>
                <nav>
                    <div class= "row">
                        <div class="col">
                            <ul>
                                <li>
                                    <a href="menu8.html" class = "menuBtn">
                                        <i class="fa fa-bars"> Menu</i>
                                    </a>
                                </li>   
                                <li>
                                    <a href="login13.php" class="menuBtn">
                                        <i class="fas fa-user"></iclass></i> Login
                                    </a>
                                </li>
                                <li>
                                    <a href="orderForm13.php" class = "menuBtn">
                                        <i class="fa fa-shopping-cart"> Order</i>
                                    </a>
                                </li>
                                <li>
									<a href="listRec15.php" class = "menuBtn">
										<i class="fa fa-book"> Check Records</i>
									</a>
								</li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
        </div>
        <div class="form-container">
            <form name="loginForm" id="loginForm" method="post" >
                <div class="loginBox">
                    <h1>Login</h1>
                    <div class="textbox">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" placeholder="Username">
                    </div>

                    <div class="textbox">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Password">
                    </div>
                    <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" 
                            type="submit">Sign In</button>

                    <div id="message" class="form-control" style="display:none;"></div>
                </div>
            </form>
        </div>
    </body>
		

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script>
	$(document).ready(function() {
		$('#loginForm').submit(function(event) { 	//Trigger on form submit
			event.preventDefault(); 				//Prevent the default submit
		
			$("#message").empty();
			$("#message").hide();
			
			var postForm = $('#loginForm').serialize();
			console.log(postForm);
					
			$.ajax({ 								//Process the form using $.ajax()
				type 		: 'POST', 				//Method type
				url 		: 'validateUser.php', 	//Processing file url
				data 		: postForm, 		
				dataType 	: 'json',
						
				success 	: function(data) {
					if(!data.success) {
						if(data.errors.username) {
							$("#message").fadeIn(1000).html('<p>' + data.errors.username + '<p>');
							$("#message").show();
						}  else if(data.errors.password) {
							$("#message").fadeIn(1000).html('<p>' + data.errors.password + '<p>');
							$("#message").show();
                        }
					} else {
						$("#message").fadeIn(1000).append('<p>' + data.posted + '</p>');
						$("#message").show();
					}
				}
			});
        });		
	});

	$("#username, #password").focus(function(event){
		$("#message").empty();
		$("#message").hide();
	});

</script>


</html>