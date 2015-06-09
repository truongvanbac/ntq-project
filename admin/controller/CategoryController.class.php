<?php

class CategoryController extends Controller {

    private $data2 = array(
        'title' => '',
        'content' => '',
        'message' =>''
    );

    public function __construct() {
        parent::__construct();
        Check_login::check();
        //print_r($_SESSION);
    }

    public function index() {
        $data = array(
            'lists' => Category::get_list_category()
        );
//        echo "<pre>";
//        var_dump($data['lists']);
//        echo "</pre>";
        $data2['content'] = $this->view->load('list-category', $data);
        $data2['title'] = 'List Category';
        $this->view->loadTemplate('tempadmin', $data2);
    }

    public function add() {
        static $data = array(
            'message' => ''
        );
        $data2['content'] = $this->view->load('add-category', $data);
        $data2['title'] = 'Add Category';
        $this->view->loadTemplate('tempadmin', $data2);

        if (isset($_POST['btn-add-ct'])) {
            if (($_POST['new-category'] != '') && (($_POST['select'] != ''))) {
                $ct_name = $_POST['new-category'];
                $ct_status = $_POST['select'];

                $result = Category::add_category($ct_name, $ct_status);
                if ($result) {
                    header("location: " . BASE_URL.'/admin/category');
                } else {
                    header("location: " . BASE_URL.'/admin/category/add');
                }
            } else {
                header("location: " . BASE_URL.'/admin/category/add');
            }
        }
    }

    public function edit() {
        global $url;
        $url = rtrim($url, "/");
        $urlArray = array();
        $urlArray = explode("/", $url);
        $ct_id = $urlArray[3];

        $data = array(
            'edit_name' => Category::get_name_ct($ct_id)
        );
//        echo "<pre>";
//        var_dump(implode('', array_values($data['edit_name'])));
//        echo "<pre>";
        
        $data2['content'] = $this->view->load('edit-category', $data);
        $data2['title'] = 'Edit Category';
        $this->view->loadTemplate('tempadmin', $data2);

        if (isset($_POST['btn-edit-ct'])) {
            if (($_POST['name-edit'] != '') && (($_POST['select'] != ''))) {
                $ct_name = $_POST['name-edit'];
                $ct_status = $_POST['select'];
                echo $ct_name . ":" . $ct_status;

                $result = Category::edit_category($ct_id, $ct_name, $ct_status);
                if ($result) {
                    header("location: ".BASE_URL.'/admin/category');
                } else {
                    header("location: ".BASE_URL.'/admin/category/edit/'.$ct_id);
                }
            } else {
                header("location: ".BASE_URL.'/admin/category/edit/'.$ct_id);
            }
        }
    }

}
