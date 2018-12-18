<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 1/21/2017
 * Time: 6:50 PM
 */
?>
<?php echo doctype('html5')."\n"; ?>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Dashboard Login System - <?php echo config_item('cms_site_name'); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta name="robots" content="noindex, nofollow"/>
    <meta name="author" content="<?php echo $this->config->item('cms_author_username').' - '.$this->config->item('cms_author_email'); ?>"/>
    <?php $this->load->view($this->assets_header); ?>
    <?php // $this->load->view('libraries/favicon'); ?>
</head>
<!-- END HEAD -->
<body class=" login">
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="<?php echo site_url(); ?>"> <img src="<?php echo assets_url('images/logo-gviet.png'); ?>" alt="" /> </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <?php echo form_open(config_item('modules_url_cms_login'), array('class' => 'login-form', 'id' => 'form-login')); ?>
    <h3 class="form-title font-green">CMS Login - Gviet.vn</h3>
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span> Enter any username and password. </span>
    </div>
    <?php if (isset($error)) { ?>
        <div class="alert alert-danger">
            <button class="close" data-close="alert"></button>
            <span> <?php echo $error; ?>. </span>
        </div>
    <?php } ?>
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Username</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
    </div>
    <div class="form-actions">
        <button type="submit" class="btn green uppercase">Login</button>
        <label class="rememberme check">
            <input type="checkbox" name="remember" value="1"/>Remember </label>
            <!-- <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a> -->
    </div>
    <div class="login-options">
        <h4><!-- Or login with --></h4>
        <ul class="social-icons">
        </ul>
    </div>
    <div class="create-account">
        <p><a href="" class="uppercase"><!-- Create an account --></a></p>
    </div>
    </form>
    <!-- END LOGIN FORM -->
</div>
<!-- END LOGIN -->
<div class="copyright">
    2017 &copy; <?php echo $this->config->item('cms_site_name'); ?> - Powered by <a href="mailto:dev@nguyenanhung.com">Hung Nguyen</a>
</div>
<?php $this->load->view($this->assets_bottom); ?>
</body>
</html>
<!--
  - A production of HungNA <dev@nguyenanhung.com>
  - Page generation time: {elapsed_time}
  - Memory Usage: {memory_usage}
-->
