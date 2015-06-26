<?php

class CategoryController extends BaseController {

    
    //Hàm khởi tạo
    public function __construct() {
        parent::__construct();
    }

    //Trang category, hiển thị danh sách tất cả các category
    public function index() {
        $this->homePage(CATEGORY, 'list-category', 'List Category');
    }


    //Thêm category
    public function add() {

        $data = array(
            'oldName' => '',
            'oldStatus' => '1',
            'message' => ''
        );

        if (isset($_POST['btn-add-ct'])) {

            if ((getMethod('new-category') != '') && (getMethod('select') != '')) {

                $ct_name = htmlentities(getMethod('new-category'), ENT_QUOTES);
                $ct_status = getMethod('select');

                $result = Category::add_category($ct_name, $ct_status);
                if ($result) {
                    directScript('Successfull!', BASE_URL . LIST_CATEGORY);
                } else {
                    $data['message'] = 'Category name is existent!';
                }
            } else {
                $data['message'] = 'Category name is not empty!';
            }

            $data['oldName'] = getMethod('new-category');
            $data['oldStatus'] = getMethod('select');
        }

        $this->loadView(CATEGORY, 'add-category', 'Add Category', $data);
    }


    //Chỉnh sửa category
    public function edit() {

        $urlArray = urlAnalyze();
        $ct_id = $urlArray[3];      //Lấy id category

        $data = array(
            'edit_name' => Category::getCategory($ct_id),
            'message' => ''
        );

         //Kiem tra id category co ton tai hay khong
        $checkUrl = Category::getIdCategory($ct_id);
        if($checkUrl == 0) {
            directScript('Error, not existent category id', '' . BASE_URL . LIST_CATEGORY);
        } else {
            
            if (isset($_POST['btn-edit-ct'])) {

                if ((getMethod('name-edit') != '') && (getMethod('select') != '')) {

                    $ct_name = htmlentities(getMethod('name-edit'), ENT_QUOTES);
                    $ct_status = getMethod('select');

                    $result = Category::edit_category($ct_id, $ct_name, $ct_status);
                    if ($result) {
                        directScript('Successfull!', '' . BASE_URL . LIST_CATEGORY);
                    } else {
                        $data['message'] = 'Category name is existent';
                    }
                } else {
                    $data['message'] = 'Category name is not empty';
                }

                $data['edit_name']['ct_name'] = getMethod('name-edit');
                $data['edit_name']['ct_status'] = getMethod('select');
            }   
        }

        $this->loadView(CATEGORY, 'edit-category', 'Edit Category', $data);
    }

    //Update active các phần tử
    public function active() {
        $this->activeItem(CATEGORY);
        redirect(BASE_URL . LIST_CATEGORY);
    }

    //Sắp xếp
    public function sort() {
        $this->sortItem(CATEGORY, 'list-category', 'Data Sorting Category');
    }

    //Tìm kiếm dữ liệu
    public function getDataSearched() {
        $this->searchingItem(CATEGORY, 'list-category', 'Data Searching Category');
    }
}
