<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class RegularExpression {
    
    public function check($pattern, $subject) {
    	$pattern = "/" . $pattern . "/";
    	if (preg_match($pattern, $subject)){
    		return true;
		} else {
			return false;
		}
    } 
}
