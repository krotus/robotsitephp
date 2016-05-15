<?php 

namespace App\Utility;

class QuickForm{

	/**
	 * Create select HTML5 here with the following parameters
	 * @param string $idName Id of select option tag
	 * @param string $atribute Atribute to show on the view
	 * @param array $array Items to walk zombie.
	 * @return void
	 */
	public static function createSelect($idName, $atribute, $array){
		$atribute = "get" . ucfirst($atribute);
		?>
		<select class="selectpicker" name="<?php echo $idName ?>"> 
		<?php
		foreach ($array as $item) {
			?>
			<option value='<?php echo $item->getId(); ?>'><?php echo $item->{$atribute}(); ?></option>
			<?php
		} 
		?>
		</select>
		<?php 
	}

}

?>