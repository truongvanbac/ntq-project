<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BaseController extends Controller {
    
    public function __construct() {
        parent::__construct();
        
        if(empty($_SESSION['log'])) {
            echo "Chua dang nhap";
            header("location : login");
        } else {
            echo "Da dang nhap";
            //header("location: category");
        }
    }
}
