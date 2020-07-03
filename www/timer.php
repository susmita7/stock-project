<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>





<div class="example stopwatch" data-timer="900" id="count-down"></div>


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="TimeCircles/TimeCircles.js"></script>
<link rel="stylesheet" type="text/css" href="TimeCircles/TimeCircles.css">


<script type="text/javascript">
    $(function () {  
     $("#count-down").TimeCircles();
	$("#count-down").TimeCircles().end().fadeOut(); 
		
		
$(".example.stopwatch").TimeCircles();

});
</script>
</body>
</html>

