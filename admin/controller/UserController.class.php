<?php

class UserController extends BaseController {
    

    /**
     * Model Name
     */
    protected static $model = 'User';

   /**
    * Constructor function
    *   
    */
    public function __construct() {
        parent::__construct();
    }
    

    /**
     * Index, show list all user
     */
    public function index() {
        $this->indexPage('list-user', 'List User');
    }
    

    /**
     * Add user
     */
    public function add() {
        $data = array(
            'oldName' => '',
            'oldPass' => '',
            'oldEmail' => '',
            'oldStatus' => '1',
            'messageName' => '',
            'messageEmail' => '',
            'messagePass' => '',
            'messageImg' => ''
        );
        
        $itemPost = array('username', 'pass', 'email','select');
        $dataInput = array();
        $this->updateUser('add', $data, 'btn-add-user', $itemPost, $dataInput);
        $this->loadView('add-user', 'Add User', $data);
    }
    

    /**
     * Edit user
     */ 
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
        
        $checkUrl = User::checkIdUser($user_id);    //Check id user
        if($checkUrl == 0) {
            directScript('Error, user id not exist!', '' . BASE_URL . LIST_USER);
        } else {
            $itemPost = array('edit_username', 'edit_pass', 'edit_email', 'select');
            $dataInput = array();
            $this->updateUser('edit', $data, 'btn-edit-user', $itemPost, $dataInput, $user_id);
        }

        $this->loadView('edit-user', 'Edit User', $data);
    }
    

    /**
     * Function commmon to update user contain add and edit user
     */
    private function updateUser($action, &$data = array(), $button, $itemPost = array(), &$dataInput, &$user_id = null) {
        $result = false;
        if(isset($_POST[$button])) {

            $username_check = $this->validate->checkInputForm('Username', $itemPost[0], 'require', $data['messageName']);
            $pass_check = $this->validate->checkInputForm('Password', $itemPost[1], 'require', $data['messagePass']);
            $email_check = $this->validate->checkInputForm('Email', $itemPost[2], 'email', $data['messageEmail']);
            
            if($username_check && $pass_check && $email_check) {

                $dataInput['username'] = htmlentities(getValue($itemPost[0]), ENT_QUOTES);
                $dataInput['pass'] = md5(getValue($itemPost[1]));
                $dataInput['user_email'] = getValue($itemPost[2]);
                $dataInput['status'] = getValue($itemPost[3]);
                $fileName = $_FILES['fileToUpload'];

                if($fileName['name'] != '') {
                    $fileName['name'] = time() . $fileName['name'];
                    $dataInput['user_img'] = $fileName['name'];
                }
                
                switch ($action) {
                    case 'add':
                        if($this->uploadImg($fileName)) {
                            $dataInput['user_time_created'] = date('Y-m-d h:i:s');
                            $dataInput['user_time_updated'] = date('Y-m-d h:i:s');
                            $result = User::updateUserProcess($dataInput);
                        } else {
                            $data['messageImg'] = 'Upload Image Failed!';
                        }

                        break;
                        
                    case 'edit':
                        if(($fileName['name'] == '') || ($this->uploadImg($fileName))) {
                            if($fileName['name'] == '') {
                                $fileName['name'] = User::getUser($user_id)['user_img'];
                            }
                            $dataInput['user_time_updated'] = date('Y-m-d h:i:s');
                            $result = User::updateUserProcess($dataInput, $user_id);
                        } else {
                            $data['messageImg'] = 'Upload Image Failed!';
                        }
                        break;
                }
                if($result) {
                    directScript('Successfull!', '' . BASE_URL . LIST_USER);
                } else {
                    $data['messageName'] = 'Username is existent!';
                }
            }

            switch ($action) {
                case 'add':
                    $data['oldName'] = getValue($itemPost[0]);
                    $data['oldPass'] = getValue($itemPost[1]);
                    $data['oldEmail'] = getValue($itemPost[2]);
                    $data['oldStatus'] = getValue($itemPost[3]);
                    break;
                case 'edit':
                    $data['oldUser']['username'] = getValue($itemPost[0]);
                    $data['oldUser']['pass'] = getValue($itemPost[1]); 
                    $data['oldUser']['user_email'] = getValue($itemPost[2]);
                    $data['oldUser']['status'] = getValue($itemPost[3]);
                    break;
            }
            return $data;
        }
    }

    /**
     * Function Active
     */
    public function active() {
        $this->activeItem();
        redirect(BASE_URL . LIST_USER);
    }
    
    /**
     * Function Sort
     */
    public function sort() {
        $this->sortItem('list-user', 'Sorting User');
    }

    /**
     * Function get data searched
     */
    public function getDataSearched() {
        $this->searchingItem('list-user', 'Searching User');
    }
}
