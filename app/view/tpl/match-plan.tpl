<br/><h4 class="font-weight-bold">Artėjantys žaidimai</h4><br/>
<div style="text-align: center">
    <form method="POST" action="?view=match_plan&action=create">
        <div>Data, laikas ir žaidėjų lygis</div>
        <input name="Data" style="text-align:center;" type="text" id="datepicker" size="10" value="[@date]">
        <select name="Laikas">
            <option value="22:00">22:00</option>
            <option value="21:30">21:30</option>
            <option value="21:00">21:00</option>
            <option value="20:30">20:30</option>
            <option value="20:00">20:00</option>
            <option value="19:30">19:30</option>
            <option value="19:00" selected="19:00">19:00</option>
            <option value="18:30">18:30</option>
            <option value="18:00">18:00</option>
            <option value="17:30">17:30</option>
            <option value="17:00">17:00</option>
            <option value="16:30">16:30</option>
            <option value="16:00">16:00</option>
            <option value="15:30">15:30</option>
            <option value="15:00">15:00</option>
            <option value="14:30">14:30</option>
            <option value="14:00">14:00</option>
            <option value="13:30">13:30</option>
            <option value="13:00">13:00</option>
            <option value="12:30">12:30</option>
            <option value="12:00">12:00</option>
            <option value="11:30">11:30</option>
            <option value="11:00">11:00</option>
            <option value="10:30">10:30</option>
            <option value="10:00">10:00</option>
            <option value="09:30">09:30</option>
            <option value="09:00">09:00</option>
            <option value="08:30">08:30</option>
            <option value="08:00">08:00</option>
            <option value="07:30">07:30</option>
            <option value="07:00">07:00</option>
        </select>
        <input name="Lygis" style="text-transform:uppercase; text-align:center;" type="text" placeholder=" pvz: B-C " size="5" >
        <br/><br/>
        <table class="komandos" align="center">
            <tr><td>Mano komanda:</td><th style="width:30px"></th><td>Oponentai</td></tr>
            <tr><td><select style="min-width: 150px !important;" name="teammate1">[@menu]</select></td><td></td>
                <td><select style="min-width: 150px !important;" name="oponent1">[@menu]</select></td></tr>
            <tr><td><select style="min-width: 150px !important;" name="teammate2">[@menu]</select></td><td></td>
                <td><select style="min-width: 150px !important;" name="oponent2">[@menu]</select></td></tr>
            </table>
            <br/><input type="submit" class="btn btn-secondary" value="Išsaugoti duomenis"><br/><br/>
    </form>
</div>
