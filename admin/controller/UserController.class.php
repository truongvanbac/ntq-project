<?php
session_start();

class UserController extends Controller {
    
    // Biến $data2 lưu trữ dữ liệu truyền ra view
   private $data2 = array(
        'title' => '',
        'content' => ''
    );

   //Hầm khỏi tạo
    public function __construct() {
        parent::__construct();
    }
    

    //Trang hiển thị danh sách user
    public function index() {
        $pages = new Pagination('10', 'page');
        $pages->set_total(User::count());
        
        $data = array(
            'lists' => User::getAll($pages->get_limit()),
            'order' => "desc",
            'page_links' => $pages->page_links()
        );
        
        $data2['content'] = $this->view->load('list-user', $data);
        $data2['title'] = 'List User';
        $this->view->loadTemplate('tempadmin', $data2);
    }
    
    //Thêm user
    public function add() {
        $data = array(
            
        );
        $data2['content'] = $this->view->load('add-user', $data);
        $data2['title'] = 'Add User';
        $this->view->loadTemplate('tempadmin', $data2);
        
        if(isset($_POST['btn-add-user'])) {
            if(($_POST['username'] != '') && ($_POST['pass'] != '') && ($_POST['select'] != '')) {
                $name = $_POST['username'];
                $pass = md5($_POST['pass']);
                $email = $_POST['email'];
                $status = $_POST['select'];
                $fileName = $_FILES['fileToUpload'];
                
                if($this->uploadImg($fileName)) {
                    $result = User::addUser($name, $email, $pass, $fileName['name'], $status);
                    if($result) {
                        header("location: " . BASE_URL . "/admin/user");
                    } else {
                        header("location: " . BASE_URL . "/admin/user/add");
                    }
                } else {
                }
            }
        }
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
        
        $data2['content'] = $this->view->load('edit-user', $data);
        $data2['title'] = 'Edit User';
        $this->view->loadTemplate('tempadmin', $data2);
        
        if (isset($_POST['btn-edit-user'])) {
            if(($_POST['edit-username'] != '') && ($_POST['edit_pass'] != '') && ($_POST['select'] != '')) {
                
                $username = $_POST['edit-username'];
                $pass = $_POST['edit_pass'];
                $email = $_POST['edit-email'];
                $status = $_POST['select'];
                $fileName = $_FILES['fileToUpload'];

                if(($fileName['name'] != '') && ($this->uploadImg($fileName))) {
                    $result = User::editUser($user_id, $username, $email, $pass, $fileName['name'], $status);
                    if($result) {
                        header("location: " . BASE_URL . "/admin/user");
                        
                    } else {
                        header("location: " . BASE_URL . "/admin/user/edit/" . $user_id);
                        echo "LOI UPDATE";
                    }
                } else {
                    header("location: " . BASE_URL . '/admin/user/edit/' . $user_id);
                    echo "LOI UPLOAD";
                }
            }
        }
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
                'page_links' => $pages->page_links()
            );
        } else {
            //$order = "asc";
            $data = array(
                'order' => "asc",
                'lists' => User::sort_item($item, $order, $pages->get_limit()),   
                'page_links' => $pages->page_links()
            );
        }
        
        
        $data2['content'] = $this->view->load('list-user', $data);
        $data2['title'] = 'List User';
        $this->view->loadTemplate('tempadmin', $data2);
    }
}



