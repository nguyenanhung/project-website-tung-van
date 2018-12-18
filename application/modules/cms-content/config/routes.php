<?php

/**
 * @Author: thaodt97
 * @Date:   2018-06-01 11:21:50
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-06-09 11:45:36
 */
$route['cms-web-tung-van-posts/(:any)/(:any)'] = "posts/$1/$2";
$route['cms-web-tung-van-posts/(:any)'] = "posts/$1";
$route['cms-web-tung-van-posts'] = "posts/index";

$route['cms-web-tung-van-users/(:any)/(:any)'] = "cms-content/users/$1/$2";
$route['cms-web-tung-van-users/(:any)']        = "cms-content/users/$1";
$route['cms-web-tung-van-users']               = "cms-content/users/index";

