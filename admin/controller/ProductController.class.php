<?php

class ProductController extends BaseController {

    /**
     * Model Name
     */
    protected static $model = 'Product';

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
            'product' => array('pd_name' => '', 'pd_price' => '', 'pd_des' => '', 'pd_status' => '1', 'pd_img0' => '',
                'pd_img1' => '', 'pd_img2' => ''),
            'message' => array('name' => '', 'price' => '', 'des' => '', 'status' => '', 'img' => ''),
            'title' => 'Add',
            'btnName' => 'btn-add-pd'
        );
        
        $itemPost = array('name', 'price', 'des', 'status');
        $dataInput = array();
        $this->updateProduct('add', $data, 'btn-add-pd', $itemPost, $dataInput);
        $this->loadView('updateProduct', 'Add Product', $data);
    }
    

    /**
     * Edit product
     */
    public function edit() {

        $urlArray = urlAnalyze(); 
        $pd_id = $urlArray[3];
        
        $data = array(
            'product' => Product::getProduct($pd_id),
            'message' => array('name' => '', 'price' => '', 'des' => '', 'status' => '', 'img' => ''),
            'title' => 'Edit',
            'btnName' => 'btn-edit-pd'
        );
        
        $checkUrl = Product::getIdProduct($pd_id);  //Chek id product
        if($checkUrl == 0) {
            directScript('Error, category id not exist.', '' . BASE_URL . LIST_PRODUCT);
        } else {
            $itemPost = array('name', 'price', 'des', 'status');
            $dataInput = array();
            $this->updateProduct('edit', $data, 'btn-edit-pd', $itemPost, $dataInput, $pd_id);
        }

        $this->loadView('updateProduct', 'Edit Category', $data);
    }


    private function validateForm(&$dataValidate = array(), $itemPost = array(), &$data = array()) {
        $dataValidate = array(
            'name'          => array(
                                'label' => 'product name',
                                'input' => $itemPost[0],
                                'rule' => array('required'),
                                'message' => &$data['message']['name']
            ),

            'price'        => array(
                                'label' => 'price',
                                'input' => $itemPost[1],
                                'rule' => array('required','valid_number_natural'),
                                'message' => &$data['message']['price']
            ),

            'description'  => array(
                                'label' => 'description',
                                'input' => $itemPost[2],
                                'rule' => array('required'),
                                'message' => &$data['message']['des']
            )
        );

        $validate = $this->validateData($dataValidate);
        return $validate;
    }

    /**
     * Format data input from form
     * return data formatted
     */
    private function dataInputFormat($itemPost = array(), &$dataInput = array(), &$fileName) {
        $dataInput['pd_name'] = htmlentities(getValue($itemPost[0]), ENT_QUOTES);
        $dataInput['pd_price'] = htmlentities(getValue($itemPost[1]));
        $dataInput['pd_des'] = htmlentities(getValue($itemPost[2]), ENT_QUOTES);
        $dataInput['pd_status'] = getValue($itemPost[3]);
        $dataInput['pd_time_updated'] = date('Y-m-d h:i:s');
        for($i = 0; $i < NUM_IMG; $i++) {
            if($fileName['name'][$i] != '') {
                $fileName['name'][$i] = time() . $fileName['name'][$i];
                $dataInput["pd_img" . $i] = $fileName['name'][$i];
            }
        }
        return $dataInput;
    }


    /**
     * get data when user input form
     * return data
     */
    private function getDataReturn($action, &$data = array(), $itemPost = array()) {
        $data['product']['pd_name'] = getValue($itemPost[0]);
        $data['product']['pd_price'] = getValue($itemPost[1]);
        $data['product']['pd_des'] = getValue($itemPost[2]); 
        $data['product']['pd_status'] = getValue($itemPost[3]);
        return $data;
    }

    /**
     * Function commmon to update product contain add and edit
     */
    private function updateProduct($action, &$data = array(), $button, $itemPost = array(), &$dataInput, &$pd_id = null) {
        $result = false;
        $check = false;
        if(isset($_POST[$button])) {
            $validate = $this->validateForm($dataValidate, $itemPost, $data);

            if($validate) {
                $fileName = $_FILES['fileToUpload'];
                $this->dataInputFormat($itemPost, $dataInput, $fileName);

                $imgString = '';
                for($i =0; $i < NUM_IMG; $i++) {
                    $imgString .= $fileName['name'][$i];
                }

                if($pd_id == null) {  //add                                                       //add
                    $dataInput['pd_time_created'] = date('Y-m-d h:i:s');
                    if(($imgString != '') && ($this->uploadMultiImg($fileName))) {
                        $check = true;
                    } else {
                        $data['message']['img'] = 'Upload Image Failed.';
                    }
                } else {
                    if($this->uploadMultiImg($fileName)) {
                        for($i =0; $i < NUM_IMG; $i++) {
                            if($fileName['name'][$i] == '') {
                                $fileName['name'][$i] = Product::getProduct($pd_id)["pd_img" . $i];
                                $dataInput["pd_img" . $i] = $fileName['name'][$i];
                            }
                        }
                        $check = true;
                    } else {
                        $data['message']['img'] = 'Upload Image Failed.';
                    }
                }

                if($check) {
                    $result = Product::updateProductProcess($dataInput, $pd_id);
                    if($result) {
                        directScript('Successfull!', '' . BASE_URL . LIST_PRODUCT); 
                    } else {
                        $data['message']['name'] = 'Product name is exist.';
                    }
                }
            }

            $this->getDataReturn($action, $data, $itemPost);
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



