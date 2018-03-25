<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Padelio Teniso klubas - tai žmonių bendruomenė, kurią vienija noras žaisti padelį. Bendruomenę sudaro skirtingo lygio, amžiaus ar lyties žaidėjai. www.padelioklubas.lt puslapio tikslas - suburti įvairių lygių žaidėjus į vieną vietą, išsaugoti norimus žaidimų rezultatus, bendrauti tarpusavyje pokalbių sistemoje, planuoti ateinančius žaidimus, bei konkuruoti šio puslapio reitingavimo sistemoje.">
        <meta name="keywords" content="padelio klubas, padelioklubas, padelioklubas.lt, padel club, padelis Kaune, padel, padelis, padelio tenisas, padel tennis, padelio žaidimas, žaidimų istorija, planuojami žaidimai, žaidėjų sąrašas, žaidėjų reitingai">
        <link rel="stylesheet" href="css\bootstrap.min.css">
        <link rel="icon" type="image/ico" href="uploads\ball.ico">

    <div class="parent">
        <img id='header' role="banner" src='uploads/padelblue.jpg' alt='Banner Image'/>
        <a href="http://padelioklubas.lt/?view=match_plan&action=new" title="Padelio teniso klubas"><img id="pavadinimas" src='uploads/14.png'/></a>
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