<?php
	// Include Files
	include_once ('db_connect.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Space Catering Company</title>
        <meta http-equiv="Content-Type" content="text.html; charset=UTF-8"/>
        <link rel="stylesheet" href= "order.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
	      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>	
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

	<?php
		echo <<< requestRef
		<div class="table-container">
			<form id="recForm">
				<table class="recTable">
					<tr>
						<td>
							<input type='text' id='refNo' name='refNo' value='Reference Number here'/>
						</td>
					</tr>
					<tr>
						<td colspan="4" id="outcomeMessage"></td>
						<td>
							<button type="submit" id="submitBtn">Submit</button>
						</td>
						<td>
							<button type="reset" id="resetBtn">Reset</button>
						</td>
					</tr>
					<table id="result-table">

		requestRef;

		echo <<< requestEnd
				</table>
			</form>
		</div>
	
		requestEnd;
	?>
	</body>

	<script  type="text/javascript" src="checkRec16.js">
		$("#submitBtn").click( function(event) {
			event.preventDefault();
			$("#submitBtn").prop('disabled', true);
			console.log("submit");

			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var newObj = JSON.parse(this.responseText);
					document.getElementById("outcomeMessage").innerHTML = newObj[0];
				}
			};
			xmlhttp.open("GET", "getRec12.php", true);
			xmlhttp.send();
		});
	</script>
</html>