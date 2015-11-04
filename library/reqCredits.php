<?php   SESSION_START();	?>
<?php   ERROR_REPORTING(0);	?>


<?php

    include '../includes/ServerConnect.php';


    $ITEM_ID = $_POST['ITEM_ID'];
    $ACTION = $_POST['ACTION'];

    if($ACTION == "reqCredits")
    {
        reqCredits($ITEM_ID);
    }

    function reqCredits($ITEM_ID)
    {
        $QUERY = "
                    SELECT REQ_CREDITS from items
                    INNER JOIN librorum_items.items_original ON items.ITEM_INFO_ID = librorum_items.items_original.INFO_ID
                    INNER JOIN sub_categories ON sub_categories.CATEGORY_ID = librorum_items.items_original.ITEM_CATEGORY_ID
                    INNER JOIN main_categories ON main_categories.CATEGORY_ID = sub_categories.MAIN_CATEGORY_ID
                    WHERE ITEM_ID = $ITEM_ID
                  ";

        $RESULT = mysql_query($QUERY);
        while($ROW = mysql_fetch_array($RESULT))
        {
            echo $ROW['REQ_CREDITS'];
        }
    }
?>


