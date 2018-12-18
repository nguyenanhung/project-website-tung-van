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
                        <?php echo form_open_multipart($this->modules_link.'/create', array('class' => 'form-horizontal form-bordered', 'id' => 'form-content')); ?>
                        <!-- BEGIN FORM-->
                        <div class="form-body">

                            <div class="form-group">
                                <label class="col-md-3 control-label">Tên thể loại</label>
                                <div class="col-md-8">
                                    <input name="name" placeholder="Nhập tên thể loại" type="text"
                                           class="form-control input_name "id="input_name" >
                                    <p class="help-block">Tên thể loại - VD: Cơ hội việc làm</p>
                                    <span id="result" style="color: red;"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Slugs</label>
                                <div class="col-md-8">
                                    <input name="slugs" type="text" class="form-control" id="slug">
                                    <p class="help-block">Slugs - VD: co-hoi-viec-lam (Có thể không nhập!)</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Tiêu đề</label>
                                <div class="col-md-8">
                                    <input name="title" placeholder="Nhập tiêu đề" type="text" class="form-control">
                                    <p class="help-block">Tiêu đề (Mặc định: Giống tên thể loại) - VD: Thể thao</p>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">Miêu tả</label>
                                <div class="col-md-8">
                                    <input name="description" placeholder="Nhập miêu tả" type="text" class="form-control">
                                    <p class="help-block">Miêu tả (Mặc định: Giống tên thể loại) - VD: Thể thao</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Từ khóa</label>
                                <div class="col-md-8">
                                    <input name="keywords" placeholder="Nhập từ khóa" type="text" class="form-control">
                                    <p class="help-block">Từ khóa (Mặc định: Giống tên thể loại) - VD: Thể thao</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Thể loại cha</label>
                                <div class="col-md-8">
                                    <select name="parent" class="select2-multiple form-control" data-style="blue">
                                        <option value="select_parent">Không có</option>
                                        <?php $this->sub_categories->get_sub_categories($parent_lists);  ?>

                                    </select>
                                    <p class="help-block">(Mặc định: Không)</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">menu</label>
                                <div class="col-md-8">
                                    <select name="menu" class="select2-multiple form-control" data-style="blue">
                                        <option value="select_menu">Không có</option>
                                        <?php $this->menu->get_sub_categories($list_menu);  ?>

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
                                    <input name="order_stt" placeholder="Nhập số thứ tự" type="number" class="form-control">
                                    <p class="help-block">Số thứ tự</p>
                                </div>
                                <div class="col-md-4">
                                    <input checked name="status" type="checkbox" class="make-switch" data-on-text="Kích hoạt" data-off-text="Hủy">
                                    <p class="help-block">Trạng thái</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Vị trí</label>
                                <div class="col-md-2">
                                    <input name="show_home" type="checkbox" class="make-switch" data-on-text="Hiện" data-off-text="Ẩn">
                                    <p class="help-block">Trang chủ</p>
                                </div>

                                <div class="col-md-2">
                                    <input name="show_right" type="checkbox" class="make-switch" data-on-text="Hiện" data-off-text="Ẩn">
                                    <p class="help-block">Bên phải</p>
                                </div>

                                <div class="col-md-2">
                                    <input name="show_top" type="checkbox" class="make-switch"  data-on-text="Hiện" data-off-text="Ẩn">
                                    <p class="help-block">Bên trên</p>
                                </div>

                                <div class="col-md-1">
                                    <input name="show_bottom" type="checkbox" class="make-switch" data-on-text="Hiện" data-off-text="Ẩn">
                                    <p class="help-block">Bên dưới</p>
                                </div>
                            </div>
                            <!-- Form action buttons -->
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" name="Create_new_Items"
                                                value="<?php echo config_item('confirm_key_create'); ?>"
                                                id="Create_new_Items" class="btn green btn-outline"
                                                data-url="<?php echo base_url('cms-content/categories/create') ?>">
                                            <i class="fa fa-check"></i> Thêm
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
    .bootstrap-switch .bootstrap-switch-handle-on, .bootstrap-switch .bootstrap-switch-handle-off, .bootstrap-switch .bootstrap-switch-label {
        height: unset;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        //khai báo nút submit form
        var submit = $("button[type='submit']");
        // alert('ok');
        //khi thực hiện kích vào nút Login
        submit.click(function () {
            // alert('ok');
            var name = $("#input_name").val();

            var url = $(this).attr("data-url");
            if (name == '') {
                $("#result").html("Tên thể loại không được để trống");
                return false;
            }else{
                var data = $('form#form-content').serialize(); //lấy giá trị các trường của form
                //su dung ham $.ajax()
                // alert(data);
                $.ajax({
                    type : 'POST', //kiểu post
                    url  : url, //gửi dữ liệu sang trang submit.php
                    data : data,
                    dataType:"json",
                    success: function(result){
                        //console.log(result);
                        if(result.error)
                        {
                            alert(result.error);
                        }else{
                           // alert(result.status);
                            window.location.assign('http://web.tungvan.io/cms-content/categories');
                        }
                    }
                });
                return false;
            }
        });
    });
</script>