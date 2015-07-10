<?php

class UserController extends BaseController {
    

    /**
     * Model Name
     */
    protected $model = 'User';


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
            'user' => array('username' => '', 'user_email' => '', 'pass' => '', 'status' => '1', 'user_img' => ''),
            'message' => array('name' => '', 'email' => '', 'pass' => '', 'img' => ''),
            'title' => 'Add',
            'btnName' => 'btn-add-user',
        );
        
        $itemPost = array('username', 'pass', 'email','status');
        $dataInput = array();
        $this->updateUser('add', $data, 'btn-add-user', $itemPost, $dataInput);
        $this->loadView('updateUser', 'Add User', $data);
    }
    

    /**
     * Edit user
     */ 
    public function edit() {
        $urlArray = urlAnalyze();
        $user_id = $urlArray[3];
        
        $data = array(
            'user' => User::getUser($user_id),
            'message' => array('name' => '', 'email' => '', 'pass' => '', 'status' => '', 'img' => ''),
            'title' => 'Edit',
            'btnName' => 'btn-edit-user',
        );
        
        $checkUrl = User::checkIdUser($user_id);    //Check id user
        if($checkUrl == 0) {
            directScript('Error, user id not exist.', '' . BASE_URL . LIST_USER);
        } else {
            $itemPost = array('username', 'pass', 'email','status');
            $dataInput = array();
            $this->updateUser('edit', $data, 'btn-edit-user', $itemPost, $dataInput, $user_id);
        }

        $this->loadView('updateUser', 'Edit User', $data);
    }
    

    /**
     * Check validate data input from form
     * return true or false
     */
    private function validateForm(&$dataValidate = array(), $itemPost = array(), &$data = array()) {
        $dataValidate = array(
            'username'      =>  array(
                                'label' => 'username',
                                'input' => $itemPost[0],
                                'rule' => array('required'),
                                'message' => &$data['message']['name']
            ),

            'pass'          =>  array(
                                'label' => 'password',
                                'input' => $itemPost[1],
                                'rule' => array('required'),
                                'message' => &$data['message']['pass']
            ),

            'email'         =>  array(
                                'label' => 'email',
                                'input' => $itemPost[2],
                                'rule' => array('required', 'valid_email'),
                                'message' => &$data['message']['email']
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
        $dataInput['username'] = htmlentities(getValue($itemPost[0]), ENT_QUOTES);
        $dataInput['pass'] = getValue($itemPost[1]);
        $dataInput['user_email'] = getValue($itemPost[2]);
        $dataInput['status'] = getValue($itemPost[3]);
        $dataInput['user_time_updated'] = date('Y-m-d h:i:s');
        
        if(!empty($fileName['name'])) {
            $fileName['name'] = time() . $fileName['name'];
            $dataInput['user_img'] = $fileName['name'];
        }
        return $dataInput;
    }

    /**
     * get data when user input form
     * return data
     */
    private function getDataReturn($action, &$data = array(), $itemPost = array()) {
        $data['user']['username'] = htmlentities(getValue($itemPost[0]));
        $data['user']['pass'] = getValue($itemPost[1]); 
        $data['user']['user_email'] = getValue($itemPost[2]);
        $data['user']['status'] = getValue($itemPost[3]);
        return $data;
    }

    /**
     * Function commmon to update user contain add and edit user
     */
    private function updateUser($action, &$data = array(), $button, $itemPost = array(), &$dataInput, &$user_id = null) {
        $result = false;
        $check = false;
        if(isset($_POST[$button])) {
            
            $validate = $this->validateForm($dataValidate, $itemPost, $data);
            
            if($validate) {
                $fileName = $_FILES['fileToUpload'];
                $this->dataInputFormat($itemPost, $dataInput, $fileName);

                if($user_id == null) {
                    $dataInput['user_time_created'] = date('Y-m-d h:i:s');
                    if(($fileName['name'] == '') || (!$this->uploadImg($fileName))) {
                        $data['message']['img'] = 'Upload image failed.';
                    } else {
                        $check = true;
                    }
                } else {
                    if($fileName['name'] == '') {
                        $fileName['name'] = User::getUser($user_id)['user_img'];
                    } else if(!$this->uploadImg($fileName)) {
                        $data['message']['img'] = 'Upload image failed.';
                    }
                    $check = true;
                }

                if($check) {
                    $result = User::updateUserProcess($dataInput, $user_id);
                    if($result) {
                        if(($user_id) == (User::getIdAdmin())) {
                            session_unset();
                            $_SESSION['username'] = getValue('username');
                            $_SESSION['log'] = true;
                        }

                        directScript('Successfull!', '' . BASE_URL . LIST_USER);
                    } else {
                        $data['message']['name'] = 'Username is exist.';
                    }
                }
            }
            $this->getDataReturn($action, $data, $itemPost);
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
