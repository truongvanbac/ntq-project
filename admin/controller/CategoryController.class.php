<?php

session_start();

class CategoryController extends Controller {

    private $data2 = array(
        'title' => '',
        'content' => ''
    );

    public function __construct() {
        parent::__construct();
        Check_login::check();
    }

    public function index() {
        $data = array(
            'lists' => Category::get_list_category()
        );

        $data2['content'] = $this->view->load('list-category', $data);
        $data2['title'] = 'List Category';
        $this->view->loadTemplate('tempadmin', $data2);
    }

    public function add() {
        $data = array();
        $data2['content'] = $this->view->load('add-category', $data);
        $data2['title'] = 'Add Category';
        $this->view->loadTemplate('tempadmin', $data2);

        if (isset($_POST['btn-add-ct'])) {
            if (($_POST['new-category'] != '') && (($_POST['select'] != ''))) {
                $ct_name = $_POST['new-category'];
                $ct_status = $_POST['select'];

                echo $ct_name . ":" . $ct_status;
                $result = Category::add_category($ct_name, $ct_status);
                if ($result) {
                    header("location: ../category");
                } else {
                    header("location: ../add");
                }
            } else {
                header("location: ../category/add");
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
