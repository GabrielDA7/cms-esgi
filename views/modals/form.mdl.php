<?php 
	if (!empty($errors)): 
		print_r($errors);
	endif; 
?>


<form method="<?= $config["config"]["method"] ?>" action="<?= $config["config"]["action"] ?>">

	<?php foreach ($config["input"] as $name => $attributs):?>

		<?php if($attributs["type"]=="text" || $attributs["type"]=="email" || $attributs["type"]=="number" || $attributs["type"]=="password"):?>

			<input type="<?= $attributs["type"];?>" 
				   placeholder="<?= $attributs["placeholder"];?>" 
				   name="<?= $name;?>" 
				   <?= (isset($attributs["required"])) ? "required='required'" : ""; ?>>

		<?php endif;?>

	<?php endforeach;?>

	<input type="submit" name="submit" value="<?= $config["config"]["submit"];?>" >

</form>