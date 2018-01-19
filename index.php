<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css\bootstrap.min.css">
        <link rel="icon" type="image/ico" href="uploads\ball.ico">

    <div class="parent">
        <img id='header' role="banner" src='uploads/padelblue.jpg' alt='Banner Image'/>
        <a href="http://padelioklubas.lt" title="Padelio teniso klubas"><img id="pavadinimas" src='uploads/picturetopeople9.png'/></a>
    </div>
    <title>Padelio teniso klubas</title>
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="js/jquery.datepicker.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#datepicker").datepicker({dateFormat: 'yy-mm-dd', minDate: 0, maxDate: "+14D"}).val();
        });
        $(function () {
            $("#datepicker2").datepicker({dateFormat: 'yy-mm-dd', minDate: "-14D", maxDate: 0}).val();
        });
    </script>

</head>
<body class="body">

    <?php
    include (__DIR__ . '/header.php');
    ?>
    <div>
        <?php
        include_once ('include.php');

        use app\Club;

$app = new Club();
        ?>
    </div>

</body>
<footer class="footer">  © 2018 Padelio Teniso Klubas </footer>
</html>