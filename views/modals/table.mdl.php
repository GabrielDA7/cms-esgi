<table id="<?=$config["config"]["id"]?>" class="<?=$config["config"]["class"]?>">
  <thead>
    <tr>
      <?php foreach ($config["cell"] as $name => $attributs):?>
        <th <?=(isset($attributs["class"])) ? "class='".$attributs["class"]."'" : "";?>>
          <?= $attributs["name"]; ?>
        </th>
      <? endforeach; ?>
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>
