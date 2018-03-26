<form action="<?= DIRNAME.USER_ADD_LINK;?>" method="POST">
	<label for="userName">	Pseudo</label>			<input type="text" 		name="userName" 	value="Lala"></br>
	<label for="name">		Prenom</label>			<input type="text" 		name="name" 		value="Louis"></br>
	<label for="firstName">	Nom</label>				<input type="text" 		name="firstName" 	value="Louis"></br>
	<label for="email">		Email</label>			<input type="email" 	name="email" 		value="louis@gmail.com"></br>
	<label for="age">		Age</label>				<input type="number" 	name="age" 			value="20"></br>
	<label for="pwd">		Mot de passe</label>	<input type="password" 	name="pwd" 			value="aze"></br>
	<input type="submit" name="submit" value="S'inscrire">
</form>