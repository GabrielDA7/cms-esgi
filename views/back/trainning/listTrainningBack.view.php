<section id="dashboard-list-tranning">

  <div class="row">
    <div class="M4">
      <div class="back-title">
        <h1>List of trainings</h1>
        <div class="hr-separation"></div>
      </div>
    </div>
  </div>

  <div class="row row-tools">
    <div class="M4">
      <div class="wrapper-icon">
          <i class="fas fa-search icon-left"></i>
          <input class="input-medium input-icon" type="text" oninput="searchTrainning();">
      </div>
    </div>
    <div class="M2 M--offset6">
      <a class="btn-extra-small btn-filled-orange btn btn-icon" href="">Add<i class="fas fa-plus"></i></a>
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

  <div class="row row-pagination">
    <div class="M2">
      <p>X elements</p>
    </div>
    <div class="M2 M--offset8">
      <select class="pagination-selector" name="pagination" id="listTrainningSelect" onchange="listTrainningSelectChange()">
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="30">50</option>
        <option value="30">100</option>
      </select>
    </div>

  </div>

</section>
