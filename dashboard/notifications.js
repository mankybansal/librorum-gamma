
	var notificationTitle = "";
	var requestDate = "";
	var returnDate = "";
	var toName = "";
	var fromName = "";
	var itemTitle = "";
	
	function changeID(element, id) {
		$(elem).find("[id]").add(elem).each(function() {
			this.id = this.id.replace(/\d+$/, "") + id;
		})
	}

	var cloneCntr = 1;
	$("button").click(function () { 
		var table = $("#CONTAINER").clone(true,true) 
		chaneID(table, cloneCntr);
		table.insertAfter("#CONTAINER") 
		cloneCntr++;
	}); 