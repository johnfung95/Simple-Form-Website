
$(document).ready(function() {
    $("#recForm").submit( function(event) {
        event.preventDefault();
        $("#submitBtn").prop('disabled', true);

        console.log("submit");

        var recForm = $("#recForm").serialize();
        var refNo = document.getElementById("refNo").value;
        console.log(refNo);

        $.ajax({ 											
            type 		: 'POST', 								
            url 		: 'getRec13.php', 					
            data 		: recForm, 		
            dataType 	: 'json',
            
            success 	: function(data) {
                if ( ! data.success ) { 
                    $('#outcomeMessage').fadeIn(1000).append('<p>Record Retrieve Fail</p>');    
                    $('#outcomeMessage').show();
                    console.log("Fail");
                }
                else {
                    $('#outcomeMessage').fadeIn(1000).append('<p>' + data.success + '</p>');    
                    $('#outcomeMessage').show();
                    $('#result-table').append(data.message);
                    console.log(data.message);
                }				
            }
        });
    });
});

$("#resetBtn").click(function(event){
    $("#submitBtn").prop('disabled', false);
    var td = document.getElementById("outcomeMessage");
    td.innerHTML="";
    var result = document.getElementById("result-table");
    result.innerHTML = "";
});
