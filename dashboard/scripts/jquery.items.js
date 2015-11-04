var itemID;
var title;

function loadItems()
{
	$("#load").empty();
	var title, publisher, image, item_id, color = "#E5E5E5", dataString  = 'ACTION=' + 'load';;
	$.post('scripts/myItems.php', dataString,  function success(data){
		var json = JSON.parse(data);	
		

		if(json.length==0 || json==null)
		{
			$("#load").append(unescape("<div style='width: 100%; box-sizing: border-box; padding: 150px;  height: 100%; background: #F2D013; '><text style='font-size: 25px; '><b>You haven't added any items</b></text></div>"));
		}
		
		$.each(json,function(index, value){
			$.each(value,function(index2, value2){
				title = value['TITLE SHORT'];
				publisher = value['PUBLISHER' ];
				item_id = value['ID' ];
				image = "../images/items/"+value['IMAGE' ];	
			});

			if(color === "#E5E5E5")
				color = "#CDCDCD";
			else
				color = "#E5E5E5";

			var itemDiv=  "<div class='ITEM-LIST' style=\"background: url('"+image+"') "+color+" no-repeat; background-size: 70px 70px; background-position: 5px 5px;  \">" +
										"<div style='float: left;'>" +
											"<text style='font-size: 18px; color: #333;'>"+title+"</text><br>" +
											"<text style='font-size: 16px; color: #333;'>"+publisher+"</text>" +
										"</div>" +
										"<div style='float: right; height: 70px; margin-top: -10px; width: 200px; '>" +
											"<div class='item-actions' id='view-"+item_id+"'>" +
												"<text style='font-size: 15px; color: #333;' >VIEW</text>" +
											"</div>" +
											"<div class='item-actions' id='edit-"+item_id+"'>" +
												"<text style='font-size: 15px; color: #333;' >EDIT</text>" +
											"</div>" +
											"<div class='item-actions' id='remove-"+item_id+"'>" +
												"<text style='font-size: 15px; color: #333;' >REMOVE</text>" +
											"</div>"+
										"</div>" +
									"</div>";
			
			$("#load").append(unescape(itemDiv));
		});		
	});
}

$(document).on("click",".item-actions",function(e){

	$("#BODY-ACTIONS").fadeIn();

	var datastring;
	var button = $(this).attr('id');
	var array= button.split('-');
	
	$(".action-containers").hide();
	itemID = array[1];
	$("#" + array[0]).show();

	if(array[0]  === "remove")
	{
		dataString  = 'ITEM_ID=' + array[1] + '&ACTION=' + 'fetch';
		$.post('scripts/myItems.php', dataString,  function success(data){
			
			var item = jQuery.parseJSON(data);
			$(".title").text(item['TITLE FULL']);
			
			title = item['TITLE FULL'];
			
		});
	}
	else if(array[0]  === "edit")
	{
		dataString  = 'ITEM_ID=' + array[1] + '&ACTION=' + 'fetch';
		$.post('scripts/myItems.php', dataString,  function success(data){


		});		
	}			
	else if(array[0]  === "view")
	{
		window.location.href="../library/display.php?ITEM_ID="+array[1];
		dataString  = 'ITEM_ID=' + array[1] + '&ACTION=' + 'fetch';
		$.post('scripts/myItems.php', dataString,  function success(data){
		});		
	}
	
});		


function notification(title, text, type) {
	
	if(type === "success")
	{
		$( "<div id='notification' class='notification green'>" + 
				"<text style='font-size: 30px;'>" +
					"<i class='fa fa-check'></i> &nbsp;<b>" + title +"</b> " + text +
				"</text>"+
			"</div>"
		).appendTo('#BODY-ACTIONS').hide().fadeIn(1000);
		$("#notification").delay(2000).fadeOut(1000);        
		setTimeout(function(){
			  $("#notification").remove();        
		  }, 4000);
	}else
	{
		$( "<div id='notification' class='notification red'>" + 
				"<text style='font-size: 30px;'>" +
					"<i class='fa fa-check'></i> &nbsp;<b>" + title +"</b> " + text +
				"</text>"+
			"</div>"
		).appendTo('#BODY-ACTIONS').hide().fadeIn(1000);
		$("#notification").delay(2000).fadeOut(1000);        
		setTimeout(function(){
			  $("#notification").remove();        
		  }, 4000);	
	}
}

function loadItems2()
{
	
	$("#load3").empty();
	var title, publisher, image, item_id, color = "#E5E5E5", dataString  = 'ACTION=' + 'load';
	$.post('scripts/userBorrowedItems.php', dataString,  function success(data){

		var json = JSON.parse(data);
		
		if(json===null)
		{
			$("#load3").append(unescape("<div style='width: 100%; box-sizing: border-box; padding: 150px;  height: 100%; background: #F2D013; '><text style='font-size: 25px; '><b>No Borrowed Items</b></text></div>"));
		}

		$.each(json,function(index, value){
			$.each(value,function(index2, value2){
				title = value['TITLE FULL'];
				publisher = value['PUBLISHER'];
				item_id = value['ID'];
				owner_name = value['OWNER NAME' ];
				borrower_name = value['BORROWER NAME'];
				borrowTime = value['BORROW' ];
				returnTime = value['RETURN'];
				image = "../images/items/"+value['IMAGE' ];	
			});

			
			
			
			if(color === "#E5E5E5")
				color = "#CDCDCD";
			else
				color = "#E5E5E5";

			var itemDiv=  "<div class='ITEM-LIST2' style='padding: 5px; background: #DDD;'>" +
										"<div style='float: left; width: 80px; text-align: center; box-sizing: border-box; padding: 10px;  height: 100%;  background: #AAA;'>" +
											"<text style='font-size: 18px; color: #333;'>ITEM ID</text><br>" +
											"<text style='font-size: 22px; color: #333;'><b>LIB-"+item_id+"</b></text><br>" +
										"</div>" +
										"<div style='float: left; margin-left: 10px;'>" +
											"<text style='font-size: 18px; color: #333;'><b>"+title+"</b></text><text style='font-size: 15px; color: #333;'> by "+publisher+"</text><br>" +
											"<text style='font-size: 16px; color: #333;'><b>OWNER: </b>" + owner_name +"<b> BORROWER: </b>" + borrower_name + " <br><b>BORROWED ON: </b>" + borrowTime +"</b></text><br>" +
										"</div>" +
								"</div>";
			
			$("#load3").append(unescape(itemDiv));
		
		});			
	});
}

$(document).ready( function(){
	
	loadItems();
	loadItems2();
	$("#error").hide();
	
	$("#ITEM-SUBMIT").click(function(form){
		form.preventDefault();
		$("#error").text("");
		var data = $( "#ADD-ITEM" ).serialize();
		$.post( "scripts/add_item.php", data,
			function(result) {
				if($.trim(result) == '1')
				{
					$("#error").text("").hide();
					title = $("#TITLE").val();
					notification(title, "successfully added!", "success");
					document.getElementById("ADD-ITEM").reset();
					loadItems();
				}
				else
				{
					$("#error").show().text("You must fill everything.");
				}
		});
	 });

	$("#AddItem").click(function(){
		$("#BODY-ACTIONS").fadeIn();
		$(".action-containers").hide();
		$("#add").show();
	});
	
	$("#Button3").click(function(){
		$("#BODY-ACTIONS").fadeIn();
		$(".action-containers").hide();
		$("#add").show();
	});
	
	
	function overlayHide()
{

	$('#BODY-ACTIONS').fadeOut(500);
}


	$("#close").click(function(){
		$(".action-containers").removeClass( "bounceInLeft" );
		$(".action-containers").addClass( "bounceOutLeft" );

		setTimeout(function(){
		overlayHide();

		}, 500);
		setTimeout(function(){

			$(".action-containers").addClass( "bounceInLeft" );
			$(".action-containers").removeClass( "bounceOutLeft" );

		},1000);
		$("#LANDINGDiv").fadeIn(500);
		
	});	

	$("#close2").click(function(){
		$(".action-containers").removeClass( "bounceInLeft" );
		$(".action-containers").addClass( "bounceOutLeft" );

		setTimeout(function(){
		overlayHide();

		}, 500);
		setTimeout(function(){

			$(".action-containers").addClass( "bounceInLeft" );
			$(".action-containers").removeClass( "bounceOutLeft" );

		},1000);
		$("#LANDINGDiv").fadeIn(500);
	});	
	
	$(".YesNo").click(function(){
		var button = $(this).attr('id');
		var array= button.split('-');
		if(array[0]  === "REMOVE")
		{
			if(array[1]  === "YES")
			{
				dataString  = 'ITEM_ID=' + itemID + '&ACTION=' + 'remove';
				$.post('scripts/myItems.php', dataString,  function success(data){
					
					if(data.trim()==="FAILED")
					{
						notification(title, "is currently borrowed!", "fail");
						$("#BODY-ACTIONS").delay(3000).fadeOut(1000);
					}else
					{
						notification(title, "successfully removed!", "success");
						$("#BODY-ACTIONS").delay(3000).fadeOut(1000);
					}
					
					loadItems();
				});	
			}else
			{
				$("#BODY-ACTIONS").fadeOut();
			}
		}
	});

});
	
	