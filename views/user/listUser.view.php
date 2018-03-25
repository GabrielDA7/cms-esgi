<?php foreach ($users as $user) { ?>
        <div><?= $user->getId(); ?></div>
        <div><?= $user->getName(); ?></div>
        <div><?= $user->getFirstName(); ?></div>
        <div><?= $user->getAge(); ?></div>
        <form action="<?= DIRNAME.USER_DELETE_LINK;?>" method="POST">
        	<input type="hidden" value="<?= $user->getId(); ?>" name="id">
        	<input type="submit" name="submit" value="X">
        </form>
        <form action="<?= DIRNAME.USER_EDIT_LINK;?>" method="POST">
        	<input type="hidden" value="<?= $user->getId(); ?>" name="id">
        	<input type="submit" name="edit" value="edit">
        </form>
<?php } ?>