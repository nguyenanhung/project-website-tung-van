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
                <li><a href="<?php echo site_url(config_item('modules_url_cms_manage')); ?>">Dashboard</a></li>
            </ul>
            <!-- Page Toolbar -->
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions <i class="fa fa-angle-down"></i></button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="<?php echo site_url($this->modules_link); ?>"><i class="icon-list"></i> List Item</a></li>
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
                    </div><!-- End of portlet-title -->
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <form action="<?php echo site_url($this->modules_link); ?>" method="GET" class="form-horizontal form-bordered" id="filter_box">
                                <div class="row">
                                    <!-- Filter user_id -->
                                    <div class="col-md-3">
                                        <select name="user_id" class="select2-multiple form-control" data-style="blue">
                                            <option value="select_user_id">Chọn username</option>
                                            <?php foreach ($user_list as $users) {?>
                                                <option <?php if (isset($user_id) && $user_id === $users->id) echo "selected"; ?> value="<?php echo $users->id ?>"><?php echo $users->username ?></option>

                                            <?php } ?>
                                        </select>
                                        <div class="help-block">Username</div>
                                    </div>

                                    <!-- Filter module -->
                                    <div class="col-md-3">
                                        <select name="module" class="select2-multiple form-control" data-style="blue">
                                            <option value="select_module">Chọn Module</option>
                                            <?php foreach ($module_list as $modules) {?>
                                                <option <?php if (isset($module) && $module === $modules->module) echo "selected"; ?> value="<?php echo $modules->module ?>"><?php echo $modules->module ?></option>

                                            <?php } ?>
                                        </select>
                                        <div class="help-block">Module</div>
                                    </div>

                                    <!-- Filter controller -->
                                    <div class="col-md-3">
                                        <select name="controller" class="select2-multiple form-control" data-style="blue">
                                            <option value="select_controller">Chọn Controller</option>
                                            <?php foreach ($controller_list as $controllers) {?>
                                                <option <?php if (isset($controller) && $controller === $controllers->controller) echo "selected"; ?> value="<?php echo $controllers->controller ?>"><?php echo $controllers->controller ?></option>

                                            <?php } ?>
                                        </select>
                                        <div class="help-block">Controller</div>
                                    </div>

                                    <!-- Filter action -->
                                    <div class="col-md-3">
                                        <select name="action" class="select2-multiple form-control" data-style="blue">
                                            <option value="select_action">Chọn Action</option>
                                            <?php foreach ($action_list as $actions) {?>
                                                <option <?php if (isset($action) && $action === $actions->action) echo "selected"; ?> value="<?php echo $actions->action ?>"><?php echo $actions->action ?></option>

                                            <?php } ?>
                                        </select>
                                        <div class="help-block">Action</div>
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

                        <br />
                        <hr>
                        <table class="table table-striped table-bordered table-hover" id="table_desc">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Module</th>
                                <th>Controller</th>
                                <th>Action</th>
                                <th>Params</th>
                                <th>Thời gian</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($data['item_lists'] as $item) { ?>
                                <!-- BEGIN MODAL -->
                                    <div class="modal fade" id="<?php echo 'params_detail' . $item->id; ?>" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title text-center">Thông tin chi tiết</h4>
                                                </div>
                                                <div class="modal-body" style="word-wrap: break-word;">
                                                    <?php
                                                    echo '<pre>';
                                                    echo $item->params;
                                                    echo '</pre>';
                                                    ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Đóng</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                <!-- END MODAL -->

                                <tr class="odd gradeX">
                                    <td><?php echo $item->id; ?></td>
                                    <td><?php echo $item->username; ?></td>
                                    <td><?php echo $item->module; ?></td>
                                    <td><?php echo $item->controller; ?></td>
                                    <td><?php echo $item->action; ?></td>
                                    <td>
                                        <a class="btn blue btn-outline" data-toggle="modal" href="<?php echo '#params_detail' . $item->id ?>">Chi tiết</a>
                                    </td>
                                    <td><?php echo $item->created_at; ?></td>
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

