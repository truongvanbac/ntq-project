<?php
/**
 * Base Controller class
 */
class BaseController {
	
    protected $view = NULL;
    protected $regular = NULL;
    protected $validate = null;

    public function __construct() {   
        $this->view = new Template();       //Khởi tạo template
        $this->regular = new RegularExpression();
        $this->validate = new Validation();
        $this->checkLogin();
    }

    public function checkLogin() {
        if(empty($_SESSION['log'])) {
            redirect(BASE_URL . LOGIN);  
        }
    }
    

    //Uploda image
    protected function uploadMultiImg($file) {
        $target_dir = DIR_UPLOAD;
        $check = true;
        for($i = 0; $i < NUM_IMG; $i++) {
            $target_file[$i] = $target_dir . basename($file['name'][$i]);
            if($file['name'][$i] != '') {
                if(($file['type'][$i] == 'image/jpg') || ($file['type'][$i] == 'image/png') || ($file['type'][$i] == 'image/jpeg')) {
                    move_uploaded_file($file['tmp_name'][$i], $target_file[$i]);
                } else {
                    $check = false;
                }
            }
        }
        if($check) {
            return true;
        } else {
            return false;
        }
    }

    protected function uploadImg($file) {
        $target_dir = DIR_UPLOAD;
        $target_file = $target_dir . basename($file['name']);
        $check = true;
        if(($file['type'] == 'image/jpg') || ($file['type'] == 'image/png') || ($file['type'] == 'image/jpeg')) {
            move_uploaded_file($file['tmp_name'], $target_file);
        } else {
            $check = false;
        }

        if($check) {
            return true;
        } else {
            return false;
        }
    }


    protected function loadView($Item, $view, $title, $data = array()) {

        $data2['oldUser'] = User::getUser(User::getIdAdmin());
        $data2['content'] = $this->view->load($view, $data);
        $data2['title'] = $title;
        $this->view->loadTemplate('tempadmin', $data2);
    }

    //Load trang dau tien cua moi muc
    protected function homePage($Item, $view, $title) {
        $pages = new Pagination(PER_PAGE, INSTANT);
        $pages->set_total($Item::count());
        
        $data = array(
            'lists' => $Item::get_list($pages->get_limit()),
            'order' => "desc",
            'page_links' => $pages->page_links(),
            'count' => $Item::count(),
            'valueSearch' => ''
        );

        $this->loadView($Item, $view, $title, $data);
    }

    protected function searchingItem($Item, $view, $title) {
        $data1 = array();
        $value = '';
        if(getMethod('search') != '') {
            $string = getMethod('search');
            $data1 = explode(' ', $string);
            for($i = 0; $i < count($data1); $i++) {
                $value .= $data1[$i] . '+'; 
            }

            $value = rtrim($value, ' +');
            $totalRecord = $Item::seaching_process($string)['count'];
            $pages = new Pagination(PER_PAGE, INSTANT);
            $pages->set_total($totalRecord);
            $data = array(
                'lists' => $Item::seaching_process($string, $pages->get_limit())['result'],
                'page_links' => $pages->page_links($path='?',$ext = "&search=$value"),
                'count' => $totalRecord,
                'valueSearch' => $string,
                'order' => 'desc'
            );
        }

        $this->loadView($Item, $view, $title, $data);
    }

    protected function sortItem($Item, $view, $title) {
        // global $url;
        // $url = rtrim($url, "/");
        // $urlArray = array();
        // $urlArray = explode("/", $url);
        $urlArray = urlAnalyze();       //function/urlAnalyze
        $item = $urlArray[3];
        $order = $urlArray[4];
        
        
        $pages = new Pagination(PER_PAGE, INSTANT);
        $pages->set_total($Item::count());
        
        if ($order == "asc") {
            $data = array(
                'order' => "desc",
                'lists' => $Item::sort_item($item, $order, $pages->get_limit()),
                'page_links' => $pages->page_links(),
                'count' => $Item::count()
            );
        } else {
            $data = array(
                'order' => "asc",
                'lists' => $Item::sort_item($item, $order, $pages->get_limit()),   
                'page_links' => $pages->page_links(),
                'count' => $Item::count()
            );
        }
        
        $data['valueSearch'] = '';
        $this->loadView($Item, $view, $title, $data);
    }

    protected function activeItem($Item) {

        if (!is_null(getMethod('btn-ac'))) {
            if (!is_null(getMethod('checkbox'))) {
                foreach ((getMethod('checkbox')) as $check) {
                    $Item::update_active($check, '1');
                }
            }
        }

        if (!is_null(getMethod('btn-dac'))) {
            if (!is_null(getMethod('checkbox'))) {
                foreach ((getMethod('checkbox')) as $check) {
                    $Item::update_active($check, '0');
                }
            }
        }
    }
}

?>