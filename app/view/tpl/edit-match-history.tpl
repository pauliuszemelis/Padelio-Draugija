<div class="font-weight-bold" style="text-align: center">Žaidimo duomenų redagavimas</div><br>
<div style="text-align: center">
    <form method="POST" action="?view=match_history&action=update&id=[@id]" enctype="multipart/form-data">
        <div>Data:</div><input type="date" value="[@Data]" name="Data" value="[@date]"><br><br>
        <table align="center"><tr style='align-content: center'>
                <td><div class="font-weight-bold">Mano komanda:</div><select name="teammate1">[@menu1]</select><br><select name="teammate2">[@menu2]</select></td>
                <td style="width:30px"> </td><td><div class="font-weight-bold">Oponentai:</div><select name="oponent1">[@menu3]</select><br><select name="oponent2">[@menu4]</select></td>
            </tr></table><br>
        <div>Pirmas setas:</div><input type="number" value="[@team1_result1]" name="team1_result1"><input type="number" value="[@team2_result1]" name="team2_result1">
        <div>Antras setas:</div><input type="number" value="[@team1_result2]" name="team1_result2"><input type="number" value="[@team2_result2]" name="team2_result2">
        <div>Trečias setas:</div><input type="number" value="[@team1_result3]" name="team1_result3"><input type="number" value="[@team2_result3]" name="team2_result3">
        <br><br><input type="submit" class="btn btn-secondary" value="Atnaujinti duomenis">
    </form><br>
</div>
<div style="text-align: center">
<form method="POST" action="?view=match_history&action=delete&id=[@id]">
    <input type="submit" class="btn btn-dark" value="Užšaldyti"></form><br>
<form method="POST" action="?view=match_history&action=undelete&id=[@id]">
    <input type="submit" class="btn btn-dark" value="Sugrąžinti"></form><br>
    <form method="POST" action="?view=match_history&action=permdelete&id=[@id]">
    <input type="submit" class="btn btn-danger" value="Ištrinti"></form><br>
</div>

