<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
                <li><a href="<?php echo site_url($this->modules_link.'/index'); ?>"><?php echo $this->modules_name; ?></a><i class="fa fa-circle"></i></li>
<li><span><?php echo $data['title']; ?></span></li>
</ul>
<!-- Page Toolbar -->
<div class="page-toolbar">
    <div class="btn-group pull-right">
        <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Hành động <i class="fa fa-angle-down"></i></button>
        <ul class="dropdown-menu pull-right" role="menu">
            <li><a href="<?php echo site_url($this->modules_link.'/create'); ?>"><i class="icon-plus"></i>Thêm mới</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo site_url($this->modules_link); ?>"><i class="icon-list"></i> Danh sách</a></li>
        </ul>
    </div>
</div>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"><?php echo $data['title']; ?></h3>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PORTLET-->
        <div class="portlet light form-fit bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-social-dribbble font-green"></i>
                    <span class="caption-subject font-green bold uppercase"><?php echo $data['title']; ?></span>
                </div>
            </div>
            <div class="portlet-body form">
                <?php echo form_open_multipart($this->modules_link.'/edit/'.$item->id, array('class' => 'form-horizontal form-bordered', 'id' => 'form-content')); ?>
                <!-- BEGIN FORM-->
                <table class="table table-striped table-bordered table-hover " id="table_desc ">
                    <thead>
                    <tr>
                        <th>ID cấu hình</th>
                        <th>Nhãn cấu hình</th>
                        <th>Giá trị</th>
                        <th>Loại</th>
                    </tr>
                    </thead>
                    <tbody id="config_field">
                    <tr class="odd gradeX">
                        <td><input name="id" value="<?php echo $item->id; ?>" readonly placeholder="Nhập ID cấu hình" type="text" required="required" class="form-control">
                            <p class="help-block">Viết liền không dấu - VD: id_cau_hinh</p></td>
                        <td><input name="label" value="<?php echo $item->label; ?>" placeholder="Nhập tên nhãn" type="text" class="form-control">
                            <p class="help-block">Tên nhãn</p></td>
                        <td><input name="value" value="<?php echo $item->value; ?>" placeholder="Nhập giá trị" type="text" required="required" class="form-control">
                            <p class="help-block">Giá trị</p></td>
                        <td><select name="type" class="select2-multiple form-control" data-style="blue">
                                <option <?php echo ($item->type == 0) ? "selected" : ""; ?> value="0">Chuỗi</option>
                                <option <?php echo ($item->type == 1) ? "selected" : ""; ?> value="1">Số</option>
                                <option <?php echo ($item->type == 2) ? "selected" : ""; ?> value="2">Json</option>
                            </select></td>
                    </tr>
                    </tbody>
                </table>
                <!-- Form action button -->
                <!-- Form action buttons -->
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" name="Update_the_Items" value="<?php echo config_item('confirm_key_update'); ?>" id="Update_the_Items" class="btn green btn-outline">
                                <i class="fa fa-check"></i> Cập nhật
                            </button>
                            <button type="reset" name="reset" class="btn default">Hủy</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END FORM-->
            <?php echo form_close(); ?>
        </div>
        <!-- END PORTLET-->
    </div>
</div>
</div>
<!-- END CONTENT BODY -->
</div>
<style>

    .bootstrap-switch .bootstrap-switch-handle-on, .bootstrap-switch .bootstrap-switch-handle-off, .bootstrap-switch .bootstrap-switch-label{
        height: 5%;
    }
</style>
