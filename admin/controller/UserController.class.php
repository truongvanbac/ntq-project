<?php
session_start();

class UserController extends Controller {
    
   private $data2 = array(
        'title' => '',
        'content' => ''
    );
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $data = array();

        $data2['content'] = $this->view->load('list-user', $data);
        $data2['title'] = 'List Category';
        $this->view->loadTemplate('tempadmin', $data2);
    }
}



