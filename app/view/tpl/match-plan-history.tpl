<br/><h4 class="font-weight-bold">Suveskite žaidimo duomenis</h4><br/>
<div style="text-align: center">
    <form method="POST" action="?view=match_history&action=createfromplan&id=[@id]">
        <div>Data:</div><input style="text-align:center;" name="Data" type="text" id="datepicker2" size="10" value="[@date]"><br/>
        <table class="komandos" align="center"><br/>
            <tr><td>Mano komanda:</td><th style="width:30px"></th><td>Oponentai</td></tr>
            <tr><td><select style="min-width: 150px !important;" name="teammate1">[@menu1]</select></td><td></td>
                <td><select style="min-width: 150px !important;" name="oponent1">[@menu3]</select></td></tr>
            <tr><td><select style="min-width: 150px !important;" name="teammate2">[@menu2]</select></td><td></td>
                <td><select style="min-width: 150px !important;" name="oponent2">[@menu4]</select></td></tr>
            </table><br/>
        <div>Pirmas setas:</div><input type="number" name="team1_result1"><input type="number" name="team2_result1">
        <div>Antras setas:</div><input type="number" name="team1_result2"><input type="number" name="team2_result2">
        <div>Trečias setas:</div><input type="number" name="team1_result3"><input type="number" name="team2_result3">
        <br/><br/><input type="submit" class="btn btn-secondary" value="Išsaugoti duomenis">
    </form>
</div><br/><br/>
