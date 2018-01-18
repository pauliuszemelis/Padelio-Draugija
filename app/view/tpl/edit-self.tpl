<br/><h4 class="font-weight-bold">Redaguoti mano duomenis</h4><br/>
<div style="text-align: center">
    <form method="POST" action="?view=users&action=selfupdate" enctype="multipart/form-data">
        <div id="text">Vardas:</div><input style="min-width: 250px !important;" type="text" value="[@Vardas]" name="Vardas"><br/>
        <div id="text">Pavarde:</div><input style="min-width: 250px !important;" type="text" value="[@Pavardė]" name="Pavardė">
        <div id="text">Slapyvardis:</div><input style="min-width: 250px !important;" type="text" value="[@Slapyvardis]" name="Slapyvardis">
        <div id="text">El.paštas:</div><input style="min-width: 250px !important;" type="email" value="[@email]" name="email"><br/>
        <div id="text">Slaptažodis:</div><input style="min-width: 250px !important;" type="password" name="password"><br/>
        <br/><br/>
        <input type="submit" class="btn btn-secondary" value="Atnaujinti duomenis"><br/>
    </form><br/>
</div>
<div style="text-align: center">
<form method="POST" action="?view=users&action=delete&id=[@id]">
    <input type="submit" class="btn btn-danger" value="Ištrinti anketą"></form><br/> 
</div>
