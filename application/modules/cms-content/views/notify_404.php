<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 1/23/2017
 * Time: 4:46 PM
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
                <li><a href="<?php echo site_url(config_item('modules_url_cms_manage')); ?>">Dashboard</a></li>
                <li><i class="fa fa-circle"></i>Notify</li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"><?php echo $data['title']; ?></h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="note note-info note-bordered">
            <p>Trang không tồn tại.</p>
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
                        <p>+ Rất tiếc trang bạn yêu cầu không tồn tại!</p>
                        <p>+ Hãy liên hệ với quản trị viên để có thêm thông tin!</p>
                        <p>+ Hoặc báo cho người phụ trách kỹ thuật nếu bạn tin rằng đây là 1 lỗi hệ thống</p>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>