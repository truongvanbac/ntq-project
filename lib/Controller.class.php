<?php
/**
 * Base Controller class
 */
class Controller {
	
    protected $view = NULL;
    public function __construct() {   
        $this->view = new Template();       //Khởi tạo template
    }
    

    //Uploda image
    protected function uploadImg($file) {
        $target_dir = DIR_UPLOAD;
        $target_file = $target_dir . basename($file['name']);
        $uploadOk = true;
        
        if($file['type'] != 'image/jpg' && $file['type'] != 'image/png') {
            $uploadOk = false;
        } else {
            $uploadOk = true;
        }
        
        if(file_exists($file['name'])) {
            $uploadOk = false;
        } else {
            $uploadOk = true;
        }
        
        
        if($uploadOk == true) {
            move_uploaded_file($file['tmp_name'], $target_file);
            return true;
        }
        
    }

    
}

?>