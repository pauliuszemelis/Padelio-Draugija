<div style="text-align: center">
    <form method="POST" action="?view=match_history&action=create">
        <div>Data:</div><input type="date" name="date" value="[@date]">
        <div>Mano komanda:</div><select name="teammate1">[@menu]</select><br><select name="teammate2">[@menu]</select><br>
        <div>Oponentai:</div><select name="oponent1">[@menu]</select><br><select name="oponent2">[@menu]</select><br>
        <div>Pirmas setas:</div><input type="number" name="team1_result1"><input type="number" name="team2_result1">
        <div>Antras setas:</div><input type="number" name="team1_result2"><input type="number" name="team2_result2">
        <div>Trečias setas:</div><input type="number" name="team1_result3"><input type="number" name="team2_result3">
        <br><br><input type="submit" class="btn btn-secondary" value="Išsaugoti duomenis">
    </form>
</div>



