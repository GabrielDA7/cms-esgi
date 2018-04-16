<?php $this->addModal("form", $config, $errors); ?>

<?php 
	if(isset($wrongPassword) && $wrongPassword === TRUE) {
		echo "Mauvais identifiants";
	}
?>