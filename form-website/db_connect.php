<? 
	error_reporting(E_ALL ^ E_WARNING);				// suppress warning
	
	DEFINE('DB_USER',       "epiz_27182518");
	DEFINE('DB_PASSWORD',   "kX9XCStliK6UB");
	DEFINE('DB_HOST',       "sql106.epizy.com");
	DEFINE('DB_NAME',       "epiz_27182518_rest");
 
	// Connect to MySQL
	$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	mysqli_set_charset($con,"utf8");	

	// Check connection
	if (mysqli_connect_error()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	else {
		//$message += "Connection OK for : " . DB_NAME;			
	}
?> 
   
   





