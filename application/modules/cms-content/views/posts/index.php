<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 1/21/2017
 * Time: 10:10 PM
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

                                    <!-- Filter Categories -->
                                    <div class="col-md-3">
                                        <select name="categories" class="select2-multiple form-control" data-style="blue">
                                            <option value="select_status">Thể loại</option>

                                            <?php $this->sub_categories->get_sub_categories($categories_lists, $categories);  ?>

                                        </select>
                                        <div class="help-block">Thể loại</div>
                                    </div>

                                    <!-- Filter type -->
                                    <div class="col-md-3">
                                        <select name="type" class="bs-select form-control" data-style="green-meadow">
                                            <option value="select_type">Loại tin</option>

                                            <?php foreach (config_item('post_type') as $key => $value) {?>

                                                <option <?php if (isset($type) && $is_type === $key) echo "selected"; ?> value="<?php echo $key ?>"><?php echo $value ; ?></option>

                                            <?php } ?>

                                        </select>
                                        <div class="help-block">Loại tin</div>
                                    </div>

                                    <!-- Filter status -->
                                    <div class="col-md-3">
                                        <select name="status" class="bs-select form-control" data-style="blue">
                                            <option value="select_status">Trạng thái</option>

                                            <?php foreach (config_item('post_status') as $key => $value) {?>

                                                <option <?php if (isset($status) && $is_status === $key) echo "selected"; ?> value="<?php echo $key ?>"><?php echo $value ; ?></option>


                                            <?php } ?>

                                        </select>
                                        <div class="help-block">Trạng thái</div>
                                    </div>

                                    <!-- Filter show slider -->
                                    <div class="col-md-3">
                                        <select name="status" class="bs-select form-control" data-style="blue">
                                            <option value="select_status">Trạng thái silde</option>

                                            <?php foreach (config_item('post_slider') as $key => $value) {?>

                                                <option <?php if (isset($sho_slider) && $is_show_slider === $key) echo "selected"; ?> value="<?php echo $key ?>"><?php echo $value ; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="help-block">Trạng thái silde</div>
                                    </div>

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
                                            <option value="75"<?php if (isset($max_results) && $max_results == '75') {echo " selected";}?>>Max: Default</option>
                                            <option value="150"<?php if (isset($max_results) && $max_results == '150') {echo " selected";}?>>150 kết quả</option>
                                            <option value="300"<?php if (isset($max_results) && $max_results == '300') {echo " selected";}?>>300 kết quả</option>
                                            <option value="450"<?php if (isset($max_results) && $max_results == '450') {echo " selected";}?>>450 kết quả</option>
                                            <option value="600"<?php if (isset($max_results) && $max_results == '600') {echo " selected";}?>>600 kết quả</option>
                                            <option value="750"<?php if (isset($max_results) && $max_results == '750') {echo " selected";}?>>750 kết quả</option>
                                        </select>
                                        <div class="help-block">Max Results</div>
                                    </div>
                                    <!-- Filter Page Results -->
                                    <?php
                                    if ($count_result > $is_max_results)
                                    {
                                        // GET Page Number
                                        if (isset($page) && is_numeric($page))
                                        {
                                            $page_number = $page;
                                        }
                                        else
                                        {
                                            $page_number = '1';
                                        }
                                        // GET Total MAX Page
                                        $total_page_number = ceil($count_result / $is_max_results);
                                        ?>
                                        <div class="col-md-2">
                                            <?php if ($total_page_number <= 100) { ?>
                                                <!-- TH Số lượng Page <= 100 thì dùng Select -->
                                                <select name="page" class="bs-select form-control" data-style="green-meadow"><?php echo select_page($count_result, $is_max_results, $is_page_results); ?></select>
                                            <?php } else { ?>
                                                <!-- TH Số lượng Page > 100 thì dùng Number Filter -->
                                                <input value="<?php echo $page_number; ?>" placeholder="Page Number" type="number" name="page" class="form-control">
                                            <?php } ?>
                                            <div class="help-block">
                                                Page
                                                <strong><?php echo $page_number; ?></strong>
                                                of
                                                <strong><?php echo $total_page_number; ?></strong>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <!-- Search Submit -->
                                    <div class="col-md-1">
                                        <input type="submit" class="btn blue-steel" value="Filter" />
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
                                <th>ID</th>
                                <th>Trạng thái</th>
                                <th>Tên</th>
                                <th>Ảnh</th>
                                <th>Thể loại</th>
                                <th>Loại tin</th>
                                <th>HT trên slide</th>
                                <th>Ngày tạo</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($data['item_lists'] as $item) {
                                ?>
                                <!-- BEGIN MODAL CONFIRM DELETE ITEM -->
                                <div class="modal fade" id="<?php echo 'td_confirm_delete_' . encodeId_Url_byHungDEV($item->posts_id); ?>" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title text-center">Xác nhận xóa?</h4>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc chắn muốn xóa: <?php echo $item->posts_name; ?> ?
                                            </div>
                                            <div class="modal-footer">
                                                <?php echo form_open($this->modules_link.'/delete'); ?>
                                                <input type="hidden" name="delete_id" value="<?php echo encodeId_Url_byHungDEV($item->posts_id); ?>">
                                                <button type="submit" name="Delete_the_Item" value="<?php echo config_item('confirm_key_delete'); ?>" id="Delete_the_Item_btn_<?php echo encodeId_Url_byHungDEV($item->posts_id); ?>" class="btn sbold red"><i class="fa fa-trash-o"></i> Xóa</button>
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
                                    <td><?php echo $item->posts_id; ?></td>
                                    <td class="text-center <?php echo ($item->posts_status == 1) ? " bold uppercase" : "" ?>">
                                        <span>
                                            <?php echo ($item->posts_status == 1) ? "Kích hoạt" : "Không kích hoạt"; ?>
                                        </span>
                                        <br>
                                        <?php $btn = ($item->posts_status == 1)? 'danger': 'info'; ?>
                                        <button type="submit" data="<?php echo $item->posts_id ?>" data-style="<?php echo $item->posts_status ?>" class="btn btn-<?php echo $btn;?> btn-circle sbold  change_post_status"><i class="fa fa-exchange"></i></button>
                                    </td>
                                    <td><a href="<?php echo config_item('wapsite_posts_url').$item->posts_id; ?>.html" target="_blank"><?php echo $item->posts_name; ?></a></td>
                                    <td class="text-center"><img src="<?php echo $item->thumb; ?>" width="60px" /></td>
                                    
                                    <td><?php echo $item->categories_name; ?></td>
                                    <td class="text-center <?php echo ($item->posts_type == 2) ? " bold uppercase" : "" ?>">
                                        <span>
                                            <?php echo ($item->posts_type == 2)? "Hot" : "Thường";  ?>
                                        </span>
                                            <br>
                                        <?php $btn = ($item->posts_type == 2)? 'danger': 'info'; ?>
                                        <button type="submit" data="<?php echo $item->posts_id ?>" data-style="<?php echo $item->posts_type ?>" class="btn btn-<?php echo $btn;?> btn-circle sbold  check_status_type"><i class="fa fa-exchange"></i></button>
                                        <?php echo form_close(); ?>
                                    </td>
                                    <td class="text-center <?php echo ($item->posts_show_slider == 1) ? " bold uppercase" : "" ?>">
                                        <span>
                                            <?php echo ($item->posts_show_slider == 1)? "Hiển thị" : "Không hiển thị";  ?>
                                        </span>
                                            <br>
                                        <?php $btn = ($item->posts_show_slider == 1)? 'danger': 'info'; ?>
                                        <button type="submit" data="<?php echo $item->posts_id ?>" data-style="<?php echo $item->posts_show_slider ?>" class="btn btn-<?php echo $btn;?> btn-circle sbold change_post_show_slider"><i class="fa fa-exchange"></i></button>
                                        <?php echo form_close(); ?>
                                    </td>
                                    <td><?php echo $item->posts_created_at; ?></td>
                                    <td>
                                        <a href="<?php echo site_url($this->modules_link.'/edit/'.encodeId_Url_byHungDEV($item->posts_id)); ?>" class="btn btn-circle btn-sm green"><i class="fa fa-edit"></i> Sửa</a></td>
                                    <td>
                                        <a class="btn btn-sm btn-circle sbold dark" data-toggle="modal" href="<?php echo '#td_confirm_delete_' . encodeId_Url_byHungDEV($item->posts_id); ?>"><i class="fa fa-trash-o"></i> Xóa</a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div><!-- End of portlet-body -->
                    <div class="portlet-footer">
                        <hr>
                        <?php if (isset($count_result)) { ?>
                            Total Item: <strong><?=$count_result?></strong>.
                        <?php } ?>
                    </div><!-- End of portlet-footer-->
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>




