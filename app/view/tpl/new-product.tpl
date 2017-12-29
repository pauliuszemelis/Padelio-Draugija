<div style="text-align: center">
	<form method="POST" action="?view=product&action=create" enctype="multipart/form-data">
        <div>Pavadinimas:</div><input type="text" name="name"><br>
        <div>EAN:</div><input type="number" name="ean">
        <div>Mato vienetas:</div><select name="unit">
            <option value="KG">KG</option>
            <option value="PCS">VNT</option>
        </select><br>
        <div>Svoris:</div><input step="0.001" type="number" name="weight"><br>
        <div>Savikaina:</div><input type="number" step="0.001" name="prime_cost"><br>
        <div>Pardavimo kaina:</div><input type="number" step="0.001" name="sale_price"><br>
        <div>Nuotrauka:</div><input type="file" accept="image/jpeg" name="picture"><br><br>
	<input type="submit" class="btn btn-secondary" value="Išsaugoti duomenis"><br>
	</form><br>
</div>
