var itemID;
var title;

function loadItems()
{
	
	$("#load").empty();
	var title, publisher, image, item_id, color = "#E5E5E5", dataString  = 'ACTION=' + 'load';
	$.post('scripts/adminBorrowedItems.php', dataString,  function success(data){

		var json = JSON.parse(data);
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

			var itemDiv=  "<div class='ITEM-LIST' style='padding: 5px; background: #DDD;'>" +
										"<div style='float: left; width: 80px; text-align: center; box-sizing: border-box; padding: 10px;  height: 100%;  background: #AAA;'>" +
											"<text style='font-size: 18px; color: #333;'>ITEM ID</text><br>" +
											"<text style='font-size: 22px; color: #333;'><b>LIB-"+item_id+"</b></text><br>" +
										"</div>" +
										"<div style='float: left; margin-left: 10px;'>" +
											"<text style='font-size: 18px; color: #333;'><b>"+title+"</b></text><text style='font-size: 15px; color: #333;'> by "+publisher+"</text><br>" +
											"<text style='font-size: 16px; color: #333;'><b>OWNER: </b>" + owner_name +"<b> BORROWER: </b>" + borrower_name + " <br><b>BORROWED ON: </b>" + borrowTime +"</b></text><br>" +
										"</div>" +
								"</div>";
			
			$("#load").append(unescape(itemDiv));
		
		});			
	});
}

function loadItems2()
{
	
	$("#load2").empty();
	var title, publisher, image, item_id, color = "#E5E5E5", dataString  = 'ACTION=' + 'load2';
	$.post('scripts/adminBorrowedItems.php', dataString,  function success(data){

		var json = JSON.parse(data);
		$.each(json,function(index, value){
			$.each(value,function(index2, value2){
				title = value['TITLE FULL'];
				publisher = value['PUBLISHER'];
				item_id = value['ID'];
				owner_name = value['OWNER NAME' ];
				image = "../images/items/"+value['IMAGE' ];	
			});

			if(color === "#E5E5E5")
				color = "#CDCDCD";
			else
				color = "#E5E5E5";

			var itemDiv=  "<div class='ITEM-LIST viewer' style='padding: 5px;' id='item-"+item_id+"'>" +
										"<div style='float: left; width: 80px; text-align: center; box-sizing: border-box; padding: 5px;  height: 100%;  background: #AAA;'>" +
											"<text style='font-size: 18px; color: #333;'>ITEM ID</text><br>" +
											"<text style='font-size: 22px; color: #333;'><b>LIB-"+item_id+"</b></text><br>" +
										"</div>" +
										"<div style='float: left; margin-left: 10px; box-sizing: border-box; width: 500px; padding: 10px;'>" +
											"<div style='width: 500px; overflow: hidden; height: 18px; margin-bottom: 10px;'><text style='font-size: 18px; color: #333;'><b>"+title+"</b></text><text style='font-size: 15px; color: #333;'> by "+publisher+"</text></div>" +
											"<text style='font-size: 16px; color: #333;'><b>OWNER: </b>" + owner_name +"</text><br>" +
										"</div>" +
								"</div>";
			
			$("#load2").append(unescape(itemDiv));
		
		});			
	});
}

$(document).on("click",".viewer",function(e){
	
		var button = $(this).attr("id");
		var array= button.split('-');
		window.location.href="../library/display.php?ITEM_ID="+array[1];
	
});


$(document).ready( function(){
	loadItems();
	loadItems2();
});