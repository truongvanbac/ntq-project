<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LoginController extends BaseController {

    //Hàm khởi tạo
    public function __construct() {
        parent::__construct();

        //Kiem tra cookie        
        if(isset($_COOKIE)) {
            if(!empty($_COOKIE['username'])) {
                $_SESSION['log'] = true;
                $_SESSION['username'] = $_COOKIE['username'];
            }
        }

        //Kiem tra session
        if(isset($_SESSION['log'])) {
            redirect(BASE_URL  . LIST_CATEGORY);
        }


    }

    public function checkLogin(){}
    
    //Đăng nhập
    public function index() {
        
        $data = array(
            'title' => 'Login Administrator',
            'message' => '',
            'message1' => '',
            'message2' => ''
        );
        
        
        if (isset($_POST['btn-login'])) {
            if ((!empty($_POST['username'])) && (!empty($_POST['password']))) {

                $username = $_POST['username'];
                $password = $_POST['password'];

                $result = User::login_process($username, $password);
                if ($result) {

                    $_SESSION['username'] = $username;
                    $_SESSION['log'] = true;

                    if (isset($_POST['remember'])) {
                        setcookie('username', $username, time() + 7200);
                    } else {
                        setcookie('username', $username, time() - 7200);
                    }

                    redirect(BASE_URL . LIST_CATEGORY);
                } else {
                    $data['message'] = 'Account is not existent!';
                }
            } else if(empty($_POST['username'])) {
                $data['message1'] = 'Input username!';
            } else if(empty($_POST['password'])) {
                $data['message2'] = 'Input password!';
            }
        }

        $this->view->load('login', $data);
        $this->view->show();
    }

    //Đăng xuất
    public function logout() {
        session_destroy();
        setcookie('username');
        redirect(BASE_URL . LOGIN);
    }

}
