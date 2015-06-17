<?php
session_start();
class CategoryController extends Controller {

    //Lưu trữ nội dung truyền đến template
    private $data2 = array();
    
    //Hàm khởi tạo
    public function __construct() {
        parent::__construct();
        if(empty($_SESSION['log'])) {
            header('location : login');
        }
    }

    //Trang category, hiển thị danh sách tất cả các category
    public function index() {
        $pages = new Pagination('10', 'page');  //Khởi tạo phân trang
        $pages->set_total(Category::count());   //Sét tổng số phần tử của trang
        

        //Biến $data lưu trữ dữ liệu truyền đến view
        $data = array(
            'lists' => Category::get_list_category($pages->get_limit()),
            'order' => "desc",
            'page_links' => $pages->page_links()
        );
        
        $data2['content'] = $this->view->load('list-category', $data);
        $data2['title'] = 'List Category';
        $this->view->loadTemplate('tempadmin', $data2);
    }



    //Thêm category
    public function add() {
        $data = array(
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


    //Chỉnh sửa category
    public function edit() {
        global $url;
        $url = rtrim($url, "/");
        $urlArray = array();
        $urlArray = explode("/", $url);     //Tách url thành mảng
        $ct_id = $urlArray[3];      //Lấy id category

        $data = array(
            'edit_name' => Category::getCategory($ct_id)
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

    //Update active các phần tử
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

    //Sắp xếp
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

    //Tìm kiếm dữ liệu
    public function getDataSearched() {
        

        if(isset($_POST['btn-search-ct'])) {
            if($_POST['search'] != '') {
                $string = $_POST['search'];
                //$array = Category::seaching_process($string);
                $totalRecord = Category::seaching_process($string)['count'];
                $pages = new Pagination('1', 'page');
                $pages->set_total($totalRecord);
                $data = array(
                    'lists' => Category::seaching_process($string, $pages->get_limit())['result'],
                    'page_links' => $pages->page_links()
                );
            }
            //var_dump($data['lists']);
            // echo '<pre>';
            // var_dump($totalRecord);
            // echo '</pre>';
        }

        $data2['content'] = $this->view->load('list-category', $data);
        $data2['title'] = 'Data Searching Category';
        $this->view->loadTemplate('tempadmin', $data2);
    }
}
