<?php

class ProductController extends BaseController {

    //Hàm khoeir tạo
    public function __construct() {
        parent::__construct();
    }
    

    //Trang hiển thị danh sách products
    public function index() {
        $this->homePage(PRODUCT, 'list-product', 'List Product');
    }
    

    //Thêm mới một product
    public function add() {
        $data = array(
            'oldName' => '',
            'oldPrice' =>'',
            'oldDes' => '',
            'oldStatus' => '1',
            'messageName' => '',
            'messagePrice' => '',
            'messageDes' => '',
            'messageImg' => ''
        );
        
        
        if(isset($_POST['btn-add-pd'])) {
            if((getMethod('pd_name') != '') && (getMethod('pd_price') != '') && (getMethod('pd_text') != '')
                    && (getMethod('select') != '')) {

                $name = htmlentities(getMethod('pd_name'), ENT_QUOTES);
                $price = htmlentities(getMethod('pd_price'));
                $des = htmlentities(getMethod('pd_text'), ENT_QUOTES);
                $status = getMethod('select');
                $fileName = ($_FILES['fileToUpload']);

                $imgString = '';
                for($i = 0; $i < NUM_IMG; $i++) {
                    if($fileName['name'][$i] != '') {
                        $imgString .= $fileName['name'][$i];
                        $fileName['name'][$i] = time() . $fileName['name'][$i];
                    }
                }

                if(($imgString != '') && ($this->uploadMultiImg($fileName))) {

                    $result = Product::addProduct($name, $price, $des, $fileName['name'], $status);

                    if($result) {
                        directScript('Successfull!', '' . BASE_URL . LIST_PRODUCT);
                    } else {
                        $data['messageName'] = 'Product name is existent!';
                    }
                } else {
                    $data['messageImg'] = 'Field Image is invalid!';
                }

            } else {
                if(getMethod('pd_name') == ''){
                    $data['messageName'] = 'Field Product Name is not empty!';
                }
                if(getMethod('pd_price') == '') {
                    $data['messagePrice'] = 'Field Price Name is not empty!';
                } else if(!($this->regular->check('[0-9]', getMethod('pd_price'))) || (getMethod('pd_price') < 0)) {
                    $data['messagePrice'] = 'Price is must numeric and positive!';
                }
                if(getMethod('pd_text') == '') {
                    $data['messageDes'] = 'Filed Description is not empty!';
                }
            }

            $data['oldName'] = getMethod('pd_name');
            $data['oldPrice'] = getMethod('pd_price');
            $data['oldDes'] = getMethod('pd_text'); 
            $data['oldStatus'] = getMethod('select');

        }

        $this->loadView(PRODUCT, 'add-product', 'Add Product', $data);
    }
    
    //Sủa product
    public function edit() {

        $urlArray = urlAnalyze(); // function.php->urlAnalyze()
        $pd_id = $urlArray[3];
        
        $data = array(
            'oldPd' => Product::getProduct($pd_id),
            'messageName' => '',
            'messagePrice' => '',
            'messageDes' => '',
            'messageImg' => ''
        );
        

         //Kiem tra id category co ton tai hay khong
        $checkUrl = Product::getIdProduct($pd_id);
        if($checkUrl == 0) {
            directScript('Error, not existent category id', '' . BASE_URL . LIST_PRODUCT);
        } else {
            if (isset($_POST['btn-edit-pd'])) {
                if((getMethod('edit-name') != '') && (getMethod('edit-price') != '') && (getMethod('edit-des') != '')
                        && (getMethod('select') != '')) {
                    
                    $name = htmlentities(getMethod('edit-name'), ENT_QUOTES);
                    $price = htmlentities(getMethod('edit-price'));
                    $des = htmlentities(getMethod('edit-des'));
                    $status = getMethod('select');
                    $fileName = $_FILES['fileToUpload'];

                    for($i = 0; $i < NUM_IMG; $i++) {
                        if($fileName['name'][$i] != '') {
                            $fileName['name'][$i] = time() . $fileName['name'][$i];
                        }
                    }

                    if($this->regular->check('[0-9]', $price) && ($price >= 0)) {
                        if($this->uploadMultiImg($fileName)) {
                             for($i = 0; $i < NUM_IMG; $i++) {
                                if($fileName['name'][$i] == '') {
                                    $fileName['name'][$i] = Product::getProduct($pd_id)["pd_img" . $i];
                                }
                            }
                            $result = Product::editProduct($pd_id, $name, $price, $des, $fileName['name'], $status);
                            if($result) {
                                directScript('Successfull!', '' . BASE_URL . LIST_PRODUCT);
                                
                            } else {
                                $data['messageName'] = 'Product name is existent';
                            }
                        } else {
                            $data['messageImg'] = 'Uload image failed!';
                        }
                    } else {
                        $data['messagePrice'] = 'Price is nummeric and positive';
                    }

                } else {
                    if(getMethod('edit-name') == '') {
                        $data['messageName'] = 'Field Product name is not empty!';
                    }
                    if(getMethod('edit-price') == '') {
                        $data['messagePrice'] = 'Field Price is not empty!';
                    }
                    if(getMethod('edit-des') == '') {
                        $data['messageDes'] = 'Field Description is not empty!';
                    }
                }

                $data['oldPd']['pd_name'] = getMethod('edit-name');
                $data['oldPd']['pd_price'] = getMethod('edit-price');
                $data['oldPd']['pd_des'] = getMethod('edit-des'); 
                $data['oldPd']['pd_status'] = getMethod('select');
            }
        }

        $this->loadView(PRODUCT, 'edit-product', 'Edit Category', $data);
    }
    
    //Update active
    public function active() {
        $this->activeItem(PRODUCT);
        redirect(BASE_URL . LIST_PRODUCT);
    }
    


    //Sắp xếp
    public function sort() {
        $this->sortItem(PRODUCT, 'list-product', 'Data Sorting Product');
    }

    //Tìm kiếm dữ liệu
    public function getDataSearched() {
        $this->searchingItem(PRODUCT, 'list-product', 'Data Searching Product');
    }
    
}



