<?php

namespace App\Utility;

/**
 * Classe QuickForm que te como a proposit generar codi HTML de forma dinamica segons
 * la necessitat que requereixi la vista a renderitzar.
 * @package \App\Utility
 */
class QuickForm {

    /**
     * Crea un combobox en HTML5 segons els parametres passats
     * @param string $idName La id del select
     * @param string $atribute Atribut que es vol mostrar a la vista
     * @param array $array Llista de elements que es vol mostrar
     * @param integer $idSelected Id del selector seleccionat per defecte
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

    /**
     * Mostra la llista de errors en format d'alerta i utilitzan una llista desordenada.
     * @param array $errors Els errors trobats despres de una validació.
     * @return void
     */
    public static function showListErrors($errors){
        echo '<div class="alert alert-danger" role="alert"><ul>';
        foreach ($errors as $key => $error) {
            echo "<li>" . $error . "</li>";
        }
        echo '</ul></div>';
    }

}
?>