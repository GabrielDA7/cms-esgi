<form action="<?= DIRNAME;?>user/login" method="POST">
	<label for="userName">Pseudo</label><input type="text" name="userName">
	<label for="pwd">Mot de passe</label><input type="password" name="pwd">
	<input type="submit" name="submit" value="connexion">
</form>

<?php 
	if($wrongPassword === true) {
		echo "Mauvais identifiants";
	}
?>