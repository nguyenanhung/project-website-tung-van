<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 1/21/2017
 * Time: 8:11 PM
 */
?>
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a target="_blank" href="<?php echo site_url('/dashboard'); ?>"><img src="<?php echo assets_url('images/logo-gviet-small.png'); ?>" alt="logo" class="logo-default" /> </a>
            <div class="menu-toggler sidebar-toggler"></div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" class="img-circle" src="<?php if (!empty($this->session->userdata(DASHBOARD_CMS_SESSION . 'user_photo'))) {
                            echo base_url($this->session->userdata(DASHBOARD_CMS_SESSION . 'user_photo'));
                        } else {
                            echo assets_url('images/system/no_avatar_100x100.jpg');
                        } ?>" />
                        <span class="username username-hide-on-mobile"><?php echo $this->session->userdata(DASHBOARD_CMS_SESSION . 'user_fullname');?></span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li><a href="<?php echo site_url(config_item('modules_url_cms_manage')); ?>"><i class="icon-home"></i> Dashboard Manage</a></li>
                        <li><a href="<?php echo site_url(config_item('modules_url_cms_profile')); ?>"><i class="icon-user"></i> My Profile </a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url(config_item('modules_url_cms_logout')); ?>"><i class="icon-key"></i> Log Out </a></li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-quick-sidebar-toggler">
                    <a href="<?php echo site_url(config_item('modules_url_cms_logout')); ?>" class="dropdown-toggle"><i class="icon-logout"></i></a>
                </li>
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<style>
    .pagination>li>a, .pagination>li>span {
        float: none;
    }
</style>