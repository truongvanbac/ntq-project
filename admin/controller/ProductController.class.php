<?php

class ProductController extends BaseController {

    /**
     * Model Name
     */
    protected static $model = 'Product';

    /**
     * Constructor function
     */
    public function __construct() {
        parent::__construct();
    }
    

    /**
     * Index, show list all product
     */
    public function index() {
        $this->indexPage('list-product', 'List Product');
    }
    

    /**
     * Add product
     */
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
        
        $itemPost = array('pd_name', 'pd_price', 'pd_text', 'select');
        $dataInput = array();
        $this->updateProduct('add', $data, 'btn-add-pd', $itemPost, $dataInput);
        $this->loadView('add-product', 'Add Product', $data);
    }
    

    /**
     * Edit product
     */
    public function edit() {

        $urlArray = urlAnalyze(); 
        $pd_id = $urlArray[3];
        
        $data = array(
            'oldPd' => Product::getProduct($pd_id),
            'messageName' => '',
            'messagePrice' => '',
            'messageDes' => '',
            'messageImg' => ''
        );
        
        $checkUrl = Product::getIdProduct($pd_id);  //Chek id product
        if($checkUrl == 0) {
            directScript('Error, category id not exist!', '' . BASE_URL . LIST_PRODUCT);
        } else {
            $itemPost = array('edit-name', 'edit-price', 'edit-des', 'select');
            $dataInput = array();
            $this->updateProduct('edit', $data, 'btn-edit-pd', $itemPost, $dataInput, $pd_id);
        }

        $this->loadView('edit-product', 'Edit Category', $data);
    }


    /**
     * Function commmon to update product contain add and edit
     */
    private function updateProduct($action, &$data = array(), $button, $itemPost = array(), &$dataInput, &$pd_id = null) {
        $result = false;
        if(isset($_POST[$button])) {
            // var_dump((!preg_match('/^[0-9]+$/', getValue($itemPost[1]))));
            // $pd_name_check = $this->validate->checkInputForm('Product', $itemPost[0], 'require', $data['messageName']);
            // $pd_price_check = $this->validate->checkInputForm('Username', $itemPost[1], 'numeric', $data['messagePrice']);
            // $pd_des_check = $this->validate->checkInputForm('Description', $itemPost[2], 'require', $data['messageDes']);

            if(getValue($itemPost[0]) == ''){
                $data['messageName'] = 'Field Product Name is not empty!';
            } else if(getValue($itemPost[1]) == '') {
                $data['messagePrice'] = 'Field Price is not empty!';
            } else if(!($this->regular->check('[0-9]', getValue($itemPost[1]))) || (getValue($itemPost[1]) < 0)) {
                $data['messagePrice'] = 'Price is must numeric and positive!';
            } else if(getValue($itemPost[2]) == '') {
                $data['messageDes'] = 'Filed Description is not empty!';
            } else {

                $dataInput['pd_name'] = htmlentities(getValue($itemPost[0]), ENT_QUOTES);
                $dataInput['pd_price'] = htmlentities(getValue($itemPost[1]));
                $dataInput['pd_des'] = htmlentities(getValue($itemPost[2]), ENT_QUOTES);
                $dataInput['pd_status'] = getValue($itemPost[3]);
                $fileName = ($_FILES['fileToUpload']);
                
                $imgString = '';        //Check image = null?
                for($i = 0; $i < NUM_IMG; $i++) {
                    if($fileName['name'][$i] != '') {
                        $imgString .= $fileName['name'][$i];
                        $fileName['name'][$i] = time() . $fileName['name'][$i];
                        $dataInput["pd_img" . $i] = $fileName['name'][$i];
                    }
                }

                switch ($action) {
                    case 'add':
                        if(($imgString != '') && ($this->uploadMultiImg($fileName))) {
                            $dataInput['pd_time_created'] = date('Y-m-d h:i:s');
                            $dataInput['pd_time_updated'] = date('Y-m-d h:i:s');
                            $result = Product::updateProductProcess($dataInput);
                        } else {
                            $data['messageImg'] = 'Field Image is invalid!';
                        }
                            
                        break;

                    case 'edit':
                        if($this->uploadMultiImg($fileName)) {
                            for($i = 0; $i < NUM_IMG; $i++) {
                                if($fileName['name'][$i] == '') {
                                    $fileName['name'][$i] = Product::getProduct($pd_id)["pd_img" . $i];
                                    $dataInput["pd_img" . $i] = $fileName['name'][$i];
                                }
                            }
                            $dataInput['pd_time_updated'] = date('Y-m-d h:i:s');
                            $result = Product::updateProductProcess($dataInput, $pd_id);
                        } else {
                            $data['messageImg'] = 'Upload image failed!';
                        }
                        break;
                }

                if($result) {
                    directScript('Successfull!', '' . BASE_URL . LIST_PRODUCT); 
                } else {
                    $data['messageName'] = 'Product name is existent';
                }
            }

            switch ($action) {
                case 'add':
                    $data['oldName'] = getValue($itemPost[0]);
                    $data['oldPrice'] = getValue($itemPost[1]);
                    $data['oldDes'] = getValue($itemPost[2]); 
                    $data['oldStatus'] = getValue($itemPost[3]);
                    break;
                
                case 'edit':
                    $data['oldPd']['pd_name'] = getValue($itemPost[0]);
                    $data['oldPd']['pd_price'] = getValue($itemPost[1]);
                    $data['oldPd']['pd_des'] = getValue($itemPost[2]); 
                    $data['oldPd']['pd_status'] = getValue($itemPost[3]);
                    break;
            }
            return $data;
        }
    }

    /**
     * Function active item
     */
    public function active() {
        $this->activeItem();
        redirect(BASE_URL . LIST_PRODUCT);
    }
    

    /**
     * Function sort
     */
    public function sort() {
        $this->sortItem('list-product', 'Sorting Product');
    }


    /**
     * Get data searched
     */
    public function getDataSearched() {
        $this->searchingItem('list-product', 'Searching Product');
    }
    
}



