<div><?= $trainning->getAuthor() ?></div>
<div><?= $trainning->getTitle() ?></div>
<div><?= $trainning->getDescription() ?></div>
<?php foreach ($trainning->getChapters() as $chapter): ?>
	<div>Chapitre : <?= $chapter->getNumber(); ?></div>
	<div>Title : <?= $chapter->getTitle(); ?></div>
	<a href="<?= DIRNAME . CHAPTER_CHAPTER_FRONT_LINK . '?id=' . $chapter->getId();?>">lien</a>
	<br>
<?php endforeach ?>