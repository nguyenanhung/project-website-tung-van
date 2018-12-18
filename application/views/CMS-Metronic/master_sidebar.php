<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 1/21/2017
 * Time: 8:14 PM
 */
$this_sidebar_user_id = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_id');
$this_sidebar_user_group = $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_group');
?>
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler"></div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <li class="nav-item start ">
                <a href="<?php echo site_url(config_item('modules_url_cms_manage')); ?>" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="arrow"></span>
                    <span class="selected"></span>
                    <!-- <span class="arrow open"></span> -->
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start "><a href="<?php echo site_url(config_item('modules_url_cms_manage')); ?>" class="nav-link "><i class="icon-home"></i> <span class="title">Quản lí dashboard</span></a></li>
                    <li class="nav-item start "><a href="<?php echo site_url(config_item('modules_url_cms_profile')); ?>" class="nav-link "><i class="icon-user"></i> <span class="title">Trang cá nhân</span></a></li>
                    <li class="nav-item start "><a href="<?php echo site_url(config_item('modules_url_cms_logout')); ?>" class="nav-link "><i class="icon-key"></i> <span class="title">Đăng xuất</span></a></li>
                </ul>
            </li>

            <?php
            if (in_array($this_sidebar_user_group, config_item('cms_dashboard_group_content_access')))
            {
                echo '<li class="heading"><h3 class="uppercase">QUẢN TRỊ NỘI DUNG</h3></li>';
                $this->load->view(config_item('template_cms_sidebar').'cms_web_tung_van_content');
            }

            // check roles master and heading sidebar cms_news
            if (in_array($this_sidebar_user_group, config_item('cms_dashboard_group_admin')))
            {
                echo '<li class="heading"><h3 class="uppercase">SYSTEMS</h3></li>';
                $this->load->view(config_item('template_cms_sidebar').'users');
                $this->load->view(config_item('template_cms_sidebar').'maintenance');
            }
            ?>
        </ul><!-- END SIDEBAR MENU -->
    </div><!-- END SIDEBAR -->
</div>
