	$(document).ready(function() {
	
		//FUNCTION IF SUBMIT IS PRESSED
		$("#LOGOUT-FORM").submit(function(e){
			e.preventDefault();

			//COLLECTS ALL DATA FROM FORM AND MAKES A SINGLE STRING FOR POST
			dataString = $("#LOGOUT-FORM").serialize();
			$.ajax({
			type: "POST",
			url: "../accounts/logout.php",
			data: dataString,
			dataType: "json",
			success: 
				function(result) {
					if (result=="1") {	
						//RESULT 1 --> Logout True
						window.location.assign("../accounts/login.php?LOGOUT=TRUE")						
					}
				}
			   
			});  
			
		});	
	});	