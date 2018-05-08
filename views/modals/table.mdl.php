<table id="<?=$config["config"]["id"]?>" class="<?=$config["config"]["class"]?>">
  <thead>
    <tr>
      <?php foreach ($config["cells"] as $name => $attributs): ?>
        <th <?= (isset($attributs["class"])) ? "class='".$attributs["class"]."'" : ""; ?>>
          <?= $attributs["name"]; ?>
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
    <div id="div_pagination">
      <input type="hidden" id="txt_rowid" value="0">
      <input type="hidden" id="txt_allcount" value="0">
      <input type="button" class="button" value="Previous" id="but_prev" />

      <input type="button" class="button" value="Next" id="but_next" />
    </div>
  </div>
  <div class="M4">
    <select class="pagination-selector" name="pagination">
      <option value="10">10</option>
      <option value="20">20</option>
      <option value="30">50</option>
      <option value="30">100</option>
    </select>
  </div>
</div>
