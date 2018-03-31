<form action="<?= DIRNAME.USER_ADD_FRONT_LINK;?>" method="POST">
	<label for="userName">	Pseudo 		 </label> <input type="text" 	 name="userName"  value="Lala"			  required> </br>
	<label for="name">		Prenom		 </label> <input type="text" 	 name="name" 	  value="Louis"			  required> </br>
	<label for="firstName">	Nom 		 </label> <input type="text" 	 name="firstName" value="Louis"		      required> </br>
	<label for="email">		email		 </label> <input type="email"    name="email" 	  value="louis@gmail.com" required> </br>
	<label for="age">		age			 </label> <input type="number"   name="age" 	  value="20" 			  required> </br>
	<label for="pwd">		Mot de passe </label> <input type="password" name="pwd" 	  value="aze" 		      required> </br>
	<input type="submit" name="submit" value="S'inscrire">
</form>