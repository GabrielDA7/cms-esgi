<div><?= $trainning->getAuthor() ?></div>
<div><?= $trainning->getTitle() ?></div>
<div><?= $trainning->getDescription() ?></div>
<?php foreach ($trainning->getLessons() as $lesson): ?>
	<div>Chapitre : <?= $lesson->getChapter(); ?></div>
	<div>Partie : <?= $lesson->getPart(); ?></div>
	<div>Title : <?= $lesson->getTitle(); ?></div>
	<div>Content : <?= $lesson->getContent(); ?></div>
	<br>
<?php endforeach ?>