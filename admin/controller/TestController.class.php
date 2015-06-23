<?php

class TestController extends Controller {

	public function index() {
		$result = User::getIdAdmin();
		echo ($result);
	}
}