<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LoginController extends BaseController {

    protected static $model = "user";

    /*
     * Constructor function
     */
    public function __construct() {
        parent::__construct();

        //Check cookie        
        if(isset($_COOKIE)) {
            if(!empty($_COOKIE['username'])) {
                $_SESSION['log'] = true;
                $_SESSION['username'] = $_COOKIE['username'];
            }
        }

        //Check session
        if(isset($_SESSION['log'])) {
            redirect(BASE_URL  . LIST_CATEGORY);
        }
    }

    /*
     * Override function BaseController
     */
    public function checkLogin(){}
    

    /*
     * Login
     */
    public function index() {
        
        $data = array(
            'title' => 'Login Administrator',
            'message' => '',
            'message1' => '',
            'message2' => ''
        );
        
        if (isset($_POST['btn-login'])) {
            if ((!empty(getValue('username'))) && (!empty(getValue('password')))) {

                $username = getValue('username');
                $password = getValue('password');

                $result = User::login_process($username, $password);
                if ($result) {

                    $_SESSION['username'] = $username;
                    $_SESSION['log'] = true;

                    if (isset($_POST['remember'])) {
                        setcookie('username', $username, time() + TIME_COOKIE);
                    } else {
                        setcookie('username', $username, time() - TIME_COOKIE);
                    }

                    redirect(BASE_URL . LIST_CATEGORY);
                } else {
                    $data['message'] = 'Account is not exist.';
                }
            } else if(empty(getValue('username'))) {
                $data['message1'] = 'Input username!';
            } else if(empty(getValue('password'))) {
                $data['message2'] = 'Input password!';
            }
        }

        $this->view->load(strtolower(static::$model),'login', $data);
        $this->view->show();
    }

    /*
     * Logout
     */
    public function logout() {
        session_destroy();
        setcookie('username');
        redirect(BASE_URL . LOGIN);
    }

}
