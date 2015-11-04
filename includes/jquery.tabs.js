function TabSelector() {

	var openID

	$(".button").click(function(){
	
	
		var button = $(this).attr('id');

		
		if(openID!=button)
		{
			$('.containers').fadeOut(300);
			$('.button').animate({backgroundColor: "#EEE", "color": "#000"}, 100);
			$("#" + button + "Div").fadeIn(300);
			$("#" + button).animate({backgroundColor: AppBaseColor, "color": "white"}, 100);
			openID = button;
		}
		else
		{
			//Do nothing
		}
		
	});
};
		