<?php
$user = (new \app\controller\UsersController())->loggedUser();
    if (isset($_COOKIE['user'])){
        echo "<div style='text-align: center'>"
        . "<a class ='btn btn-light' href='?view=match_history&action=new'>Naujas rezultatas</a>"
        . "<a class ='btn btn-light' href='?view=match_history&action=table'>Žaidimų istorija</a>"
        . "<a class ='btn btn-light' href='?view=users&action=table'>Žaidėjų sąrašas</a>"
        . "<a class ='btn btn-light' href='?view=users&action=new'>Registruoti žaidėją</a>"
        . "<a class ='btn btn-light' href='?view=users&action=logout'>Atsijungti</a>"
        . "<a class ='btn btn-light' href='?view=users&action=self&id=".$_COOKIE['user']."'>(".$user.")</a>";
        } else {
        echo "<div style='text-align: center'>"
        . "<a class ='btn btn-light' href='?view=match_history&action=new'>   Naujas rezultatas   </a>"
        . "<a class ='btn btn-light' href='?view=match_history&action=table'>   Žaidimų istorija   </a>"
        . "<a class ='btn btn-light' href='?view=users&action=table'>   Žaidėjų sąrašas   </a>"
        . "<a class ='btn btn-light' href='?view=users&action=new'>   Registruotis   </a>"
        . "<a class ='btn btn-light' href='?view=users&action=login'>   Prisijungti   </a>";
        }
?>
<pre>

</pre>
