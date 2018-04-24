<?php foreach ($trainnings as $trainning): ?>
      <div><?= $trainning->getAuthor() ?></div>
      <div><?= $trainning->getTitle() ?></div>
      <div><?= $trainning->getDescription() ?></div>
      <a href="<?= DIRNAME . TRAINNING_TRAINNING_BACK_LINK . '?id=' . $trainning->getId();?>">aa</a>
<?php endforeach;?>
<section id="dashboard-list-tranning">

  <div class="row">
    <div class="M4">
      <div class="back-title">
        <h1>List of trainings</h1>
        <div class="hr-separation"></div>
      </div>
    </div>
  </div>

  <div class="row M--end">
    <div class="M2">
      <a class="btn-extra-small btn-filled-orange btn btn-list" href="">Add<i class="fas fa-plus"></i></a>
    </div>
  </div>

  <div class="row M--center X--center">
    <div class="M12">
      <table id="list-trainning" class="list-data">
        <thead>
          <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Author</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- GetListTrainning -->
          <tr>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td><a href="#edit/id"><i class="fas fa-edit"></i></a><a href="#delete/id"><i class="far fa-trash-alt"></i></a></td>
          </tr>
          <tr>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td><a href="#edit/id"><i class="fas fa-edit"></i></a><a href="#delete/id"><i class="far fa-trash-alt"></i></a></td>
          </tr>
          <tr>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td><a href="#edit/id"><i class="fas fa-edit"></i></a><a href="#delete/id"><i class="far fa-trash-alt"></i></a></td>
          </tr>
          <tr>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td><a href="#edit/id"><i class="fas fa-edit"></i></a><a href="#delete/id"><i class="far fa-trash-alt"></i></a></td>
          </tr>
          <tr>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td><a href="#edit/id"><i class="fas fa-edit"></i></a><a href="#delete/id"><i class="far fa-trash-alt"></i></a></td>
          </tr>
          <tr>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td><a href="#edit/id"><i class="fas fa-edit"></i></a><a href="#delete/id"><i class="far fa-trash-alt"></i></a></td>
          </tr>
          <tr>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td><a href="#edit/id"><i class="fas fa-edit"></i></a><a href="#delete/id"><i class="far fa-trash-alt"></i></a></td>
          </tr>
          <tr>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td><a href="#edit/id"><i class="fas fa-edit"></i></a><a href="#delete/id"><i class="far fa-trash-alt"></i></a></td>
          </tr>
          <tr>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td><a href="#edit/id"><i class="fas fa-edit"></i></a><a href="#delete/id"><i class="far fa-trash-alt"></i></a></td>
          </tr>
          <tr>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td>Test1</td>
            <td><a href="#edit/id"><i class="fas fa-edit"></i></a><a href="#delete/id"><i class="far fa-trash-alt"></i></a></td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>

</section>
