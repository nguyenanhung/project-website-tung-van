<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 1/21/2017
 * Time: 8:07 PM
 */
?>
<?php //echo doctype('html5')."\n"; ?>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--><html lang="en"><!--<![endif]-->
<!-- BEGIN HEAD -->
<base href="<?php echo site_url(); ?>" />
<head>
    <meta charset="utf-8" />
    <title><?php echo $data['title'].' - '.$this->config->item('cms_site_name'); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="robots" content="noindex, nofollow"/>
    <meta name="author" content="<?php echo $this->config->item('cms_author_username').' - '.$this->config->item('cms_author_email'); ?>"/>
    <?php $this->load->view($this->assets_header); ?>
    <?php $this->load->view('libraries/favicon'); ?>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<!-- BEGIN HEADER -->
<?php $this->load->view(config_item('template_cms_master_layout_header')); ?>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <?php $this->load->view(config_item('template_cms_master_layout_sidebar')); ?>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <?php if (isset($sub)) {
        if (isset($data)) {
            $this->load->view($sub, $data);
        } else {
            $this->load->view($sub);
        }
    } ?>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        <?php echo $data['title']; ?>
        - <?php echo date('Y'); ?> &copy; <a href="<?php echo $this->config->item('cms_site_link'); ?>" title="<?php echo $this->config->item('cms_site_name'); ?>"><?php echo $this->config->item('cms_site_name'); ?></a>
        - Powered by <?php echo mailto($this->config->item('cms_author_email'), $this->config->item('cms_author_name')); ?>
    </div>
    <div class="scroll-to-top"><i class="icon-arrow-up"></i></div>
</div>
<!-- END FOOTER -->
<?php $this->load->view($this->assets_bottom); ?>
</body>
<!-- END BODY -->
</html>
<!--
    - A production of HungNA <dev@nguyenanhung.com>
    - Page generation time: {elapsed_time}
    - Memory Usage: {memory_usage}
 -->
