<?php
if(isset($_SESSION['lastmsg'])){
    $buttonPokalbiai = "btn-outline-primary";
}
else {
    $buttonPokalbiai = "btn-outline-danger";
}
    
if (isset($_COOKIE['user'])){
    $user = $_SESSION['name'];
echo "<div class='btn-block'>"
    . "<a class ='btn1 btn-sm btn-outline-primary' style='width:150px;'href='?view=match_plan&action=new'>Artėjantys žaidimai</a>"
    . "<a class ='btn1 btn-sm btn-outline-primary' href='?view=match_history&action=new'>Suvesti rezultatus</a>"
    . "<a class ='btn1 btn-sm btn-outline-primary' href='?view=match_history&action=table'>Žaidimų istorija</a>"
    . "<a class ='btn1 btn-sm btn-outline-primary' href='?view=users&action=table'>Žaidėjų sąrašas</a>"
    . "<a class ='btn1 btn-sm btn-outline-primary' href='?view=users&action=invite'>Pakviesti žaidėją</a>"
    . "<a class ='btn1 btn-sm $buttonPokalbiai' href='?view=chat&action=session'>Pokalbiai</a>"
    . "<a class ='btn1 btn-sm btn-outline-primary' style='width:110px;' href='?view=info&action=about'>Apie</a>"
    . "<a class ='btn1 btn-sm btn-outline-primary' href='?view=users&action=self'>$user</a>"
    . "<a class ='btn1 btn-sm btn-outline-primary' href='?view=users&action=logout'>Atsijungti</a></div>";
}
else {
        echo "<div class='btn-block'>"
        . "<a class ='btn1 btn-sm btn-outline-primary' href='?view=match_plan&action=new'>Artėjantys žaidimai</a>"
        . "<a class ='btn1 btn-sm btn-outline-primary' href='?view=match_history&action=new'>Suvesti rezultatus</a>"
        . "<a class ='btn1 btn-sm btn-outline-primary' href='?view=match_history&action=table'>Žaidimų istorija</a>"
        . "<a class ='btn1 btn-sm btn-outline-primary' href='?view=users&action=table'>Žaidėjų sąrašas</a>"
        . "<a class ='btn1 btn-sm btn-outline-primary' href='?view=chat&action=session'>Pokalbiai</a>"
        . "<a class ='btn1 btn-sm btn-outline-primary' href='?view=info&action=about'>Apie</a>"
        . "<a class ='btn1 btn-sm btn-outline-primary' href='?view=users&action=new'>Registruotis</a>"
        . "<a class ='btn1 btn-sm btn-outline-primary' href='?view=users&action=login'>Prisijungti</a></div>";
        }
?>
