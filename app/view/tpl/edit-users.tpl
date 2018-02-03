<br/><h4 class="font-weight-bold">Žaidėjų duomenų redagavimas</h4><br/>
<div style="text-align: center">
    <form method="POST" action="?view=users&action=update&id=[@id]" enctype="multipart/form-data">
        <div>Vardas:</div><input style="min-width: 250px !important;" type="text" value="[@Vardas]" name="Vardas"><br/>
        <div>Pavarde:</div><input style="min-width: 250px !important;" type="text" value="[@Pavardė]" name="Pavardė">
        <div>El.paštas:</div><input style="min-width: 250px !important;" type="email" value="[@email]" name="email"><br/>
        <div>Reitingas:</div><input style="min-width: 250px !important;" type="number" value="[@Reitingas]" name="Reitingas"><br/>
        <div>Paskutinis:</div><input style="min-width: 250px !important;" type="number" value="[@Paskutinis]" name="Paskutinis"><br/>
        <div>Pergalės:</div><input style="min-width: 250px !important;" type="number" value="[@win]" name="win"><br/>
        <div>Pralaimėjimai:</div><input style="min-width: 250px !important;" type="number" value="[@lose]" name="lose"><br/>
        <div>Slaptažodis:</div><input style="min-width: 250px !important;" type="password" name="password"><br/>
        <br/>
        <input type="submit" class="btn btn-secondary" value="Atnaujinti duomenis"><br/>
    </form><br/>
</div>
<div style="text-align: center">
<form method="POST" action="?view=users&action=delete&id=[@id]">
    <input type="submit" class="btn btn-dark" value="Užšaldyti"></form><br/>
<form method="POST" action="?view=users&action=undelete&id=[@id]">
    <input type="submit" class="btn btn-dark" value="Sugrąžinti"></form><br/>
    <form method="POST" action="?view=users&action=permdelete&id=[@id]">
    <input type="submit" class="btn btn-danger" value="Ištrinti"></form><br/>
</div>
