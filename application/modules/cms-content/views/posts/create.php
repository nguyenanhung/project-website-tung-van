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
                <li><a href="<?php echo site_url(); ?>">Home</a><i class="fa fa-circle"></i></li>
                <li><a href="<?php echo site_url(config_item('modules_url_cms_manage')); ?>">Dashboard</a><i class="fa fa-circle"></i></li>
                <li><a href="<?php echo site_url($this->modules_link.'/index'); ?>"><?php echo $this->modules_name; ?></a><i class="fa fa-circle"></i></li>
                <li><span><?php echo $data['title']; ?></span></li>
            </ul>
            <!-- Page Toolbar -->
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Hoạt động <i class="fa fa-angle-down"></i></button>
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
                                <label class="col-md-3 control-label">Thể loại</label>
                                <div class="col-md-8">
                                    <select name="categories" class="select2-multiple form-control" data-placeholder="Chọn thể loại" data-style="blue">
                                        <option value="">Chọn thể loại</option>
                                        <?php $this->sub_categories->get_sub_categories($categories_lists);  ?>
                                    </select>
                                    <p class="help-block">Thể loại bài viết</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Tên bài viết</label>
                                <div class="col-md-8">
                                    <input name="name" placeholder="Nhập tên bài viết" type="text" class="form-control input_name" id="input_name">
                                    <p class="help-block">Tên bài viết - VD: Phản ứng của các sao bóng đá khi nhận được quà giáng sinh </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Tiêu đề bài viết</label>
                                <div class="col-md-8">
                                    <input name="title" placeholder="Nhập tiêu đề bài viết" type="text" class="form-control">
                                    <p class="help-block">Tiêu đề bài viết - VD: Phản ứng của các sao bóng đá khi nhận được quà giáng sinh</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Slugs</label>
                                <div class="col-md-8">
                                    <input name="slugs" placeholder="Nhập slugs" id="slug" type="text" class="form-control">
                                    <p class="help-block">Slugs - VD: phan-ung-cua-cac-sao-bong-da-khi-nhan-duoc-qua-giang-sinh (Có thể không nhập!)</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Ảnh</label>
                                <div class="col-md-9">
                                    <div style="height: 32px;">
                                    <input checked id="check_upload" name="check_upload" type="checkbox" class="make-switch" data-on-text="Upload Ảnh" data-off-text="Link Ảnh"  data-check-upload="1" ">
                                    </div>
                                    <p class="help-block">Hình thức upload</p>
                                </div>
                                <div id="select_image_to_upload" class="col-md-9 col-md-offset-3" >
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                            <span class="btn green btn-file">
                                            <span class="fileinput-new"> Select file </span>
                                            <span class="fileinput-exists"> Change </span>
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
                                <label class="col-md-3 control-label">Tóm tắt</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" placeholder="Nhập tóm tắt bài viết" name="summary" rows="3"></textarea>

                                    <p class="help-block">Tóm tắt bài viết (Mặc định: Tên bài viết) - VD: Phản ứng của các sao bóng đá khi nhận được quà giáng sinh</p>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">Nội dung</label>
                                <div class="col-md-8">
                                    <textarea class="ckeditor form-control" id="editor1" name="editor1" rows="6"></textarea>
                                    <script>initPosts();</script>
                                    <p class="help-block">Nội dung bài viết</p>
                                </div>


                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Miêu tả</label>
                                <div class="col-md-8">
                                    <input name="description" placeholder="Nhập miêu tả bài viêt" type="text" class="form-control">
                                    <p class="help-block">Miêu tả bài viết</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Nguồn bài viết</label>
                                <div class="col-md-8">
                                    <input name="source" placeholder="Nhập nguồn bài viêt" type="text" class="form-control">
                                    <p class="help-block">Nguồn bài viết</p>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">Loại tin, Trạng thái</label>
                                <div class="col-md-2">
                                    <select name="type" class="bs-select form-control" data-style="blue">
                                        <option value="">Loại tin</option>
                                        <?php foreach (config_item('post_type') as $key => $type) { ?>
                                                <option value="<?php echo $key; ?>"><?php echo $type; ?></option>
                                            <?php }?>
                                    </select>
                                    <p class="help-block">Mặc định: HOT</p>
                                </div>

                                <div class="col-md-2">
                                    <select name="status" class="bs-select form-control" data-style="green-meadow">
                                        <option value="">Trạng thái</option>
                                        <?php foreach (config_item('post_status') as $key => $type) { ?>
                                                <option value="<?php echo $key; ?>"><?php echo $type; ?></option>
                                            <?php }?>
                                    </select>
                                    <p class="help-block">Mặc định: Kích hoạt</p>
                                </div>

                                <div class="col-md-2">
                                    <select name="show_slider" class="bs-select form-control" data-style="green-meadow">
                                        <option value="">TT hiển thị trên slide</option>
                                        <?php foreach (config_item('post_slider') as $key => $type) { ?>
                                                <option value="<?php echo $key; ?>"><?php echo $type; ?></option>
                                            <?php }?>
                                    </select>
                                    <p class="help-block">Mặc định: Không kích hoạt</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Tags</label>
                                <div class="col-md-8">
                                    <input name="tags" type="text" value="" placeholder="Nhập tags, enter! " type="text" data-role="tagsinput">
                                </div>
                            </div>

                            <!-- Form action buttons -->
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" name="Create_new_Items" value="<?php echo config_item('confirm_key_create'); ?>" id="Create_new_Items" class="btn green btn-outline">
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

