<?PHP

ERROR_REPORTING(0);

//PREREQUISITE VARIABLES FOR THE SessionValidate.php PAGE
$REDIRECT_PATH = "";
$MY_PAGE_SET = TRUE;
$LOGIN_PAGE_SET = FALSE;
$LOGIN_REQUIRED = TRUE;
$DASHBOARD = TRUE;

//THIS SCRIPT VALIDATES THE CURRENT SESSION
include('../includes/SessionValidate.php');

//CONNECT SCRIPT FOR DATABASE ACCESS
include '../includes/ServerConnect.php';

//OTHER PAGE SETTINGS
$DASHBOARD_MENU = FALSE;

	
if(isset($_SESSION['MY_STATUS']) && $_SESSION['MY_STATUS']!='CONFIRMED')
{
	print "<script>var confirmed=false;</script>";
}
else
{
	print "<script>var confirmed=true;</script>";
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Dashboard | Librorum - The Sharing Community</title>

<!-- META TAGS. -->
<meta name="description" content="Librorum - The Sharing Community, the one stop place to see what you can borrow in your community. We make sharing beneficial by giving back more when you lend.">
<meta name="keywords" content="Librorum, Sharing, Community, Rentals, Community Sharing, Sharing in Bengaluru">
<meta name="author" content="Librorum Web Team">
<meta charset="UTF-8">

<!-- LINKS FOR FILES REQUIRED ON PAGE. -->
<link href="../css/MainSheetCSS.css" rel="stylesheet" type="text/css"/>
<link href="../css/AnimateCSS.css" rel="stylesheet" type="text/css"/>
<link href="../css/FontAwesomeCSS.css" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
<link rel="icon" href="../favicon.ico" type="image/x-icon">

<!-- JAVASCRIPT LINKS -->
<script type="text/javascript" src="../includes/jquery.min.js"></script>
<script type="text/javascript" src="../includes/jquery.logout.js"></script>
<script type="text/javascript" src="../includes/jquery.form.js"></script>
<script type="text/javascript" src="../includes/jquery.newData.js"></script>
<script type="text/javascript" src="../includes/BackgroundBubbles.js"></script>

<!-- VIEWPORT SPACER CSS-->
<style>
    div.viewport-spacer {
        width: 100%;
        min-height: 5px;
        min-width: 1000px;
        float: top;
    }

    div.header {
        width: 100%;
        min-width: 1000px;
        height: 70px;
        float: top;
    }

    div.content {
        width: 100%;
        min-width: 1000px;
        height: 500px;
        float: top;
    }

    div.footer {
        width: 100%;
        min-width: 460px;
        height: 65px;
        float: top;
    }

    html, body {
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        overflow: hidden;
        background: #759E2F;
    }
	
	input.form, select.form {
		font-size: 25px; font-family: SourceSans; padding: 0px 20px 0px 20px; 
		height: 60px; 
		box-sizing: border-box;
		border: 0px;
		color: black;
		box-shadow: 0px 0px 20px rgba(0,0,0,.05);
		border-radius: 5px;
	}

    #BODY-BACKGROUND {
        position: absolute;
        left: 0;
        z-index: 0;
    }

    #BODY-FOREGROUND {
        width: 100%;
        height: 100%;
        position: relative;
        z-index: 1;
    }

    #GUIDE {
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        top: 0;
        background: rgba(255, 255, 255, 0.95);
        z-index: 2;
        box-sizing: border-box;
        padding: 40px 50px 70px 50px;
        text-align: left;
        text-align: center;
    }

    button.SUBMIT {
        height: 60px;
        outline: none;
        width: 200px;
        border: 0px;
        font-size: 25px;
        font-family: SourceSans;
        margin-left: 380px;
        background: #688B25;
        color: white;
        border-radius: 10px;
        box-sizing: border-box;
		box-shadow: 0px 0px 10x rgba(0,0,0,.05);
        border-radius: 5px;
    }

    #HelpContainer {
        display: inline-block;
        box-sizing: border-box;
        padding: 50px 0px 50px 0px;
        text-align: center;
        min-width: 900px;
        width: 80%;
        height: 1000px;
        background: #333;
        border-radius: 30px;
        margin-top: 600px;
    }

    div.content-boxes {
        display: none;
    }

</style>
<!-- VIEWPORT SPACER CSS-->

<!-- VIEWPORT SPACER JQUERY-->
<script>

    $(window).load(function () {
        resize();
        $("body").fadeIn(2000);
    });

    $(window).resize(function () {
        resize();
    });

    function resize() {

        var viewportWidth = $(this).width();
        var viewportHeight = $(this).height();

        var headerHeight = $(".header").height();
        var footerHeight = $(".footer").height();
        var contentHeight = $(".content").height();

        var spacerHeight = (viewportHeight - (headerHeight + footerHeight + contentHeight)) / 2;

        $('#spacer-1').css('height', spacerHeight);
        $('#spacer-2').css('height', spacerHeight);
        $('#MYSPACER').css('height', spacerHeight);

    }
    ;

    $(document).ready(function () {

        pushListener();
        $('#notification-icon').hide();
        $('#notification-text').hide();
        $('#notification-push').hide();
        setInterval(function () {
            pushListener();
        }, 500);

        $(".HelpBox").hide();
       
		function switchBox(item, time){
			$(item).delay(1000+time).fadeIn(1000);
			setTimeout(function(){$(item).toggleClass('fadeInUp fadeOutDown').fadeOut(500);},7500+time);
		}
		
		if(confirmed==true)
		{
			startGuide();
		}
		
		function startGuide(){
			$("#GUIDE").show();
			$("#HelpTitle").delay(2000).animate({"margin-top": "0"}, 1500);
			$("#HelpContainer").delay(2000).animate({"margin-top": "30"}, 1500);

			setTimeout(function(){
				switchBox("#Help1", 0);
				switchBox("#Help2", 8000);
				switchBox("#Help3", 16000);
				switchBox("#Help4", 24000);
				switchBox("#Help5", 32000);
				switchBox("#Help6", 40000);
			},3500);

			$("#HelpContainer").delay(48000).fadeOut(1500)
			$("#HelpTitle").delay(48000).fadeOut(1500)
			$("#Started").delay(53500).fadeIn(1000);
			$("#GUIDE").delay(59000).fadeOut(1000);	
		}
		
    });

    function pushListener() {

        var dataString = "ACTION=notifications";
        $.post('scripts/push.php', dataString, function success(data) {

            if (data.trim() === "0") {
                $('.notification-push').fadeIn(300).text('');
                $('.notification-icon').fadeIn(500).css({height: '100px', width: '100px', marginTop: '8px'});
                $('.notification-text').fadeIn(300).text('');

            }
            else if (data.trim() === "1") {
                $('.notification-push').fadeIn(300).text(data.trim());
                $('.notification-icon').fadeIn(500).css({height: '50px', width: '50px', marginBottom: '-7px'});
                $('.notification-text').fadeIn(300).text("notification");

            }
            else {
                $('.notification-icon').fadeIn(300).css({height: '50px', width: '50px', marginBottom: '-7px'});
                $('.notification-text').fadeIn(500).text("notifications");
                $('.notification-push').fadeIn(300).text(data.trim());
            }
        });

        $.post('scripts/push.php', "ACTION=credits", function success(data) {
            $(".myCredits").text(data.trim());
        });
    }
</script>
<!-- VIEWPORT SPACER JQUERY -->


</head>

<body class="animated fadeIn" style="text-align: center; min-width: 1000px; min-height: 600px;">

<canvas id="BODY-BACKGROUND">
</canvas>

<?php

    $QUERY = "SELECT * FROM users WHERE USER_ID =".$_SESSION['MY_ID'];
    $RESULT = mysql_query($QUERY);

    while($ROW = mysql_fetch_array($RESULT))
    {
        $helpGuide = $ROW['MESSAGE_VIEW'];
    }

    if($helpGuide=="NO" && isset($_SESSION['MY_STATUS']) && $_SESSION['MY_STATUS']=='CONFIRMED')
    {
        include "startGuide.html";
        $QUERY = "UPDATE users SET MESSAGE_VIEW='YES' WHERE USER_ID=".$_SESSION['MY_ID'];
        $RESULT = mysql_query($QUERY);
    }
?>



<div id="BODY-FOREGROUND">

    <div class="header animated fadeInDown">
        <?php include('../includes/HeaderMenu.php'); ?>
    </div>

    <!-- VIEWPORT SPACER -->
    <div class="viewport-spacer" id="spacer-1"></div>
    <!-- VIEWPORT SPACER -->

    <div class="content">

        <div id="address" class="content-boxes">
        <div style="min-width: 1000px; min-height: 400px; display: inline-block; ">
            <div class="SPACER-25"></div>
            <text style="font-size: 45px;">Just One More Thing.</text>
            <br>
            <text style="font-size: 20px;">We need your address so that people can find you <br> when you allow them to
                borrow an item.
            </text>
            <br>

            <form id="ADDRESS-FORM" method="post">
                <div class="SPACER-20"></div>
                <input class="form" name="address" type="text" style="text-transform: capitalize; width: 500px;" placeholder="Current Residential Address">

                <div class="SPACER-10"></div>
                <text style="font-size: 20px;">If you are a student enrolled at a university, mention your room and block if you live in a hostel.
                </text>
                <br>

                <div class="SPACER-10"></div>
                <text style="font-size: 25px;"><b>Examples:</b></text>
                <br>
                <text style="font-size: 20px;">#311, Block 20, MIT Hostels, Manipal University.</text>
                <br>
                <text style="font-size: 20px;">#B-813, Sobha Onyx Apartments.</text>
                <div class="SPACER-15"></div>
                <text id="E-A" style="color: rgba(0,0,0,0);"><b>You must enter an address. You cannot lend without a valid one.</b></text>

                <div class="SPACER-15"></div>
                <button type="submit" class="SUBMIT" style="margin: 0 auto; background: #4E80BC;">I'm Done! &nbsp; <img
                        id="loader-2" src="../accounts/loader-white.gif"
                        style="display: none; position: absolute; width: 35px; height: 35px;"></button>
                <br>

                <div class="SPACER-10"></div>
                <text style="font-size: 20px;">By clicking <b>I'm Done</b> you agree to our <b><a href="https://docs.google.com/document/d/1tAH0MzfUdUBR57tiMFzSX0ZAyAxWKpW4dTeGFEoXOkE/edit?usp=sharing"
							target="_blank">Terms of Service</a></b> and our <b><a href="https://docs.google.com/document/d/1tAH0MzfUdUBR57tiMFzSX0ZAyAxWKpW4dTeGFEoXOkE/edit?usp=sharing"
							target="_blank">Privacy Policy</a></b></text>

            </form>
        </div>
    </div>

    <div id="admin-confirm" class="content-boxes">
		<div class="SPACER-40"></div>
		<div class="SPACER-30"></div>
		<text style="font-size: 80px;"><i class="fa fa-clock-o"></i></text><br>
		<text style="font-size: 45px;">Now just sit back, and relax!</text><br>
		<text style="font-size: 20px;">You can start sharing as soon as one of our <b>Librorum</b> administrators from your
			<br>locality confirms your address and account soon.
		</text><br><br>
		<text style="font-size: 20px;">We will notify you by email once this process is done!</text><br><br><br>
		<text style="font-size: 20px;"><b>Please contact us if it has been more than <br>48 hours since you've made your account!<br></b></text>
	</div>

	<div id="admin-denied" class="content-boxes">
		<div class="SPACER-40"></div>
		<div class="SPACER-40"></div>
		<div class="SPACER-15"></div>
		<text style="font-size: 80px;"><i class="fa fa-lock"></i></text><br>
		<text style="font-size: 45px;">Whoops! Sorry!</text><br>
		<text style="font-size: 20px;">We weren't able to affiliate you to your local community because the <br><b>Librorum</b>
			administrators from your locality denied your account.
		</text><br><br><br>
		<text style="font-size: 20px;"><b>Please contact us if this was a mistake</b></text>
	</div>

	<div id="error" class="content-boxes">
		<div class="SPACER-40"></div>
		<div class="SPACER-40"></div>
		<div class="SPACER-15"></div>
		<text style="font-size: 80px;"><i class="fa fa-warning"></i></text><br>
		<text style="font-size: 45px;">Whoops! That's an error!</text><br>
		<text style="font-size: 20px;">An unexpected error occured that wasn't supposed to happen.</text><br><br><br>
		<text style="font-size: 20px;"><b>Please contact us if this problem persists</b></text>
	</div>

<div id="first-login" class="content-boxes">
<div style="min-width: 1000px; height: 90px; ">
<script>
    $(document).ready(function () {

        $("#form").hide();

        $("#image").css('marginTop', '140px');
        $("#image").fadeIn(1000);
        $("#welcome").fadeIn(2000);
        $("#instructions").delay(1000).fadeIn(3000);

        $(".footer").css('marginTop', '0px');

        $("#image").delay(4000).animate({"margin-top": "20", "opacity": "0"}, 1000);
        $("#welcome").delay(3200).animate({"margin-top": "-120"}, 1000);

        $(".footer").delay(5000).animate({marginTop: '0px'}, 1000);

        $(".footer").delay(5000).animate({marginTop: '0px'}, 1000);
        $("#form").delay(5500).fadeIn(1000);

    });

</script>

<img id="image" src="../images/logos/white-no-text.png"
     style="display: none; margin: 0 auto; height: 100px; width: 100px;">

<div id="welcome" style="display: none;">
    <text style="font-size: 50px;"><b>Welcome to Librorum</b></text>
    <br>
</div>
<div id="instructions" style="display: none;">
    <text style="font-size: 20px;">We need a few things before you can start sharing.</text>
</div>
<div class="SPACER-20"></div>


<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        return !(charCode > 31 && (charCode < 48 || charCode > 57));
    }
</script>

<div id="form" style="display: none; width: 970px; height: 10px; margin: 0 auto;">

    <form id="FIRST-LOGIN-FORM" method="post">


        <div style="width: 620px; min-height: 10px; float: left;">

            <text style="font-size: 35px;">Change your password</text>
            <br>


            <div class="SPACER-15"></div>
            <div class="SPACER-2"></div>


            <input class="form" name="Password" type="password" style="width: 300px; font-family: 'Arial Black';"
                   placeholder="New Password">
            <input class="form" name="ConfirmPassword" type="password"
                   style="width: 300px; font-family: 'Arial Black'; margin-left: 15px;"
                   placeholder="Confirm Password"><br>


            <div style=" float: left; margin-left: 15px; height: 30px; margin-top: 5px;">
                <text id="E-1" style="color: rgba(0,0,0,0);">Your password cannot be empty!</text>
            </div>

            <div style=" float: right; margin-right: 35px; height: 30px; margin-top: 5px;">
                <text id="E-2" style="color: rgba(0,0,0,0);">The passwords don't match!</text>
            </div>

            <div class="SPACER-5"></div>


            <text style="font-size: 35px;">When were you born?</text>
            <br>


            <div class="SPACER-5"></div>
            <div class="SPACER-2"></div>

            <input id="day" class="form" type="textbox" onkeypress="return isNumberKey(event);" maxlength="2"
                   style="width: 120px;" name="Day" placeholder="Day">

            <select id="month" class="form" name="Month" type="textbox" style="width: 300px; margin-left: 15px;"
                    placeholder="Month" list='months'>
                <option value="" disabled selected>Month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>

            <input class="form" name="Year" onkeypress="return isNumberKey(event);" type="textbox" maxlength="4"
                   style="width: 160px; margin-left: 15px;" placeholder="Year"><br>

            <div class="SPACER-15"></div>

            <text id="E-3" style="color: rgba(0,0,0,0);">Check your birthday, it seems to be invalid.</text>
            <div class="SPACER-15"></div>
            <button type="submit" class="SUBMIT" style="margin: 0 auto; background: #4E80BC;">Continue &nbsp; <img id="loader" src="../accounts/loader-white.gif" style="display: none; position: absolute; width: 35px; height: 35px;"></button>
        </div>

    </form>

    <form id="myForm" action="upload.php" method="post" enctype="multipart/form-data">
        <div style="width: 350px; min-height: 10px; float: left; text-align: center;">
            <text style="font-size: 35px;">Add a profile picture</text><br><br>
            <input style="display: none;" type="file" id="theFile" size="60" name="myfile">

            <div style="width: 200px; margin: 0 auto; height: 200px; background: #F8F8F8; box-shadow: 0px 0px 10px rgba(0,0,0,0.3);">

                <?php

                $MY_ID = $_SESSION['MY_ID'];

                $query = "SELECT * FROM users WHERE USER_ID = $MY_ID";
                $result = mysql_query($query);

                while ($row = mysql_fetch_array($result)) {
                    $MY_DP = $row['DP_LINK'];
                    print "<img id='IMAGE' src='../images/users/$MY_DP' style='width: 180px; margin-top: 10px;  height: 180px;'>";
                }


                ?>

                <div onclick="performClick(document.getElementById('theFile'));" style="cursor: pointer; position: absolute; box-sizing: border-box; padding-top: 25px; z-index: 50; width: 180px; height: 180px; background: rgba(0,0,0,0.5); margin-top: -185px; margin-left: 10px; ">
                    <text style="font-size: 100px;">+</text>
                </div>

            </div>
            <br>
            <div id="bar" style="margin: 0 auto; width: 200px; height: 20px; padding: 2px; border-radius: 3px; background: white; display: none;">
                <div id="progress" style="height: 20px; width:1px; border-radius: 3px; background: #678A24; display: none;"></div><br>
                <text>Uploading...</text>
            </div>
        </div>
    </form>

    <script type="text/javascript">
        function performClick(node) {
            var evt = document.createEvent("MouseEvents");
            evt.initEvent("click", true, false);
            node.dispatchEvent(evt);
            console.log("FILE CHOSEN");
        }

        $('#theFile').change(function () {
            console.log("FILE SUBMIT");
            $('#myForm').submit();
        });
    </script>

    <div id="message"></div>

    <script>
        $(document).ready(function () {
            var options = {
                beforeSend: function () {
                    $("#progress").show();
                    $("#progress").css('width', '0px');
                    $("#bar").show();
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    $("#progress").animate({width: percentComplete + '%'}, "fast");
                },
                success: function (response) {
                    $("#progress").width('100%');
                    $('#IMAGE').attr('src', "../images/users/" + response);
                    $('#MENU-DP').attr('src', "../images/users/" + response);
                },
                complete: function () {
                    setTimeout(function () {
                        $("#progress").fadeOut(1000)
                    }, 3000);
                    setTimeout(function () {
                        $("#bar").fadeOut(1000)
                    }, 3000);
                },
                error: function () {
                    //DO NOTHING
                }

            };

            $("#myForm").ajaxForm(options);

        });

    </script>
</div>

</div>
</div>

<div id="apps" class="content-boxes">
	<div style="min-width: 1000px; height: 80px; " class="animated fadeInUp">
		<text style="font-size: 50px;"><b>Librorum Dashboard</b></text>
	</div>

	<div class="ButtonContainer animated fadeInUp">
		<a href="../library/" class="Icon" id="BROWSE">
			<div class="ButtonIcon" id="Browse"
				 style="background: url('../BrowseIcon.png') no-repeat #00A8EC; background-size: 80% 80%; background-position:center; ">

			</div>
			<div class="ButtonText">
				<text class="ButtonIcons">Browse Library</text>
			</div>
		</a>
	</div>

	<div class="ButtonContainer animated fadeInUp">
		<a href="#" class="Icon" id="BORROWS">
			<div class="ButtonIcon" style="background: #630460; ">
				<!--<div style="background: #630460; width: 100%; height: 100%;" id="INFO1">
					<div class="SPACER-20"></div>
					<text style="font-size: 60px;">23</text>
					<text style="font-size: 40px;"></text>

					<img src="../BorrowIcon.png" style="width: 50px; height: 50px; margin-bottom: -7px">
					<text style="font-size: 18px;">borrows</text><br>
				</div>	-->
				<div style="padding-top: 35px; box-sizing: border-box;">
					<text style="font-size: 30px;">Coming<br> Soon</text>
				</div>
			</div>
			<div class="ButtonText">
				<text class="ButtonIcons">My Borrows</text>
			</div>
		</a>
	</div>

	<div class="ButtonContainer animated fadeInUp">
		<a href="notifications.php" class="Icon" id="NOTIFICATIONS">
			<div class="ButtonIcon"
				 style="background: url('../NotificationsIcon.png') no-repeat #EF9B00; background-size: 80% 80%; background-position:center; ">
				<div style="background: #EF9B00; width: 100%; height: 100%;" id="INFO2">
					<div class="SPACER-20"></div>
					<text style="font-size: 60px;"><span class="notification-push"></span></text>
					<text style="font-size: 40px;"></text>

					<img class="notification-icon" src="../NotificationsIcon.png"
						 style="width: 100px; height: 100px; margin-top: 8px;">
					<text style="font-size: 18px;"><span class="notification-text"></span></text>
					<br>
				</div>
			</div>
			<div class="ButtonText">
				<text class="ButtonIcons">Notifications</text>
			</div>
		</a>
	</div>

	<div class="ButtonContainer animated fadeInUp">
		<a href="#" class="Icon" id="MESSAGES">
			<div class="ButtonIcon" style="background: #1AA0E2; ">
				<!--<div style="background: #1AA0E2; width: 100%; height: 100%;" id="INFO3">
					<div class="SPACER-20"></div>
					<text style="font-size: 60px;">17</text>
					<text style="font-size: 40px;"></text>

					<img src="../MessagesIcon.png" style="width: 50px; height: 50px; margin-bottom: -7px;">
					<text style="font-size: 18px;">messages</text><br>
				</div>-->
				<div style="padding-top: 35px; box-sizing: border-box;">
					<text style="font-size: 30px;">Coming<br> Soon</text>
				</div>
			</div>
			<div class="ButtonText">
				<text class="ButtonIcons">Messages</text>
			</div>
		</a>
	</div>

	<div class="ButtonContainer animated fadeInUp">
		<a href="credits.php" class="Icon" id="CREDITS">
			<div class="ButtonIcon" style="background: #000;">
				<div style="background: #000; width: 100%; height: 100%;" id="INFO4">
					<div style="width: 100%; height: 20px;"></div>
					<text style="font-size: 60px;"><span class="myCredits"></span></text>
					<br>
					<text style="font-size: 20px;">Remaining</text>
				</div>
			</div>
			<div class="ButtonText">
				<text class="ButtonIcons">Credits</text>
			</div>
		</a>
	</div>

	<br>

	<div class="ButtonContainer animated fadeInUp">
		<a href="#" class="Icon" id="HISTORY">
			<div class="ButtonIcon" style="background: #009E3B;">
				<div style="padding-top: 35px; box-sizing: border-box;">
					<text style="font-size: 30px;">Coming<br> Soon</text>
				</div>
			</div>
			<div class="ButtonText">
				<text class="ButtonIcons">Borrow History</text>
			</div>
		</a>
	</div>

	<div class="ButtonContainer animated fadeInUp">
		<a href="items.php" class="Icon" id="ITEMS">
			<div class="ButtonIcon" style="background: url('../MyItemIcon.png') no-repeat #F2D013; background-size: 80% 80%; background-position:center; "></div>
			<div class="ButtonText"><text class="ButtonIcons">My Items</text></div>
		</a>
	</div>

	<div class="ButtonContainer animated fadeInUp">
		<a href="settings.php" class="Icon" id="SETTINGS">
			<div class="ButtonIcon"
				 style="background: url('../SettingsIcon.png') no-repeat #FFF; background-size: 70% 70%; background-position:center; ">

			</div>
			<div class="ButtonText">
				<text class="ButtonIcons">Account Settings</text>
			</div>
		</a>
	</div>

	<div class="ButtonContainer animated fadeInUp">
		<a href="help.php" class="Icon" id="HELP">
			<div class="ButtonIcon"
				 style="background: url('../HelpIcon.png') no-repeat #1857B6; background-size: 80% 80%; background-position:center; ">

			</div>
			<div class="ButtonText">
				<text class="ButtonIcons">Help</text>
			</div>
		</a>
	</div>

	<?php
	if ($_SESSION['MY_TYPE'] == "ADMIN") {
		print    "
				<div class='ButtonContainer animated fadeInUp'>
					<a href='admin.php' class='Icon' id='ADMIN'>
					<div class='ButtonIcon' style='background: url(\"../AdminIcon.png\") no-repeat #ed1c24; background-size: 80% 80%; background-position:center; '>
					
					</div>
					<div class='ButtonText'>
						<text class='ButtonIcons'>Admin Tools</text>
					</div>
					</a>
				</div>									
				";
	} else {
		print    "
				<div class='ButtonContainer animated fadeInUp'>
					<div class='ButtonIcon' style='background: url(\"../AdminIcon.png\") no-repeat #ed1c24; background-size: 80% 80%; background-position:center; '>
						<div style='width: 100%; height: 100%; background: #333; opacity: 0.9;'>
						</div>
					</div>
					<div class='ButtonText'>
						<text class='ButtonIcons' style='color: #333;'>Admin Tools</text>
					</div>
				</div>";
	}
	?>

	</div>
</div>


	<?php

	$MY_USERNAME = $_SESSION['MY_EMAIL'];
	$QUERY = "SELECT ACCOUNT_STATUS FROM users WHERE EMAIL='" . $MY_USERNAME . "'";
	$DATA = mysql_query($QUERY);
	while ($ROW = mysql_fetch_array($DATA)) {
		$ACCOUNT_STATUS = $ROW['ACCOUNT_STATUS'];
		if ($ACCOUNT_STATUS == "EMAIL-CONFIRMED") {
			echo	"
					<script>
						$('#first-login').css('display', 'block');
					</script>
					";
		} elseif ($ACCOUNT_STATUS == "CWA") {
			echo	"
					<script>
						$('#admin-confirm').css('display','block');
				
					</script>
					";
		} else if ($ACCOUNT_STATUS == "NO-GROUP") {
			//DO THIS
		} else if ($ACCOUNT_STATUS == "NO-ADDRESS") {
			echo	"
					<script>
						$('#address').css('display', 'block');	
					</script>
					";
		} else if ($ACCOUNT_STATUS == "DENIED") {
			echo	"
					<script>
						$('#admin-denied').css('display', 'block');
					</script>
					";
		} else if ($ACCOUNT_STATUS == "CONFIRMED") {
			echo	"
					<script>
						$('#apps').css('display', 'block');
					</script>
					";
		} else {
			echo	"
					<script>
						$('#error').css('display', 'block');
					</script>
					";
		}
	}

	?>

	<!-- VIEWPORT SPACER -->
	<div class="viewport-spacer" id="spacer-2"></div>
	<!-- VIEWPORT SPACER -->

	<div class="footer animated fadeIn">
		<div class="BOTTOM-MENU-BACKEND">
			<text>
				MMXIV &copy; Copyright Librorum. All Rights Reserved.
			</text>
		</div>
	</div>

</div>

</body>

</html>
