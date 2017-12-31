<div class="font-weight-bold" style="text-align: center">Suveskite žaidimo duomenis</div><br>
<div style="text-align: center">
    <form method="POST" action="?view=match_history&action=create">
        <div>Data:</div><input type="date" name="date" value="[@date]">
        <table align="center"><tr style='align-content: center'>
                <td><div class="font-weight-bold">Mano komanda:</div><select name="teammate1">[@menu]</select><br><select name="teammate2">[@menu]</select></td>
                <td style="width:25px"> </td><td><div class="font-weight-bold">Oponentai:</div><select name="oponent1">[@menu]</select><br><select name="oponent2">[@menu]</select></td>
        </tr></table>
        <div>Pirmas setas:</div><input type="number" name="team1_result1"><input type="number" name="team2_result1">
        <div>Antras setas:</div><input type="number" name="team1_result2"><input type="number" name="team2_result2">
        <div>Trečias setas:</div><input type="number" name="team1_result3"><input type="number" name="team2_result3">
        <br><br><input type="submit" class="btn btn-secondary" value="Išsaugoti duomenis">
    </form>
</div>



