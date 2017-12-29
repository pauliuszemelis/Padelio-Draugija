<div style="text-align: center">
	<form method="POST" action="?view=product&action=update&id=[@id]" enctype="multipart/form-data">
        <div>Pavadinimas:</div><input type="text" value="[@name]" name="name"><br>
        <div>EAN:</div><input type="number" value="[@ean]" name="ean">
        <div>Mato vienetas:</div><select name="unit">
            <option value="KG" [@unit_KG]>KG</option>
            <option value="PCS" [@unit_PCS]>VNT</option>
        </select><br>
        <div>Svoris:</div><input step="0.001" value="[@weight]" type="number" name="weight"><br>
        <div>Savikaina:</div><input type="number" step="0.001" value="[@prime_cost]" name="prime_cost"><br>
        <div>Pardavimo kaina:</div><input type="number" step="0.001" value="[@sale_price]" name="sale_price"><br>
        <div>Nuotrauka:</div><input type="text" disabled value="[@picture]" name="picture"><br><br>
	<input type="submit" class="btn btn-secondary" value="Išsaugoti duomenis"><br>
	</form><br>
    <form method="POST" action="?view=workers&action=delete&id=[@id]">
        <input type="submit" class="btn btn-danger" value="Ištrinti"><br>
    </form>
</div>
