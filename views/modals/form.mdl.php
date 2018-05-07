<form method="<?= $config["config"]["method"] ?>" action="<?= $config["config"]["action"] ?>" enctype="<?= $config["config"]["enctype"] ?>">

	<?php foreach ($config["input"] as $name => $attributs):?>
		<?php if(isset($attributs["label"]) && !empty($attributs["label"])): ?>
			<label class="form-label-top form-group <?= $attributs["labelClass"] ?>"
				for="<?= $name; ?>"><?= $attributs["label"]; ?></label>
		<?php endif; ?>
		<?php if($attributs["type"] == "textarea"): ?>
			<textarea
				<?=(isset($attributs["class"])) ? "class='".$attributs["class"]."'" : "";?>
				name="<?= $name; ?>"
				<?= (isset($attributs["placeholder"])) ? "placeholder='".$attributs["placeholder"]."'" : ""; ?>
				<?= (isset($attributs["value"])) ? "value='".$attributs["value"]."'" : ""; ?>
				<?= (isset($attributs["required"])) ? "required='required'" : ""; ?>></textarea>
		<?php elseif ($attributs["type"] == "button"): ?>
			<button
			<?=(isset($attributs["id"])) ? "id='".$attributs["id"]."'" : "";?>
			<?=(isset($attributs["class"])) ? "class='".$attributs["class"]."'" : "";?>
			name="<?= $name; ?>"
			<?=(isset($attributs["type"])) ? "type='".$attributs["type"]."'" : "";?>
			<?=(isset($attributs["onclick"])) ? "onclick='".$attributs["onclick"]."'" : ""; ?>>
			<?=(isset($attributs["value"])) ? $attributs["value"] : ""; ?></button>

		<?php else: ?>
			<input
				<?=(isset($attributs["class"])) ? "class='".$attributs["class"]."'" : "";?>
				<?=(isset($attributs["type"])) ? "type='".$attributs["type"]."'" : "";?>
				name="<?= $name; ?>"
				<?=(isset($attributs["placeholder"])) ? "placeholder='".$attributs["placeholder"]."'" : ""; ?>
				<?=(isset($attributs["value"])) ? "value='".$attributs["value"]."'" : ""; ?>
				<?=(isset($attributs["required"])) ? "required='required'" : ""; ?>
				<?=(isset($attributs["onclick"])) ? "onclick='".$attributs["onclick"]."'" : ""; ?>>
		<?php endif; ?>
	<?php endforeach;?>
		<input class="btn form-group <?= $config["config"]["submitClass"]; ?>" type="submit" name="submit" value="<?= $config["config"]["submit"];?>">

</form>
