<?php
/**
 * Base Controller class
 */
class BaseController {

	/**
	* Model Name
	*/
	protected $model = '';
	protected $id = '';

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
		$this->view = new Template();
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
	protected function uploadMultiImg($file, &$message = null) {
		$target_dir = DIR_UPLOAD;
		$check = true;

		for($i = 0; $i < NUM_IMG; $i++) {
			$target_file[$i] = $target_dir . basename($file['name'][$i]);
			if($file['name'][$i] != '') {
				if(($file['type'][$i] == 'image/jpg') || ($file['type'][$i] == 'image/png') 
					|| ($file['type'][$i] == 'image/jpeg')) {
					move_uploaded_file($file['tmp_name'][$i], $target_file[$i]);
				} else {
					$message = 'Image only contain .jpg, .png, .jpge';
					$check = false;
					break;
				}
			}
		}
		return $check;
	}


	/**
	 * Function uploda single image
	 */
	protected function uploadImg($file, &$message = null) {
		$target_dir = DIR_UPLOAD;
		$target_file = $target_dir . basename($file['name']);
		$check = true;
		if($file['name'] != ''){
			if(($file['type'] == 'image/jpg') || ($file['type'] == 'image/png') || ($file['type'] == 'image/jpeg')) {
				move_uploaded_file($file['tmp_name'], $target_file);
			} else {
				$message = 'Image only contain .jpg, .png, .jpge';
				$check = false;
			}
		}
		return $check;
	}


	/**
	 * Function load view
	 */
	protected function loadView($view, $title, $data = array()) {
		$data2 = array();
		$data2['oldUser'] = User::getUser(User::getIdAdmin());
		$data2['content'] = $this->view->load(strtolower($this->model), $view, $data);
		$data2['title'] = $title;
		$this->view->loadTemplate('tempadmin', $data2);
	}


	/**
	 * Function common show list category, product or user 
	 */
	protected function indexPage($view, $title) {
		$model = $this->model;
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


	protected function validateData($data = array()) {
		$check = true;
		foreach ($data as $value) {
			$validate = $this->validate->checkInputForm($value['input'], $value['label'],  $value['rule'],$value['message']);
			if(!$validate) {
				$check = false;
			}
		}
		return $check;
	}


	/**
	 * Function common to search data
	 */
	protected function searchingItem($view, $title) {
		$model = $this->model;
		if(isset($_GET['type'])) {
			$order = $_GET['type'];
		}
		else {
			$order = 'asc';
		}

		if(isset($_GET['field'])) {
			$item = $_GET['field'];
		}
		else {
			$item = $this->id;
		}


		if(getValue('search') != '') {
			$string = test_input(getValue('search'));
			$string = preg_replace('/\s\s+/', ' ', $string);
			$totalRecord = $model::seaching_process($string)['count'];
			$pages = new Pagination(PER_PAGE, INSTANT);
			$pages->set_total($totalRecord);
			$data = array(
				'lists' => $model::sort_search($string, $item, $order, $pages->get_limit())['result'],
				'page_links' => $pages->page_links($path="?&field=" . $item . "&type=" . $order . "&search=" . $string . "&", $ext = ''),
				'count' => $totalRecord,
				'valueSearch' => $string
			);
			
			if ($order == "asc") {
				$data['order'] = "desc";
			} else {
				$data['order'] = "asc";
			}

			$this->loadView($view, $title, $data);
		} else {
			$this->indexPage($view, $title);
		}
		
	}


	/**
	 * Function common to sort item
	 */
	protected function sortItem($view, $title) {
		$model = $this->model;

		$pages = new Pagination(PER_PAGE, INSTANT);
		$pages->set_total($model::count());

		$item = $_GET['field'];
		$order = $_GET['type'];

		$data = array(
			'lists' => $model::sort_item($item, $order, $pages->get_limit()),
			'page_links' => $pages->page_links($path="?field=" . $item . "&type=" . $order . "&", $ext = ''),
			'count' => $model::count()
		);

		if ($order == "asc") {
			$data['order'] = "desc";
		} else {
			$data['order'] = "asc";
		}
		
		$data['valueSearch'] = '';
		$this->loadView($view, $title, $data);
	}



	protected function showData($view, $title) {
		$model = $this->model;
		if(isset($_GET['search'])) {
			$this->searchingItem($view, $title);
		} else {
			$this->sortItem($view, $title);
		}
	}


	/**
	 * Function common to active item
	 */
	protected function activeItem() {
		if (!empty(getValue('btn-ac'))) {
			$this->update_active(ACTIVE_VALUE);
		}

		if (!empty(getValue('btn-dac'))) {
			$this->update_active(DEACTIVE_VALUE);
		}
	}

	private function update_active($status) {
		$model = $this->model;
		if (!empty(getValue('checkbox'))) {
			foreach ((getValue('checkbox')) as $check) {
				$model::update_active($check, $status);
			}
		} else {
			$_SESSION['checkBox'] = "Please tick in check box.";
		}
	}
}

?>