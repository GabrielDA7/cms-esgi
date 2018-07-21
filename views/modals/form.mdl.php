<form method="<?= $config["config"]["method"] ?>" action="<?= $config["config"]["action"] ?>"
	<?= (isset($config["config"]["enctype"])) ? "enctype='".$config["config"]["enctype"]."'>" : ">"; ?>

	<?php foreach ($config["input"] as $name => $attributs):?>
		<?php if(isset($attributs["label"]) && !empty($attributs["label"])): ?>
			<label class="form-label-top form-group"
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

		<?php elseif ($attributs["type"] == "select"): ?>
			<select
			<?=(isset($attributs["id"])) ? "id='".$attributs["id"]."'" : "";?>
			<?=(isset($attributs["class"])) ? "class='".$attributs["class"]."'" : "";?>
			name="<?= $name; ?>">
				<?php if(isset($attributs["option"])): ?>
					<?php foreach($attributs["option"] as $key => $value): ?>
						<option value="<?= $key ?>"><?= $value ?></span>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>
		<?php elseif ($attributs["type"] == "plainText"): ?>
			<?php if (isset($attributs["value"])): ?>
				<?php if($attributs["value"] == 0): ?>
					<p class="form-group">Status : member</p>
				<?php elseif($attributs["value"] == 1): ?>
					<p class="form-group">Status : premium member</p>
				<?php else: ?>
					<p class="form-group">Status : admin</p>
				<?php endif; ?>
			<?php endif; ?>
		<?php else: ?>
			<?php if (isset($attributs["image"])) : ?>
					<image class="avatar-img-edition" src="<?= $attributs['image'] ?>" alt="avatar image"/>
			<?php endif; ?>
			<input
				<?= (isset($attributs["disabled"])) ? "disabled='". $attributs["disabled"] ."'" : "";?>
				<?=(isset($attributs["class"])) ? "class='".$attributs["class"]."'" : "";?>
				<?=(isset($attributs["type"])) ? "type='".$attributs["type"]."'" : "";?>
				name="<?= $name; ?>"
				<?=(isset($attributs["placeholder"])) ? "placeholder='".$attributs["placeholder"]."'" : ""; ?>
				<?=(isset($attributs["value"])) ? "value='".$attributs["value"]."'" : ""; ?>
				<?=(isset($attributs["required"])) ? "required='required'" : ""; ?>
				<?=(isset($attributs["onclick"])) ? "onclick='".$attributs["onclick"]."'" : ""; ?>>
		<?php endif; ?>
	<?php endforeach; ?>
		<input class="btn form-group <?= $config["config"]["submitClass"]; ?>" type="submit" name="submit" value="<?= $config["config"]["submit"];?>">

</form>
