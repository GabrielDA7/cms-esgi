<form action="edit" method="POST">
	<input type="hidden" value="<?= $user->getId(); ?>" name="id">
	<label for="userName">	Pseudo</label>			<input type="text" 		name="userName" 	placeholder="<?= $user->getUserName(); ?>"></br>
	<label for="name">		Prenom</label>			<input type="text" 		name="name" 		placeholder="<?= $user->getName(); ?>"></br>
	<label for="firstName">	Nom</label>				<input type="text" 		name="firstName" 	placeholder="<?= $user->getFirstName(); ?>"></br>
	<label for="email">		Email</label>			<input type="email" 	name="email" 		placeholder="<?= $user->getEmail(); ?>"></br>
	<label for="age">		Age</label>				<input type="number" 	name="age" 			placeholder="<?= $user->getAge(); ?>"></br>
	<label for="pwd">		Mot de passe</label>	<input type="password" 	name="pwd" 			placeholder="<?= $user->getPwd(); ?>"></br>
	<input type="submit" name="submit" value="Modifier">
</form>
<form action="delete" method="POST">
	<input type="hidden" value="<?= $user->getId(); ?>" name="id">
	<input type="submit" name="submit" value="X">
</form>