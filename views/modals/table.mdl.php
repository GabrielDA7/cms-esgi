<table id="<?=$config["config"]["id"]?>" class="<?=$config["config"]["class"]?>">
  <thead>
    <tr>
      <?php foreach ($config["cells"] as $name => $attributs): ?>
        <th <?= (isset($attributs["class"])) ? "class='".$attributs["class"]."'" : ""; ?>>
          <a id="<?= $name ?>" href="#" class="column_sort" data-order="asc">
            <?= $attributs["name"]; ?><i></i>
          </a>
        </th>
      <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

<div class="row row-pagination">
  <div class="M4">
    <p>Showing <span class="count-page-element"></span> to
    of <span class="count-all-element"></span> entries</p>
  </div>
  <div class="M4">
    <div id="pagination_links">
    </div>
  </div>
  <div class="M4">
    <select class="pagination_selector" name="pagination_selector">
      <option value="10">10</option>
      <option value="20">20</option>
      <option value="30">50</option>
      <option value="30">100</option>
    </select>
  </div>
</div>
