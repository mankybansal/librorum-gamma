var NotificationCurrent;
var NotificationNew;

function PushListener()
{
	$.post('scripts/push.php', "ACTION=notifications",  function success(data){
		alert(data);
	});
}