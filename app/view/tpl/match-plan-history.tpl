<div class="font-weight-bold" style="text-align: center">Suveskite žaidimo duomenis</div><br/>
<div style="text-align: center">
    <form method="POST" action="?view=match_history&action=createfromplan&id=[@id]">
        <div>Data:</div><input style="text-align:center;" name="Data" type="text" id="datepicker2" size="10" value="[@date]"><br/>
        <table align="center"><tr style='align-content: center'>
                <br/><td><div class="font-weight-bold">Mano komanda:</div>
                    <select style="min-width: 150px !important;" name="teammate1">[@menu1]</select><br/>
                    <select style="min-width: 150px !important;" name="teammate2">[@menu2]</select></td>
                <td style="width:30px"> </td><td><div class="font-weight-bold">Oponentai:</div>
                    <select style="min-width: 150px !important;" name="oponent1">[@menu3]</select><br/>
                    <select style="min-width: 150px !important;" name="oponent2">[@menu4]</select></td>
            </tr></table><br/>
        <div>Pirmas setas:</div><input type="number" name="team1_result1"><input type="number" name="team2_result1">
        <div>Antras setas:</div><input type="number" name="team1_result2"><input type="number" name="team2_result2">
        <div>Trečias setas:</div><input type="number" name="team1_result3"><input type="number" name="team2_result3">
        <br/><br/><input type="submit" class="btn btn-secondary" value="Išsaugoti duomenis">
    </form>
</div><br/><br/>
