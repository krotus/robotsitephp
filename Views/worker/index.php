<?php 

if (array_key_exists("message", $data)) {
	echo "<p>" . $data["message"] . "</p>";
}

?>
<h2><?php echo $trans['title']; echo " " . $data["marc"]?></h2>
<a href="<?php echo URL . 'worker/language' ?>">switch language</a>