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
                <li><a href="<?php echo site_url($this->modules_link.'/create'); ?>"><?php echo $this->modules_name; ?></a><i class="fa fa-circle"></i></li>
                <li><span><?php echo $data['title']; ?></span></li>
            </ul>
            <!-- Page Toolbar -->
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Hoạt động <i class="fa fa-angle-down"></i></button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="<?php echo site_url($this->modules_link.'/create'); ?>"><i class="fa fa-plus-square-o"></i> Thêm mới</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url($this->modules_link); ?>"><i class="fa fa-list"></i> Danh sách</a></li>
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
<!--                            <i class="icon-social-dribbble font-green"></i>-->
                            <i class="fa fa-cog" style="font-size:15px;color:black;"></i>
                            <span class="caption-subject font-green bold uppercase"><?php echo $data['title']; ?></span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <?php echo form_open_multipart($this->modules_link.'/create', array('class' => 'form-horizontal form-bordered', 'id' => 'form-content')); ?>
                        <!-- BEGIN FORM-->
                        <table class="table table-striped table-bordered table-hover " id="table_desc ">
                            <thead>
                                <tr>
                                    <th>Tên option</th>
                                    <th>Giá trị</th>
                                    <th>Loại</th>
                                    <th>Số thứ tự</th>
                                    <th>Icon_font</th>
                                    <th>Thêm/Xóa</th>  
                                </tr>
                            </thead>
                            <tbody id="options_field">
                                <tr class="odd gradeX">
                                    <td><input name="name[]" placeholder="Nhập tên option" type="text" class="form-control">
                                        <p class="help-block">Tên option</p></td>
                                    <td><input name="value[]" placeholder="Nhập giá trị" type="text" required="required" class="form-control">
                                        <p class="help-block">Giá trị</p></td>
                                    <td>
                                        <select name="type[]" class="bs-select form-control" data-style="green-meadow">
                                            <option value="select_type">Loại</option>
                                            <?php foreach (config_item('option_type') as $key => $value) {?>
                                                <option <?php if (isset($type) && $is_type === $key) echo "selected"; ?> value="<?php echo $key ?>"><?php echo $value ; ?></option>

                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td><input name="order_stt[]" placeholder="Nhập stt" type="text" class="form-control">
                                        <p class="help-block">Số thứ tự</p></td>
                                    <td><input name="icon_font[]" placeholder="Nhập icon" type="text" class="form-control">
                                        <p class="help-block">Icon_font</p></td>
                                    <td><input type="button" id="add_options" name="add_option" value="+" class="btn btn-success"></button>
                                   </td>
                               </tr>
                           </tbody>
                       </table>
                       <!-- Form action button -->
                        <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" name="Create_new_Items" value="<?php echo config_item('confirm_key_create'); ?>" id="Create_new_Items" class="btn green btn-outline">
                                            <i class="fa fa-check"></i> Thêm 
                                        </button>
                                        <a href="<?php echo site_url($this->modules_link.'/index')?>">
                                            <button type="reset" name="reset" class="btn default">Hủy</button>
                                        </a>
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
