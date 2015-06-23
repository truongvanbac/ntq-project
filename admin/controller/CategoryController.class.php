<?php
session_start();
class CategoryController extends Controller {

    //Lưu trữ nội dung truyền đến template
    public $data2 = array(
    );
    
    //Hàm khởi tạo
    public function __construct() {
        parent::__construct();

        if(empty($_SESSION['log'])) {
            header("location: " . BASE_URL . '/admin/login');  
        }

    }

    //Trang category, hiển thị danh sách tất cả các category
    public function index() {
        $pages = new Pagination('10', 'page');
        $pages->set_total(Category::count());
        

        //Biến $data lưu trữ dữ liệu truyền đến view
        $data = array(
            'lists' => Category::get_list_category($pages->get_limit()),
            'order' => "desc",
            'page_links' => $pages->page_links(),
            'count' => Category::count(),
            'valueSearch' => ''
        );

        $data2['oldUser'] = User::getUser(User::getIdAdmin());
        $data2['content'] = $this->view->load('list-category', $data);
        $data2['title'] = 'List Category';
        $this->view->loadTemplate('tempadmin', $data2);
        
    }



    //Thêm category
    public function add() {
        $data = array(
            'oldName' => '',
            'oldStatus' => '1'
        );
        

        if (isset($_POST['btn-add-ct'])) {
            if ((($_POST['new-category'] != '')) && (($_POST['select'] != ''))) {
                $ct_name = htmlentities($_POST['new-category'], ENT_QUOTES);
                $ct_status = $_POST['select'];


                $data['oldName'] = $ct_name;
                $data['oldStatus'] = $ct_status;

                $result = Category::add_category($ct_name, $ct_status);
                if ($result) {
                    directScript('Successfull!', BASE_URL . '/admin/category');
                } else {
                    notifyScript('Category name is existent');
                }
            } else {
                notifyScript('Please Input Category Name');
            }
        }
        $data2['oldUser'] = User::getUser(User::getIdAdmin());
        $data2['content'] = $this->view->load('add-category', $data);
        $data2['title'] = 'Add Category';
        $this->view->loadTemplate('tempadmin', $data2);
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

         //Kiem tra id category co ton tai hay khong
        $checkUrl = Category::getIdCategory($ct_id);
        if($checkUrl == 0) {
            directScript('Error, not existent category id', '' . BASE_URL . '/admin/category');
        } else {
            if (isset($_POST['btn-edit-ct'])) {

                if (($_POST['name-edit'] != '') && (($_POST['select'] != ''))) {

                    $ct_name = htmlentities($_POST['name-edit'], ENT_QUOTES);
                    $ct_status = $_POST['select'];


                    $result = Category::edit_category($ct_id, $ct_name, $ct_status);
                    if ($result) {
                        directScript('Successfull!', '' . BASE_URL . '/admin/category');
                    } else {
                        notifyScript('Category name is existent');
                    }
                } else {
                    notifyScript('Please input category name');
                }
            }
        }
        $data2['oldUser'] = User::getUser(User::getIdAdmin());
        $data2['content'] = $this->view->load('edit-category', $data);
        $data2['title'] = 'Edit Category';
        $this->view->loadTemplate('tempadmin', $data2);
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
                'page_links' => $pages->page_links(),
                'count' => Category::count()
            );
        } else {
            //$order = "asc";
            $data = array(
                'order' => "asc",
                'lists' => Category::sort_item($item, $order, $pages->get_limit()),   
                'page_links' => $pages->page_links(),
                'count' => Category::count()
            );
        }
        
        $data['valueSearch'] = '';
        $data2['oldUser'] = User::getUser(User::getIdAdmin());
        $data2['content'] = $this->view->load('list-category', $data);
        $data2['title'] = 'List Category';
        $this->view->loadTemplate('tempadmin', $data2);
    }

    //Tìm kiếm dữ liệu
    public function getDataSearched() {
        $data3 = array();
        $value = '';
        if($_GET['search'] != '') {
            $string = $_GET['search'];
            $data3 = explode(' ', $string);
            for($i = 0; $i<count($data3); $i++) {
                $value .= $data3[$i] . '+'; 
            }

            $value = rtrim($value, ' +');
            $totalRecord = Category::seaching_process($string)['count'];
            $pages = new Pagination('10', 'page');
            $pages->set_total($totalRecord);
            $data = array(
                'lists' => Category::seaching_process($string, $pages->get_limit())['result'],
                'page_links' => $pages->page_links($path='?',$ext = "&search=$value"),
                'count' => $totalRecord,
                'valueSearch' => $string
            );
        }

        $data2['oldUser'] = User::getUser(User::getIdAdmin());
        $data2['content'] = $this->view->load('list-category', $data);
        $data2['title'] = 'Data Searching Category';
        $this->view->loadTemplate('tempadmin', $data2);
    }
}
