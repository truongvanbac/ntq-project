<?php

class UserController extends BaseController {
    

   //Hầm khỏi tạo
    public function __construct() {
        parent::__construct();
    }
    
    //Trang hiển thị danh sách user
    public function index() {
        $this->homePage(USER, 'list-user', 'List User');
    }
    
    //Thêm user
    public function add() {
        $data = array(
            'oldName' => '',
            'oldEmail' => '',
            'oldStatus' => '1',
            'messageName' => '',
            'messageEmail' => '',
            'messagePass' => '',
            'messageImg' => ''
        );
        
        if(isset($_POST['btn-add-user'])) {
            if((getMethod('username') != '') && (getMethod('pass') != '') && (getMethod('email') != '') 
                && (getMethod('select') != '')) {

                $name = htmlentities(getMethod('username'), ENT_QUOTES);
                $pass = md5(getMethod('pass'));
                $email = getMethod('email');
                $status = getMethod('select');
                $fileName = $_FILES['fileToUpload'];

                if($fileName['name'] != '') {
                    $fileName['name'] = time() . $fileName['name'];
                }
                
                if($this->uploadImg($fileName)) {

                    $result = User::addUser($name, $email, $pass, $fileName['name'], $status);

                    if($result) {
                        directScript('Successfull!', '' . BASE_URL . LIST_USER);
                    } else {
                        $data['messageName'] = 'Username is existent!';
                    }
                } else {
                    $data['messageImg'] = 'Upload Image Failed!';
                }
                
            } else {
                if(getMethod('username') == '') {
                    $data['messageName'] = 'Field Username is not empty!';
                }

                if(getMethod('email') == '') {
                    $data['messageEmail'] = 'Field Email is not empty!';
                } else if(filter_var(getMethod('email'), FILTER_VALIDATE_EMAIL) == false) {
                    $data['messageEmail'] = 'Email is invalid!';
                }

                if(getMethod('pass') == '') {
                    $data['messagePass'] = 'Field Password is not empty!';
                }
            }

            $data['oldName'] = getMethod('username');
            $data['oldEmail'] = getMethod('email');
            $data['oldStatus'] = getMethod('select');
            $data['oldPass'] = getMethod('pass');
        }

        $this->loadView(USER, 'add-user', 'Add User', $data);
    }
    

    //Sửa user 
    public function edit() {
        $urlArray = urlAnalyze();
        $user_id = $urlArray[3];
        
        $data = array(
            'oldUser' => User::getUser($user_id),
            'messageName' => '',
            'messageEmail' => '',
            'messagePass' => '',
            'messageImg' => ''
        );
        
        $checkUrl = User::checkIdUser($user_id);
        if($checkUrl == 0) {
            directScript('Error, not existent user id!', '' . BASE_URL . LIST_USER);
        } else {
            if (isset($_POST['btn-edit-user'])) {
                if((getMethod('edit_username') != '') && (getMethod('edit_pass') != '') && (getMethod('edit_email') != '') 
                    && (getMethod('select') != '')) {
                    
                    $username = htmlentities(getMethod('edit_username'), ENT_QUOTES);
                    $pass = md5(getMethod('edit_pass'));
                    $email = getMethod('edit_email');
                    $status = getMethod('select');
                    $fileName = $_FILES['fileToUpload'];

                    if($fileName['name'] != '') {
                        $fileName['name'] = time() . $fileName['name'];
                    }

                    if(($fileName['name'] == '') || ($this->uploadImg($fileName))) {

                        if($fileName['name'] == '') {
                            $fileName['name'] = User::getUser($user_id)['user_img'];
                        }

                        $result = User::editUser($user_id, $username, $email, $pass, $fileName['name'], $status);
                        
                        if($result) {

                            if(($user_id) == (User::getIdAdmin())) {
                                session_unset();
                                $_SESSION['username'] = getMethod('edit_username');
                                $_SESSION['log'] = true;
                            }

                            directScript('Successfull!', '' . BASE_URL . LIST_USER);

                        } else {
                            $data['messageName'] = 'Username is existent!';
                        }
                    } else {
                        $data['messageImg'] = 'Upload Image Failed!';
                    }

                } else {
                    if(getMethod('edit_username') == '') {
                        $data['messageName'] = 'Field username is not empty!';
                    }

                    if(getMethod('edit_email') == '') {
                        $data['mesageEmail'] = 'Field is not empty';
                    } else if(filter_var(getMethod('email'), FILTER_VALIDATE_EMAIL) == false) {
                        $data['mesageEmail'] = 'Email is invalid!';
                    }

                    if(getMethod('edit_pass') == '') {
                        $data['messagePass'] = 'Field is not empty!';
                    }
                }
                $data['oldUser']['username'] = getMethod('edit_username');
                $data['oldUser']['user_email'] = getMethod('edit_email');
                $data['oldUser']['pass'] = getMethod('edit_pass'); 
                $data['oldUser']['status'] = getMethod('select');
            }
        }

        $this->loadView(USER, 'edit-user', 'Edit User', $data);
    }
    

    //Update active
    public function active() {
        $this->activeItem(USER);
        redirect(BASE_URL . LIST_USER);
    }
    
    //Sắp xếp
    public function sort() {
        $this->sortItem(USER, 'list-user', 'Data Sorting User');
    }

    //Tìm kiếm dữ liệu
    public function getDataSearched() {
        $this->searchingItem(USER, 'list-user', 'Data Searching User');
    }
}
