<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 1/21/2017
 * Time: 11:41 PM
 */
?>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li><a href="<?php echo site_url(); ?>">Trang chủ</a><i class="fa fa-circle"></i></li>
                <li><a href="<?php echo site_url(config_item('modules_url_cms_manage')); ?>">Dashboard</a><i class="fa fa-circle"></i></li>
                <li><a href="<?php echo site_url($this->modules_link.'/index'); ?>"><?php echo $this->modules_name; ?></a><i class="fa fa-circle"></i></li>
                <li><span><?php echo $data['title']; ?></span></li>
            </ul>
            <!-- Page Toolbar -->
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Hành dộng <i class="fa fa-angle-down"></i></button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="<?php echo site_url($this->modules_link.'/create'); ?>"><i class="icon-plus"></i> Thêm mới</a></li>
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
                        <?php echo form_open_multipart($this->modules_link.'/create', array('class' => 'form-horizontal form-bordered', 'id' => 'form-content')); ?>
                        <!-- BEGIN FORM-->
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-3 control-label">Tên tài khoản</label>
                                <div class="col-md-8">
                                    <input name="username" placeholder="Nhập tên tài khoản" type="text" class="form-control">
                                    <p class="help-block">Nhập tên tài khoản, VD: hungnguyen</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Mật khẩu</label>
                                <div class="col-md-8">
                                    <input name="password" placeholder="Nhập mật khẩu" type="password" class="form-control" id="password">
                                    <p class="help-block">Nhập mật khẩu</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Xác nhận mật khẩu</label>
                                <div class="col-md-8">
                                    <input name="password" placeholder="Nhập mật khẩu" type="password" class="form-control" id="password_confirm">
                                    <p class="help-block">Xác nhận mật khẩu</p>
                                    <p class="help-block hidden" id="pw_incorrect" style="color: #ff6161" >Mật khẩu không trùng khớp</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Nhóm người dùng</label>
                                <div class="col-md-6">
                                    <!-- SELECT TOPICS -->
                                    <select name="group_level" id="select2-single-input-sm-topics" class="form-control input-sm select2-multiple">
                                        <option value="0">-- Chọn nhóm người dùng</option>
                                        <?php foreach (config_item('level_group') as $key => $value) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Hình ảnh</label>
                                <div class="col-md-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <span class="btn green btn-file">
                                            <span class="fileinput-new"> Chọn ảnh </span>
                                            <span class="fileinput-exists"> Cập nhật </span>
                                            <input type="file" name="photo"></span>
                                        <span class="fileinput-filename"></span> &nbsp; <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Tên đầy đủ</label>
                                <div class="col-md-8">
                                    <input name="fullname" placeholder="Nhập tên đầy đủ" type="text" class="form-control">
                                    <p class="help-block">Nhập tên đầy đủ, VD: Hung Nguyen</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Email</label>
                                <div class="col-md-8">
                                    <input name="email" placeholder="Nhập email" type="text" class="form-control">
                                    <p class="help-block">Nhập Email, VD: hungna@gviet.vn</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Điện thoại</label>
                                <div class="col-md-8">
                                    <input name="phone" placeholder="Nhập số điện thoại" type="text" class="form-control">
                                    <p class="help-block">Nhập SDT, VD: 84xxxxxxxx</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Trạng thái</label>
                                <div class="col-md-8">
                                    <select name="status" class="bs-select form-control" data-width="125px" data-style="red">
                                        <option value="1">+ Kích hoạt</option>
                                        <option value="2">+ Đợi</option>
                                        <option value="0">+ Khóa</option>
                                    </select>
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

<script type="text/javascript">
    $(document).ready(function(){
        $('#Create_new_Items').click(function(){
            var pw1 = $('#password').val();
            var pw2 = $('#password_confirm').val();
            if (pw1 != pw2) {
                $('#pw_incorrect').removeClass('hidden');
                return false;
            }
            else return true;
        });        
    });
</script>
