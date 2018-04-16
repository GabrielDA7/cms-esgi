<?php 
	if (!empty($errors)): 
		print_r($errors);
	endif; 
?>


<form method="<?= $config["config"]["method"] ?>" action="<?= $config["config"]["action"] ?>" enctype="<?= $config["config"]["enctype"] ?>">

	<?php foreach ($config["input"] as $name => $attributs):?>

			<input type="<?= $attributs["type"];?>" 
				   name="<?= $name;?>" 
				   <?= (isset($attributs["placeholder"])) ? "placeholder='".$attributs["placeholder"]."'" : ""; ?>
				   <?= (isset($attributs["value"])) ? "value='".$attributs["value"]."'" : ""; ?>
				   <?= (isset($attributs["required"])) ? "required='required'" : ""; ?>>

	<?php endforeach;?>

	<input type="submit" name="submit" value="<?= $config["config"]["submit"];?>" >

</form>
