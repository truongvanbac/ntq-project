<?php

class TestController extends Controller {

	public function index() {
		$pattern = '[a-z]';
		$subject = 'adsads';
		$check = $this->regular->check($pattern, $subject);
		if($check) {
			echo 'ok';
		} else {
			echo 'No';
		}		
	}
}