<div><?= $trainning->getAuthor() ?></div>
<div><?= $trainning->getTitle() ?></div>
<div><?= $trainning->getDescription() ?></div>
<?php foreach ($trainning->getLessons as $lesson): ?>
	<div>Lesson : <?= $lesson->getChapter(); ?></div>
<?php endforeach ?>