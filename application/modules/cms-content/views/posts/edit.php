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
                        <?php echo form_open_multipart($this->modules_link.'/edit/'.encodeId_Url_byHungDEV($item->id), array('class' => 'form-horizontal form-bordered', 'id' => 'form-content')); ?>
                        <!-- BEGIN FORM-->
                        <div class="form-body">


                            <div class="form-group">
                                <label class="col-md-3 control-label">Thể loại</label>
                                <div class="col-md-8">
                                    <select name="categories" class="select2-multiple form-control" data-style="blue">
                                        <?php $this->sub_categories->get_sub_categories($categories_lists, $item->categories);  ?>
                                    </select>
                                    <p class="help-block">Thể loại bài viết</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Tên bài viết</label>
                                <div class="col-md-8">
                                    <input name="name" value="<?php echo $item->name; ?>" placeholder="Nhập tên bài viết" type="text" id='input_name' class="form-control">
                                    <p class="help-block">Tên bài viết - VD: Phản ứng của các sao bóng đá khi nhận được quà giáng sinh</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Tiêu đề bài viết</label>
                                <div class="col-md-8">
                                    <input name="title" value='<?php echo $item->title; ?>' placeholder="Nhập tiêu đề bài viết" type="text" class="form-control">
                                    <p class="help-block">Tiêu đề bài viết (Mặc định: Tên bài viết) - VD: Phản ứng của các sao bóng đá khi nhận được quà giáng sinh</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Slugs</label>
                                <div class="col-md-8">
                                    <input value="<?php echo $item->slugs; ?>" name="slugs" placeholder="Nhập slugs" type="text" class="form-control" id='slug'>
                                    <p class="help-block">Slugs - VD: phan-ung-cua-cac-sao-bong-da-khi-nhan-duoc-qua-giang-sinh(Có thể không nhập!)</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Ảnh</label>
                                <div class="col-md-9">
                                    <div style="height: 32px">
                                        <input checked id="check_upload" name="check_upload" type="checkbox" class="make-switch" data-on-text="Upload Ảnh" data-off-text="Link Ảnh"  data-check-upload="1">
                                        <p class="help-block">Hình thức upload</p>
                                    </div>
                                </div>
                                <div class="col-md-9 col-md-offset-3" id="select_image_to_upload">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="<?php echo ($item->thumb); ?>" alt=""/>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                            <span class="btn default btn-file">
                                                <span class="fileinput-new"> Select image </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="photo"></span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="paste_url_image" class="col-md-8 col-md-offset-3">
                                        <input name="url_image" placeholder="Nhập link ảnh" type="text" class="form-control" value="<?php echo $item->photo; ?>">
                                        <p class="help-block">Link ảnh</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Tóm tắt</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" placeholder="Nhập tóm tắt bài viết" name="summary" rows="3"><?php echo $item->summary; ?></textarea>

                                        <p class="help-block">Tóm tắt bài viết (Mặc định: Tên bài viết) - VD: Phản ứng của các sao bóng đá khi nhận được quà giáng sinh</p>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nội dung</label>
                                    <div class="col-md-8">
                                        <textarea class="ckeditor form-control" id="editor1" name="editor1" rows="6">
                                            <?php echo $item->content;?>
                                        </textarea>
                                        <script>initPosts();</script>
                                        <p class="help-block">Nội dung bài viết</p>
                                    </div>


                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Miêu tả</label>
                                    <div class="col-md-8">
                                        <input value="<?php echo $item->description; ?>" name="description" placeholder="Nhập miêu tả bài viêt" type="text" class="form-control">
                                        <p class="help-block">Miêu tả bài viết (Mặc định: Tên bài viết)</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Nguồn bài viết</label>
                                    <div class="col-md-8">
                                        <input value="<?php echo $item->source; ?>" name="source" placeholder="Nhập nguồn bài viêt" type="text" class="form-control">
                                        <p class="help-block">Nguồn bài viết</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Loại tin, Trạng thái</label>
                                    <div class="col-md-2">
                                        <select name="type" class="bs-select form-control" data-style="blue">
                                            <option <?php echo ($item->type == 1) ? "selected" : "" ?> value="1">Normal</option>
                                            <option <?php echo ($item->type == 2) ? "selected" : "" ?> value="2">Hot</option>
                                            <p class="help-block">Loại tin</p>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <select name="status" class="bs-select form-control" data-style="green-meadow">
                                            <option <?php echo ($item->status == 0) ? "selected" : "" ?> value="0">Không kích hoạt</option>
                                            <option <?php echo ($item->status == 1) ? "selected" : "" ?> value="1">Kích hoạt</option>
                                        </select>
                                        <p class="help-block">Trạng thái</p>
                                    </div>

                                    <div class="col-md-2">
                                        <select name="show_slide" class="bs-select form-control" data-style="green-meadow">
                                            <option <?php echo ($item->show_slider == 0) ? "selected" : "" ?> value="0">Hiển thị</option>
                                            <option <?php echo ($item->show_slider == 1) ? "selected" : "" ?> value="1">Không hiển thị</option>
                                        </select>
                                        <p class="help-block">Trạng thái hiển thị slide</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Tags</label>
                                    <div class="col-md-8">
                                        <input name="tags" type="text" value="<?php echo $item->tags ?>" placeholder="Nhập tags, enter! " type="text" data-role="tagsinput">
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