<?php 

if (array_key_exists("message", $data)) {
	echo $data["message"];
}

?>
<h2><?php echo $trans['title'];?></h2>
<a href="<?php echo URL . 'worker/language' ?>">switch language</a>