<?php
session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LoginController extends Controller {

    //Hàm khởi tạo
    public function __construct() {
        parent::__construct();
        if(!empty($_SESSION['log'])) {
            header('location: category');
        }
    }
    
    //Đăng nhập
    public function index() {
        
        $data = array(
            'title' => 'Login Administrator'
        );
        $this->view->load('login', $data);
        $this->view->show();

        
        
        if (isset($_POST['btn-login'])) {
            if ((!empty($_POST['username'])) || (!empty($_POST['password']))) {

                $username = $_POST['username'];
                $password = $_POST['password'];

                $result = User::login_process($username, $password);
                if ($result) {

                    $_SESSION['username'] = $username;
                    $_SESSION['log'] = true;

                    echo $_SESSION['username'];

                    if (isset($_POST['remember'])) {
                        setcookie('username', $username, time() + 60 * 60 * 24 * 365);
                    } else {
                        setcookie('username', $username, time() - 60 * 60 * 24 * 365);
                    }

                    header("location: category");
                } else {
                    header("location: " . BASE_URL . "/admin/login");
                }
            }
        }
    }

    //Đăng xuất
    public function logout() {
        session_unset();
        setcookie('username', $username, time() - 60 * 60 * 24 * 365);
        header("location: ../login");
    }

}
