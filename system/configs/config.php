<?php

//Define controller and action default
define('DEFAULT_CONROLLER', 'index');
define('DEFAULT_ACTION', 'index');

//Config database
define('DB_HOST','localhost');
define('DB_NAME','ntq-project');
define('DB_USER','root');
define('DB_PASS','bac17041994');

//Define pagination
define('PER_PAGE', '10');
define('INSTANT', 'page');

//Define name item
define('CATEGORY', 'Category');
define('PRODUCT', 'Product');
define('USER', 'User');

//Define number image
define('NUM_IMG', '3');

//Define active and deactive value
define("ACTIVE_VALUE", "1");
define("DEACTIVE_VALUE", "0");

//Define set time cookie
define("TIME_COOKIE", "7200");

//Define Login
define('LOGIN', '/admin/login');
define('LOGOUT', '/admin/login/logout');

//Define category manager page
define('LIST_CATEGORY', '/admin/category');
define('ADD_CATEGORY', '/admin/category/add');
define('EDIT_CATEGORY', '/admin/category/edit');
define('ACTIVE_CATEGORY', '/admin/category/active');
define('SHOW_CATEGORY', '/admin/category/show');

//Define product manager page
define('LIST_PRODUCT', '/admin/product');
define('ADD_PRODUCT', '/admin/product/add');
define('EDIT_PRODUCT', '/admin/product/edit');
define('ACTIVE_PRODUCT', '/admin/product/active');
define('SHOW_PRODUCT', '/admin/product/show');

//Define user manager page
define('LIST_USER', '/admin/user');
define('ADD_USER', '/admin/user/add');
define('EDIT_USER', '/admin/user/edit');
define('ACTIVE_USER', '/admin/user/active');
define('SHOW_USER', '/admin/user/show');

?>