<?php
    if (isset($_COOKIE['user'])){
        echo "<div style='text-align: center'>"
        . "<a href='?view=match_history&action=new'>-   Naujas rezultatas   -</a>"
        . "<a href='?view=match_history&action=listall'>-   Žaidimų istorija   -</a>"
        . "<a href='?view=users&action=listall'>-   Žaidėjų sąrašas   -</a>"
        . "<a href='?view=users&action=new'>-   Registruoti žaidėją   -</a>"
        . "<a href='?view=users&action=logout'>-   Atsijungti   -</a>";
        echo (" (");
        $model = new \app\controller\UsersController();
        echo $model->loggedUser();
        echo ")</div>";
        } else {
        echo "<div style='text-align: center'>"
        . "<a href='?view=match_history&action=new'>-   Naujas rezultatas   -</a>"
        . "<a href='?view=match_history&action=listall'>-   Žaidimų istorija   -</a>"
        . "<a href='?view=users&action=listall'>-   Žaidėjų sąrašas   -</a>"
        . "<a href='?view=users&action=new'>-   Registruotis   -</a>"
        . "<a href='?view=users&action=login'>-   Prisijungti   -</a>";
        }
?>
<pre>

</pre>
