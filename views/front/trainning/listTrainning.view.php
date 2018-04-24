<?php foreach ($trainnings as $trainning): ?>
      <div><?= $trainning->getAuthor() ?></div>
      <div><?= $trainning->getTitle() ?></div>
      <div><?= $trainning->getDescription() ?></div>
      <a href="<?= DIRNAME . TRAINNING_TRAINNING_FRONT_LINK . '?id=' . $trainning->getId();?>">lien</a>
<?php endforeach;?>