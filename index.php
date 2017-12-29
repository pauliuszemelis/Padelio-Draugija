<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--<title>Lithuania padel association / Lietuvos padelio Asociacija</title>-->
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="icon" type="image/ico" href="uploads\title.ico">
    <script type='text/javascript'>
        msg = "                  ";
        msg = "Lietuvos padelio teniso asociacija                          " + msg;
        position = 0;
        function scrolltitle() {
            document.title = msg.substring(position, msg.length) + msg.substring(0, position); position++;
            if (position > msg.length) position = 0
            window.setTimeout("scrolltitle()",170);
        }
        scrolltitle();
    </script>
</head>
<body>

<?php

include_once('include.php');
use app\Association;
$app = new Association();

?>

</body>
</html>




