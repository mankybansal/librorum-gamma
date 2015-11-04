	$(document).ready(function() {
	
		//FUNCTION IF SUBMIT IS PRESSED
		$("#SIGNUP-FORM").submit(function(e){
			e.preventDefault();		
			
			//DISPLAY THE LOADER
			$("#loader").show();
			
			//COLLECTS ALL DATA FROM FORM AND MAKES A SINGLE STRING FOR POST
			dataString = $("#SIGNUP-FORM").serialize();
			
			$.ajax({
			type: "POST",
			url: "SignUp.php",
			data: dataString,
			dataType: "json",
			success: 
				
				function(result) {
				setTimeout (function(){
				
					$(".error").css("color","#759E2F");
					$(".form").css("background","#FFF");
					
						if($.trim(result) == 'VALID')
						{
							var email = $("#F-3").val();
							
							$("#form").css('display', 'none');
							$("#complete").css('display', 'block');
							$("#email").text(email);
							
							var arr = email.split('@');
							if(arr[1] == 'gmail.com' || arr[1] == 'yahoo.com' || arr[1] == 'yahoo.co.in' || arr[1] == 'live.com' || arr[1] == 'reddif.com' || arr[1] == 'hotmail.com' )
							{
								$("#email-url").attr('onclick', "window.open('http://www." + arr[1] + "','_blank');");
							}
							else
							{
								$("#email-url").hide();
							}
							
						}
						else if($.trim(result) == 'EXISTS')
						{
							$("#E-7").css("color","#F8F8F8");
						}
						else
						{
							$.each(result, function( index, value ) {
								$("#F-" + value).css("background","#FEC1A7");
								$("#E-" + value).css("color","#F8F8F8");
							});
						
						}
						
						$("#loader").css("display","none");
					
				}, 1000);
					
				}
			});  
			
		});	
	});	