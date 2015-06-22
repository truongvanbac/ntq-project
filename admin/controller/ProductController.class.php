<?php
session_start();

class ProductController extends Controller {

    //Biến $data2 lưu trữ dữ liệu xuất ra view
    private $data2 = array();

    //Hàm khoeir tạo
    public function __construct() {
        parent::__construct();
        if(empty($_SESSION['log'])) {
            header("location: " . BASE_URL . '/admin/login');  
        }
    }
    

    //Trang hiển thị danh sách products
    public function index() {
        $pages = new Pagination('10', 'page');
        $pages->set_total(Product::count());
        
        $data = array(
            'lists' => Product::get_list_product($pages->get_limit()),
            'order' => "desc",
            'page_links' => $pages->page_links(),
            'count' => Product::count()
        );
        $data2['oldUser'] = User::getUser(1);
        $data2['content'] = $this->view->load('list-product', $data);
        $data2['title'] = 'List Product';
        $this->view->loadTemplate('tempadmin', $data2);
    }
    

    //Thêm mới một product
    public function add() {
        $data = array(
            'oldName' => '',
            'oldPrice' =>'',
            'oldDes' => '',
            'oldStatus' => '1'
        );
        
        
        if(isset($_POST['btn-add-pd'])) {
            if(($_POST['pd_name'] != '') && ($_POST['pd_price'] != '') && ($_POST['pd_text'] != '')
                    && ($_POST['select'] != '')) {

                $name = htmlentities($_POST['pd_name']);
                $price = htmlentities($_POST['pd_price']);
                $des = htmlentities($_POST['pd_text']);
                $status = $_POST['select'];
                $fileName = $_FILES['fileToUpload'];


                $data['oldName'] = $name;
                $data['oldPrice'] = $price;
                $data['oldDes'] = $des;
                $data['oldStatus'] = $status;

                
                if($this->regular->check('[0-9]', $price)) {
                    if(($fileName['name'] != '') && ($this->uploadImg($fileName))) {

                        $result = Product::addProduct($name, $price, $des, $fileName['name'], $status);

                        if($result) {
                            echo "<script>";
                            echo "setTimeout(
                                function() {
                                    alert('Successfull');
                                    window.location = ('http://localhost/ntq-project/admin/product');
                                }
                            , 500);";
                            echo "</script>";
                        } else {
                            echo "<script>";
                            echo "alert('Product name is invalid');";
                            echo "</script>";
                        }
                    } else {
                        echo "<script>";
                        echo "alert('Upload Image is Failed');";
                        echo "</script>";
                    }
                } else {
                    echo "<script>";
                    echo "alert('Price is nummeric');";
                    echo "</script>";
                }
            } else {
                echo "<script>";
                echo "alert('Let\'s input fully Product name, Price and Description');";
                echo "</script>";
            }
        }
        $data2['oldUser'] = User::getUser(1);
        $data2['content'] = $this->view->load('add-product', $data);
        $data2['title'] = 'Add Product';
        $this->view->loadTemplate('tempadmin', $data2);


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
        


         //Kiem tra id category co ton tai hay khong
        $checkUrl = Product::getIdProduct($pd_id);
        if($checkUrl == 0) {
            echo "<script>";
            echo "setTimeout(
                    function() {
                        alert('Error, not existent category id!!!');
                        window.location = ('http://localhost/ntq-project/admin/category');
                    }
                , 500);";
            echo "</script>";
        } else {
            if (isset($_POST['btn-edit-pd'])) {
                if(($_POST['edit-name'] != '') && ($_POST['edit-price'] != '') && ($_POST['edit-des'] != '')
                        && ($_POST['select'] != '')) {
                    
                    $name = htmlentities($_POST['edit-name']);
                    $price = htmlentities($_POST['edit-price']);
                    $des = htmlentities($_POST['edit-des']);
                    $status = $_POST['select'];
                    $fileName = ($_FILES['fileToUpload']);

                    if($fileName['name'] == '') {
                        $fileName['name'] = Product::getProduct($pd_id)['pd_img'];
                    }

                    if($this->regular->check('[0-9]', $price) && ($price >= 0)) {
                        if(($fileName['name'] != '') && ($this->uploadImg($fileName))) {
                            $result = Product::editProduct($pd_id, $name, $price, $des, $fileName['name'], $status);
                            if($result) {
                                echo "<script>";
                                echo "setTimeout(
                                    function() {
                                        alert('Successfull');
                                        window.location = ('http://localhost/ntq-project/admin/product');
                                    }
                                , 500);";
                                echo "</script>";
                                
                            } else {
                                echo "<script>";
                                echo "alert('Product name is invalid');";
                                echo "</script>";
                            }
                        } else {
                            echo "<script>";
                            echo "alert('Upload Image is Failed');";
                            echo "</script>";
                        }
                    } else {
                        echo "<script>";
                        echo "alert('Price is nummeric and positive');";
                        echo "</script>";
                    }

                } else {
                    echo "<script>";
                    echo "alert('Let\'s input fully Product name, Price and Description');";
                    echo "</script>";
                }
            }
        }

        $data2['oldUser'] = User::getUser(1);
        $data2['content'] = $this->view->load('edit-product', $data);
        $data2['title'] = 'Edit Product';
        $this->view->loadTemplate('tempadmin', $data2);
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
                'page_links' => $pages->page_links(),
                'count' => Product::count()
            );
        } else {
            $data = array(
                'order' => "asc",
                'lists' => Product::sort_item($item, $order, $pages->get_limit()),   
                'page_links' => $pages->page_links(),
                'count' => Product::count()
            );
        }
        
        
        $data2['content'] = $this->view->load('list-product', $data);
        $data2['title'] = 'List Product';
        $this->view->loadTemplate('tempadmin', $data2);
    }

    //Tìm kiếm dữ liệu
    public function getDataSearched() {
        

        if(isset($_GET['btn-search-pd'])) {
            if($_GET['search'] != '') {
                $string = $_GET['search'];
                $totalRecord = Product::searching_process($string)['count'];
                $pages = new Pagination('10', 'page');
                $pages->set_total($totalRecord);
                $data = array(
                    'lists' => Product::searching_process($string, $pages->get_limit())['result'],
                    'page_links' => $pages->page_links(),
                    'count' => $totalRecord
                );
            }
        }
        $data2['oldUser'] = User::getUser(1);
        $data2['content'] = $this->view->load('list-product', $data);
        $data2['title'] = 'Data Searching Product';
        $this->view->loadTemplate('tempadmin', $data2);
    }
    
}



