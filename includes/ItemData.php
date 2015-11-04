<?php


function fetchCategories()
{
	$QUERY = "SELECT * FROM  main_categories";
	$RESULT = mysql_query($QUERY);
	
	while($ROW = mysql_fetch_array($RESULT))
	{
		
		$QUERY1 = "SELECT * FROM  sub_categories WHERE MAIN_CATEGORY_ID='".$ROW['CATEGORY_ID']."'";
		$RESULT1 = mysql_query($QUERY1);
		
		$COLOR = $ROW['CATEGORY_COLOR'];
		
		if($ROW['CATEGORY_ID']==1 || $ROW['CATEGORY_ID']==2 || $ROW['CATEGORY_ID']==3 || $ROW['CATEGORY_ID']==4)
		{
			print "<optgroup style='background: ".$COLOR."; margin-top: 5px; ' label='".$ROW['CATEGORY_MAIN_TITLE']."'>";
		
			while($ROW1 = mysql_fetch_array($RESULT1))
			{
				print "<option style='padding-left: 30px; color: white; background: ".$COLOR.";' value='".$ROW1['CATEGORY_ID']."' $disabled>".$ROW1['SUB_CATEGORY']."</option>";
			}
		}
		
		print "</optgroup>";
	}	
}
	

if(isset($_SESSION['MY_ID']))
{
	$LOCATION_FILTER =	"
						WHERE OWNER_ID IN	(
							SELECT DISTINCT USER_ID from user_group_relation
							WHERE GROUP_ID IN	(
								SELECT GROUP_ID FROM user_group_relation 
								WHERE USER_ID = '".$_SESSION['MY_ID']."'
							)
						)
						";
}
else
{	
	unset($LOCATION_FILTER);
}

	
function fetch_categoryID($category_name)
{
	$QUERY = "SELECT * FROM sub_categories WHERE SUB_CATEGORY = '".$category_name."'"; 
	$RESULT = mysql_query($RESULT);
	while($ROW = mysql_fetch_array($result))
	{
		return $ROW['CATEGORY_ID'];
	}

}

function fetch_items($select_condition, $conditions)
{

	global $array_location, $LOCATION_FILTER;
	$array = array();
	
	if($select_condition == "default")
	{
		$select_condition = "
							SELECT *, IF(EXISTS(SELECT * FROM librorum.items WHERE ITEM_INFO_ID =  INFO_ID), FALSE, TRUE) AS `MISSING`
							FROM items 
							LEFT JOIN librorum_items.items_original ON librorum.items.ITEM_INFO_ID = librorum_items.items_original.INFO_ID 
							
							LEFT JOIN librorum_items.series_relation ON librorum_items.series_relation.ITEM_INFO_ID = librorum_items.items_original.INFO_ID 
							LEFT JOIN users ON items.OWNER_ID = users.USER_ID 
							LEFT JOIN sub_categories ON sub_categories.CATEGORY_ID = librorum_items.items_original.ITEM_CATEGORY_ID 
							LEFT JOIN main_categories ON main_categories.CATEGORY_ID = sub_categories.MAIN_CATEGORY_ID 	
							$LOCATION_FILTER					
							";
	}
	elseif($select_condition == "series")
	{
		$select_condition = "
							SELECT *, IF(ITEM_ID IN	(
														SELECT ITEM_ID FROM items
														$LOCATION_FILTER
													),FALSE ,TRUE) AS `MISSING` 

							FROM librorum_items.items_original 
							LEFT JOIN librorum.items on librorum.items.ITEM_INFO_ID = librorum_items.items_original.INFO_ID
							
							LEFT JOIN librorum_items.series_relation ON librorum_items.series_relation.ITEM_INFO_ID = librorum_items.items_original.INFO_ID 
							LEFT JOIN users ON items.OWNER_ID = users.USER_ID 
							LEFT JOIN sub_categories ON sub_categories.CATEGORY_ID = librorum_items.items_original.ITEM_CATEGORY_ID 
							LEFT JOIN main_categories ON main_categories.CATEGORY_ID = sub_categories.MAIN_CATEGORY_ID 	
							
							";

	}
	elseif($select_condition == "suggestions")
	{
		$select_condition = "
							SELECT *
							FROM librorum_items.items_original 
							LEFT JOIN sub_categories ON sub_categories.CATEGORY_ID = librorum_items.items_original.ITEM_CATEGORY_ID 
							LEFT JOIN main_categories ON main_categories.CATEGORY_ID = sub_categories.MAIN_CATEGORY_ID 	
							";

	}	
	elseif($select_condition == "special")
	{
		$select_condition =	"
							SELECT *
							FROM items 
							LEFT JOIN librorum_items.items_original ON librorum.items.ITEM_INFO_ID = librorum_items.items_original.INFO_ID 
							
							LEFT JOIN librorum_items.series_relation ON librorum_items.series_relation.ITEM_INFO_ID = librorum_items.items_original.INFO_ID 
							LEFT JOIN users ON items.OWNER_ID = users.USER_ID 
							LEFT JOIN sub_categories ON sub_categories.CATEGORY_ID = librorum_items.items_original.ITEM_CATEGORY_ID 
							LEFT JOIN main_categories ON main_categories.CATEGORY_ID = sub_categories.MAIN_CATEGORY_ID 		
							";
	}
	
	$result = mysql_query($select_condition.$conditions);
	
	//echo $select_condition.$conditions;
		
	$index = 0;
	while($row = mysql_fetch_array($result))
	{
		$ITEM_SUB_CATEGORY_ID = $row['ITEM_CATEGORY_ID'];
		$ITEM_ID = $row['ITEM_ID'];					
		$ITEM_INFO_ID = $row['INFO_ID'];
		$BORROW_COUNT = $row['BORROW_COUNT'];
		$ITEM_STATUS = $row['STATUS'];
		$ITEM_OWNER_NAME = $row['USER_NAME'];	
		$ITEM_SERIES = $row['SERIES_ID'];
		
		if(isset($row['MISSING']))
		{
			$ITEM_MISSING = $row['MISSING'];
		}else
		{
			$ITEM_MISSING = NULL;
		}
		
		$CATEGORY_COLOR = $row['CATEGORY_COLOR'];
		$CATEGORY_MAIN_TITLE = $row['CATEGORY_MAIN_TITLE'];
		$CATEGORY_SUB_TITLE = $row['SUB_CATEGORY'];

		$ITEM_TITLE = $row['TITLE/PRODUCT'];
		$ITEM_IMAGE = $row['IMAGE'];
		$ITEM_RATING = $row['RATING'];
		$ITEM_DESCRIPTION = $row['DESCRIPTION'];		
		$PLATFORM = $row['PLATFORM'];		
	

		if($CATEGORY_MAIN_TITLE=='BOOKS & READING' || $CATEGORY_SUB_TITLE=='Music CDs') 
		{
			$ITEM_PUBLISHER = $row['AUTHOR/ARTISTS'];
		}
		else 
		{
			$ITEM_PUBLISHER = $row['PUBLISHER/NETWORK/MANUFACTURER'];
		}
		
		if(strlen($ITEM_TITLE)>48)
		{
			$ITEM_TITLE_FULL = substr($ITEM_TITLE,0,45).'...';
		}else
		{
			$ITEM_TITLE_FULL = $ITEM_TITLE;
		}
		
		if(strlen($ITEM_TITLE_FULL)>38)
		{
			$ITEM_TITLE_SHORT = substr($ITEM_TITLE_FULL,0,35).'...';
		}else
		{
			$ITEM_TITLE_SHORT = $ITEM_TITLE_FULL;
		}
		
		$array[$index] =  array(
							'ID' =>  $ITEM_ID, 
							'INFO ID' => $ITEM_INFO_ID,
							'TITLE FULL' => $ITEM_TITLE_FULL,
							'TITLE SHORT' => $ITEM_TITLE_SHORT,
							'PUBLISHER' => $ITEM_PUBLISHER,
							'PLATFORM' => $PLATFORM,
							'DESCRIPTION' => $ITEM_DESCRIPTION,
							'IMAGE' => $ITEM_IMAGE,
							'CATEGORY COLOR' =>  $CATEGORY_COLOR ,
							'SUB CATEGORY' => $CATEGORY_SUB_TITLE, 								
							'MAIN CATEGORY' =>   $CATEGORY_MAIN_TITLE , 
							'OWNER' =>   $ITEM_OWNER_NAME,
							'BORROW COUNT' =>   $BORROW_COUNT, 
							'RATING' =>   $ITEM_RATING, 
							'STATUS' =>   $ITEM_STATUS,
							'SERIES' => $ITEM_SERIES,
							'MISSING' => $ITEM_MISSING
						  );	
			$index++;
		
		
			
	}
	
	return $array;
}

function display_items($settings)
{
	
	$default = array(
		'SELECT STATEMENT' => 'default',
		'SELECT CONDITIONS'=> 'default',
		'DISPLAY ID'=> rand(0,999),
		'HOVER'=> true,
		'COLOR'=> 'white'
	);
	
	
	$settings = array_replace($default, $settings);
	
	$array = fetch_items($settings['SELECT STATEMENT'], $settings['SELECT CONDITIONS']);					
	
	foreach($array as $item)
	{
		if($item['IMAGE']!="default2.png") $DISPLAY_IMAGE = "<img class='ITEM-IMAGE' data-adaptive-background='1' src='../images/items/thumbs/".$item['IMAGE']."'>";
		else $DISPLAY_IMAGE = "<img class='ITEM-IMAGE' style='height: 105%;' src='../images/items/thumbs/".$item['IMAGE']."'>";
		
		$IMAGE = $item['IMAGE'];
		
		if($item['MISSING']==TRUE)
		{
			print	"	
					<a href='../dashboard/items.php'>	
					<div class='ITEM-MISSING'>
					
						<div class='ITEM-IMAGE-CONTAINER' style=\"background: linear-gradient(to bottom, rgba(255,255,255,1) 0%, rgba(255,255,255,.8) 40%, rgba(255,255,255,.6) 60%, rgba(255,255,255,.1) 100%), url('../images/items/thumbs/$IMAGE') #AAA; background-size:cover;\">
						
								<div class='ITEM-IMAGE-BACKGROUND' id='missing' style='height: 90px; padding-top: 5px;'>
								<div class='SPACER-5'></div>
								<text style=\"font-size: 15px; letter-spacing: -1px; color: #555;\"><b>ADD TO LIBRARY</b></text>
								<div style='margin-top: 5px;'>
								<text style=\"font-size: 50px; font-family: 'Blackoak Std'; color: #555;\">+</text>
								</div>
						
							</div>
							
							<div class='ITEM-CATEGORY' style='background: #AAA;'>".$item['MAIN CATEGORY']."</div>
						</div>

						<text class='ITEM-TITLE' style='color: ".$settings['COLOR'].";' >".$item['TITLE SHORT']."</text><br>
						<text class='ITEM-AUTHOR' style='color: ".$settings['COLOR'].";'>".$item['PUBLISHER']."</text>

					</div>
					</a>
					";
		}
		else
		{
		
			print	"
					<div class='ITEM-CONTAINER' id='".$settings['DISPLAY ID']."-".$item['ID']."'>
					";
					
			if($settings['HOVER']!=false)
			{
			
				print	"
						<div id='".$settings['DISPLAY ID']."-".$item['ID']."-info' class='ITEM-STATUS'>
							
							<div style='text-align: center; width: 100%; height: 110px; float: top; overflow: hidden;'>
								<div class='dot'>
								<text style='color: black; font-size: 17px; ' >".$item['TITLE FULL']."</text><br>
								</div>
								<div class='PUBLISHER-CONTAINER'>
									<text style='text-transform:uppercase; font-size: 12px; ' ><b>".$item['PUBLISHER']."</b></text>
								</div>
								
							</div>

							<div style='width: 100%; height: 30px; float: top;'>
								
								<div style='float: right; margin-left: 3px; margin-top: -4px;'>
									<text class='".$item['STATUS']."'><b>".$item['STATUS']."</b></text>
								</div>
								
								<div class='".$item['STATUS']."'></div>
								
								<div class='SPACER-10'></div>
								
								<div style='float: right; margin-left: 3px; margin-top: -1px;'>
									<text class='OWNER' ><b>".$item['OWNER']."</b></text>
								</div>
								<div style=' float: right;'>
									<img src='../images/icons/user.png' style='width: 10px; height: 10px; '>
								</div>
							</div>

						</div>
						";
						
			}	
					
			print	"
						<div class='ITEM-IMAGE-CONTAINER' style='background: ".$item['CATEGORY COLOR'].";'>
							<div class='ITEM-IMAGE-BACKGROUND'>
								$DISPLAY_IMAGE
							</div>
							<div class='ITEM-CATEGORY' style='background: ".$item['CATEGORY COLOR'].";'>".$item['MAIN CATEGORY']."</div>
						</div>

						<div class='dot2' style='color: ".$settings['COLOR'].";' >
							<text class='ITEM-TITLE' style='color: ".$settings['COLOR'].";'>".$item['TITLE SHORT']."</text>
						</div>
						<text class='ITEM-AUTHOR' style='color: ".$settings['COLOR'].";'>".$item['PUBLISHER']."</text>
	
					</div>
					";
					
			if($settings['HOVER']!=false)
			{		
				print	"
						
						<script>			
						$('#".$settings['DISPLAY ID']."-".$item['ID']."').hover(
							
							function()
							{
								$('#".$settings['DISPLAY ID']."-".$item['ID']."-info').stop(true, false).delay(500).slideDown(300);
								
							},
							function()
							{
								$('#".$settings['DISPLAY ID']."-".$item['ID']."-info').stop(true, false).slideUp(100);
							}
						);	
						</script>
						";
				} 
				
				print	"
						<script>
						$('#".$settings['DISPLAY ID']."-".$item['ID']."').click(
							
							function()
							{
								$('body').fadeOut(500);
							   
							   setTimeout(function () {
								   window.location.href = 'display.php?ITEM_ID=".$item['ID']."';
								}, 1000);
								
							}
						);	
						</script>
						";
			
					
		}
	
	}
	
}



?>