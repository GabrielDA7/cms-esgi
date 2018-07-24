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
				<?= (isset($attributs["required"])) ? "required='required'" : ""; ?>><?= (isset($attributs["value"])) ? $attributs["value"] : ""; ?></textarea>
		<?php elseif ($attributs["type"] == "checkbox"): ?>
			<div <?=(isset($attributs["class"])) ? "class='".$attributs["class"]."'" : "";?>>
				<input type="checkbox"
				name="<?= $name; ?>"
				<?=(isset($attributs["id"])) ? "id='".$attributs["id"]."'" : "";?>
				<?= (isset($attributs["checked"]) && $attributs["checked"] == 1) ? "checked" : ""; ?>
				<?= (isset($attributs["value"])) ? "value='".$attributs["value"]."'" : ""; ?>
				>
				<label for="<?= $name; ?>">Only for premium</label>
			</div>

		<?php elseif ($attributs["type"] == "parts"): ?>
			<div
				<?=(isset($attributs["id"])) ? "id='".$attributs["id"]."'" : "";?>
				<?=(isset($attributs["class"])) ? "class='".$attributs["class"]."'" : "";?>>
				<?php if(isset($attributs["value"])): ?>
					<?php foreach ($attributs["value"] as $key => $value): ?>
						<div class="content-hidden" id="numberPart">
							<?= count($attributs["value"]);?>
						</div>
						<div id='chapterSubpart<?= $value->getNumber();?>' class='form-group chapterParts'>
											<div class='row subpartHead expand-div'>
												<div class='M10'>
													<p>Subpart <?= $value->getNumber(); ?></p>
												</div>
												<div class='M2'>
													<i class='fas fa-chevron-down btn-icon'></i>
												</div>
											</div>
											<div class='content-hidden'>
													<div class='row'>
														<input type='text' name='parts["<?= $value->getNumber(); ?>"][title]' class='input form-group margin-bottom' placeholder='Title' value="<?= $value->getTitle(); ?>">
													</div>
													<div class='row'>
														<textarea name='parts["<?= $value->getNumber(); ?>"][content]' class='form-group input tinymce' placeholder='Content'><?= $value->getContent(); ?></textarea>
													</div>
												<input type='hidden' name='parts["<?= $value->getNumber(); ?>"][number]' value='" <?= $value->getNumber(); ?> "'></input>
											</div>
						 </div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		<?php elseif ($attributs["type"] == "button"): ?>
			<button
			<?=(isset($attributs["id"])) ? "id='".$attributs["id"]."'" : "";?>
			<?=(isset($attributs["class"])) ? "class='".$attributs["class"]."'" : "";?>
			name="<?= $name; ?>"
			<?=(isset($attributs["type"])) ? "type='".$attributs["type"]."'" : "";?>
			<?=(isset($attributs["onclick"])) ? "onclick='".$attributs["onclick"]."'" : ""; ?>>
			<?=(isset($attributs["value"])) ? $attributs["value"] : ""; ?></button>
		<?php elseif ($attributs["type"] == "file"): ?>
			<input type="file"
			name="<?= $name; ?>"
			<?=(isset($attributs["value"])) ? "value=" . $attributs["value"] : ""; ?>
			<?=(isset($attributs["class"])) ? "class='".$attributs["class"]."'" : "";?>
			<?=(isset($attributs["maxSize"]) ? "maxfilesize=" . $attributs["maxSize"] : ""); ?>
			<?=(isset($attributs["extension"]) ? "extension=" . implode(",",$attributs["extension"]) : ""); ?>
			><?=(isset($attributs["title"]) ? $attributs["title"] : ""); ?></input>
		<?php elseif ($attributs["type"] == "select"): ?>
			<select
			<?=(isset($attributs["value"])) ? "value='" . $attributs["value"]. "'" : ""; ?>
			<?=(isset($attributs["id"])) ? "id='".$attributs["id"]."'" : "";?>
			<?=(isset($attributs["class"])) ? "class='".$attributs["class"]."'" : "";?>
			name="<?= $name; ?>">
				<?php if(isset($attributs["option"])): ?>
					<?php foreach($attributs["option"] as $key => $value): ?>
						<option value="<?= $key ?>"><?= $value ?></option>
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
				<?=(isset($attributs["onclick"])) ? "onclick='".$attributs["onclick"]."'" : ""; ?>
			>
		<?php endif; ?>
	<?php endforeach; ?>
		<input class="btn form-group <?= $config["config"]["submitClass"]; ?>" type="submit" name="submit" value="<?= $config["config"]["submit"];?>">

</form>
