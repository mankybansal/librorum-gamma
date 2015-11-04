$(document).on("click",".item-actions",function(e){
		
	var datastring;
	var button = $(this).attr('id');
	var array= button.split('-');
	$("#"+button).css("background-color", "white");
	
	if($("#mySpinner"+array[1]).length)
	{
	}else
	{
		$("#"+button).prepend("<i id='mySpinner"+array[1]+"' style='margin-left: 3px;' class='fa fa-circle-o-notch fa-spin'></i>");
	} 
	
	itemID = array[1];
		//alert(array[0]);
		//alert(array[1]);
		dataString  = 'REQUEST_ID=' + array[1] + '&ACTION=' + array[0];
		$.post('scripts/notifications.php', dataString,  function success(data){

				setTimeout(function(){
					$("#"+button).css("background-color","");
					$('#mySpinner'+array[1]).remove();
				},3000);
		});
	
});	
	
$(document).on('click', '.user2', function(){
	$("#BODY-ACTIONS").fadeIn(500);
	$(".action-containers").hide();
	$("#deniedAcc").fadeIn(1000);
});

$(document).on('click', '.user', function(){
	var button = $(this).attr('class');
	var array= button.split(' ');
	
	$("#BODY-ACTIONS").fadeIn(500);
		$(".action-containers").hide();
	$("#user").fadeIn(1000);
	dataString  = 'REQUEST_ID=' + array[1];
	$.post('scripts/get_user.php', dataString,  function success(data){			
		var json = JSON.parse(data);
		$.each(json,function(index, value){
			$.each(value,function(index2, value2){
				user_name = value['NAME' ];
				user_email = value['EMAIL' ];
				user_phone = value['PHONE' ];
				user_address = value['ADDRESS' ];
				dp_link = value['DP_LINK' ];
			});
			
			$("span.user_1").text(user_name);
			$("span.user_2").text(user_email);
			$("span.user_3").text(user_phone);
			$("span.user_4").text(user_address);
			$("div.user_5").css({"background": "url('../images/users/"+dp_link+"') no-repeat", "background-size": "100% 100%"});
			
		});
	});	
	
	dataString  = 'REQUEST_ID=' + array[1];
	$.post('scripts/get_admin.php', dataString,  function success(data){			
		var json = JSON.parse(data);
		$.each(json,function(index, value){
			$.each(value,function(index2, value2){
				user_name = value['NAME'];
				user_email = value['EMAIL'];
				user_phone = value['PHONE'];
				user_address = value['ADDRESS'];
				dp_link = value['DP_LINK'];
			});
			
			$("span.admin_1").text(user_name);
			$("span.admin_2").text(user_email);
			$("span.admin_3").text(user_phone);
			$("span.admin_4").text(user_address);
			$("div.admin_5").css({"background": "url('../images/users/"+dp_link+"') no-repeat", "background-size": "100% 100%"});	
		});
	});		
});		

$(document).on('click', '#close2', function(){
	$("#BODY-ACTIONS").fadeOut(500);
});		

function getNotifications(request_id)
{
	var notifcation_id, color = "#7299C9", dataString  = 'ACTION=' + 'myNotifications' + '&REQUEST_ID=' + request_id;
	$.post('scripts/notifications.php', dataString,  function success(data){
		
		var json = JSON.parse(data);
		$.each(json,function(index, value){
			$.each(value,function(index2, value2){
				notification_id = value['NOTIFICATION_ID' ];
				notification_type = value['NOTIFICATION_TYPE' ];
				item_title = value['ITEM_TITLE' ];
				notif_date = value['DATE' ];
				name = value['NAME'];
				from_id = value['FROM_ID'];
			});
				
			var now = new Date(notif_date);
			now.format("yyyy-mm-dd HH:MM:ss");
			date = dateFormat(now, "dddd, dS mmmm , yyyy, h:MM:ss TT");
			
			var returnDate = new Date(notif_date);
			returnDate.setDate(returnDate.getDate() + 7);
			returnDate.format("yyyy-mm-dd HH:MM:ss");
			returnDate = dateFormat(returnDate, "dddd, dS mmmm , yyyy, h:MM:ss TT");
			
			
			if(color === "#7299C9")
				color = "#A9C1DE";
			else
				color = "#7299C9";
			
			
			if(notification_type === "ACCEPTED")
			{
				var itemDiv=  "<div class='ITEM-LIST '  id='N-"+notification_id+"-M'  style='background: "+color+";'>" +
									"<div style='float: left;'>" +
										"<text class='T333-18PX'><b><span class='user "+from_id+"'> "+name+"</span></b>  has <b>ACCEPTED</b> your request for: </text><br>" +
										"<text class='T333-25PX'>"+item_title+"</text><br>" +
										"<text class='T333-15PX'> ACCEPTED ON: <b>"+date+"</b></text><br>" +
										"<text class='T333-15PX'> RETURN ON: <b>"+returnDate+"</b></text>" +
									"</div>" +
									"<div class='actionContainer'>" +
										"<div class='item-actions' id='return-"+notification_id+"'>" +
											"<text class='T333-15PX' >&nbsp; RETURN NOW &nbsp;<i class='fa fa-reply'></i>&nbsp;</text>" +
										"</div>" +
									"</div>" +
								"</div>";
			
			}
			else if(notification_type === "DECLINED")
			{
				var itemDiv=  "<div class='ITEM-LIST '  id='N-"+notification_id+"-M'  style='background: "+color+";'>" +
									"<div style='float: left;'>" +
										"<text class='T333-18PX'><b>"+name+"</b>  has <b>DECLINED</b> your request for: </text><br>" +
										"<text class='T333-25PX'>"+item_title+"</text><br>" +
										"<text class='T333-15PX'> DECLINED ON: <b>"+date+"</b></text>" +
									"</div>" +
									"<div class='actionContainer'>" +
										"<div class='item-actions' id='clear-"+notification_id+"'>" +
											"<text class='T333-15PX' >&nbsp; REMOVE <i class='fa fa-remove'></i>&nbsp;</text>" +
										"</div>" +
									"</div>" +
								"</div>";
			}
			else if(notification_type === "RETURN")
			{
				var itemDiv=  "<div class='ITEM-LIST '  id='N-"+notification_id+"-M'  style='background: "+color+";'>" +
									"<div style='float: left;'>" +
										"<text class='T333-18PX'><b><span class='user "+from_id+"'> "+name+"</span></b>  has <b>REMINDED</b> you to pick up: </text><br>" +
										"<text class='T333-25PX'>"+item_title+"</text><br>" +
										"<text class='T333-15PX'> SENT ON: <b>"+date+"</b></text>" +
									"</div>" +
									"<div class='actionContainer'>" +
										"<div class='item-actions' id='clear-"+notification_id+"'>" +
											"<text class='T333-15PX' >REMOVE &nbsp; <i class='fa fa-remove'></i></text>" +
										"</div>" +
									"</div>" +
								"</div>";
			}
			else if(notification_type === "RETURNING")
			{
				var itemDiv=  "<div class='ITEM-LIST '  id='N-"+notification_id+"-M'  style='background: "+color+";'>" +
									"<div style='float: left;'>" +
										"<text class='T333-18PX'>You have requested <b><span class='user "+from_id+"'> "+name+"</span></b> to pick up: </text><br>" +
										"<text class='T333-25PX'>"+item_title+"</text><br>" +
										"<text class='T333-15PX'> SENT ON: <b>"+date+"</b></text>" +
									"</div>" +
									"<div class='actionContainer'>" +
										"<div class='item-actions' id='clear-"+notification_id+"'>" +
											"<text class='T333-15PX' >&nbsp; REMOVE <i class='fa fa-remove'></i>&nbsp;</text>" +
										"</div>" +
									"</div>" +
								"</div>";
			}
			else if(notification_type === "RETURN REMINDER")
			{
				var itemDiv=  "<div class='ITEM-LIST '  id='N-"+notification_id+"-M'  style='background: "+color+";'>" +
									"<div style='float: left;'>" +
										"<text class='T333-18PX'>You have reminded <b><span class='user "+from_id+"'> "+name+"</span></b> to return: </text><br>" +
										"<text class='T333-25PX'>"+item_title+"</text><br>" +
										"<text class='T333-15PX'> SENT ON: <b>"+date+"</b></text>" +
									"</div>" +
									"<div class='actionContainer'>" +
										"<div class='item-actions' id='clear-"+notification_id+"'>" +
											"<text class='T333-15PX' >&nbsp; REMOVE <i class='fa fa-remove'></i>&nbsp;</text>" +
										"</div>" +
									"</div>" +
								"</div>";
			}
			else if(notification_type === "RETURN REMINDED")
			{
				var itemDiv=  "<div class='ITEM-LIST '  id='N-"+notification_id+"-M'  style='background: "+color+";'>" +
									"<div style='float: left;'>" +
										"<text class='T333-18PX'><b><span class='user "+from_id+"'> "+name+"</span></b> is reminding you to return: </text><br>" +
										"<text class='T333-25PX'>"+item_title+"</text><br>" +
										"<text class='T333-15PX'> SENT ON: <b>"+date+"</b></text>" +
									"</div>" +
									"<div class='actionContainer'>" +
										"<div class='item-actions' id='clear-"+notification_id+"'>" +
											"<text class='T333-15PX' >&nbsp; REMOVE <i class='fa fa-remove'></i>&nbsp;</text>" +
										"</div>" +
									"</div>" +
								"</div>";
			}
			else if(notification_type === "OVERDUE")
			{
				var itemDiv=  "<div class='ITEM-LIST '  id='N-"+notification_id+"-M'  style='background: #BD1100;'>" +
									"<div style='float: left;'>" +
										"<text class='TEEE-18PX'>This item borrowed from <b><span class='user "+from_id+"'>"+name+"</span></b> is overdue:</text><br>" +
										"<text class='TEEE-25PX'>"+item_title+"</text><br>" +
										"<text class='TEEE-15PX'> SENT ON: <b>"+date+"</b></text>" +
									"</div>" +
									"<div class='actionContainer'>" +
										"<div class='item-actions' id='clear-"+notification_id+"'>" +
											"<text class='T333-15PX'>&nbsp; REMOVE <i class='fa fa-remove'></i>&nbsp;</text>" +
										"</div>" +
									"</div>" +
								"</div>";
			}
			else if(notification_type === "RETURNED SENT")
			{
				var itemDiv=  "<div class='ITEM-LIST '  id='N-"+notification_id+"-M' style='background: "+color+";'>" +
									"<div style='float: left;'>" +
										"<text class='T333-18PX'>We have notified <b><span class='user "+from_id+"'> "+name+"</span></b> that you have returned: </text><br>" +
										"<text class='T333-25PX'>"+item_title+"</text><br>" +
										"<text class='T333-15PX'>SENT ON: <b>"+date+"</b></text>" +
									"</div>" +
									"<div class='actionContainer'>" +
										"<div class='item-actions' id='clear-"+notification_id+"'>" +
											"<text class='T333-15PX' >&nbsp; REMOVE <i class='fa fa-remove'></i>&nbsp;</text>" +
										"</div>" +
									"</div>" +
								"</div>";
			}
			else if(notification_type === "RETURNED ALREADY")
			{
				var itemDiv=  "<div class='ITEM-LIST ' id='N-"+notification_id+"-M' style='background: "+color+";'>" +
									"<div style='float: left;'>" +
										"<text class='T333-18PX'><b><span class='user "+from_id+"'> "+name+"</span></b> claims to have returned: </text><br>" +
										"<text class='T333-25PX'>"+item_title+"</text><br>" +
										"<text class='T333-15PX'>SENT ON: <b>"+date+"</b></text>" +
									"</div>" +
									"<div class='actionContainer'>" +
										"<div class='item-actions' id='clear-"+notification_id+"'>" +
											"<text class='T333-15PX' >&nbsp; REMOVE <i class='fa fa-remove'></i>&nbsp;</text>" +
										"</div>" +
									"</div>" +
								"</div>";
			}
			console.log("ADDED" +" N-"+request_id+"M");
			$(unescape(itemDiv)).prependTo('#load').hide().fadeIn(500);
		});		
	});
}

function myRequests(request_id)
{

	var request_id, color = "#E5E5E5", dataString  = 'ACTION=' + 'myRequests' + '&REQUEST_ID=' + request_id;
	$.post('scripts/notifications.php', dataString,  function success(data){
		
		var json = JSON.parse(data);
		$.each(json,function(index, value){
			$.each(value,function(index2, value2){
				request_id = value['REQUEST_ID' ];
				request_type = value['REQUEST_TYPE' ];
				item_title = value['ITEM_TITLE' ];
				date = value['DATE' ];
				name = value['NAME'];
				from_id = value['FROM_ID'];
			});

			var now = new Date(date);
			now.format("yyyy-mm-dd HH:MM:ss");
			date = dateFormat(now, "dddd, dS mmmm , yyyy, h:MM:ss TT");

			
			if(color === "#E5E5E5")
				color = "#CDCDCD";
			else
				color = "#E5E5E5";
			
			if(request_type === "BORROW")
			{
				var itemDiv=  "<div class='ITEM-LIST ' id='R-"+request_id+"-M' style='background: "+color+";'>" +
									"<div style='float: left;'>" +
										"<text class='T333-18PX'>Request to <b>BORROW</b> from <b><span class='user2'>"+name+"</span></b></text><br>" +
										"<text class='T333-25PX'>"+item_title+"</text><br>" +
										"<text class='T333-15PX'> PLACED ON: <b>"+date+"</b></text>" +
									"</div>" +
									"<div class='actionContainer'>" +
										"<div class='item-actions' id='cancel-"+request_id+"'>" +
											"<text class='T333-15PX' >CANCEL</text>" +
										"</div>" +
									"</div>" +
								"</div>";
			}
			else if(request_type === "RETURN")
			{
				var itemDiv=  "<div class='ITEM-LIST ' id='R-"+request_id+"-M' style='background: "+color+";'>" +
									"<div style='float: left;'>" +
										"<text class='T333-18PX'>Request to <b>RETURN</b> to <b><span class='user "+from_id+"'> "+name+"</span></b></text><br>" +
										"<text class='T333-25PX'>"+item_title+"</text><br>" +
										"<text class='T333-15PX'> PLACED ON: <b>"+date+"</b></text>" +
									"</div>" +
									"<div class='actionContainer'>" +
										"<div class='item-actions' id='remindOwner-"+request_id+"'>" +
											"<text class='T333-15PX' >&nbsp; I HAVE RETURNED &nbsp; <i class='fa fa-frown-o'></i> &nbsp;</text>" +
										"</div>" +
									"</div>" +
								"</div>";
			}	
			
			console.log("ADDED" +" R-"+request_id+"M");

		$(unescape(itemDiv)).prependTo('#load').hide().fadeIn(500);
		});		
	});
}

function otherRequests(request_id)
{
		
	var request_id, color = "#FFC75E", dataString  = 'ACTION=' + 'otherRequests' + '&REQUEST_ID=' + request_id;
	$.post('scripts/notifications.php', dataString,  function success(data){
		
		var json = JSON.parse(data);
		$.each(json,function(index, value){
			$.each(value,function(index2, value2){
				request_id = value['REQUEST_ID' ];
				request_type = value['REQUEST_TYPE' ];
				item_title = value['ITEM_TITLE' ];
				from_id = value['FROM_ID'];
				date = value['DATE' ];
				name = value['NAME' ];
			});

			var now = new Date(date);
			now.format("yyyy-mm-dd HH:MM:ss");
			date = dateFormat(now, "dddd, dS mmmm , yyyy, h:MM:ss TT");

			if(color === "#FFC75E")
				color = "#FFD079";
			else
				color = "#FFC75E";
							
			if(request_type === "BORROW")
			{
				var itemDiv=  "<div class='ITEM-LIST' id='R-"+request_id+"-O' style='background: "+color+" '>" +
									"<div style='float: left;'>" +
										"<text class='T333-18PX'> <b><span class='user "+from_id+"'> "+name+"</span></b> wants to <b>BORROW</b></text><br>" +
										"<text class='T333-25PX'>"+item_title+"</text><br>" +
										"<text class='T333-15PX'> PLACED ON: <b>"+date+"</b></text>" +
									"</div>" +
									"<div class='actionContainer'>" +
										"<div class='item-actions' id='acceptRequest-"+request_id+"'>" +
											"<text class='T333-15PX' >&nbsp;ACCEPT <i class='fa fa-check'></i>&nbsp;</text>" +
										"</div>" +
										"<div class='item-actions' id='decline-"+request_id+"'>" +
											"<text class='T333-15PX' >&nbsp;DECLINE <i class='fa fa-remove'></i>&nbsp;</text>" +
										"</div>" +
									"</div>" +
								"</div>";

			}
			else if(request_type === "RETURN")
			{
				var itemDiv=  "<div class='ITEM-LIST ' id='R-"+request_id+"-O' style='background: "+color+" '>" +
									"<div style='float: left;'>" +
										"<text class='T333-18PX'><b><span class='user "+from_id+"'> "+name+"</span></b> wants to <b>RETURN</b></text><br>" +
										"<text class='T333-25PX'>"+item_title+"</text><br>" +
										"<text class='T333-15PX'> PLACED ON: <b>"+date+"</b></text>" +
									"</div>" +
									"<div style='float: right; height: 70px; margin-top: 0px; width: 250px; '>" +
										"<div class='item-actions' id='remindBorrower-"+request_id+"'>" +
											"<text class='T333-15PX' >&nbsp; REMIND BORROWER &nbsp; <i class='fa fa-bell-o'></i> &nbsp;</text>" +
										"</div>" +
										"<div class='item-actions' id='returnedRequest-"+request_id+"'>" +
											"<text class='T333-15PX' >&nbsp; RETURNED &nbsp; <i class='fa fa-check'></i> &nbsp;</text>" +
										"</div>" +
									"</div>" +
								"</div>";
			}

		console.log("ADDED" +" R-"+request_id+"O");
		$(unescape(itemDiv)).prependTo('#load').hide().fadeIn(500);

		});
	});
	
}

var noNotifications = false;
function PushListener()
{
	var count=0;

	$.post('scripts/PushArray.php', "ACTION=GetNotificationID",  function success(data){
		var json = JSON.parse(data);
		$.each(json, function(index, value){
			NotificationNew.push([value]);
			count++;
		});
		if(count==0)
		{
			if(noNotifications == false)
			{
				var itemDiv=  "<div class='ITEM-LIST noNotifications' id='noNotifications'>" +
								"<text style='font-size: 80px; color: #333;'><i class='fa fa-bell-slash'></i></text><br>" +
								"<text class='T333-25PX'>You have no notifications for now!</text>" +
						      "</div>";
				setTimeout(function(){
					$(unescape(itemDiv)).prependTo('#load').hide().fadeIn(500);
				},1500);
				noNotifications = true;
			}
		}
		else
		{
			$("#noNotifications").fadeOut(500);
			noNotifications = false;
		}
	});
}

var NotificationCurrent = [];
var NotificationNew = [];
var RemoveArray = [];
var AddArray = [];

function getFlattenedArray(arr){
	return arr.join().split(",");
}

$(document).ready(function () {

    getNotifications();

    setInterval(function () {

        NotificationNew = [];
        RemoveArray = [];
        AddArray = [];
        console.log("CurrentNotification-" + NotificationCurrent);

        setTimeout(function () {

            PushListener();
            $('#loading').fadeOut(500).delay(500).remove();
            setTimeout(function () {
                //otherRequests();
                NotificationNew = getFlattenedArray(NotificationNew);
                console.log("NewNotification-" + NotificationNew);
                //GET ELEMENT IDS TO BE REMOVED
                $.each(NotificationCurrent, function (index, value) {
                    if ($.inArray(value, NotificationNew) == "-1") {
                        RemoveArray.push(value);
                    }
                });

                //GET ELEMENT IDS TO BE ADDED
                $.each(NotificationNew, function (index, value) {
                    if ($.inArray(value, NotificationCurrent) == "-1") {
                        AddArray.push(value);
                    }
                });

                //PREPEND ELEMENTS WHICH HAVE BEEN ADDED
                $.each(AddArray, function (index, value) {
                    NotificationCurrent.push(value);
                    var array = value.split("-");
                    console.log("ADD - " + value);
                    if (array[0] === 'N') {
                        getNotifications(array[1]);
                    }
                    else if (array[0] === 'R') {
                        if (array[2] === 'M') {
                            myRequests(array[1]);
                        }
                        else if (array[2] === 'O') {
                            otherRequests(array[1]);
                        }
                    }
                });

                console.log(RemoveArray);

                //REMOVE ELEMENTS WHICH HAVE BEEN ADDED
                $.each(RemoveArray, function (index, value) {
                    var index = NotificationCurrent.indexOf(value);
                    NotificationCurrent.splice(index, 1);

                    console.log("REMOVE - " + value + " INDEX-" + index);
                    $("#" + value).fadeOut("1000", function () {
                        $(this).remove();
                    });

                });

            }, 500);

        }, 1000);
    }, 5000);

});