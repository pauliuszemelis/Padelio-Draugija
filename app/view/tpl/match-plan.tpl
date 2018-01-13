<html>
    

  
 
<div class="font-weight-bold" style="text-align: center">Planuojami žaidimai</div><br/>
<div style="text-align: center">
    <form method="POST" action="?view=match_plan&action=create">
        <div>Data ir laikas:</div><input name="Data" type="text" id="datepicker" size="10" value="[@date]">
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
        <table align="center"><tr style='align-content: center'>
                <td><div class="font-weight-bold">Mano komanda:</div><select name="teammate1">[@menu]</select><br/><select name="teammate2">[@menu]</select></td>
                <td style="width:30px"> </td><td><div class="font-weight-bold">Oponentai:</div><select name="oponent1">[@menu]</select><br/><select name="oponent2">[@menu]</select></td>
            </tr></table><br/>
            <br/><input type="submit" class="btn btn-secondary" value="Išsaugoti duomenis">
    </form>
</div>
</html>