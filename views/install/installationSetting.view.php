<h1>Parametres</h1>

<form action="<?= DIRNAME.INSTALLATION_SETTING_LINK;?>" method="POST">
		<label for="LANGUAGE">Langue</label>
        <select name="LANGUAGE">
  			<option value="french">Francais</option> 
  			<option value="english">Anglais</option>
		</select>
		<br>

		<label for="FRONT_TEMPLATE">Template Front</label>
		<select name="FRONT_TEMPLATE">
  			<option value="defaultFront">Defaut</option> 
  			<option value="templateFront1">Template 1</option>
  			<option value="templateFront2">Template 2</option>
		</select>
		<br>

		<label for="BACK_TEMPLATE">Template Back</label>
		<select name="BACK_TEMPLATE">
  			<option value="defaultBack">Default</option> 
  			<option value="templateBack1">Template 1</option>
  			<option value="templateBack2">Template 2</option>
		</select>
		<br>

        <input type="submit" name="submit" value="Valider">
</form>