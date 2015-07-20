<?php

class ProductController extends BaseController {

    /**
     * Model Name
     */
    protected $model = 'Product';
    protected $id = 'pd_id';

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
            'message' => array('name' => '', 'price' => '', 'des' => '', 'status' => '', 'img' => ''),      //Message
            'title' => 'Add',               //Title page
            'btnName' => 'btn-add-pd'       //Button name
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
                                'input' => test_input(getValue($itemPost[0])),
                                'rule' => array('required'),
                                'message' => &$data['message']['name']
            ),

            'price'        => array(
                                'label' => 'price',
                                'input' => test_input(getValue($itemPost[1])),
                                'rule' => array('required','valid_number_natural'),
                                'message' => &$data['message']['price']
            ),

            'description'  => array(
                                'label' => 'description',
                                'input' => test_input(getValue($itemPost[2])),
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
        $dataInput['pd_name'] = test_input(getValue($itemPost[0]));
        $dataInput['pd_price'] = test_input(getValue($itemPost[1]));
        $dataInput['pd_des'] = test_input(getValue($itemPost[2]));
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
        $data['product']['pd_name'] = test_input(getValue($itemPost[0]));
        $data['product']['pd_price'] = test_input(getValue($itemPost[1]));
        $data['product']['pd_des'] = test_input(getValue($itemPost[2])); 
        $data['product']['pd_status'] = getValue($itemPost[3]);
        return $data;
    }

    /**
     * Function commmon to update product contain add and edit
     */
    private function updateProduct($action, &$data = array(), $button, $itemPost = array(), &$dataInput, &$pd_id = null) {
        $result = false;
        $check = false;
        if(isset($_POST[$button])) {                //press button
            $fileName = $_FILES['fileToUpload'];            //get file upload
            $validate = $this->validateForm($dataValidate, $itemPost, $data);       //validate data
            $this->dataInputFormat($itemPost, $dataInput, $fileName);           //format data
            
            // if($pd_id == null) {
            //     $validate = $this->validate->validateImg($fileName['name'], $data['message']['img']);   //check image empty
            // }

            if($validate) {
                if($this->uploadMultiImg($fileName, $data['message']['img'] )) {
                    $check = true;
                }

                if($pd_id == null) {                                                            //add product
                    $dataInput['pd_time_created'] = date('Y-m-d h:i:s');
                } else {                                                                       //edit product

                    if(!empty($_POST['checkdel'])) {                //remove image when tick checkbox
                        $dataImg = array();
                        foreach (getValue('checkdel') as $check) {
                            $dataImg[] = $check;
                        }
                        Product::remove_image($pd_id, $dataImg);
                    }

                    for($i =0; $i < NUM_IMG; $i++) {                //check if image not exit
                        $oldImg = Product::getProduct($pd_id)["pd_img" . $i];           //get old Image

                        if($fileName['name'][$i] == '') {
                            $fileName['name'][$i] = $oldImg;
                            $dataInput["pd_img" . $i] = $fileName['name'][$i];
                        } else {
                            if($oldImg != null)
                                deleteFile($oldImg);                //delete image
                        }
                    }
                }

                if($check) {
                    $result = Product::updateProductProcess($dataInput, $pd_id);        //update database
                    if($result) {       //if upload image success
                        directScript('Successfull!', '' . BASE_URL . LIST_PRODUCT);     //redirect list product
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
     * Active item
     */
    public function active() {
        $this->activeItem();
        redirect(BASE_URL . LIST_PRODUCT);
    }

    /**
     *Search and sort
     */
    public function show() {
        $this->showData('list-product', 'Product');
    }
}


