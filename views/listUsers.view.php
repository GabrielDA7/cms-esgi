<?php foreach ($users as $user) { ?>
        <div><?= $user->getId(); ?></div>
        <div><?= $user->getName(); ?></div>
        <div><?= $user->getFirstName(); ?></div>
        <div><?= $user->getAge(); ?></div>
        <form action="delete" method="POST">
        	<input type="hidden" value="<?= $user->getId(); ?>" name="id">
        	<input type="submit" name="submit" value="X">
        </form>
<?php } ?>