<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="icon" type="image/ico" href="uploads\title.png">
    <script type='text/javascript'>
        msg = "                  ";
        msg = "Kauno padelio klubas                          " + msg;
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
use app\Club;
$app = new Club();

?>

</body>
</html>




