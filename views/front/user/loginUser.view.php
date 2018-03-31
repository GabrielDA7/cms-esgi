<form action="<?= DIRNAME.USER_LOGIN_FRONT_LINK;?>" method="POST">
	<label for="userName">	Pseudo		 </label>	<input type="text" 		name="userName" required>
	<label for="pwd">		Mot de passe </label>	<input type="password" 	name="pwd" 	 	required>
	<input type="submit" name="submit" value="connexion">
</form>

<?php 
	if($wrongPassword === true) {
		echo "Mauvais identifiants";
	}
?>