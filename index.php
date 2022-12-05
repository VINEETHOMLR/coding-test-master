<?php
error_reporting(E_ALL);    
ini_set('display_errors', 1);
//require "vendor/autoload.php";
require "config.php";
//require "functions.php";

?>
<!DOCTYPE html>
<html>
  <head>
    
    <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    
    <link rel="stylesheet"
          href=
"https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"
    />
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js">
   </script>
  
    
    <style>
      body {
        text-align: center;
      }
      p {
        font-size: 25px;
        font-weight: bold;
      }
      .success{
          color:#4caf50; 
      }
      .error{

      	color:#f00;

      }
    </style>
  </head>
<body>
    
  
 <input type="text" class="datetimepicker" />
 <span class='error'></span>
 <span class='success'></span>
 <br>
 <button type="button" onclick="placeorder()"> Place Order</button>

</body>
   
<script type="text/javascript">
     

$( ".datetimepicker" ).datetimepicker({
  format: 'Y-m-d H:i',
  changeMonth: true,
  changeYear: true
});


function placeorder()
{
	var selectedDate = $('.datetimepicker').val();
    $('.error').html("");
	if(!selectedDate) {

		$('.error').html("").html("Please select date time to proceed");
		return false;

	}

    var postForm = { 
            'date'     : selectedDate
        };
	$.ajax({
        url: "functions.php",
        type: "post",
        data: postForm ,
        success: function (response) {

           var newResp = JSON.parse(response);
           if(newResp['status'] == 'true') {
               
               $('.success').html("").html(newResp['msg']);
               return false;

           }else{

               $('.error').html("").html(newResp['msg']);
               return false;

           }

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });


	
}
    
</script>
</body>
</html>






