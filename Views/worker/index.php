<?php 
if(isset($data)){
	if (array_key_exists("alert", $data)) {
		echo '<div class="alert alert-danger" role="alert">' . $trans[$data["alert"]] . '</div>';
	}	
}
?>
<h2><?php echo $trans['title']; echo " " . $data["marc"]?></h2>
<a href="<?php echo URL . 'worker/language' ?>">switch language</a>