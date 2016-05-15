<?php 

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class IdentityCardEs extends AbstractRule
{
    public function validate($input)
    {
        $valid = true;
		//comprova la longitud i que sigui un format dni
	    if (strlen($input) != 9 || preg_match('/^[XYZ]?([0-9]{7,8})([A-Z])$/i', $input, $matches) !== 1) {
	        $valid = false;

	    }
	    if($valid == true){
	    	$map = 'TRWAGMYFPDXBNJZSQVHLCKE';
	    	list(,$number, $letter) = $matches; //matches a la posició 0 guarda el dni, 1 el numero, 2 la lletra
	    	if(strtoupper($letter) === $map[((int) $number) % 23]){
	    		$valid = true;
	    	}else{
	    		$valid = false;
	    	}	
	    }
	    return $valid;
    }
}


?>