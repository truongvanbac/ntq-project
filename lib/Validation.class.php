<?php 
	
class Validation {

	public function checkInputForm($name, $field, $option, &$message = '') {
		$check = true;
		switch ($option) {
			case 'require':
				if(getValue($field) == '') {
					$message =  $name . " is not empty.";
					$check = false;
				}

				break;
			
			case 'email':
				if(filter_var(getValue($field), FILTER_VALIDATE_EMAIL) == false) {
		            $message = 'Email is invalid!';
		            $check = false;
		        }

				break;

			case 'numeric':
				if (!preg_match('/^[0-9]+$/', $field)) {
					$message = $name . " must numeric and positive.";
					$check = false;
				}
				break;
		}
		return $check;

	}
	
}