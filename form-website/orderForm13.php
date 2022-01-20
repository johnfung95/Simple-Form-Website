<?php
    include "db_connect.php";
    include "includeHeading.php";

    $strSQL = " SELECT * FROM products ";

    $result = mysqli_query($con, $strSQL);

    if(! $result) {
        die("Datebase access failed ".mysqli_error());
    }

    $recCount = mysqli_num_rows($result);

    if ($recCount == 0) {
        echo "No Inventory Record";
    } else {
        for ($i = 0;$i < $recCount; $i++) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $productName[] = $row['description'];
            $price[] = $row['price'];
            $photo[] = $row['photoDir'];
        }
    }
?>
   <body onLoad="javascript:getToday();">
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
            echo <<< tableHead
            <div class="table-container">
            <!--list products-->
                <form id="orderForm">
                    <table class="orderTable">
                        <thead class="infoBar">
                            <tr>
                                <th colspan="3" class="companyName">
                                    Space Catering
                                </th>
                                <th colspan="3" class="userName">
                                    UserName
                                </th>
                            </tr>
                        </thead>
                        <thead class="titleBar" style="text-align:center;">
                            <th colspan="6">
                                Food Order Form
                            </th>
                        </thead>
                        <tr class="dateBar">
                            <td colspan="6" id="datePlaceHolder">
                                <!--called by external js function getDate()-->
                            </td>
                        </tr>
                        <tr class="listItem">
                            <td>
                                Item
                            </td>
                            <td>
                                Description
                            </td>
                            <td>
                                Picture
                            </td>
                            <td>
                                Quantity
                            </td>
                            <td>
                                Price ($)
                            </td>
                            <td>
                                Amount ($)
                            </td>
                        </tr>
            tableHead;

                for ($i=0; $i<$recCount; $i++) {
                    $temp = $i + 1;
                    if ($i == 0) {
                        $pic = "img/grape-juice.png";
                    } else if ($i == 1) {
                        $pic = "img/fresh-tomato-juice.jpg";
                    } else if ($i == 2) {
                        $pic = "img/banana-juice.png";
                    } else if ($i == 3) {
                        $pic = "img/potato-juice.png";
                    } else if ($i == 4) {
                        $pic = "img/apple-juice.png";
                    }

                    echo <<< tableDetail
                        <tr id="productInfo">
                            <td>
                                <input type='text' class='item' name='item[$i]' value=$temp readonly/>
                            </td>
                            <td>
                                <input type='text' class='productName' name='productName[$i]' value='$productName[$i]' readonly/>
                            </td>
                            <td><img src='$pic' class='productPic'></td>
                            <td><input type='number' label='qty' class='qty' name='qty[$i]' min=0></td>
                            <td><input type='number' label='price' name='price[$i]' class='price' readonly value='$price[$i]'></td>
                            <td><input type='number' label='amount' class='amount' name='amount[$i]' readonly></td>
                        </tr>
                    tableDetail;
                }

                    echo <<< tableTotal
                        <tr class="listItem">
                            <td rowspan="4" colspan="4"></td>
                            <td>Sub Total</td>
                            <td>
                                <input type="number" label="subTotal" class="subTotal" name="subTotal" readonly>
                            </td>
                        </tr>
                        <tr class="listItem">
                            <td>Discount</td>
                            <td>
                                <input type="number" label="discount" class="discount" name="discount" readonly>
                            </td>
                        </tr>
                        <tr class="listItem">
                            <td>Delivery Charges</td>
                            <td>
                                <input type="number" label="charges" class="charges" name="charges" readonly>
                            </td>
                        </tr>
                        <tr class="listItem">
                            <td>Grand Total</td>
                            <td>
                                <input type="number" label="grandTotal" class="grandTotal" name="grandTotal" readonly>
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
                        <tr class="copyRightLogo" style="border: 1px solid tomato;">
                            <td colspan="6">
                                &copy by Spacing Catering Company
                            </td>
                        </tr>
                        </div>
                    </table>
                </form>
            </div>
            tableTotal;

            echo <<< Footer

            </body>
        Footer;
    ?>
    <script type="text/javascript" src="scripting22.js">
        ("#submitBtn").click(function(event) {
            event.preventdefault();
            $("#submitBtn").prop('disabled', true);
        });
    </script>
</html>