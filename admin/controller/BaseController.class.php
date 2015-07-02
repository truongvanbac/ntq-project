<?php
/**
 * Base Controller class
 */
class BaseController {

	/**
     * Model Name
     */
	protected static $model = '';

	/**
     * View variable
     */

	protected $view = NULL;

	/**
     * Regulation variable 
     */
	protected $regular = NULL;

	/**
     * Validate variable
     */
	protected $validate = null;


	/**
     * Constructor function
     */
	public function __construct() {   
		$this->view = new Template();       //Khởi tạo template
		$this->regular = new RegularExpression();
		$this->validate = new Validation();
		$this->checkLogin();
	}

	/**
     * Function check login
     */
	protected function checkLogin() {
		if(empty($_SESSION['log'])) {
			redirect(BASE_URL . LOGIN);  
		}
	}
	

	/**
     * Function uploda multiple image
     */
	protected function uploadMultiImg($file) {
		$target_dir = DIR_UPLOAD;
		$check = false;
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
		return $check;
	}

	/**
     * Function uploda single image
     */
	protected function uploadImg($file) {
		$target_dir = DIR_UPLOAD;
		$target_file = $target_dir . basename($file['name']);
		$check = false;
		if(($file['type'] == 'image/jpg') || ($file['type'] == 'image/png') || ($file['type'] == 'image/jpeg')) {
			move_uploaded_file($file['tmp_name'], $target_file);
			$check = true;
		}

		return $check;
	}


	/**
     * Function load view
     */
	protected function loadView($view, $title, $data = array()) {
		$data2 = array();
		$data2['oldUser'] = User::getUser(User::getIdAdmin());
		$data2['content'] = $this->view->load($view, $data);
		$data2['title'] = $title;
		$this->view->loadTemplate('tempadmin', $data2);
	}


	/**
     * Function common show list category, product or user 
     */
	protected function indexPage($view, $title) {
		$model = static::$model;
		$pages = new Pagination(PER_PAGE, INSTANT);
		$pages->set_total($model::count());
		
		$data = array(
			'lists' => $model::get_list($pages->get_limit()),
			'order' => "desc",
			'page_links' => $pages->page_links(),
			'count' => $model::count(),
			'valueSearch' => ''
		);

		$this->loadView($view, $title, $data);
	}


	/**
     * Function common to search data
     */
	protected function searchingItem($view, $title) {
		$model = static::$model;
		$data1 = array();
		$value = '';
		if(getValue('search') != '') {
			$string = getValue('search');
			$data1 = explode(' ', $string);
			for($i = 0; $i < count($data1); $i++) {
				// if($data1[$i] == ' ') {
				// 	str_replace(' ', '', $data1[$i]);
				// }
				$value .= $data1[$i] . '+'; 
			}

			$value = rtrim($value, ' +');
			$totalRecord = $model::seaching_process($string)['count'];
			$pages = new Pagination(PER_PAGE, INSTANT);
			$pages->set_total($totalRecord);
			$data = array(
				'lists' => $model::seaching_process($string, $pages->get_limit())['result'],
				'page_links' => $pages->page_links($path='?',$ext = "&search=$value"),
				'count' => $totalRecord,
				'valueSearch' => $string,
				'order' => 'desc'
			);
		}

		$this->loadView($view, $title, $data);
	}


	/**
     * Function common to sort item
     */
	protected function sortItem($view, $title) {
		$model = static::$model;
		$urlArray = urlAnalyze();       //function/urlAnalyze
		$item = $urlArray[3];
		$order = $urlArray[4];
		
		
		$pages = new Pagination(PER_PAGE, INSTANT);
		$pages->set_total($model::count());
		
		if ($order == "asc") {
			$data = array(
				'order' => "desc",
				'lists' => $model::sort_item($item, $order, $pages->get_limit()),
				'page_links' => $pages->page_links(),
				'count' => $model::count()
			);
		} else {
			$data = array(
				'order' => "asc",
				'lists' => $model::sort_item($item, $order, $pages->get_limit()),   
				'page_links' => $pages->page_links(),
				'count' => $model::count()
			);
		}
		
		$data['valueSearch'] = '';
		$this->loadView($view, $title, $data);
	}


	/**
     * Function common to active item
     */
	protected function activeItem() {
		$model = static::$model;
		if (!is_null(getValue('btn-ac'))) {
			if (!is_null(getValue('checkbox'))) {
				foreach ((getValue('checkbox')) as $check) {
					$model::update_active($check, '1');
				}
			}
		}

		if (!is_null(getValue('btn-dac'))) {
			if (!is_null(getValue('checkbox'))) {
				foreach ((getValue('checkbox')) as $check) {
					$model::update_active($check, '0');
				}
			}
		}
	}

}

?>