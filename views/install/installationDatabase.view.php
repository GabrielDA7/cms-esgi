<h1>Base de données</h1>

<form action="<?= DIRNAME.INSTALLATION_DATABASE_LINK;?>" method="POST">
		<label for="dbuser"> Nom d'utilisateur </label> <input type="text"     name="dbuser"> </br>
        <label for="dbpwd">  Mot de passe 	   </label> <input type="text"     name="dbpwd">  </br>
        <label for="dbhost"> Url    		   </label> <input type="text"     name="dbhost"> </br>
        <label for="dbname"> Nom de la base    </label> <input type="text"     name="dbname"> </br>
        <label for="dbport"> Port    		   </label> <input type="number"   name="dbport"> </br>
        <input type="submit" name="submit" value="Valider">
</form>