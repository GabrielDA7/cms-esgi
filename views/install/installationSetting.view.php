<h1>Parametres</h1>

<form action="<?= DIRNAME.INSTALLATION_SETTING_LINK;?>" method="POST">
		<label for="language">Langue</label>
        <select name="language">
  			<option value="french">Francais</option> 
  			<option value="english">Anglais</option>
		</select>
		<br>

		<label for="templateFront">Template Front</label>
		<select name="templateFront">
  			<option value="defaultFront">Defaut</option> 
  			<option value="templateFront1">Template 1</option>
  			<option value="templateFront2">Template 2</option>
		</select>
		<br>

		<label for="templateBack">Template Back</label>
		<select name="templateBack">
  			<option value="defaultBack">Default</option> 
  			<option value="templateBack1">Template 1</option>
  			<option value="templateBack2">Template 2</option>
		</select>
		<br>

        <input type="submit" name="submit" value="Valider">
</form>