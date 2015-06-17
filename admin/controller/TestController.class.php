<?php

class TestController extends Controller {

	public function index() {
		$data3 = array(
            'name' => Category::getCategory(2)
        );
        
        $name = ($data3['name']['ct_name']);
        var_dump($name);
	}
}