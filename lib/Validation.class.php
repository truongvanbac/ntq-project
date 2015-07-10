<?php 
class Validation {

	public $mesage = array(
		'required' => "Field %s is not empty.",
		'valid_email' => "Field %s must contain a valid email.",
		'valid_number_natural' => "Field %s must contain a number natural.",
		'min_length' => "Field %s must contain more than %s charcter.",
		'max_length' => "Field %s must contain less than %s charcter."
	);
	/**
	 * Check Input form 
	 */
	public function checkForm($field, $label, $rule = array(), &$message = array()) {
		$check = true;

		foreach ($rule as $value) {

			if(preg_match('/^[a-z_]+$/', $value)) {								//if string only contain a-z characters
				if(($this->$value(getValue($field))) == false) {
					$message = sprintf($this->mesage[$value], $label);
					$check = false;
					break;
				}
			} else {
				$array = $this->explodeStr($value, ":");
				$str1 = $array[0];
				$val =$array[1];

				if($this->$str1(getValue($field), $val) == false) {
					$message = sprintf($this->mesage[$str1], $label, $val);
					$check = false;
					break;
				}
			}
		}
		return $check;
	}


	/**
	 * Explode string
	 */
	private function explodeStr($str, $format) {
		$array = explode($format, $str);
		return $array;
	}



	/**
	 * Check field is empty 
	 */
	private function required($str) {
		if($str == "0") {
			return true;
		} 

		return (!empty($str));
	}

	/**
	 * Check field is email
	 */
	private function valid_email($str) {
		return (!filter_var($str, FILTER_VALIDATE_EMAIL)) ? FALSE:TRUE;
	}

	/**
	 * Check field is number natural
	 */
	private function valid_number_natural($str) {
		if ( ! preg_match( '/^[0-9]+$/', $str)) {
			return false;
		}

		if ($str == 0) {
			return false;
		}

		return true;
	}


	/**
	 * Check field is more than some of charater
	 */
	private function min_length($str, $val) {
		return (strlen($str) < $val) ? FALSE : TRUE;
	}

	/**
	 * Check field is less than some of charater
	 */
	private function max_length($str, $val) {
		return (strlen($str) > $val) ? FALSE : TRUE;
	}

	/**
	 * Check field only contain a-z character
	 */
	private function anpha($str) {
		return (preg_match( '/^[a-zA-z]+$/', $str));
	}


	/**
	 * Check field only contain a-z, 0-9 character
	 */
	private function anpha_numeric($str) {
		return (preg_match( '/^[a-zA-z0-9]+$/', $str));
	}
}