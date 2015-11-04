$(document).ready(function() {

	var CategoryMenuOpen = false;
	var DashboardMenuOpen = false;
	$( "#CATEGORY-MENU" ).hide();
	$( "#DASHBOARD-MENU-CONTAINER" ).hide();
	
	function ShowDashboardMenu() {
		$( "#DASHBOARD-MENU-CONTAINER" ).slideDown();
		DashboardMenuOpen = true;
		$("#DB-CONT").fadeIn(500);
	};
	
	function HideDashboardMenu() {
		DashboardMenuOpen = false;
		$( "#DASHBOARD-MENU-CONTAINER" ).slideUp();
		$("#DB-CONT").fadeOut(500);
	};
	
	function ShowCategoryMenu()	{
		$( "#CATEGORY-MENU" ).slideDown();
		CategoryMenuOpen = true;
		$("#NAV").html('&#9650;');
		$("div.LIBRARY-CATEGORY-LINK-CONTAINER").fadeIn(500);
	};
	
	function HideCategoryMenu() {
		$( "#CATEGORY-MENU" ).slideUp();
		CategoryMenuOpen = false;
		$("#NAV").html('&#9660;');
		$("div.LIBRARY-CATEGORY-LINK-CONTAINER").fadeOut(500);
	};
	
	$("#CATEGORY-MENU-LAUNCHER").click(function() {
		if(CategoryMenuOpen == false)
		{
			ShowCategoryMenu();
			if(DashboardMenuOpen == true)	
			{
				HideDashboardMenu();
			}
		}
		else
		{
			HideCategoryMenu();
		}  
	});
		
	$("#DASHBOARD-MENU-LAUNCHER").click(function() {
		if(DashboardMenuOpen == false)
		{
			ShowDashboardMenu();
			if(CategoryMenuOpen == true)
			{
				HideCategoryMenu();
			}
		}
		else
		{
			HideDashboardMenu();
		}
	});
		
});