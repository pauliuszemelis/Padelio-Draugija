<div style="text-align: center">
    <a href='?view=match_history&action=new'>-   Naujas rezultatas   -</a>
    <a href='?view=match_history&action=list'>-   Žaidimų istorija   -</a>
    <a href='?view=users&action=list'>-   Žaidėjų sąrašas   -</a>
    <a href='?view=users&action=new'>-   Registruotis   -</a>
    <a href="?view=users&action=logout">-   Atsijungti   -</a>
    <?php
    if (isset($_COOKIE['user'])){
        echo ("Prisijungęs kaip ");
        $model = new \app\controller\UsersController();
        echo $model->loggedUser();}?>
</div>
<pre>

</pre>
