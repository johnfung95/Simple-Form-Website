function calculateTotal() {

    var arr = document.getElementsByClassName("qty");
    var arrCount = arr.length;
    var amount = new Array();
    
    for (var i = 0;i < arrCount; i++) {
        qty = arr[i].value;

        if (qty == 0 || qty == "") {
            amount = "";
        } else {
            price = document.getElementsByClassName("price")[i].value;
            amount = price * qty;
        }
        
        document.getElementsByClassName("amount")[i].value = amount;
    }
}

function calculateSubTotal() {
    var arr = document.getElementsByClassName("amount");
    var arrCount = arr.length;
    var amount = 0;
    var subTotal = 0;

    for(var i=0;i < arrCount;i++) {
        amount = arr[i].value * 1;
        console.log(amount);
        subTotal += amount;
    }

    document.getElementsByClassName("subTotal")[0].value = "";
    document.getElementsByClassName("subTotal")[0].value = subTotal;
    console.log(subTotal);
}

function calculateDiscount() {
    var subTotal = document.getElementsByClassName("subTotal")[0].value;
    var discount = subTotal * 0.9;


    document.getElementsByClassName("discount")[0].value = "";
    document.getElementsByClassName("discount")[0].value = discount;
    console.log(discount);
}

function calculateDeliveryCharges() {
    var subTotal = document.getElementsByClassName("subTotal")[0].value;

    if (subTotal >= 1000) {
        charges = 100;
    } else {
        charges = 50;
    }

    document.getElementsByClassName("charges")[0].value = charges;
    console.log(charges);
}

function calculateGrandTotal() {
    var discount = document.getElementsByClassName("discount")[0].value;
    var charges = document.getElementsByClassName("charges")[0].value;
    var grand = 0;

    var grand = (discount * 1) + (charges * 1);

    document.getElementsByClassName("grandTotal")[0].value = "";
    document.getElementsByClassName("grandTotal")[0].value = grand;
    console.log(grand);
}

function getToday() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth();
    var yy = today.getFullYear();
    var message = "Date: ";

    message += dd + "/" + mm + "/" + yy;

    document.getElementById("datePlaceHolder").innerHTML = message;
}

$(".qty").focus (function( event ) {
    event.preventDefault();
    console.log("on blur " + event.type);	

    // set background color 	
    $(this).css( { 'background-color' : 'yellow' } );	
    calculateTotal();
    calculateSubTotal();
    calculateDiscount();
    calculateDeliveryCharges();
    calculateGrandTotal();
});

$(".qty").blur( function(event) {
    event.preventDefault();			
    console.log("on blur " + event.target);

    document.getElementsByClassName("subTotal")[0].value = '';
    // restore background color 		
    $(this).css( { 'background-color' : 'white' } );
    calculateTotal();
    calculateSubTotal();
    calculateDiscount();
    calculateDeliveryCharges();
    calculateGrandTotal();
});

$(document).ready(function() {
    $("#orderForm").submit( function(event) {
        event.preventDefault();
        $("#submitBtn").prop('disabled', true);

        console.log("submit");
        
        var orderForm = $("#orderForm").serialize();
        var timeStamp = new Date().YYYYMMDDHHMMSS();
        console.log(timeStamp);
        var td = document.getElementById("outcomeMessage");
        td.innerHTML = "Thank you for your Purchase. Your reference number is " + timeStamp;

        $.ajax({ 											
            type 		: 'POST', 								
            url 		: 'action3.php', 					
            data 		: orderForm, 		
            dataType 	: 'json',
            
            success 	: function(data) {

                if ( ! data.success ) { 
                    $("#outcomeMessage").fadeIn(1000).append('<p>Order Failed</p>');    
                    $("#outcomeMessage").show();
                    console.log("Failed");
                }
                else {
                    $("#outcomeMessage").fadeIn(1000).append('<p>' + data.success + '</p>');    
                    $("#outcomeMessage").fadeIn(1000).append('<p>' + data.message + '</p>');    
                    $("#outcomeMessage").show();
                    console.log("success");
                    console.log(data.success);
                    console.log(data.message);
                    console.log(data.errors);
                    console.log(data.tranStatus);
                }	
            }
        });
    });
});

$("#resetBtn").click(function(event){
    $("#submitBtn").prop('disabled', false);
    var td = document.getElementById("outcomeMessage");
    td.innerHTML="";
});

Object.defineProperty(Date.prototype, 'YYYYMMDDHHMMSS', {
    value: function() {
        function pad2(n) {  // always returns a string
            return (n < 10 ? '0' : '') + n;
        }

        return this.getFullYear() +
               pad2(this.getMonth() + 1) + 
               pad2(this.getDate()) +
               pad2(this.getHours()) +
               pad2(this.getMinutes()) +
               pad2(this.getSeconds());
    }
});
