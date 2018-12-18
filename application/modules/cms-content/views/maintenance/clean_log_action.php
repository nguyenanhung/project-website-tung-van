<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 11/6/2017
 * Time: 1:11 PM
 */
?>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li><a href="<?php echo site_url(); ?>">Home</a><i class="fa fa-circle"></i></li>
                <li><a href="<?php echo site_url(config_item('modules_url_cms_manage')); ?>">Dashboard</a><i class="fa fa-circle"></i></li>
                <li><a href="<?php echo site_url(config_item('modules_url_cms_maintenance')); ?>"><?php echo $this->modules_name; ?></a><i class="fa fa-circle"></i></li>
                <li><?php echo $data['title']; ?></li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"><?php echo $data['title']; ?></h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="note note-info note-bordered">
            <p>Maintenance action: <?php echo $data['title']; ?></p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet light bg-inverse">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-paper-plane font-green-haze"></i>
                            <span class="caption-subject bold font-green-haze uppercase"><?php echo $data['title']; ?></span>
                            <span class="caption-helper"></span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <h4>Xóa bản ghi thành công!</h4>
                        <p>+ Đã xóa <strong><?php echo $data['log_result']; ?></strong> bản ghi!</p>
                        <p>+ Hệ thống CMS tự lưu log theo dõi người dùng. Cần dọn dẹp log này theo chu kỳ tránh overload hệ thống!</p>
                        <p>&copy; DEV Email: <?php echo safe_mailto('dev@nguyenanhung.com', 'dev@nguyenanhung.com'); ?></p>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>

