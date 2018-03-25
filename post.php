<?php
@session_start();
if(isset($_SESSION['nickname'])){
    $text = $_POST['text'];
    $days = ["Pirm. ","Antr. ","Treč. ","Ketv. ","Penk. ","Šešt. ","Sekm. "];
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'>(".$days[date("N")-1].date("G:i").") <b>".$_SESSION['nickname']."</b>: ".stripslashes(htmlspecialchars($text))."<br/></div>");
    fclose($fp);
}    