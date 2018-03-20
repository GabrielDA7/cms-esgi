<?php
	foreach ($users as $key => $value) {
?>
        <div><?= $value['idUser']; ?></div>
        <div><?= $value['name']; ?></div>
        <div><?= $value['firstname']; ?></div>
        <div><?= $value['age']; ?></div>
        <form action="delete" method="POST">
        	<input type="hidden" value="<?= $value['idUser']; ?>" name="id">
        	<input type="submit" name="submit" value="X">
        </form>
<?php
	}
?>