<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @Author: thaodt97
 * @Date  :   2018-06-08 14:13:54
 * @Last  Modified by:   thaodt97
 * @Last  Modified time: 2018-07-11 11:35:52
 */
$route['change-type-post']           = "cms-content/posts/change_type";
$route['change-status-post']         = "cms-content/posts/change_status";
$route['change-show-slider-post']    = "cms-content/posts/change_show_slider";
$route['change-type-page']           = "cms-content/pages/change_type";
$route['change-status-page']         = "cms-content/pages/change_status";
$route['change-status-partner']      = "cms-content/partners/change_status";
$route['change-categories-status']   = "cms-content/categories/change_status";
$route['product']                    = "front-end/product/index";
$route['product-details']            = "front-end/product/details";
$route['product/(:any)']             = "front-end/product/list_by_categories";
$route['service']                    = "front-end/service/service";
$route['service/(:any)']             = "front-end/service/get_page_by_slug/$1";
$route['service-details']            = "front-end/service/details";
$route['recruitment/(:any)']         = "front-end/recruitment/list_by_categories/$1";
$route['(:any)/(:any)-post([A-Z]+)'] = "front-end/news/news_detail/$3/$2/$1";
$route['ve-chung-toi']               = "front-end/about/details";
$route['tin-tuc']                    = "front-end/news/news_page";
$route['dich-vu']                    = "front-end/service/service";
$route['dich-vu/(:any)']             = "front-end/service/get_page_by_slug/$1";
$route['chi-tiet-dich-vu/(:any)']    = "front-end/service/detail/$1";
$route['san-pham']                   = "front-end/product/details";
$route['chi-tiet-san-pham/(:any)']   = "front-end/product/detail/$1";
$route['lien-he']                    = "front-end/contact/details";
$route['lien-he/send-message']       = "front-end/contact/send_message";
$route['tuyen-dung']                 = "front-end/recruitment/index";
$route['tuyen-dung/tags/(:any)']     = "front-end/recruitment/list_page_by_tags/$1";
$route['tuyen-dung/thong-bao']       = "front-end/recruitment/notice";
$route['chi-tiet/(:any)']            = "front-end/recruitment/detail/$1";
$route['tuyen-dung/(:any)']          = "front-end/recruitment/detail/$1";
$route['tuyen-dung/tim-kiem']        = "front-end/recruitment/search";
$route['download/(:any)']            = "front-end/recruitment/download/$1";
$route['tin-tuc/(:any)']             = "front-end/news/news_list_by_categories/$1";
$route['dashboard']                  = 'cms-content/login/index';
