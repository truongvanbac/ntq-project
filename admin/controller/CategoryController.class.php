<?php

class CategoryController extends BaseController {
    
    /**
     * Model Name
     */
    protected static $model = 'Category';

    /**
    * Constructor function
    *   
    */
    public function __construct() {
        parent::__construct();

    }


    /**
     * Index, show list all category
     */
    public function index() {
        $this->indexPage('list-category', 'List Category');         //BaseController/indexPage()
    }


    /**
     * Add category
     */
    public function add() {

        $data = array(
            'oldName' => '',
            'oldStatus' => '1',
            'message' => ''
        );

        $itemPost = array('new-category', 'select');
        $dataInput = array();
        $this->updateCategory('add', $data, 'btn-add-ct', $itemPost, $dataInput);
        $this->loadView('add-category', 'Add Category', $data);             //BaseController/loadView()
    }


    /**
     * Edit Category
     */
    public function edit() {

        $urlArray = urlAnalyze();
        $ct_id = $urlArray[3];      //Lấy id category

        $data = array(
            'edit_name' => Category::getCategory($ct_id),
            'message' => ''
        );

        $dataInput = array();

        $checkUrl = Category::getIdCategory($ct_id);    //Check id category
        if($checkUrl == 0) {
            directScript('Error, category id is not exist!', '' . BASE_URL . LIST_CATEGORY);        //lib/function/directScript()
        } else {
            $itemPost = array(
                'name-edit',
                'select'
            );

            $this->updateCategory('edit', $data, 'btn-edit-ct', $itemPost, $dataInput, $ct_id);
        }
        $this->loadView('edit-category', 'Edit Category', $data);       //BaseController/loadView
    }


    /**
     * Function commmon to update category contain add and edit category
     */
    private function updateCategory($action, &$data = array(), $button, $itemPost = array(), &$dataInput = array(), &$ct_id = null) {

        if (isset($_POST[$button])) {
            $ct_name_check = $this->validate->checkInputForm('Category name', $itemPost[0], 'require', $data['message']);   //lib/Valodation/checkInpitForm
            $ct_status_check = $this->validate->checkInputForm('Category name', $itemPost[1], 'require', $data['message']); //lib/Valodation/checkInpitForm

            if($ct_name_check && $ct_status_check) {

                $dataInput['ct_name'] = htmlentities(getValue($itemPost[0]), ENT_QUOTES);
                $dataInput['ct_status'] = getValue($itemPost[1]);

                switch ($action) {
                    case 'add':
                        $dataInput['ct_time_created'] = $dataInput['ct_time_update'] = date('Y-m-d h:i:s');

                        $result = Category::updateCategoryProcess($dataInput);
                        break;
                    
                    case 'edit':
                        $dataInput['ct_time_update'] = date('Y-m-d h:i:s');
                        $result = Category::updateCategoryProcess($dataInput, $ct_id);
                        break;
                }

                if ($result) {
                    directScript('Successfull!', '' . BASE_URL . LIST_CATEGORY);    //lib/functions/directScript
                } else {
                    $data['message'] = 'Category name is existent!';
                }
            } 

            switch ($action) {
                case 'add':
                    $data['oldName'] = getValue($itemPost[0]);
                    $data['oldStatus'] = getValue($itemPost[1]);
                    break;
                case 'edit':
                    $data['edit_name']['ct_name'] = getValue($itemPost[0]);
                    $data['edit_name']['ct_status'] = getValue($itemPost[1]);
                    break;   
            }
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
