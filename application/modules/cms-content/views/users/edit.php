<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 1/22/2017
 * Time: 12:33 AM
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
                    <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Hành động <i class="fa fa-angle-down"></i></button>
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
        <?php if ($this->session->flashdata('notice_action_flashdata')) { ?>
          <div class="m-heading-1 border-green m-bordered">
             <p> <?php echo $this->session->flashdata('notice_action_flashdata'); ?> </p>
         </div>
     <?php } ?>

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
                    <?php echo form_open_multipart($this->modules_link.'/edit/'.encodeId_Url_byHungDEV($item->id), array('class' => 'form-horizontal form-bordered', 'id' => 'form-content')); ?>
                    <!-- BEGIN FORM-->
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Tên tài khoản</label>
                            <div class="col-md-8">
                                <input disabled name="username" value="<?php echo html_escape($item->username); ?>" placeholder="Nhập tên tài khoản" type="text" class="form-control">
                                <p class="help-block">Nhập tên tài khoản, VD: hungnguyen</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mật khẩu</label>
                            <div class="col-md-2">
                                <select name="change_password" class="bs-select form-control" data-style="blue">
                                    <option value="No">+ Không cập nhật </option>
                                    <option value="Yes" class="change-password">+ Cập nhật</option>

                                </select>
                            </div>
                            <div class="col-md-6">
                                <input disabled name="password" placeholder="Mật khẩu" type="password" id="password" class="form-control new-pass">
                                <p class="help-block">Nhập mật khẩu</p>
                                <div class="confirm-password" style="display: none">
                                    <input name="password_confirm" placeholder="Xác nhận mật khẩu" type="password" id="password_confirm"  class="form-control">
                                    <p class="help-block" >Xác nhận mật khẩu</p>
                                </div>
                                <p class="help-block hidden" id="pw_incorrect" style="color: #ff6161" >Mật khẩu không trùng khớp</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Tên đầy đủ</label>
                            <div class="col-md-8">
                                <input name="fullname" value="<?php echo html_escape($item->fullname); ?>" placeholder="Nhập tên đầy đủ" type="text" class="form-control">
                                <p class="help-block">Nhập tên đầy đủ, VD: Hung Nguyen</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nhóm người dùng</label>
                            <div class="col-md-6">
                                <!-- SELECT TOPICS -->
                                <select name="group_level" id="select2-single-input-sm-topics" class="form-control input-sm select2-multiple">

                                    <?php foreach (config_item('level_group') as $key => $value) { ?>
                                        <option <?php if ($item->group_id == $key) echo 'selected' ;?> value="<?php echo $key?>"><?php echo $value;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Ảnh</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="<?php echo base_url($item->thumb); ?>" alt=""/>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                    <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new"> Chọn ảnh </span>
                                            <span class="fileinput-exists"> Cập nhật </span>
                                            <input type="file" name="photo"></span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Hủy </a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">Email</label>
                                <div class="col-md-8">
                                    <input name="email" value="<?php echo html_escape($item->email); ?>" placeholder="Nhập email" type="text" class="form-control">
                                    <p class="help-block">Nhập email, VD: hungna@gviet.vn</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Số điện thoại</label>
                                <div class="col-md-8">
                                    <input name="phone" value="<?php echo html_escape($item->phone); ?>" placeholder="Nhập số điện thoại" type="text" class="form-control">
                                    <p class="help-block">Nhập SDT, VD: 84xxxxxxxx</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Trạng thái</label>
                                <div class="col-md-8">
                                    <select name="status" class="bs-select form-control" data-width="125px" data-style="red">
                                        <option value="1"<?php if ($item->status == '1') { echo " selected"; } ?>>+ Kích hoạt</option>
                                        <option value="2"<?php if ($item->status == '2') { echo " selected"; } ?>>+ Chờ</option>
                                        <option value="0"<?php if ($item->status == '0') { echo " selected"; } ?>>+ Khóa</option>
                                    </select>
                                </div>
                            </div>
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
                </div>
                <!-- END PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('select').on('change', function(){
            var value = this.value;
            if (value == 'Yes') {
                $('.confirm-password').attr('style','display:block');
                $('.new-pass').attr('value','');
                $('.new-pass').removeAttr('disabled');
                $('.new-pass').attr('placeholder','Nhập mật khẩu mới');

            } 
            else if (value == "No") {
                $('.confirm-password').attr('style','display:none');
                $('.new-pass').attr('placeholder','Mật khẩu');
                $('.new-pass').attr('disabled', true);
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#Update_the_Items').click(function(){
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