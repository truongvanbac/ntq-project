<?php
session_start();

class ProductController extends Controller {

    //Biến $data2 lưu trữ dữ liệu xuất ra view
    private $data2 = array(
        'title' => '',
        'content' => '',
        'message' => ''
    );

    //Hàm khoeir tạo
    public function __construct() {
        parent::__construct();
        if(empty($_SESSION['log'])) {
            header('location : login');
        }
    }
    

    //Trang hiển thị danh sách products
    public function index() {
        $pages = new Pagination('10', 'page');
        $pages->set_total(Product::count());
        
        $data = array(
            'lists' => Product::get_list_product($pages->get_limit()),
            'order' => "desc",
            'page_links' => $pages->page_links()
        );
        
        $data2['content'] = $this->view->load('list-product', $data);
        $data2['title'] = 'List Product';
        $this->view->loadTemplate('tempadmin', $data2);
    }
    

    //Thêm mới một product
    public function add() {
        $data = array(
            
        );
        $data2['content'] = $this->view->load('add-product', $data);
        $data2['title'] = 'Add Product';
        $this->view->loadTemplate('tempadmin', $data2);
        
        if(isset($_POST['btn-add-pd'])) {
            if(($_POST['pd_name'] != '') && ($_POST['pd_price'] != '') && ($_POST['pd_text'] != '')
                    && ($_POST['select'] != '')) {
                $name = $_POST['pd_name'];
                $price = $_POST['pd_price'];
                $des = $_POST['pd_text'];
                $status = $_POST['select'];
                $fileName = $_FILES['fileToUpload'];
                
                if($this->uploadImg($fileName)) {
                    $result = Product::addProduct($name, $price, $des, $fileName['name'], $status);
                    //$result = Product::addProduct('Product 1', 150000, "Product 1", "hello", 1);
                    if($result) {
                        header("location: " . BASE_URL . "/admin/product");
                        //echo "OK";
                    } else {
                        header("location: " . BASE_URL . "/admin/product/add");
                        //echo "Failed 1";
                    }
                } else {
                    //echo "Failed 2";
                }
                //echo $name . '<br>' . $price . '<br>' . $des . '<br>' . $status . '<br>' . $fileName['name'];
            }
        }
    }
    
    //Sủa product
    public function edit() {
        global $url;
        $url = rtrim($url, "/");
        $urlArray = array();
        $urlArray = explode("/", $url);
        $pd_id = $urlArray[3];
        
        $data = array(
            'oldPd' => Product::getProduct($pd_id)
        );
        
        $data2['content'] = $this->view->load('edit-product', $data);
        $data2['title'] = 'Edit Product';
        $this->view->loadTemplate('tempadmin', $data2);
        
        if (isset($_POST['btn-edit-pd'])) {
            if(($_POST['edit-name'] != '') && ($_POST['edit-price'] != '') && ($_POST['edit-des'] != '')
                    && ($_POST['select'] != '')) {
                
                $name = $_POST['edit-name'];
                $price = $_POST['edit-price'];
                $des = $_POST['edit-des'];
                $status = $_POST['select'];
                $fileName = $_FILES['fileToUpload'];

                if(($fileName['name'] != '') && ($this->uploadImg($fileName))) {
                    $result = Product::editProduct($pd_id, $name, $price, $des, $fileName['name'], $status);
                    if($result) {
                        header("location: " . BASE_URL . "/admin/product");
                        
                    } else {
                        header("location: " . BASE_URL . "/admin/product/add");
                    }
                } else {
                    header("location: " . BASE_URL . '/admin/product/edit/' . $pd_id);
                }
            }
        }
    }
    
    //Update active
    public function active() {
        if (isset($_POST['btn-ac-pd'])) {
            if (!empty($_POST['checkbox'])) {
                foreach (($_POST['checkbox']) as $check) {
                    Product::update_active($check, '1');
                }
            }
        }
        if (isset($_POST['btn-dac-pd'])) {
            if (!empty($_POST['checkbox'])) {
                foreach (($_POST['checkbox']) as $check) {
                    Product::update_active($check, '0');
                }
            }
        }

        header("location: " . BASE_URL . '/admin/product');
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
        $pages->set_total(Product::count());
        
        if ($order == "asc") {
            $data = array(
                'order' => "desc",
                'lists' => Product::sort_item($item, $order, $pages->get_limit()),
                'page_links' => $pages->page_links()
            );
        } else {
            //$order = "asc";
            $data = array(
                'order' => "asc",
                'lists' => Product::sort_item($item, $order, $pages->get_limit()),   
                'page_links' => $pages->page_links()
            );
        }
        
        
        $data2['content'] = $this->view->load('list-product', $data);
        $data2['title'] = 'List Product';
        $this->view->loadTemplate('tempadmin', $data2);
    }

    public function getDataSearched() {
        if(isset($_POST['btn-search-pd'])) {
            if($_POST['search'] != '') {
                $string = $_POST['search'];
                $data = array(
                    'lists' => Product::searching_process($string)
                );
            }
        }

        $data2['content'] = $this->view->load('list-product', $data);
        $data2['title'] = 'Data searching';
        $this->view->loadTemplate('tempadmin', $data2);
    }
    
}



