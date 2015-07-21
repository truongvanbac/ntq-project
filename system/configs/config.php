<?php

define('DEFAULT_CONROLLER', 'index');
define('DEFAULT_ACTION', 'index');

//Cấu hình database
define('DB_HOST','localhost');
define('DB_NAME','ntq-project');
define('DB_USER','root');
define('DB_PASS','bac17041994');

//Phan trang
define('PER_PAGE', '10');
define('INSTANT', 'page');

//Item
define('CATEGORY', 'Category');
define('PRODUCT', 'Product');
define('USER', 'User');

define('NUM_IMG', '3');

define("ACTIVE_VALUE", "1");
define("DEACTIVE_VALUE", "0");

define("TIME_COOKIE", "7200");

define('LOGIN', '/admin/login');
define('LOGOUT', '/admin/login/logout');

define('LIST_CATEGORY', '/admin/category');
define('ADD_CATEGORY', '/admin/category/add');
define('EDIT_CATEGORY', '/admin/category/edit');
define('ACTIVE_CATEGORY', '/admin/category/active');
define('SHOW_CATEGORY', '/admin/category/show');

define('LIST_PRODUCT', '/admin/product');
define('ADD_PRODUCT', '/admin/product/add');
define('EDIT_PRODUCT', '/admin/product/edit');
define('ACTIVE_PRODUCT', '/admin/product/active');
define('SHOW_PRODUCT', '/admin/product/show');

define('LIST_USER', '/admin/user');
define('ADD_USER', '/admin/user/add');
define('EDIT_USER', '/admin/user/edit');
define('ACTIVE_USER', '/admin/user/active');
define('SHOW_USER', '/admin/user/show');

?>