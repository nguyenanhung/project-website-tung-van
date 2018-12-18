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
                            <i class="fa fa-cog" style="font-size:15px;color:black;"></i>
                            <span class="caption-subject font-green bold uppercase"><?php echo $data['title']; ?></span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <?php echo form_open_multipart($this->modules_link.'/create', array('class' => 'form-horizontal form-bordered', 'id' => 'form-content')); ?>
                        <!-- BEGIN FORM-->
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-3 control-label">Tên ảnh: </label>
                                <div class="col-md-8">
                                    <input name="name" placeholder="Nhập tên ảnh" type="text" class="form-control" required="required">
                                    <p class="help-block">VD: About us</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Ảnh</label>
                                <div class="col-md-9">
                                    <input checked id="check_upload" name="check_upload" type="checkbox" class="make-switch" data-on-text="Tải Ảnh" data-off-text="Link Ảnh"  data-check-upload="1">
                                    <p class="help-block">Hình thức</p>
                                </div>
                                <div id="select_image_to_upload" class="col-md-9 col-md-offset-3">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                                <span class="btn green btn-file">
                                            <span class="fileinput-new"> Chọn ảnh </span>
                                            <span class="fileinput-exists"> Cập nhật </span>
                                            <input type="file" name="photo"></span>
                                            <span class="fileinput-filename"></span> &nbsp; <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"></a>
                                        </div>
                                    </div>
                                </div>

                                <div id="paste_url_image" class="col-md-8 col-md-offset-3">
                                    <input name="url_image" placeholder="Nhập link ảnh" type="text" class="form-control">
                                    <p class="help-block">Link ảnh</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Loại</label>
                                <div class="col-md-8">
                                    <select name="type" class="bs-select form-control">
                                        <option value="">Loại ảnh</option>
                                        <?php foreach (config_item('photo_type') as $key => $type) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $type; ?></option>
                                        <?php }?>
                                    </select>
                                    <p class="help-block">Loại</p>
                                </div>
                            </div>

                            <!-- Form action buttons -->
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" name="Create_new_Items" value="<?php echo config_item('confirm_key_create'); ?>" id="Create_new_Items" class="btn green btn-outline">
                                            <i class="fa fa-check"></i> Thêm mới
                                        </button>
                                        <button type="reset" name="reset" class="btn default">Hủy</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END FORM-->
                        <?php echo form_close(); ?>
                    </div>
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
