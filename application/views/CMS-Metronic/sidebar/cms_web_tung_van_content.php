<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: honglt
 * Date: 12/07/2017
 * Time: 10:06 PM
 */
?>
<?php
$segment_1 = strtolower($this->uri->segment(1) . '/' . $this->uri->segment(2));
$segment_value = array(
    config_item('modules_url_backend_cms_web_tung_van_category'),
    config_item('modules_url_backend_cms_web_tung_van_config'),
    config_item('modules_url_backend_cms_web_tung_van_option'),
    config_item('modules_url_backend_cms_web_tung_van_pages'),
    config_item('modules_url_backend_cms_web_tung_van_posts'),
    config_item('modules_url_backend_cms_web_tung_van_partners'),
    config_item('modules_url_backend_cms_web_tung_van_staff'),
    config_item('modules_url_backend_cms_web_tung_van_photo'),
    config_item('modules_url_backend_cms_web_tung_van_recruitment'),
    config_item('modules_url_backend_cms_web_tung_van_product'),
    config_item('modules_url_backend_cms_web_tung_van_feedback')
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
        <!--CMS Sao Gala -->

        <?php
        // $checkRole_UG_cms_web_tung_van_config  = $this->roles_sidebar->auth('cms_web_tung_van_content', 'modules_url_backend_cms_web_tung_van_config');
        // $checkRole_UI_cms_web_tung_van_config = $this->roles_sidebar->auth('cms_web_tung_van_content', 'modules_url_backend_cms_web_tung_van_config', 'user_id');


        ?>
        <li class="nav-item <?php if ($segment_1 == config_item('modules_url_backend_cms_web_tung_van_config')) echo 'active open'; ?>">
            <a href="<?php echo site_url(config_item('modules_url_backend_cms_web_tung_van_config')); ?>"
               class="nav-link ">
                <i class="fa fa-gear"></i> <span class="title">Cấu hình</span>
            </a>
        </li>


        <!-- if ($checkRole_UG_cms_web_tung_van_option === true || $checkRole_UI_cms_web_tung_van_option === true) {
            ?> -->
        <li class="nav-item <?php if ($segment_1 == config_item('modules_url_backend_cms_web_tung_van_option')) echo 'active open'; ?>">
            <a href="<?php echo site_url(config_item('modules_url_backend_cms_web_tung_van_option')); ?>"
               class="nav-link ">
                <i class="fa fa-gears"></i> <span class="title">Option</span>
            </a>
        </li>


        <?php
        // $checkRole_UG_cms_cms_web_tung_van_category  = $this->roles_sidebar->auth('cms_web_tung_van_content', 'modules_url_backend_cms_web_tung_van_category');
        // $checkRole_UI_cms_cms_web_tung_van_category = $this->roles_sidebar->auth('cms_web_tung_van_content', 'modules_url_backend_cms_web_tung_van_category', 'user_id');
        ?>

        <li class="nav-item <?php if ($segment_1 == config_item('modules_url_backend_cms_web_tung_van_category')) echo 'active open'; ?>">
            <a href="<?php echo site_url(config_item('modules_url_backend_cms_web_tung_van_category')); ?>"
               class="nav-link ">
                <i class="fa fa-list"></i> <span class="title">Danh mục</span>
            </a>
        </li>

        <li class="nav-item <?php if ($segment_1 == config_item('modules_url_backend_cms_web_tung_van_pages')) echo 'active open'; ?>">
            <a href="<?php echo site_url(config_item('modules_url_backend_cms_web_tung_van_pages')); ?>"
               class="nav-link ">
                <i class="fa fa-file-o"></i> <span class="title">Trang</span>
            </a>
        </li>

        <li class="nav-item <?php if ($segment_1 == config_item('modules_url_backend_cms_web_tung_van_posts')) echo 'active open'; ?>">
            <a href="<?php echo site_url(config_item('modules_url_backend_cms_web_tung_van_posts')); ?>"
               class="nav-link ">
                <i class="fa fa-file-text"></i> <span class="title">Bài viết</span>
            </a>
        </li>

        <li class="nav-item <?php if ($segment_1 == config_item('modules_url_backend_cms_web_tung_van_product')) echo 'active open'; ?>">
            <a href="<?php echo site_url(config_item('modules_url_backend_cms_web_tung_van_product')); ?>"
               class="nav-link ">
                <i class="fa fa-cube"></i> <span class="title">Sản phẩm</span>
            </a>
        </li>

        <li class="nav-item <?php if ($segment_1 == config_item('modules_url_backend_cms_web_tung_van_staff')) echo 'active open'; ?>">
            <a href="<?php echo site_url(config_item('modules_url_backend_cms_web_tung_van_staff')); ?>"
               class="nav-link ">
                <i class="fa fa-users"></i> <span class="title">Đội ngũ sáng tạo</span>
            </a>
        </li>

        <li class="nav-item <?php if ($segment_1 == config_item('modules_url_backend_cms_web_tung_van_photo')) echo 'active open'; ?>">
            <a href="<?php echo site_url(config_item('modules_url_backend_cms_web_tung_van_photo')); ?>"
               class="nav-link ">
                <i class="fa fa-camera-retro"></i> <span class="title">Ảnh </span>
            </a>
        </li>

        <li class="nav-item <?php if ($segment_1 == config_item('modules_url_backend_cms_web_tung_van_feedback')) echo 'active open'; ?>">
            <a href="<?php echo site_url(config_item('modules_url_backend_cms_web_tung_van_feedback')); ?>"
               class="nav-link ">
                <i class="fa fa-commenting"></i> <span class="title">Phản hồi</span>
            </a>
        </li>

    <!-- </ul> -->
<!-- </li> -->
