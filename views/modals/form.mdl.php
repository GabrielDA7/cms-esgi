<form method="<?= $config["config"]["method"] ?>" action="<?= $config["config"]["action"] ?>" enctype="<?= $config["config"]["enctype"] ?>">

	<?php foreach ($config["input"] as $name => $attributs):?>
			<?php if(isset($attributs["label"]) && !empty($attributs["label"])){?>
				<label class="form-label-top form-group" for="<?= $name; ?>"><?= $attributs["label"]; ?></label>
			<?php } ?>
			<input class="input" type="<?= $attributs["type"];?>"
				   name="<?= $name;?>"
				   <?= (isset($attributs["placeholder"])) ? "placeholder='".$attributs["placeholder"]."'" : ""; ?>
				   <?= (isset($attributs["value"])) ? "value='".$attributs["value"]."'" : ""; ?>
				   <?= (isset($attributs["required"])) ? "required='required'" : ""; ?>>

	<?php endforeach;?>

	<input class="btn btn-filled-orange btn-full-width form-group form-group-bottom" type="submit" name="submit" value="<?= $config["config"]["submit"];?>" >

</form>
