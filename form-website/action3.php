<?php

    // Array to return for the invoking program
    $errors     = array();              // To store errors
    $form_data  = array();              // Pass back the data to the calling program 
    $refNo = "";
    $message = "";

    include "db_connect.php";
    $tranStatus = "success";
    
    // Obtain the POST variables
    $refNo = date( "Ymdhms", strtotime( now ) );
    
    $subTotal = $_POST['subTotal'];
    $discount = $_POST['discount'];
    $charges = $_POST['charges'];
    $grandTotal = $_POST['grandTotal'];

    for ($i=0; $i<count($_POST['item']); $i++)  {
        $temp = $_POST['amount'][$i];
        echo $temp;

        if (!empty($temp)) {
            $productName[]      = $_POST['productName'][$i];
            $qty[]              = $_POST['qty'][$i];
            $price[]            = $_POST['price'][$i];      
            $amount[]           = $_POST['amount'][$i]; 
        }
    }
    
    // Insert to wage table
    $strSQL = " INSERT INTO total (" .
              " subTotal, discount, charges, grandTotal, refNo ) " .
              " VALUES ('$subTotal', '$discount','$charges', '$grandTotal', '$refNo') ";
 
    //execute SQL statement 
    $result = mysqli_query($con, $strSQL);
 
    if (! $result) { 
        $tranStatus = "fail";
        $errors['master'] = "Insert New Order Master Fail!";
        // die( "Database access failed: " . $strSQL .  mysqli_error() ); 
    }         

    // Insert to wageDetail table   
    if ($tranStatus == "success") {
        
        for ($i=0; $i<sizeof($productName); $i++) {
            
            // prepare SQL statement for insert to wageDetail table
            $strSQL1 =  " INSERT INTO orderForm (" .
                        "   description, quantity, price, amount, refNo )" .
                        " VALUES " .
                        "  ('$productName[$i]', '$qty[$i]', '$price[$i]', '$amount[$i]', '$refNo')";
        
            $result1 = mysqli_query($con, $strSQL1);
    
            if (! $result1) { 
                $tranStatus = "fail";
                $errors['detail'] = "Insert New Order Detail Fail!";
                // die( "Database access failed: " . $strSQL1. mysqli_error() );
            }
        }
    } 
    
    // Result
    if ($tranStatus == "success") {
        $form_data['success'] = "Record Added with ID : " . $refNo ;
        // echo "Record Added with ID : " . $last_id;
        $form_data['refNo'] = $refNo;
        $message .= $refNo;
        $form_data['message'] = $message;

    }
    
    echo json_encode($form_data);
?>
