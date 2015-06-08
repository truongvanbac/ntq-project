<?php
session_start();
$_SESSION['log'] = false;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LoginController extends Controller {

    public function __construct() {
        parent::__construct();
        //var_dump($_SESSION['log']);
    }

    public function index() {
        if ($_SESSION['log'] == true) {
            header('location: category');
        } else {
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
                            setcookie('password', md5($password), time() + 60 * 60 * 24 * 365);
                        } else {
                            setcookie('username', $username, time() - 60 * 60 * 24 * 365);
                            setcookie('password', md5($password), time() - 60 * 60 * 24 * 365);
                        }
                        
                        //var_dump($_SESSION['log']);
                        header("location: category");
                    } else {
                        header("location: login");
                    }
                }
            }
        }
    }

    public function logout() {
        session_start();
        session_unset($_SESSION['log']);
        session_unset($_SESSION['username']);
        setcookie('username', $username, time() - 60 * 60 * 24 * 365);
        setcookie('password', md5($password), time() - 60 * 60 * 24 * 365);
        header("location: ../login");
    }

}
