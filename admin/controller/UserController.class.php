<?php
session_start();

class UserController extends Controller {
    
    // Biến $data2 lưu trữ dữ liệu truyền ra view
   private $data2 = array(
    );

   //Hầm khỏi tạo
    public function __construct() {
        parent::__construct();
        if(empty($_SESSION['log'])) {
            header("location: " . BASE_URL . '/admin/login');
        }

        
    }
    
    //Trang hiển thị danh sách user
    public function index() {
        $pages = new Pagination('10', 'page');
        $pages->set_total(User::count());
        
        $data = array(
            'lists' => User::getAll($pages->get_limit()),
            'order' => "desc",
            'page_links' => $pages->page_links(),
            'count' => User::count(),
            'valueSearch' => ''
        );
        $data2['oldUser'] = User::getUser(User::getIdAdmin());
        $data2['content'] = $this->view->load('list-user', $data);
        $data2['title'] = 'List User';
        $this->view->loadTemplate('tempadmin', $data2);
    }
    
    //Thêm user
    public function add() {
        $data = array(
            'oldName' => '',
            'oldEmail' => '',
            'oldStatus' => '1'
        );
        
        if(isset($_POST['btn-add-user'])) {
            if(($_POST['username'] != '') && ($_POST['pass'] != '') && ($_POST['select'] != '')) {

                $name = htmlentities($_POST['username'], ENT_QUOTES);
                $pass = md5($_POST['pass']);
                $email = $_POST['email'];
                $status = $_POST['select'];
                $fileName = $_FILES['fileToUpload'];

                $data['oldName'] = $name;
                $data['oldEmail'] = $email;
                $data['oldStatus'] = $status;

                if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    if(($fileName['name'] != '') && ($this->uploadImg($fileName))) {
                        $result = User::addUser($name, $email, $pass, $fileName['name'], $status);

                        if($result) {
                            directScript('Successfull!', '' . BASE_URL . '/admin/user');
                        } else {
                            notifyScript('Username is existent');
                        }
                    } else {
                        notifyScript('Upload Image is Fail!');
                    }
                } else {
                    notifyScript('Email is invalid!');
                }
            } else {
                notifyScript('Input username, email, password');
            }
        }

        $data2['oldUser'] = User::getUser(User::getIdAdmin());
        $data2['content'] = $this->view->load('add-user', $data);
        $data2['title'] = 'Add User';
        $this->view->loadTemplate('tempadmin', $data2);
    }
    

    //Sửa user 
    public function edit() {
        global $url;
        $url = rtrim($url, "/");
        $urlArray = array();
        $urlArray = explode("/", $url);
        $user_id = $urlArray[3];
        
        $data = array(
            'oldUser' => User::getUser($user_id)
        );
        
        $checkUrl = User::checkIdUser($user_id);
        if($checkUrl == 0) {
            directScript('Error, not existent user id!!!', '' . BASE_URL . '/admin/user');
        } else {
            if (isset($_POST['btn-edit-user'])) {
                if(($_POST['edit-username'] != '') && ($_POST['edit_pass'] != '') && ($_POST['edit_email'] != '') && ($_POST['select'] != '')) {
                    
                    $username = htmlentities($_POST['edit-username'], ENT_QUOTES);
                    $pass = md5($_POST['edit_pass']);
                    $email = $_POST['edit_email'];
                    $status = $_POST['select'];
                    $fileName = $_FILES['fileToUpload'];

                    if($fileName['name'] == '') {
                        $fileName['name'] = User::getUser($user_id)['user_img'];
                    }


                    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        if(($fileName['name'] != '') && ($this->uploadImg($fileName))) {
                            $result = User::editUser($user_id, $username, $email, $pass, $fileName['name'], $status);
                            if($result) {
                                directScript('Successfull!', '' . BASE_URL . '/admin/user');
                                
                            } else {
                                notifyScript('Username is existent');
                            }
                        } else {
                            notifyScript('Upload Image is Fail');
                        }
                    } else {
                        notifyScript('Email is invalid');
                    }

                } else {
                    notifyScript('Input Username, Email, Pass');
                }
            }
        }

        $data2['oldUser'] = User::getUser(User::getIdAdmin());
        $data2['content'] = $this->view->load('edit-user', $data);
        $data2['title'] = 'Edit User';
        $this->view->loadTemplate('tempadmin', $data2);
    }
    

    //Update active
    public function active() {
        if (isset($_POST['btn-ac-user'])) {
            if (!empty($_POST['checkbox'])) {
                foreach (($_POST['checkbox']) as $check) {
                    User::update_active($check, '1');
                }
            }
        }
        if (isset($_POST['btn-dac-user'])) {
            if (!empty($_POST['checkbox'])) {
                foreach (($_POST['checkbox']) as $check) {
                    User::update_active($check, '0');
                }
            }
        }

        header("location: " . BASE_URL . '/admin/user');
    }
    
    //Sắp xếp
    public function sort() {
        global $url;
        $url = rtrim($url, "/");
        $urlArray = array();
        $urlArray = explode("/", $url);
        $item = $urlArray[3];
        
        $order = $urlArray[4];
        
        
        $pages = new Pagination('10', 'page');
        $pages->set_total(User::count());
        
        if ($order == "asc") {
            $data = array(
                'order' => "desc",
                'lists' => User::sort_item($item, $order, $pages->get_limit()),
                'page_links' => $pages->page_links(),
                'count' => User::count()
            );
        } else {
            $data = array(
                'order' => "asc",
                'lists' => User::sort_item($item, $order, $pages->get_limit()),   
                'page_links' => $pages->page_links(),
                'count' => User::count()
            );
        }

        $data['valueSearch'] = '';
        $data2['oldUser'] = User::getUser(User::getIdAdmin());
        $data2['content'] = $this->view->load('list-user', $data);
        $data2['title'] = 'List User';
        $this->view->loadTemplate('tempadmin', $data2);
    }

    //Tìm kiếm dữ liệu
    public function getDataSearched() {
        
        $data3 = array();
        $value = '';

        //if(isset($_GET['btn-search-user'])) {
            if($_GET['search'] != '') {
                $string = $_GET['search'];
                //$array = Category::seaching_process($string);

                $data3 = explode(' ', $string);
                for($i = 0; $i<count($data3); $i++) {
                    $value .= $data3[$i] . '+'; 
                }

                $value = rtrim($value, ' +');

                $totalRecord = User::seaching_process($string)['count'];
                $pages = new Pagination('10', 'page');
                $pages->set_total($totalRecord);
                $data = array(
                    'lists' => User::seaching_process($string, $pages->get_limit())['result'],
                    'page_links' => $pages->page_links($path='?',$ext = "&search=$value"),
                    'count' => $totalRecord,
                    'valueSearch' => $string
                );
            }
        //}

        $data2['oldUser'] = User::getUser(User::getIdAdmin());
        $data2['content'] = $this->view->load('list-user', $data);
        $data2['title'] = 'Data Searching User';
        $this->view->loadTemplate('tempadmin', $data2);
    }
}
