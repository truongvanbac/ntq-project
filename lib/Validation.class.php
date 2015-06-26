<?php 
	

class Validation {

	public function validateEmpty($field = array(), $message = array()) {
		$check = true;
		$count = count($field);
		for($i = 0; $i < $count; $i++ ){
			if(getMethod($field[$i]) == '') {
				$check =  false; 
			} else {
				$check = true;
			}
		}
		return $check;
	}
}
	



?>