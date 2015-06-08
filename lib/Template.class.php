<?php
/**
 * Template class
 */
class Template {
	
    
    public function __construct() {
    }
    
    private $__content = array();
    private $__content2 = array();
    
    public function load($view, $data = array()) {
        extract($data);
        ob_start();
        require_once ROOT . 'admin/view/' . $view .'.php';
        $content = ob_get_contents();
        ob_end_clean();
        
        $this->__content[] = $content;
        return $content;
    }
    
    
    public function loadTemplate($view, $data = array()) {
        extract($data);
        ob_start();
        require_once ROOT . 'admin/view/temp/' . $view .'.php';
        $content = ob_get_contents();
        ob_end_clean();
        
        $this->__content2[] = $content;
        foreach ($this->__content2 as $html) {
            echo $html;
        }
    }
    
    public function show() {
        foreach ($this->__content as $html) {
            echo $html;
        }
    }
}

?>