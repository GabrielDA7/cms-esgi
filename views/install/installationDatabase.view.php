<h1>Base de données</h1>

<form action="<?= DIRNAME.INSTALLATION_ADMIN_LINK;?>" method="POST">
		<label for="user"> Nom d'utilisateur </label> <input type="text"     name="user"> </br>
        <label for="pwd">  Mot de passe 	 </label> <input type="text"     name="pwd">  </br>
        <label for="host"> Url    			 </label> <input type="text"     name="host"> </br>
        <label for="name"> Nom de la base  	 </label> <input type="text"     name="name"> </br>
        <label for="port"> Port    			 </label> <input type="number"   name="port"> </br>
        <input type="submit" name="submit" value="Valider">
</form>