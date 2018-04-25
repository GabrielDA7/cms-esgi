<div><?= $chapter->getNumber() ?></div>
<div><?= $chapter->getTitle() ?></div>
<?php foreach ($chapter->getParts() as $part): ?>
	<div>Partie : <?= $part->getNumber(); ?></div>
	<div>Title : <?= $part->getTitle(); ?></div>
	<div>Content : <?= $part->getContent(); ?></div>
	<br>
<?php endforeach ?>