	$(document).ready(function() {
		
		$("#E-3").slideUp();
		//FUNCTION IF SUBMIT IS PRESSED
		$("#FIRST-LOGIN-FORM").submit(function(e){
			e.preventDefault();
			
											
			//DISPLAY THE LOADER
			$("#loader").show();
			
			//COLLECTS ALL DATA FROM FORM AND MAKES A SINGLE STRING FOR POST
			dataString = $("#FIRST-LOGIN-FORM").serialize();
			
			$.ajax({
			type: "POST",
			url: "FirstLogin.php",
			data: dataString,
			dataType: "json",
			success: 
				
				function(result) {
	
					setTimeout(function(){
						
						$("#E-1").css('color', 'rgba(0,0,0,0)');
						$("#E-2").css('color', 'rgba(0,0,0,0)');
						$("#E-3").css('color', 'rgba(0,0,0,0)');
						
						if(result.indexOf("3")!=1 || result.indexOf("4")!=1)
						{
							$("#E-3").fadeOut(500);
						}
					
						if($.trim(result) == 'VALID')
						{
							$('#first-login').fadeOut(1000);
							$('#address').delay(1000).fadeIn(500);
						}
						else
						{
							$.each(result, function( index, value ) {
								if(value==1)
								{
									$("#E-1").css('color', 'rgba(0,0,0,1)');
								}
								if(value==2)
								{
									$("#E-2").css('color', 'rgba(0,0,0,1)');
								}
								if(value==3)
								{
									document.getElementById("E-3").innerHTML = "You haven't entered your birthday!";
									$("#E-3").css('color', 'rgba(0,0,0,1)');
									$("#E-3").fadeIn();
								
								}
								if(value==4)
								{
									document.getElementById("E-3").innerHTML = "Your birthday appears to be invalid!";
									$("#E-3").css('color', 'rgba(0,0,0,1)');
									$("#E-3").fadeIn();
								}	
								if(value==5)
								{
									document.getElementById("E-3").innerHTML = "The password is too short. It has to have 8 characters.";
									$("#E-3").css('color', 'rgba(0,0,0,1)');
									$("#E-3").fadeIn();
								}
								
							});
	
						}

						$("#loader").css("display","none");			
					},1000);
					
				}
				
			});  
			
		});	
	
		
		//FUNCTION IF SUBMIT IS PRESSED
		$("#ADDRESS-FORM").submit(function(e){
			e.preventDefault();
			
											
			//DISPLAY THE LOADER
			$("#loader-2").show();
			
			//COLLECTS ALL DATA FROM FORM AND MAKES A SINGLE STRING FOR POST
			dataString = $("#ADDRESS-FORM").serialize();
			
			$.ajax({
			type: "POST",
			url: "Address.php",
			data: dataString,
			dataType: "json",
			success: 
				
				function(result) {
	
					setTimeout(function(){
						
						$("#E-A").css('color', 'rgba(0,0,0,0)');
						
						if($.trim(result) == 'VALID')
						{
							$('#address').fadeOut(1000);
							$('#admin-confirm').delay(1000).fadeIn(500);

						}
						else
						{
								$("#E-A").css('color', 'rgba(0,0,0,1)');
																
						}
	

						$("#loader-2").css("display","none");			
					},1000);
					
				}
				
			});  
			
		});	
	
	
	
	});	