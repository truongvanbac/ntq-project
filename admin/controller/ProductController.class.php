<?php

class ProductController extends BaseController {

    /**
     * Model Name
     */
    protected $model = 'Product';
    protected $id = 'pd_id';
    protected $checkField = array('pd_id', 'pd_name', 'pd_price', 'pd_des', 'pd_status', 'pd_time_created', 'pd_time_updated');

    /**
     * Index, show list all product
     */
    public function index() {
        $this->indexPage('list-product', 'List Product');
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

    
    /**
     * Add product
     */
    public function add() {
        $data = array(
            'product' => array(),
            'message' => array(),           //Message
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
            'message' => array(),
            'title' => 'Edit',
            'btnName' => 'btn-edit-pd'
        );
        
        $checkUrl = Product::getIdProduct($pd_id);          //Chek id product
        if($checkUrl == 0) {
            directScript('Error, category id exist.', '' . BASE_URL . LIST_PRODUCT);
        } else {
            $itemPost = array('name', 'price', 'des', 'status');
            $dataInput = array();
            $this->updateProduct('edit', $data, 'btn-edit-pd', $itemPost, $dataInput, $pd_id);
        }

        $this->loadView('updateProduct', 'Edit Category', $data);
    }

    /**
     * Validate data
     */
    private function validateForm(&$dataValidate = array(), $itemPost = array(), &$data = array()) {
        $dataValidate = array(
            'name'          => array(
                                'label'     =>  'product name',
                                'input'     =>  test_input(getValue($itemPost[0])),
                                'rule'      =>  array('required'),
                                'message'   =>  &$data['message']['name']
            ),

            'price'        => array(
                                'label'     =>  'price',
                                'input'     =>  test_input(getValue($itemPost[1])),
                                'rule'      =>  array('required','valid_number_natural'),
                                'message'   =>  &$data['message']['price']
            ),

            'description'  => array(
                                'label'     =>  'description',
                                'input'     =>  test_input(getValue($itemPost[2])),
                                'rule'      =>  array('required'),
                                'message'   =>  &$data['message']['des']
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
                $fileName['name'][$i] = time() . $i . $fileName['name'][$i];
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

        if(isset($_POST[$button])) {                        //press button
            $fileName = $_FILES['fileToUpload'];            //get file upload
            $validate = $this->validateForm($dataValidate, $itemPost, $data);           //validate data
            $this->dataInputFormat($itemPost, $dataInput, $fileName);                   //format data

            $oldImg = array();

            for($i =0; $i < NUM_IMG; $i++) {            //check if image not exit
                $oldImg[$i] = Product::getProduct($pd_id)["pd_img" . $i];
            }

            $uploadImg = $this->uploadMultiImg($fileName, $data['message']['img']);
            
            if($validate && $uploadImg) {

                if($pd_id == null) {                                                           //add product
                    $dataInput['pd_time_created'] = date('Y-m-d h:i:s');
                } else {                                                                       //edit product

                    for($i =0; $i < NUM_IMG; $i++) {            //check if image not exit

                        if(($fileName['name'][$i] == '')) {
                            $dataInput["pd_img" . $i] = $oldImg[$i];
                        } else {
                            deleteFile($oldImg[$i]);                //delete image
                        }
                    }

                    if(!empty($_POST['checkdel'])) {               //remove image when tick checkbox
                        foreach (getValue('checkdel') as $check) {
                            deleteFile($oldImg[$check]);
                            $dataInput["pd_img" . $check] = $fileName['name'][$check];
                        }
                    }
                }

                $result = Product::updateProductProcess($dataInput, $pd_id);        //update database
                if($result) {
                    directScript('Successfull!', '' . BASE_URL . LIST_PRODUCT);     //redirect list product
                } else {
                    $data['message']['name'] = 'Product name is exist.';
                }
            }

            $this->getDataReturn($action, $data, $itemPost);
            return $data;
        }
    }
}