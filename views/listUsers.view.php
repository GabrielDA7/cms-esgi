<?php
	foreach ($users as $user) {
?>
                <div><?= $user->getIdUser(); ?></div>
                <div><?= $user->getName(); ?></div>
                <div><?= $user->getFirstName(); ?></div>
                <div><?= $user->getAge(); ?></div>
                <form action="delete" method="POST">
                	<input type="hidden" value="<?= $user->getIdUser(); ?>" name="id">
                	<input type="submit" name="submit" value="X">
                </form>
<?php
	}
?>