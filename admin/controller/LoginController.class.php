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

        
        if(isset($_COOKIE)) {
            if(!empty($_COOKIE['username'])) {
                $_SESSION['log'] = true;
                $_SESSION['username'] = $_COOKIE['username'];
            }
        }


        if(isset($_SESSION['log'])) {
            header("location: " . BASE_URL . '/admin/category');
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

                    header("location: " . BASE_URL . '/admin/category');
                } else {
                    echo "<script>";
                    echo "alert('Account is not existent');";
                    echo "</script>";
                }
            } else {
                echo "<script>";
                echo "alert('Let\'s input username and password');";
                echo "</script>";
            }
        }
    }

    //Đăng xuất
    public function logout() {
        session_start();
        session_destroy();
        setcookie('username');
        header("location: " . BASE_URL . "/admin/login");
    }

}
