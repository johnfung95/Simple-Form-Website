<?php

    // Array to return for the invoking program
    $errors     = array();              // To store errors
    $form_data  = array();              // Pass back the data to the calling program 
    $message = "";

    include "db_connect.php";
    $tranStatus = "success";
    
    // Obtain the POST variables
    $refNo = $_POST['refNo'];
    if(! is_numeric($refNo)) {
        $tranStatus = "fail";
        $errors['master'] = "Retrive records failed";
    } else {
    // search in orderForm table
        $strSQL = "SELECT * FROM orderForm WHERE refNo = " .
                    $refNo;

        $result = mysqli_query($con, $strSQL);

        if (! $result)  { 
            $tranStatus = "fail";
            $errors['master'] = "Retrive records failed";
            // die( "Database access failed: " . $strSQL .  mysqli_error() ); 
        } else {
            $strSQL2 = "SELECT * FROM total WHERE refNo = " .
                        $refNo;

            $result2 =mysqli_query($con, $strSQL2);

            $recCount = mysqli_num_rows($result);
            $recount2 = mysqli_num_rows($result2);
        }

        if ($recCount == 0) {
            $message .= "No orders of the Reference number can be found, please revise your input.";
            $tranStatus = "fail";
        } else {
            $message .= "<tr class='listItem'>";
            $message .= "<td>Item</td>";
            $message .= "<td>Description</td>";
            $message .= "<td>Picture</td>";
            $message .= "<td>Quantity</td>";
            $message .= "<td>Price ($)</td>";
            $message .= "<td>Amount ($)</td>";
            $message .= "</tr>";

            for($i=0;$i<$recCount;$i++) {
                $temp = $i + 1;

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if ($row['description'] == "Grape Juice") {
                    $pic = "img/grape-juice.png ";
                } else if ($row['description'] == "Tomato Juice") {
                    $pic = "img/fresh-tomato-juice.jpg ";
                } else if ($row['description'] == "Banana Juice") {
                    $pic = "img/banana-juice.png ";
                } else if ($row['description'] == "Potato Juice") {
                    $pic = "img/potato-juice.png ";
                } else if ($row['description'] == "Apple Juice") {
                    $pic = "img/apple-juice.png ";
                }

                $message .= "<tr id='productInfo'>";
                $message .= "<td>" . $temp . "</td>";
                $message .= "<td>" . $row['description'] . "</td>";
                $message .= "<td class='productPic'>" . "<img src=" . $pic . " width='200' height='200'>" . "</td>";
                $message .= "<td>" . $row['quantity'] . "</td>";
                $message .= "<td>" . $row['price'] . "</td>";
                $message .= "<td>" . $row['amount'] . "</td>";
                $message .= "</tr>";
            }

            $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
            $message .= "<tr class='listItem'>";
            $message .= "<td rowspan='4' colspan='4'></td>";
            $message .= "<td>Sub Total</td>";
            $message .= "<td>" . $row2['subTotal'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr class='listItem'>";
            $message .= "<td>Discount</td>";
            $message .= "<td>" . $row2['discount'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr class='listItem'>";
            $message .= "<td>Delivery Charages</td>";
            $message .= "<td>" . $row2['charges'] . "</td>";
            $message .= "</tr>";
            $message .= "<tr class='listItem'>";
            $message .= "<td>Grand Total</td>";
            $message .= "<td>" . $row2['grandTotal'] . "</td>";
            $message .= "</tr>";
            $message .= "</table>";
        }
    }
    // Result
    if ($tranStatus == "success") {
        $form_data['success'] = "Record retrieved with ID : " . $refNo ;
        // $message .= "Record Added with ID : " . $last_id;
        $form_data['refNo'] = $refNo;
        $form_data['message'] = $message;
    } else {
        $form_data['refNo'] = $refNo;
        $form_data['message'] = $message;
    }
    
    echo json_encode($form_data);
?>