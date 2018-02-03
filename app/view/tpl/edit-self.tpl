<br/><h4 class="font-weight-bold">Mano duomenys</h4><br/>
<div style="text-align: center">
        <table class="table table-bordered" style="width: 700px; margin: auto;">
            <thead><tr><th colspan="5">Statistika</th></tr></thead>
            <tbody><tr><td>Reitingas</td><td>Paskutinis</td><td>Pergalės</td><td>Viso žaista</td><td>Pergalių santykis</td></tr></tbody>
            <tbody><tr><td>[@Reitingas]</td><td>[@Paskutinis]</td><td>[@win]</td><td>[@played]</td><td>[@winPerc]</td></tr></tbody>
        </table><br/>
    <form method="POST" action="?view=users&action=selfupdate" enctype="multipart/form-data">
        <div>Vardas:</div><input style="min-width: 250px !important;text-align: center" type="text" value="[@Vardas]" name="Vardas"><br/><br/>
        <div>Pavarde:</div><input style="min-width: 250px !important;text-align: center" type="text" value="[@Pavardė]" name="Pavardė"><br/><br/>
        <div>El.paštas:</div><input style="min-width: 250px !important;text-align: center;background-color:#e6e6e6" type="email"  value="[@email]" name="email" readonly><br/><br/>
        <input type="submit" class="btn btn-secondary" value="Atnaujinti duomenis"><br/><br/><br/>
    </form>
    <form method="POST" action="?view=users&action=passchange&email=[@email]" enctype="multipart/form-data">
        <input type="email"  value="[@email]" name="email" hidden readonly>
        <div style="color: grey;"><b>Slaptažodžio keitimas</b></div><br/><div>Senas slaptažodis:</div><input style="min-width: 250px !important;text-align: center" type="password" name="password"><br/>
        <div>Naujas slaptažodis:</div><input style="min-width: 250px !important;text-align: center" type="password" name="newpassword"><br/>
        <div>Pakartokite naują slaptažodį:</div><input style="min-width: 250px !important;text-align: center" type="password" name="new2password"><br/><br/>
        <input type="submit" class="btn btn-secondary" value="Pakeisti slaptažodį"><br/><br/><br/>
    </form>
</div>
<div style="text-align: center">
<form method="POST" action="?view=users&action=delete&id=[@id]">
    <input type="submit" class="btn btn-danger" value="Ištrinti anketą"></form><br/> 
</div>
