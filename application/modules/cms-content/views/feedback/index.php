<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 09/07/2018
 * Time: 2:12 CH
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
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url($this->modules_link); ?>"><i class="fa fa-list"></i> List Item</a></li>
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
                            <!--                            <i class="icon-settings font-dark">-->
                            <i class="icon-settings font-dark" style="font-size:15px;color:black;"></i>
                            <span class="caption-subject bold uppercase"><?php echo $data['title']; ?></span>
                        </div>

                    </div><!-- End of portlet-title -->
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <form action="<?php echo base_url($this->modules_link); ?>" method="GET" class="form-horizontal form-bordered" id="filter_box">
                                <div class="row">

                                    <!-- Filter Date -->
                                    <div class="col-md-4">
                                        <div class="input-group input-large date-picker input-daterange" data-date="2012-11-10" data-date-format="yyyy-mm-dd">
                                            <input value="<?php if (isset($begin_date)) {echo $begin_date;}?>" name="begin_date" placeholder="Begin date" type="text" class="form-control">
                                            <span class="input-group-addon"> đến </span>
                                            <input value="<?php if (isset($end_date)) {echo $end_date;}?>" name="end_date" placeholder="End date" type="text" class="form-control">
                                        </div>
                                        <div class="help-block">Created</div>
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
                                    <!-- Search Submit -->
                                    <div class="col-md-1">
                                        <input type="submit" class="btn blue-steel" value="Tìm kiếm" />
                                    </div>

                                </div>
                                <?php echo form_close(); ?>
                        </div>
                        <hr>
                        <br />
                        <hr>
                        <table class="table table-striped table-bordered table-hover" id="table_desc">
                            <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Chủ đề</th>
                                <th>Nội dung tin</th>
                                <th>Ngày gửi</th>
                                <th>Xóa</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($data['item_lists'] as $item) {
                                ?>
                                <!-- BEGIN MODAL CONFIRM DELETE ITEM -->
                                <div class="modal fade" id="<?php echo 'td_confirm_delete_' . $item->feedback_id; ?>" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title text-center">Xác nhận xóa?</h4>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc chắn muốn xóa: <?php echo $item->feedback_name; ?> ?
                                            </div>
                                            <div class="modal-footer">
                                                <?php echo form_open($this->modules_link.'/delete'); ?>
                                                <input type="hidden" name="delete_id" value="<?php echo $item->feedback_id; ?>">
                                                <button type="submit" name="Delete_the_Item" value="<?php echo config_item('confirm_key_delete'); ?>" id="Delete_the_Item_btn_<?php echo $item->feedback_id; ?>" class="btn sbold red"><i class="fa fa-trash-o"></i> Xóa</button>
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
                                    <td><?php echo $item->feedback_name; ?></td>
                                    <td><?php echo $item->feedback_email; ?></td>
                                    <td><?php echo $item->feedback_subject; ?></td>
                                    <td><?php echo $item->feedback_msg; ?></td>
                                    <td><?php echo $item->feedback_created_at; ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-circle sbold dark" data-toggle="modal" href="<?php echo '#td_confirm_delete_' . $item->feedback_id; ?>"><i class="fa fa-trash-o"></i> Xóa</a>
                                    </td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div><!-- End of portlet-body -->
                    <div class="portlet-footer">
                        <hr>
                        <?php if (isset($count_result)) { ?>
                            Total Item: <strong><?php echo $count_result; ?></strong>.
                        <?php } ?>
                    </div><!-- End of portlet-footer-->
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<style>
    .pagination>li>a, .pagination>li>span {
        float: none;
    }
</style>




