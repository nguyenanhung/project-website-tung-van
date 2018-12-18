<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 2/18/2017
 * Time: 7:09 PM
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
                <li><?php echo $title; ?></li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"><?php echo $data['title']; ?></h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="note note-info note-bordered">
            <p>Trung tâm bảo trì dữ liệu.</p>
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
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
