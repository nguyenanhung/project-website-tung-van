<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 2/18/2017
 * Time: 7:13 PM
 */
?>
<?php
$segment_1 = strtolower($this->uri->segment(2));
$segment_value = array(
    'maintenance'
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
    
    <!-- <ul class="sub-menu"> -->
        <!-- Xóa Cache -->
        <li class="nav-item <?php if ($segment_1 == 'maintenance') { echo 'active open';} ?>">
            <a href="<?php echo site_url(config_item('modules_url_cms_maintenance').'/clean_cache'); ?>" class="nav-link ">
                <i class="fa fa-exchange"></i> <span class="title">Xóa Cache</span>
            </a>
        </li>
    <!-- </ul> -->
<!-- </li> -->
