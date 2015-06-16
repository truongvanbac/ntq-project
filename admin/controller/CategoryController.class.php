<?php
session_start();
class CategoryController extends Controller {

    private $data2 = array(
        'title' => '',
        'content' => '',
        'message' => ''
    );
    
    public function __construct() {
        parent::__construct();
        if(empty($_SESSION['log'])) {
            header('location : login');
        }
    }

    public function index() {
        $pages = new Pagination('10', 'page');
        $pages->set_total(Category::count());
        
        $data = array(
            'lists' => Category::get_list_category($pages->get_limit()),
            'order' => "desc",
            'page_links' => $pages->page_links()
        );
        
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
                    header("location: " . BASE_URL . '/admin/category');
                } else {
                    header("location: " . BASE_URL . '/admin/category/add');
                }
            } else {
                header("location: " . BASE_URL . '/admin/category/add');
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

                $result = Category::edit_category($ct_id, $ct_name, $ct_status);
                if ($result) {
                    header("location: " . BASE_URL . '/admin/category');
                } else {
                    header("location: " . BASE_URL . '/admin/category/edit/' . $ct_id);
                }
            } else {
                header("location: " . BASE_URL . '/admin/category/edit/' . $ct_id);
            }
        }
    }

    public function active() {
        if (isset($_POST['btn-ac-ct'])) {
            if (!empty($_POST['checkbox'])) {
                foreach (($_POST['checkbox']) as $check) {
                    Category::update_active($check, '1');
                }
            }
        }
        if (isset($_POST['btn-dac-ct'])) {
            if (!empty($_POST['checkbox'])) {
                foreach (($_POST['checkbox']) as $check) {
                    Category::update_active($check, '0');
                }
            }
        }

        header("location: " . BASE_URL . '/admin/category');
    }

    public function sort() {
        global $url;
        $url = rtrim($url, "/");
        $urlArray = array();
        $urlArray = explode("/", $url);
        $item = $urlArray[3];
        
        $order = $urlArray[4];
        
        
        $pages = new Pagination('10', 'page');
        $pages->set_total(Category::count());
        
        if ($order == "asc") {
            $data = array(
                'order' => "desc",
                'lists' => Category::sort_item($item, $order, $pages->get_limit()),
                'page_links' => $pages->page_links()
            );
        } else {
            //$order = "asc";
            $data = array(
                'order' => "asc",
                'lists' => Category::sort_item($item, $order, $pages->get_limit()),   
                'page_links' => $pages->page_links()
            );
        }
        
        
        $data2['content'] = $this->view->load('list-category', $data);
        $data2['title'] = 'List Category';
        $this->view->loadTemplate('tempadmin', $data2);
    }

}
