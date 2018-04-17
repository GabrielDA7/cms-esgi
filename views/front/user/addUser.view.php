<?php 
    if ($errors === FALSE): 
		echo 'Un email a ete envoyé';
	else:
		$this->addModal("form", $config, $errors); 
	endif;
?>
