	$(document).ready(function() {
	
		//HIDE ERROR MESSAGES AND SHOW SPACER
		$("#ERROR1").hide();
		$("#ERROR2").hide();
		$("#ERROR3").hide();
		$("#FILL").show();
		
		//FUNCTION IF SUBMIT IS PRESSED
		$("#LOGIN-FORM").submit(function(e){
			e.preventDefault();
			
			$("#LOGIN-SUBMIT").css("background-image","url('loader.gif')");
	
			//COLLECTS ALL DATA FROM FORM AND MAKES A SINGLE STRING FOR POST
			dataString = $("#LOGIN-FORM").serialize();
			$.ajax({
			type: "POST",
			url: "CheckLogin.php",
			data: dataString,
			dataType: "json",
			success: 
				
				function(result) {

					if (result=="1") {	
						//RESULT 1 --> AUTHENTICATED
						setTimeout (function(){window.location.assign("../dashboard/")}, 3000);
					}
					else if (result=="2") {
						//SHOW ERROR 1
						//RESULT 2 --> CREDENIALS WRONG
						setTimeout (function(){
							$("#ERROR1").show();
							$("#ERROR2").hide();
							$("#ERROR3").hide();
							$("#LOGOUT").hide();
							$("#FILL").hide();
							$("#LOGIN-SUBMIT").css("background-image","url('go.png')");
						}, 1000);
						
					}
					else if (result=="3") {
						//SHOW ERROR 2
						//RESULT 3 --> USERNAME OR PASSWORD EMPTY
						setTimeout (function(){
							$("#ERROR1").hide();
							$("#ERROR2").show();
							$("#ERROR3").hide();
							$("#LOGOUT").hide();
							$("#FILL").hide();
							$("#LOGIN-SUBMIT").css("background-image","url('go.png')");
						}, 1000);
						
					}
					else
					{
						//SHOW ERROR 3
						//RESULT DEFAULT --> UNEXPECTED ERROR
						setTimeout (function(){
							$("#ERROR1").hide();
							$("#ERROR2").hide();
							$("#ERROR3").show();
							$("#LOGOUT").hide();
							$("#FILL").hide();
								$("#LOGIN-SUBMIT").css("background-image","url('go.png')");
						}, 2000);
					
					}
				}
			});  
			
		});	
	});	