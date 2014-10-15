<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Touchpunchtest</title>
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no">
<script src="http://code.jquery.com/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>

<script src="../jquery.ui.touch-punch.min.js"></script>


<script>


jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();

</script>
</head>
<body>
<div id="draggybox" onClick="void(0)" style="width: 150px; height: 150px; background: green;"></div>
<script>$('#draggybox').draggable();</script>
</body>
</html>