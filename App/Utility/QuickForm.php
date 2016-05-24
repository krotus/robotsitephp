<?php

namespace App\Utility;

class QuickForm {

    /**
     * Create select HTML5 here with the following parameters
     * @param string $idName Id of select option tag
     * @param string $atribute Atribute to show on the view
     * @param array $array Items to walk zombie.
     * @return void
     */
    public static function createSelect($idName, $atribute, $array, $idSelected = false) {
        $atribute = "get" . ucfirst($atribute);
        ?>
        <select id="<?php echo $idName ?>" class="selectpicker form-control" name="<?php echo $idName ?>"> 
            <?php
            foreach ($array as $item) {
                if (is_numeric($idSelected)) {
                    if ($item->getId() == $idSelected) {
                        ?>
                        <option value='<?php echo $item->getId(); ?>' selected><?php echo $item->{$atribute}(); ?></option>
                        <?php
                    } else {
                        ?>
                        <option value='<?php echo $item->getId(); ?>'><?php echo $item->{$atribute}(); ?></option>
                        <?php
                    }
                    ?>     
                    <?php
                } else {
                    ?>
                    <option value='<?php echo $item->getId(); ?>'><?php echo $item->{$atribute}(); ?></option>
                    <?php
                }
            }
            ?>
        </select>
        <?php
    }

}
?>