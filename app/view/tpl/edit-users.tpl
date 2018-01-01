<div class="font-weight-bold" style="text-align: center">Žaidėjų duomenų redagavimas</div><br>
<div style="text-align: center">
    <form method="POST" action="?view=users&action=update&id=[@id]" enctype="multipart/form-data">
        <div>Vardas:</div><input type="text" value="[@Vardas]" name="Vardas"><br>
        <div>Pavarde:</div><input type="text" value="[@Pavardė]" name="Pavardė">
        <div>Slapyvardis:</div><input type="text" value="[@Slapyvardis]" name="Slapyvardis">
        <div>El.paštas:</div><input type="email" value="[@email]" name="email"><br>
        <div>Slaptažodis:</div><input type="password" value="[@password]" name="password"><br>
        <br><br>
        <input type="submit" class="btn btn-secondary" value="Registruotis"><br>
    </form><br>
    <div style="text-align: center">
    <form method="POST" action="?view=users&action=delete&id=[@id]">
        <input type="submit" class="btn btn-danger" value="Ištrinti"><br>
    </form></div>
</div>
