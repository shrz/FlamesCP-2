<?php

require 'include/login.php';

if (!isset($_SESSION['username'])){

	header('Location: /');
	die();
	
}

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
        $consoletext = file_get_contents($logFile);
        $consoletext = preg_replace("/\[0;(.*);22m/", '', $consoletext);
        $consoletext = preg_replace("/\[0;(.*);1m/", '', $consoletext);
        $consoletext = preg_replace("/\[m/", '', $consoletext);
	$consoletext = strip_tags($consoletext);
        echo $consoletext;
}else{
?>
<html>
	<title>Log</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<div class="container-fluid">
	<style>
		@import url(http://fonts.googleapis.com/css?family=Ubuntu);
		body{
			background-color: black;
			background: black;
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
			/*top: -34px;*/
			top: -12px;
		}
		#scrollLock{
			width:2px;
			height: 0px;
			/* overflow:visible; */
			overflow: hidden;
		}
	</style>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
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
		<div id="scrollLock"> <input style="display: none" class="disableScrollLock" type="button" value="Disable Scroll Lock" /> <input class="enableScrollLock" style="display: none;" type="button" value="Enable Scroll Lock" /></div>
	</body>
</html>
<?php  } ?>
