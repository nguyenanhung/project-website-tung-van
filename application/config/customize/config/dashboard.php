<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @Author: thaodt97
 * @Date:   2018-05-31 10:47:27
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-06-06 08:58:11
 */
/**
 * Confirm KEY
 */
$config['confirm_key_create']   = md5('dVzHrLZNTYAhDfeMKMXqZSX5');
$config['confirm_key_update']   = md5('nuUeSKpC43pYDSndGRpysR7Z');
$config['confirm_key_delete']   = md5('RAJn8V57n684JrdRNgubxhx7');
$config['confirm_key_update_post_type']   = md5('RAJn8V57n6DfeMKMXqZSX5');
$config['confirm_key_cancel_service']   = md5('nuUeSKpC43pYDSeMKMXqZSX5');
// Cấu hình những nhóm được phép truy cập vào CMS dịch vụ
// $config['cms_dashboard_group_accesss'] = array(1);

// $config['cms_dashboard_group_content_accesss'] = array(2,3,4,5);

// $config['cms_dashboard_group_supper_admins'] = array(2);
// $config['cms_dashboard_group_td_admins'] = array(2,4);
// $config['cms_dashboard_group_manager'] = array(2,3);
// $config['cms_dashboard_group_dt_admins'] = array(3);

$config['cms_dashboard_group_admin'] = array(1);
$config['cms_dashboard_group_editor'] = array(2);
$config['cms_dashboard_group_content_access'] = array(1,2);