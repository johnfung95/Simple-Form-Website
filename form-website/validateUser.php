<?php
	
	// Array to return for the invoking program
	$errors 	= array(); 							// To store errors
    $form_data 	= array(); 							// Pass back the data to the calling program 'login.php'

	// POST variables
	$username = $_POST['username'];
	$password = $_POST['password'];
    
	// Inlude Files
	include_once ('db_connect.php');	
	
    // Check username	
	if (empty($username)) { 						// Name cannot be empty
		$errors['username'] = 'Name cannot be blank';		
    }
 
    if (empty($password)) { 						// Password cannot be empty
        $errors['password'] = 'Password cannot be blank';
    }
	
    if ( ! empty($errors ) ) { 						// If errors array already contain items
    	$form_data['success'] = false;
    	$form_data['errors']  = $errors;			// include the errors array to the form_data array for passing back to invoking program
    } 
	else { 											// If errors is still empty, process the form

		// Set up a SQL enquiry statement
		$strSQL  = " SELECT * FROM user WHERE `userName` =  '$username' AND `password` = '$password' " ;
	
		// Execute the SQL statement
		$result = mysqli_query($con, $strSQL);	
	
		// Check whether the SQL is properly executed.  Immediate stop if error
		if (! $result) {    
			die( "Database access failed: " . mysqli_error() ); 
		}
		
		// Find out only one record is obtained
		$recCount = mysqli_num_rows($result); 

		if ($recCount == 1) 
		{
			// For legitmate user : set up a session variable
			$_SESSION['restaurant'] = "rest";
		
			// Set up a return message
			$form_data['success'] = true;
			$form_data['posted'] = $username .  ' - Login Successfully';			
		} 
		else 
		{
			// For non-legitmate user : set up errors element and 
			// include it to the form_data array for passing back to invoking program
			$form_data['success'] = false;
			$errors['username'] = 'Name and Password Invalid';				
			$form_data['errors']  = $errors;			
		}			
    }

    // Return the form_data back to invoking program
    echo json_encode($form_data);
?>