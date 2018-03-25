<?php foreach ($users as $user) { ?>
        <div><?= $user->getId(); ?></div>
        <div><?= $user->getName(); ?></div>
        <div><?= $user->getFirstName(); ?></div>
        <div><?= $user->getAge(); ?></div>
        <form action="<?= DIRNAME;?>user/delete" method="POST">
        	<input type="hidden" value="<?= $user->getId(); ?>" name="id">
        	<input type="submit" name="submit" value="X">
        </form>
        <form action="<?= DIRNAME;?>user/user" method="POST">
        	<input type="hidden" value="<?= $user->getId(); ?>" name="id">
        	<input type="submit" name="submit" value="edit">
        </form>
<?php } ?>