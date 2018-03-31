<h1>Base de données</h1>

<form action="<?= DIRNAME.INSTALLATION_DATABASE_LINK;?>" method="POST">
		<label for="DBUSER"> Nom d'utilisateur </label> <input type="text"     name="DBUSER"> </br>
        <label for="DBPWD">  Mot de passe 	   </label> <input type="text"     name="DBPWD">  </br>
        <label for="DBHOST"> Url    		   </label> <input type="text"     name="DBHOST"> </br>
        <label for="DBNAME"> Nom de la base    </label> <input type="text"     name="DBNAME"> </br>
        <label for="DBPORT"> Port    		   </label> <input type="number"   name="DBPORT"> </br>
        <input type="submit" name="submit" value="Valider">
</form>