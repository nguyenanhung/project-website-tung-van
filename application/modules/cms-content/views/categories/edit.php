<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: HongLT
 * Date: 4/07/2017
 * Time: 9:55 AM
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
                        <li><a href="<?php echo site_url($this->modules_link); ?>"><i class="icon-list"></i> Danh mục</a></li>
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
                        <?php echo form_open_multipart($this->modules_link.'/edit/'.encodeId_Url_byHungDEV($item->id), array('class' => 'form-horizontal form-bordered', 'id' => 'form-content')); ?>
                        <!-- BEGIN FORM-->
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-3 control-label">Tên thể loại</label>
                                <div class="col-md-8">
                                    <input name="name" placeholder="Nhập tên thể loại" value="<?php echo html_escape($item->name); ?>" type="text" class="form-control">
                                    <p class="help-block">Tên thể loại - VD: Thể thao</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Slugs</label>
                                <div class="col-md-8">
                                    <input value="<?php echo $item->slugs; ?>" name="slugs" placeholder="Nhập slugs" type="text" class="form-control">
                                    <p class="help-block">Slugs - VD: The-thao (Có thể không nhập!)</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Tiêu đề</label>
                                <div class="col-md-8">
                                    <input value="<?php echo $item->title; ?>" name="title" placeholder="Nhập tiêu đề" type="text" class="form-control">
                                    <p class="help-block">Tiêu đề - VD: Thể thao</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Miêu tả</label>
                                <div class="col-md-8">
                                    <input value="<?php echo $item->description; ?>" name="description" placeholder="Nhập miêu tả" type="text" class="form-control">
                                    <p class="help-block">Miêu tả - VD: Thể thao</p>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">Từ khóa</label>
                                <div class="col-md-8">
                                    <input value="<?php echo $item->keywords; ?>" name="keywords" placeholder="Nhập từ khóa" type="text" class="form-control">
                                    <p class="help-block">Từ khóa (Default: Input Name) - VD: Thể thao</p>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">Thể loại cha</label>
                                <div class="col-md-8">
                                    <select name="parent" class="select2-multiple form-control" data-style="blue">
                                        <option value="select_parent">Không có</option>

                                        <?php $this->sub_categories->get_sub_categories($parent_lists, $item->parent);  ?>

                                    </select>
                                    <p class="help-block">(Mặc định: Không)</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Menu</label>
                                <div class="col-md-8">
                                    <select name="menu" class="select2-multiple form-control" data-style="blue">
                                        <option value="select_menu">Không có</option>

                                        <?php $this->menu->get_sub_categories($list_menu, $item->menu_id); ?>

                                    </select>
                                    <p class="help-block">(Mặc định: Không)</p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label">Ngôn ngữ</label>
                                <div class="col-md-8">
                                    <select name="language" class="select2-multiple form-control" data-placeholder="Chọn thể loại" data-style="blue">
                                        <option value="english">Tiếng anh</option>
                                        <option value="vietnamese">Tiếng việt</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Số thứ tự</label>
                                <div class="col-md-2">
                                    <input name="order_stt" placeholder="Nhập số thứ tự" value="<?php if (isset($item->order_stt)) echo $item->order_stt; ?>" type="number" class="form-control">
                                    <p class="help-block">Số thứ tự</p>
                                </div>
                                <div class="col-md-4">
                                    <input <?php if ($item->status === '1') echo 'checked'?>  name="status" type="checkbox" class="make-switch" data-on-text="Kích hoạt" data-off-text="Hủy">
                                    <p class="help-block">Trạng thái</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Vị trí</label>
                                <div class="col-md-2">
                                    <input  <?php if ($item->show_home === '1') echo 'checked'?> name="show_home" type="checkbox" class="make-switch" data-on-text="Hiện" data-off-text="Ẩn">
                                    <p class="help-block">Trang chủ</p>
                                </div>

                                <div class="col-md-2">
                                    <input  <?php if ($item->show_right === '1') echo 'checked'?> name="show_right" type="checkbox" class="make-switch" data-on-text="Hiện" data-off-text="Ẩn">
                                    <p class="help-block">Bên phải</p>
                                </div>

                                <div class="col-md-2">
                                    <input  <?php if ($item->show_top === '1') echo 'checked'?> name="show_top" type="checkbox" class="make-switch"  data-on-text="Hiện" data-off-text="Ẩn">
                                    <p class="help-block">Bên trên</p>
                                </div>

                                <div class="col-md-1">
                                    <input  <?php if ($item->show_bottom === '1') echo 'checked'?> name="show_bottom" type="checkbox" class="make-switch" data-on-text="Hiện" data-off-text="Ẩn">
                                    <p class="help-block">Bên dưới</p>
                                </div>
                            </div>
                            <!-- Form action buttons -->
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" name="Update_the_Items" value="<?php echo config_item('confirm_key_update'); ?>" id="Update_the_Items" class="btn green btn-outline">
                                            <i class="fa fa-check"></i> Submit
                                        </button>
                                        <button type="reset" name="reset" class="btn default">Cancel</button>
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
    .bootstrap-switch .bootstrap-switch-handle-on, .bootstrap-switch .bootstrap-switch-handle-off, .bootstrap-switch .bootstrap-switch-label {
        height: unset;
    }
</style>