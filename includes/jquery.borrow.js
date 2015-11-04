

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

var ITEM_ID = getUrlVars()["ITEM_ID"];

function overlayShow()
{	
	$('#BODY-OVERLAY').fadeIn(500);
	noScroll();
}

function overlayHide()
{

	$('#BODY-OVERLAY').fadeOut(500);
	yesScroll();

}




function notification(title, textBefore, textAfter, type) {
	
	if(type === "success")
	{
		$( "<div id='notification' class='notification green'>" + 
				"<text style='font-size: 30px;'>" +
					"<i class='fa fa-check'></i> &nbsp; " + textBefore +" <b>"+ title +"</b> " + textAfter+
				"</text>"+
			"</div>"
		).appendTo('#BODY-OVERLAY').hide().fadeIn(500);
		$("#notification").delay(2500).fadeOut(1000);        
		setTimeout(function(){
			  $("#notification").remove();        
		  }, 4500);
	}else
	{
		$( "<div id='notification' class='notification red'>" + 
				"<text style='font-size: 30px;'>" +
					"<i class='fa fa-remove'></i> &nbsp;"+ textBefore +" <b>"+ title +"</b> " + textAfter+
				"</text>"+
			"</div>"
		).appendTo('#BODY-OVERLAY').hide().fadeIn(500);
		$("#notification").delay(2500).fadeOut(1000);        
		setTimeout(function(){
			  $("#notification").remove();        
		  }, 4500);	
	}
}

function noScroll(){
	$('html, body').delay(1500).css({
		'overflow': 'hidden',
		'height': '100%'
	});
}

function yesScroll(){
	$('html, body').delay(1500).css({
		'overflow': 'auto',
		'height': 'auto'
	});
}

function alertShow()
{
	$("#ALERT").fadeIn(500);
	noScroll();
}

function alertHide()
{
	$("#ALERT").fadeOut(500);
	yesScroll();
}


$(document).ready(function(){


$("#notif-close").click(function()
{
	alertHide();
});

	$("#itunes, #wishlist").click(function()
	{
												alertShow();
						$('#BODY').delay(1500).css('overflow', 'hidden');
					$("#notification-text").text("This feature is coming soon!");
	});
	
	
		$(".otherItem").click(function(){
			alert("apple");
			var myid = $(this).attr('id');
			window.open('../display.php?ITEM_ID='+myid, '_blank');
		});
	
	$("#google").click(function()
	{
			var title = $("#gettitle").text();
			var author = $("#getauthor").text();
			window.open('http://www.google.com/search?q=' + title +"+"+ author, '_blank');
	});

	$("#gamespot").click(function()
	{
			var title = $("#gettitle").text();
						window.open('http://www.gamespot.com/search/?q=' + title, '_blank');
	});
	

	$("#goodreads").click(function()
	{
			var title = $("#gettitle").text();
						window.open('http://www.goodreads.com/search?&query=' + title, '_blank');
	});
	
	$("#imdb").click(function()
	{
			var title = $("#gettitle").text();
						window.open('http://www.imdb.com/find?q=' + title, '_blank');
	});

	$("#flipkart").click(function()
	{
			var title = $("#gettitle").text();
						window.open('http://www.flipkart.com/search?q=' + title + '&affid=adminlibro', '_blank');
	});


$("#close2").click(function(){
	
	$("#borrow").removeClass( "bounceInLeft" );
	$("#borrow").addClass( "bounceOutLeft" );
	
	setTimeout(function(){
	overlayHide();
		
	}, 500);
	setTimeout(function(){
		
		$("#borrow").addClass( "bounceInLeft" );
		$("#borrow").removeClass( "bounceOutLeft" );
		
	},1000);

});


	$(".YesNo").click(function(){
		var button = $(this).attr('id');
		var array= button.split('-');
		var title = $("#gettitle").text();
		if(array[0]  === "BORROW")
		{
			if(array[1]  === "YES")
			{
				dataString  = 'ITEM_ID=' + ITEM_ID + '&ACTION=' + 'BORROW';
				$.post('../includes/borrowItem.php', dataString,  function success(data){
					if(data.trim() == "maximum request limit")
					{
						notification(title.trim(), "Request for", "has not been placed.<br>You have reached maximum borrow requests.","failed")
						setTimeout( function(){
							overlayHide();
							 location.reload();
						}, 3000);
					}
					else
					{
						notification(title.trim(), "Request for", "has been placed!","success")
						setTimeout( function(){
							overlayHide();
							
						}, 3000);
						setTimeout( function(){
							 location.reload();
							
						}, 4000);
					}
				});	
			}else
			{
							$("#borrow").removeClass( "bounceInLeft" );
							$("#borrow").addClass( "bounceOutLeft" );
							
							setTimeout(function(){
							overlayHide();
								
							}, 500);
							setTimeout(function(){
								
								$("#borrow").addClass( "bounceInLeft" );
								$("#borrow").removeClass( "bounceOutLeft" );
								
							},1000);


							}
		}
	});
	

	$("#LIBRARY-BORROW-NOW").click(function(){

		var title = $("#gettitle").text();
		var dataString = 'ITEM_ID=' + ITEM_ID + '&ACTION=CHECK';
		
		$.post('../includes/borrowItem.php', dataString,  function success(data){
		
				if(confirmed==false)
				{
				    data = "CWA";
				}
				
				if(data.trim() === "available")
				{
					 overlayShow();
					 $("#title").text(title.trim());
					 $("#borrow").show();
				}
				else if(data.trim() === "all borrowed")
				{
					alertShow();
					$("#notification-text").text("Sorry! All copies of this item are borrowed. Check again later!");
					
				}
				else if(data.trim() === "CWA")
				{
					alertShow();
					$("#notification-text").text("Your account has to be activated by your community administator before you can start borrowing!");
					
				}			
				else if(data.trim() === "creditError")
				{
					alertShow();
					$("#notification-text").html("You don't have enough credits! Find out how to get more from <a style='color:#333; font-size: 25px;' href='../dashboard/credits.php'><b>here</b></a>.");
				}
				else if(data.trim() === "owner")
				{
					alertShow();
					$("#notification-text").text("Whoops. You're trying to borrow your own item or an item that you own!");
				}
				else if(data.trim() ==="not signed in")
				{
					alertShow();
					$("#notification-text").text("You need to login to borrow this item!");
				}
				else if($.isNumeric(data.trim()) == true)
				{
					alertShow();
					$("#notification-text").html("This copy is borrowed, but we have found another copy! Click <a style='color: #333; font-size: 25px;' href='display.php?ITEM_ID="+data.trim()+"'><b>here</b></a> to go to it.");
				}

		});
		
	});

});