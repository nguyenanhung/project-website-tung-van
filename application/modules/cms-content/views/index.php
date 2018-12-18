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
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase"><?php echo $data['title']; ?></span>
                        </div>
                        <div class="actions">
                            <a href="<?php echo site_url($this->modules_link.'/create'); ?>" title="Add new Item">
                                <button id="add_new_item_btn" class="btn sbold green"> Thêm mới <i class="fa fa-plus"></i></button>
                            </a>

                        </div>
                    </div><!-- End of portlet-title -->
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <form action="<?php echo site_url($this->modules_link); ?>" method="GET" class="form-horizontal form-bordered" id="filter_box">
                                <div class="row">
                                    <!-- Filter Name -->
                                    <div class="col-md-3">
                                        <input type="text" name="name" value="<?php if (isset($name)) {echo $is_name;} ?>" placeholder="Tên" class="form-control">
                                        <div class="help-block">Tên</div>
                                    </div>

                                    <!-- Filter status -->
                                    <div class="col-md-2">
                                        <select name="status" class="bs-select form-control" data-style="blue">
                                            <option value="select_status">Trạng thái</option>
                                            <option  value="0">Không kích hoạt</option>
                                            <option  value="1">Kích hoạt</option>
                                        </select>
                                        <div class="help-block">Trạng thái</div>
                                    </div>

                                    <!-- Filter Date -->
                                    <div class="col-md-4">
                                        <div class="input-group input-large date-picker input-daterange" data-date="2012-11-10" data-date-format="yyyy-mm-dd">
                                            <input value="" name="begin_date" placeholder="Bắt đầu" type="text" class="form-control">
                                            <span class="input-group-addon"> đến </span>
                                            <input value="" name="end_date" placeholder="Kết thúc" type="text" class="form-control">
                                        </div>
                                        <div class="help-block">Ngày tạo</div>
                                    </div>
                                    <!-- Filter MAX Results -->
                                    <div class="col-md-2">
                                        <select name="max_results" class="bs-select form-control" data-style="red">
                                            <option value="75">Mặc định</option>
                                            <option value="150">150 kết quả</option>
                                            <option value="300">300 kết quả</option>
                                            <option value="450">450 kết quả</option>
                                            <option value="600">600 kết quả</option>
                                            <option value="750">750 kết quả</option>
                                        </select>
                                        <div class="help-block">Số kết quả tối đa</div>
                                    </div>
                                    <!-- Filter Page Results -->
                                    <div class="col-md-2">

                                        <!-- TH Số lượng Page <= 100 thì dùng Select -->
                                        <select name="page" class="bs-select form-control" data-style="green-meadow">1</select>

                                        <!-- TH Số lượng Page > 100 thì dùng Number Filter -->
                                        <input value="" placeholder="Page Number" type="number" name="page" class="form-control">

                                        <div class="help-block">
                                            Page
                                            <strong>4</strong>
                                            of
                                            <strong>30</strong>
                                        </div>
                                    </div>


                                    <!-- Search Submit -->
                                    <div class="col-md-1">
                                        <input type="submit" class="btn blue-steel" value="Tìm kiếm" />
                                    </div>
                                </div>

                        </div>
                        <hr>
                        <br />
                        <hr>
                        <table class="table table-striped table-bordered table-hover" id="table_desc">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Danh mục cha</th>
                                <th>Trạng thái</th>
                                <th>Tiêu đề</th>
                                <th>Ngày tạo</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                <!-- BEGIN MODAL CONFIRM DELETE ITEM -->
                                <div class="modal fade" id="" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title text-center">Xác nhận xóa?</h4>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc chắn muốn xóa:  ?
                                            </div>
                                            <div class="modal-footer">
                                                <?php echo form_open($this->modules_link.'/delete'); ?>
                                                <input type="hidden" name="delete_id" value="">
                                                <button type="submit" name="Delete_the_Item" value="" id="Delete_the_Item_btn_" class="btn sbold red"><i class="fa fa-trash-o"></i> Xóa</button>
                                                <?php echo form_close(); ?>
                                                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- END MODAL -->
                                <tr class="odd gradeX">
                                    <td>1</td>
                                    <td>Xã hội</td>
                                    <td>Không có</td>
                                    <td class="<?php echo ($item->status === '1') ? 'font-red' : 'font-blue'; ?>"><?php echo ($item->status == 1) ? "Kích hoạt" : "Không kích hoạt" ?></td>
                                    <td><?php echo $item->title; ?></td>
                                    <td><?php echo $item->created_at; ?></td>
                                    <td><a href="" class="btn btn-circle btn-sm green"><i class="fa fa-edit"></i> Sửa</a></td>
                                    <td>
                                        <a class="btn btn-sm btn-circle sbold dark" data-toggle="modal" href=""><i class="fa fa-trash-o"></i> Xóa</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div><!-- End of portlet-body -->
                    <div class="portlet-footer">
                        <hr>

                            Total Item: <strong>xxx</strong>.

                    </div><!-- End of portlet-footer-->
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>




