<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Check_login{
    
    public static function check() {
        if(empty($_SESSION['log'])) {
            header("location: login");
        }
    }
}
