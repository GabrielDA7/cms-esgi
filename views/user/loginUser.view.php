<form action="<?= DIRNAME.USER_LOGIN_LINK;?>" method="POST">
	<label for="userName">	Pseudo</label>			<input type="text" 		name="userName">
	<label for="pwd">		Mot de passe</label>	<input type="password" 	name="pwd">
	<input type="submit" name="submit" value="connexion">
</form>

<?php 
	if($wrongPassword === true) {
		echo "Mauvais identifiants";
	}
?>