<style>

div.dots {
	width: 10px;
	height: 10px;
	border-radius: 5px; 
	display: inline-block;
	margin: 5px;
	

}
</style>

	<script type="text/javascript" src="../includes/jquery.min.js"></script>
	<script type="text/javascript" src="../includes/jquery.color.js"></script>

	<script>
	
	$(".dots").css("background", "white");
	
	
	$(document).ready( function(){
	
	var interval = setInterval(function () {
    $("#1").delay(300).animate({backgroundColor: "green"}, 500);	
	$("#2").delay(600).animate({backgroundColor: "green"}, 500);
	$("#3").delay(900).animate({backgroundColor: "green"}, 500);
	$("#4").delay(1200).animate({backgroundColor: "green"}, 500);
	$("#5").delay(1500).animate({backgroundColor: "green"}, 500);	
	
	
	$("#1").delay(600).animate({backgroundColor: "white"}, 500);
	$("#2").delay(700).animate({backgroundColor: "white"}, 500);
	$("#3").delay(800).animate({backgroundColor: "white"}, 500);
	$("#4").delay(900).animate({backgroundColor: "white"}, 500);
	$("#5").delay(1000).animate({backgroundColor: "white"}, 500);
}, 10);	

	var interval = setInterval(function () {
    $("#6").delay(250).animate({backgroundColor: "green"}, 500);	
	$("#7").delay(600).animate({backgroundColor: "green"}, 500);
	$("#8").delay(900).animate({backgroundColor: "green"}, 500);
	$("#9").delay(1000).animate({backgroundColor: "green"}, 500);
	$("#10").delay(1500).animate({backgroundColor: "green"}, 500);	
	
	
	$("#6").delay(600).animate({backgroundColor: "white"}, 500);
	$("#7").delay(700).animate({backgroundColor: "white"}, 500);
	$("#8").delay(800).animate({backgroundColor: "white"}, 500);
	$("#9").delay(900).animate({backgroundColor: "white"}, 500);
	$("#10").delay(1000).animate({backgroundColor: "white"}, 500);
}, 15);
	
	});
	
	</script>
	

<div class="dots" id="1"></div>
<div class="dots" id="2"></div>
<div class="dots" id="3"></div>
<div class="dots" id="4" ></div>
<div class="dots" id="5"></div><br>

<div class="dots" id="6"></div>
<div class="dots" id="7"></div>
<div class="dots" id="8"></div>
<div class="dots" id="9" ></div>
<div class="dots" id="10"></div>