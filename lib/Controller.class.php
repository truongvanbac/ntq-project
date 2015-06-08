<?php
/**
 * Base Controller class
 */
class Controller {
	
    protected $view = NULL;
    public function __construct() {   
        $this->view = new Template();
    }
}

?>