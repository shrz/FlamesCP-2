<!--<body style="background: transparent">-->
<?php
include 'include/login.php';
if ($logged_in == "false"){
header("Location: /");
die();
}

?>

<?php
/*
 * Easy PHP Tail 
 * by: Thomas Depole
 * v1.0
 * 
 * just fill in the varibles bellow, open in a web browser and tail away 
 */
$logFile = "/SERVER/logs/latest.log"; // local path to log file
$interval = 1000; //how often it checks the log file for changes, min 100
$textColor = ""; //use CSS color
// Don't have to change anything bellow
if(!$textColor) $textColor = "white";
if($interval < 100)  $interval = 100; 
if($_GET['getLog']){
	echo system("tail ".$logFile." -n 50");
}else{
include 'include/header.php';
?>
	<style>
		@import url(http://fonts.googleapis.com/css?family=Ubuntu);
		body{
			background-color: black;
			color: <?php echo $textColor; ?>;
			font-family: 'Ubuntu', sans-serif;
			font-size: 16px;
			line-height: 20px;	
		}
		h4{
			font-size: 18px;
			line-height: 22px;
			color: #353535;
		}
		#log {
			position: relative;
			top: -34px;
		}
		#scrollLock{
			width:2px;
			height: 2px;
			overflow:visible;
		}
	</style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>
		setInterval(readLogFile, <?php echo $interval; ?>);
		window.onload = readLogFile; 
		var pathname = window.location.pathname;
		var scrollLock = true;
		
		$(document).ready(function(){
			$('.disableScrollLock').click(function(){
				$("html,body").clearQueue()
				$(".disableScrollLock").hide();
				$(".enableScrollLock").show();
				scrollLock = false;
			});
			$('.enableScrollLock').click(function(){
				$("html,body").clearQueue()
				$(".enableScrollLock").hide();
				$(".disableScrollLock").show();
				scrollLock = true;
			});
		});
		function readLogFile(){
			$.get(pathname, { getLog : "true" }, function(data) {
				data = data.replace(new RegExp("\n", "g"), "<br />");
		        $("#log").html(data);
		        
		        if(scrollLock == true) { $('html,body').animate({scrollTop: $("#scrollLock").offset().top}, <?php echo $interval; ?>) };
		    });
		}
	</script>
	<body>
		
	<div id="log">
			
		</div>
<div class="container">
<p class="small"><b>Settings</b></p>
		<div id="scrollLock"><input class="disableScrollLock btn btn-success btn-sm" type="button" value="Automatic scrolling enabled. Press me to disable." /> <input class="enableScrollLock btn btn-danger btn-sm" style="display: none;" type="button" value="Automatic scrolling disabled. Press me to enable." /></div></div><br> </br>
	</body>
<br>
</html>
<?php  } ?>
