<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>


<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script type="text/javascript" src="http://www.pureexample.com/js/lib/jquery.ui.touch-punch.min.js"></script>
 
 
<!-- CSS -->
<style type="text/css">
.square {
    width: 200px;
    height: 200px;
    border: 1px solid black;
    margin-bottom: 5px;
    margin-left: 5px;
    text-align: center;
    line-height: 200px;
    background-color: lightblue;
    cursor: pointer;
}
</style>
 
 
<!-- Javascript -->
<script>
    $(function () {
        $("#dragItem").draggable({
            opacity: 0.5
        });
        $("#slider").slider({
            range: "min",
            value: 0.5,
            min: 0.1,
            max: 1,
            step: 0.01,
            slide: function (event, ui) {
                $("#info").html("dragging opacity : " + ui.value);
                $("#dragItem").draggable("option", "opacity", ui.value);
            }
        });
    });
</script>
 </head>
 
 <body>
<!-- HTML -->
<div>
    <div id="dragItem" class="square"><span id="info">dragging opacity : 0.5</span></div>                   
</div>
Slide to adjust dragging opacity
<div id="slider" style="width:300px"></div>


</body>
</html>