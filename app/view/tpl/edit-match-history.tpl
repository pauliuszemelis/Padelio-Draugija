<br/><h4 class="font-weight-bold">Žaidimo duomenų redagavimas</h4><br/>
<div style="text-align: center">
    <form method="POST" action="?view=match_history&action=update&id=[@id]" enctype="multipart/form-data">
        <div>Data:</div><input name="Data" style="text-align:center" type="text" id="datepicker2" size="10" value="[@date]"><br/><br/>
        <table class="komandos" align="center"><br/>
            <tr><td>Mano komanda:</td><th style="width:30px"></th><td>Oponentai</td></tr>
            <tr><td><select style="min-width: 150px !important;" name="teammate1">[@menu1]</select></td><td></td>
                <td><select style="min-width: 150px !important;" name="oponent1">[@menu3]</select></td></tr>
            <tr><td><select style="min-width: 150px !important;" name="teammate2">[@menu2]</select></td><td></td>
                <td><select style="min-width: 150px !important;" name="oponent2">[@menu4]</select></td></tr>
            </table><br/>
        <div>Pirmas setas:</div><input type="number" value="[@team1_result1]" name="team1_result1"><input type="number" value="[@team2_result1]" name="team2_result1">
        <div>Antras setas:</div><input type="number" value="[@team1_result2]" name="team1_result2"><input type="number" value="[@team2_result2]" name="team2_result2">
        <div>Trečias setas:</div><input type="number" value="[@team1_result3]" name="team1_result3"><input type="number" value="[@team2_result3]" name="team2_result3">
        <br/><br/><input type="submit" class="btn btn-secondary" value="Atnaujinti duomenis">
    </form><br/>
</div>
<div style="text-align: center">
<form method="POST" action="?view=match_history&action=delete&id=[@id]">
    <input type="submit" class="btn btn-dark" value="Užšaldyti"></form><br/>
<form method="POST" action="?view=match_history&action=undelete&id=[@id]">
    <input type="submit" class="btn btn-dark" value="Sugrąžinti"></form><br/>
    <form method="POST" action="?view=match_history&action=permdelete&id=[@id]">
    <input type="submit" class="btn btn-danger" value="Ištrinti"></form><br/>
</div>

