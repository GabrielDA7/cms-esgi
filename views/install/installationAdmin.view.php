<h1>Compte Administrateur</h1>

<form action="<?= DIRNAME.INSTALLATION_ADMIN_LINK;?>" method="POST">
	<label for="userName">	Pseudo 		 </label> <input type="text" 	 name="userName"  value="admin"			  required> </br>
	<label for="name">		Prenom		 </label> <input type="text" 	 name="name" 	  value="Louis"			  required> </br>
	<label for="firstName">	Nom 		 </label> <input type="text" 	 name="firstName" value="Louis"		      required> </br>
	<label for="email">		email		 </label> <input type="email"    name="email" 	  value="louis@gmail.com" required> </br>
	<label for="age">		age			 </label> <input type="number"   name="age" 	  value="20" 			  required> </br>
	<label for="pwd">		Mot de passe </label> <input type="password" name="pwd" 	  value="aze" 		      required> </br>

	<input type="hidden" name="role" 		 	  value="<?=ADMIN_ROLE;?>" required> </br>
	<input type="hidden" name="installation_Done" value="true" 			   required> </br>
	<input type="submit" name="submit" 		 	  value="Valider">
</form>