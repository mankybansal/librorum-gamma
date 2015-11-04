	$(document).ready(function() {

		//FUNCTION IF SUBMIT IS PRESSED
		$("#CHANGE-PASSWORD").submit(function(e){
			e.preventDefault();
										
			//DISPLAY THE LOADER
			$("#loader").show();
			
			//COLLECTS ALL DATA FROM FORM AND MAKES A SINGLE STRING FOR POST
			dataString = $("#CHANGE-PASSWORD").serialize();
			
			$.ajax({
			type: "POST",
			url: "ChangePass.php",
			data: dataString,
			dataType: "json",
			success: 
				
				function(result) {
	
					setTimeout(function(){
						
						$("#E-1").hide();
						$("#E-2").hide();

						if($.trim(result) == 'VALID')
						{
							$("#SETTINGS2").slideUp(400);
							$("#SETTINGS1").delay(400).slideDown(600);
						}
						else
						{
							$.each(result, function( index, value ) {
								if(value==1)
								{
									$("#E-1").show();
								}
								if(value==2)
								{
									$("#E-2").show();
								}
								if(value==3)
								{
									$("#E-3").show();
								}								
							});
	
						}

						$("#loader").css("display","none");			
					},1000);
					
				}
				
			});  
			
		});	
	
	});	