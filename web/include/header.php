<?php
require 'include/db.php';
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>FlamesCP 2</title>
<style>
@import 'https://fonts.googleapis.com/css?family=ABeeZee';
body {
font-family: 'ABeeZee';
padding-top: 20px;
}

.col-center {
   float: none;
   margin-right: auto;
   margin-left: auto;
}

.iframediv {
border-radius: 10px;
width: 100%;
overfloy: hidden;
}
</style>

<script>
$(document).ready(function() {
    $("#startserver").click(function(){

	$.get( "start_server.php", function( data ) {
	  $( "#msgarea" ).html( data );
	});

    }); 

    $("#stopserver").click(function(){

        $.get( "stop_server.php", function( data ) {
          $( "#msgarea" ).html( data );
        });

    });

           $.get('status.php', function(data) {
                $('#srvstatus').html(data);
            });

	setInterval(function(){
	    $.get('status.php', function(data) {
	        $('#srvstatus').html(data);
	    });
	}, 3000); // 5 seconds

});

$(document).on('submit', '#cmdform', function(e) {
     $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        success: function(html) {
        $('#cmdform')[0].reset();
        }
    });
    e.preventDefault();
});

</script>

</head>
