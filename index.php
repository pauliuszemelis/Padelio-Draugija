<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <link rel="icon" type="image/ico" href="uploads\title.png">
    <script type='text/javascript'>
        msg = "                  ";
        msg = "Padelio teniso klubas                          " + msg;
        position = 0;
        function scrolltitle() {
            document.title = msg.substring(position, msg.length) + msg.substring(0, position); position++;
            if (position > msg.length) position = 0;
            window.setTimeout("scrolltitle()",170);
        }
        scrolltitle();
    </script>
    <style>
body { 
    background: lightblue url("uploads/pretty image.jpg") no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover; 
}

.header {
    width: 100%;
    height: 30px;
    top: 0;
    text-align: center;
}
.footer {
    width: 100%;
    background-color: #e5e5e5;
    height: 25px;
    position: fixed;
    bottom: 0px;  
    color: #000;
    text-align: center;
}

</style>
</head>
<body class="body">

<?php
include_once ('include.php');
use app\Club;
$app = new Club();

?>
    
<div class="footer">  © 2017 Padelio Teniso Klubas </div>
</body>
</html>




