<?php
ob_start();
/**
 * Template class
 */
class Template {
	
    private $__content = array();
    private $__content2 = array();
    
    //Load view
    public function load($folder, $view, $data = array()) {
        extract($data);
        ob_start();
        require_once ROOT . 'admin/view/' . $folder .'/'. $view .'.php';
        $content = ob_get_contents();
        ob_end_clean();
        
        $this->__content[] = $content;
        return $content;
    }
    
    //Load template
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
    
    //Show view
    public function show() {
        foreach ($this->__content as $html) {
            echo $html;
        }
    }
}
ob_flush();
?>