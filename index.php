<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--<title>Lithuania padel tennis society / Lietuvos padelio teniso draugija</title>-->
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="icon" type="image/ico" href="uploads\title.png">
    <script type='text/javascript'>
        msg = "                  ";
        msg = "Lietuvos padelio teniso draugija                          " + msg;
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
use app\Society;
$app = new Society();

?>

</body>
</html>




