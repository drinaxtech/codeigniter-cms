<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['dashboard/posts/create'] = 'dashboard/create_post';
$route['dashboard/posts/trash'] = 'dashboard/post_trash';
$route['dashboard/user/edit/(:num)'] = 'dashboard/user_edit/$1';
$route['dashboard/posts/edit/(:num)'] = 'dashboard/post_edit/$1';
$route['dashboard/categories'] = 'dashboard/categories';
$route['dashboard/users'] = 'dashboard/users';
$route['dashboard/comments'] = 'dashboard/comments';
$route['dashboard/posts'] = 'dashboard/posts';
$route['dashboard/user/profile'] = 'dashboard/user_profile';



$route['login'] = 'user/login';
$route['user/subscribe'] = 'user/subscribe';
$route['register'] = 'user/register';
$route['user'] = 'user/index';
$route['user/logout'] = 'user/logout';
$route['user/update'] = 'user/update';
$route['user/findall'] = 'user/findall';
$route['user/edit/(:num)'] = 'user/edit/$1';
$route['user/profile'] = 'user/profile/';

$route['categories'] = 'category/categories';


$route['posts/edit/(:num)'] = 'posts/edit/$1';
$route['posts/index/(:num)'] = 'posts/index/$1';
$route['posts/findall/(:num)'] = 'posts/findall/$1';
$route['posts/author/(:any)'] = 'posts/user/$1';
$route['posts/update/(:num)'] = 'posts/update/$1';
$route['posts/delete/(:num)'] = 'posts/delete/$1';
$route['posts/(:any)/(:num)'] = 'posts/view/$1/$1';
$route['category/(:any)'] = 'posts/category/$1';


$route['default_controller'] = 'posts/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
