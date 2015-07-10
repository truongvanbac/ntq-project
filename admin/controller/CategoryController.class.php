<?php

class CategoryController extends BaseController {


    /**
     * Model Name
     */
    protected static $model = 'Category';

    /**
     * Index, show list all category
     */
    public function index() {
        $this->indexPage('list-category', 'List Category');
    }


    /**
     * Add category
     */
    public function add() {

        $data = array(
            'category' => array('ct_name' => '', 'ct_status' => '1'),
            'message' => array('name' => '', 'status' => ''),
            'title' => 'Add',
            'btnName' => 'btn-add-ct',
        );

        $itemPost = array('name', 'status');
        $dataInput = array();
        $this->updateCategory('add', $data, 'btn-add-ct', $itemPost, $dataInput);
        $this->loadView('updateCategory', 'Add Category', $data);
    }


    /**
     * Edit Category
     */
    public function edit() {

        $urlArray = urlAnalyze();
        $ct_id = $urlArray[3];

        $data = array(
            'category' => Category::getCategory($ct_id),
            'message' => array('name' => '', 'status' => ''),
            'title' => 'Edit',
            'btnName' => 'btn-edit-ct',
        );

        $dataInput = array();
        //Check if id not empty
        $checkUrl = Category::getIdCategory($ct_id);
        if($checkUrl == 0) {
            directScript('Error, category id is not exist!', '' . BASE_URL . LIST_CATEGORY);
        } else {
            $itemPost = array('name','status');

            $this->updateCategory('edit', $data, 'btn-edit-ct', $itemPost, $dataInput, $ct_id);
        }
        $this->loadView('updateCategory', 'Edit Category', $data);
    }


    /**
     * Check validate data input from form
     * return true or false
     */
    private function validateForm(&$dataValidate = array(), $itemPost = array(), &$data = array()) {
        $dataValidate = array(
            'name'      => array(
                            'label'  => 'category name',
                            'input' => $itemPost[0],
                            'rule' => array('required','min_length:4','max_length:30'),
                            'message' => &$data['message']['name']
            ),

            'status'    => array(
                            'label' => 'status',
                            'input' => $itemPost[1],
                            'rule' => array('required'),
                            'message' => &$data['message']['status']
            )
        );

        $validate = $this->validateData($dataValidate);
        return $validate;
    }

    /**
     * Format data input from form
     * return data formatted
     */
    private function dataInputFormat($itemPost = array(), &$dataInput = array()) {
        $dataInput['ct_name'] = htmlentities(getValue($itemPost[0]), ENT_QUOTES);
        $dataInput['ct_status'] = getValue($itemPost[1]);
        $dataInput['ct_time_update'] = date('Y-m-d h:i:s');
        return $dataInput;
    }


    /**
     * get data when user input form
     * return data
     */
    private function getDataReturn($action, &$data = array(), $itemPost = array()) {
        $data['category']['ct_name'] = getValue($itemPost[0]);
        $data['category']['ct_status'] = getValue($itemPost[1]);
        return $data;
    }

    /**
     * Function commmon to update category contain add and edit category
     */
    private function updateCategory($action, &$data = array(), $button, $itemPost = array(), &$dataInput = array(), &$ct_id = null) {

        if (isset($_POST[$button])) {
           $validate = $this->validateForm($dataValidate, $itemPost, $data);        //Check validate data input
            if($validate) {

                $this->dataInputFormat($itemPost, $dataInput);                      //format daata input

                if($ct_id == null) {
                    $dataInput['ct_time_created'] = date('Y-m-d h:i:s');
                }

                $result = Category::updateCategoryProcess($dataInput, $ct_id);              //update category

                if ($result) {
                    directScript('Successfull!', '' . BASE_URL . LIST_CATEGORY);            // lib/function/directScript()
                } else {
                    $data['message']['name'] = 'Category name is exist.';
                }
                
            } 
            $this->getDataReturn($action, $data, $itemPost);        //Get data input return
            return $data;
        }
    }


    /**
     * Active item category
     */
    public function active() {
        $this->activeItem();
        redirect(BASE_URL . LIST_CATEGORY);
    }

    /**
     * Sort category
     */
    public function sort() {
        $this->sortItem('list-category', 'Sorting Category');
    }

    /**
     * Get Data Searched
     */
    public function getDataSearched() {
        $this->searchingItem('list-category', 'Searching Category');
    }
}
