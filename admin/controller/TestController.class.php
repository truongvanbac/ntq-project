<?php

class TestController extends Controller {

	public function index() {
		$result = User::getIdAdmin();
		var_dump($result);
	}
}