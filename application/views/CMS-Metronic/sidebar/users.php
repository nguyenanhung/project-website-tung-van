<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HongLT
 * Date: 4/07/2017
 * Time: 9:55 AM
 */

?>
<?php
$segment_1 = strtolower($this->uri->segment(1) . '/' . $this->uri->segment(2));
$segment_value = array(
    config_item('modules_url_backend_user'),
    config_item('modules_url_backend_user_group')

);
if (in_array($segment_1, $segment_value)) {
    $active_open = 'active open';
    $arrow_open = 'open';
} else {
    $active_open = '';
    $arrow_open = '';
}
?>
<!-- <li class="nav-item active open"> -->
    
    <!-- <ul class="sub-menu active open"> -->
        <?php if (in_array($this->session->userdata(DASHBOARD_CMS_SESSION . 'user_group'), config_item('cms_dashboard_group_admin'))) {
        ?>
        <!-- Users -->
        <li class="nav-item <?php if ($segment_1 == config_item('modules_url_backend_user')) echo 'active open'; ?>">
            <a href="<?php echo site_url(config_item('modules_url_backend_user')); ?>" class="nav-link ">
                <i class="fa fa-user"></i> <span class="title">Quản lý người dùng</span>
            </a>
        </li>
        <?php } ?>
            
    <!-- </ul> -->
<!-- </li> -->