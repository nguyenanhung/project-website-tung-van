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
            <li><a href="<?php echo site_url(); ?>">Trang chủ</a><i class="fa fa-circle"></i></li>
            <li><a href="<?php echo site_url(config_item('modules_url_cms_manage')); ?>">Dashboard</a><i
               class="fa fa-circle"></i></li>
            <li>
               <a href="<?php echo site_url($this->modules_link . '/index'); ?>"><?php echo $this->modules_name; ?></a><i
                  class="fa fa-circle"></i>
            </li>
            <li><span><?php echo $data['title']; ?></span></li>
         </ul>
         <!-- Page Toolbar -->
         <div class="page-toolbar">
            <div class="btn-group pull-right">
               <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown">Hành động <i class="fa fa-angle-down"></i></button>
               <ul class="dropdown-menu pull-right" role="menu">
                  <li><a href="<?php echo site_url($this->modules_link . '/create'); ?>"><i class="icon-plus"></i>Thêm mới</a>
                  </li>
                  <li class="divider"></li>
                  <li><a href="<?php echo site_url($this->modules_link); ?>"><i class="icon-list"></i> Danh sách</a>
                  </li>
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
                     <a href="<?php echo site_url($this->modules_link . '/create'); ?>" title="Add new Item">
                     <button id="add_new_item_btn" class="btn sbold green"> Thêm mới <i
                        class="fa fa-plus"></i></button>
                     </a>
                  </div>
               </div>
               <!-- End of portlet-title -->
               <div class="portlet-body">
                  <div class="table-toolbar">
                     <form action="<?php echo site_url($this->modules_link); ?>" method="GET"
                        class="form-horizontal form-bordered" id="filter_box">
                     <div class="row">
                        <!-- Filter Username -->
                        <div class="col-md-3">
                           <input type="text" name="username" value="<?php if (isset($username)) {echo $is_username;} ?>" placeholder="Tên" class="form-control">
                           <div class="help-block">Nhập tên</div>
                        </div>
                        <!-- Filter Groups -->
                        <div class="col-md-2">
                           <select name="level" class="bs-select form-control" data-style="blue">
                              <option value="select_level">Chọn nhóm</option>
                              <option <?php if (isset($level) && $level == 1) echo 'selected';?> value="1">ADMIN</option>
                              <option <?php if (isset($level) && $level == 2) echo 'selected';?> value="2">Biên tập viên</option>
                           </select>
                           <div class="help-block">Nhóm người dùng</div>
                        </div>
                        <!-- Filter Date -->
                        <div class="col-md-4">
                           <div class="input-group input-large date-picker input-daterange" data-date="2012-11-10" data-date-format="yyyy-mm-dd">
                              <input value="<?php if (isset($begin_date)) {echo $begin_date;} ?>" name="begin_date" placeholder="Bắt đầu" type="text" class="form-control"><span class="input-group-addon"> đến </span>
                              <input value="<?php if (isset($end_date)) {echo $end_date;}?>" name="end_date" placeholder="Kết thúc" type="text" class="form-control">
                           </div>
                           <div class="help-block">Ngày tạo</div>
                        </div>
                        <!-- Filter MAX Results -->
                        <div class="col-md-2">
                           <select name="max_results" class="bs-select form-control" data-style="red">
                              <option value="75"<?php if (isset($max_results) && $max_results == '75') {
                                 echo " selected";
                                 } ?>>Mặc định
                              </option>
                              <option value="150"<?php if (isset($max_results) && $max_results == '150') {
                                 echo " selected";
                                 } ?>>150 kết quả
                              </option>
                              <option value="300"<?php if (isset($max_results) && $max_results == '300') {
                                 echo " selected";
                                 } ?>>300 kết quả
                              </option>
                              <option value="450"<?php if (isset($max_results) && $max_results == '450') {
                                 echo " selected";
                                 } ?>>450 kết quả
                              </option>
                              <option value="600"<?php if (isset($max_results) && $max_results == '600') {
                                 echo " selected";
                                 } ?>>600 kết quả
                              </option>
                              <option value="750"<?php if (isset($max_results) && $max_results == '750') {
                                 echo " selected";
                                 } ?>>750 kết quả
                              </option>
                           </select>
                           <div class="help-block">Số kết quả tối đa</div>
                        </div>
                        <!-- Filter Page Results -->
                        <?php
                           if ($count_result > $is_max_results) {
                               // GET Page Number
                               if (isset($page) && is_numeric($page)) {
                                   $page_number = $page;
                               } else {
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
                           <div class="help-block">Page<strong><?php echo $page_number; ?></strong>of<strong><?php echo $total_page_number; ?></strong>
                           </div>
                        </div>
                        <?php } ?>
                        <!-- Search Submit -->
                        <div class="col-md-1">
                           <input type="submit" class="btn blue-steel" value="Filter"/>
                        </div>
                     </div>
                     <?php echo form_close(); ?>
                  </div>
                  <hr>
                  <br/>
                  <hr>
                  <table class="table table-striped table-bordered table-hover" id="table_desc">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Ảnh</th>
                           <th>Tên</th>
                           <th>Trạng thái</th>
                           <th>Nhóm</th>
                           <th>Lịch sử truy cập</th>
                           <th>Ngày tạo</th>
                           <th>Sửa</th>
                           <th>Xóa</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach ($data['item_lists'] as $item) {
                           if ($item->user_status == '1') {
                               $user_status = '<strong class="font-red-thunderbird">Kích hoạt</strong>';
                           } elseif ($item->user_status == '2') {
                               $user_status = '<strong class="font-blue">Chờ</strong>';
                           } else {
                               $user_status = '<strong class="font-grey-salt">Khóa</strong>';
                           }
                           ?>
                        <!-- BEGIN MODAL CONFIRM DELETE ITEM -->
                        <div class="modal fade" id="<?php echo 'td_confirm_delete_' . encodeId_Url_byHungDEV($item->user_id); ?>" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title text-center">Xác nhận xóa?</h4>
                                 </div>
                                 <div class="modal-body">Bạn có chắc chắn muốn xóa: <?php echo $item->username; ?> ?
                                 </div>
                                 <div class="modal-footer">
                                    <?php echo form_open($this->modules_link . '/delete'); ?>
                                    <input type="hidden" name="delete_id" value="<?php echo encodeId_Url_byHungDEV($item->user_id); ?>">
                                    <button type="submit" name="Delete_the_Item" value="<?php echo config_item('confirm_key_delete'); ?>" id="Delete_the_Item_btn_<?php echo encodeId_Url_byHungDEV($item->user_id); ?>" class="btn sbold red"><i class="fa fa-trash-o"></i> Xóa
                                    </button>
                                    <?php echo form_close(); ?>
                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Đóng
                                    </button>
                                 </div>
                              </div>
                              <!-- /.modal-content -->
                           </div>
                           <!-- /.modal-dialog -->
                        </div>
                        <!-- END MODAL -->

               </div>
               <tr class="odd gradeX">
               <td><?php echo $item->user_id; ?></td>
               <td><img src="<?php echo $item->user_thumb; ?>" width="30px"/></td>
               <td><?php echo $item->username; ?></td>
               <td><?php echo $user_status; ?></td>
               <td class= "
               <?php if ($item->group_id == 1) echo 'font-red'; else echo 'font-blue'; ?>" >
               	<?php if ($item->group_id == 1) echo 'ADMIN'; else echo 'Biên tập viên';  ?>
               	
               </td>
              
               <td class="text-center"><a data-user-id="<?php echo encodeId_Url_byHungDEV($item->user_id); ?>" title="Xem chi tiết" class="td_tooltip btn btn-sm btn-circle sbold green"><i class="fa fa-search"></i></a>
               </td>
               <td><?php echo $item->user_created_at; ?></td>
               <td>
               <a href="<?php echo site_url($this->modules_link . '/edit/' . encodeId_Url_byHungDEV($item->user_id)); ?>"
                  class="btn btn-circle btn-sm green"><i class="fa fa-edit"></i> Edit</a></td>
               <td>
               <a class="btn btn-sm btn-circle sbold dark" data-toggle="modal"
                  href="<?php echo '#td_confirm_delete_' . encodeId_Url_byHungDEV($item->user_id); ?>"><i
                  class="fa fa-trash-o"></i> Delete</a>
               </td>
               </tr>
               <?php } ?>
               </tbody>
               </table>
            </div>
            <!-- End of portlet-body -->
            <div class="portlet-footer">
               <hr>
               <?php if (isset($count_result)) { ?>
               Total Item: <strong><?= $count_result ?></strong>.
               <?php } ?>
            </div>
            <!-- End of portlet-footer-->
         </div>
         <!-- END EXAMPLE TABLE PORTLET-->
      </div>
   </div>
</div>
<!-- END CONTENT BODY -->
<!-- BEGIN MODAL LIST HISTORY -->
<div class="modal fade" id="td_user_history" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
   <div class="modal-dialog" id="td_modal_dialog">
      <div class="modal-content" id="td_modal_content">
         <div class="modal-header" id="td_modal_header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title text-center">Lịch sử truy cập</h4>
         </div>
         <div class="modal-body" id="modal_body_history">
            <div id="agreement">
            </div>
         </div>
         <div class="modal-footer" id="footer_loading">
            <div class="spinner">
               <div class="rect1"></div>
               <div class="rect2"></div>
               <div class="rect3"></div>
               <div class="rect4"></div>
               <div class="rect5"></div>
            </div>
         </div>
         <div class="modal-footer" id="td_modal_footer">
            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Đóng</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- END MODAL LIST HISTORY -->



<div class="modal fade bs-modal-lg" id="ModalSidebarAuthen" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            <h4 class="modal-title">Phân quyền sidebar cho người dùng</h4>
         </div>
         <?php echo form_open_multipart($this->modules_link . '/index', array('class' => 'form-horizontal form-bordered', 'id' => 'form-content')); ?>
         <div class="modal-body">
            <input type="hidden" name="user_id" value="<?php echo encodeId_Url_byHungDEV($item->user_id); ?>" />

            <div style="display: block;max-height: 400px;overflow-y: scroll;" id="box_sidebar_lists">
               
            </div>
         </div>
         <div class="modal-footer">
            <button type="submit" name="Create_sidebar_authentication" value="<?php echo config_item('confirm_key_create'); ?>" id="Create_new_Items" class="btn green btn-outline"><i class="fa fa-check"></i> Phân quyền</button>
            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Đóng</button>
         </div>
         <?php echo form_close(); ?>
      </div>
      <!-- /.modal-content -->
   </div>
</div>

<div class="modal fade bs-modal-lg" id="ModelAuthen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Phân quyền tương tác</h4>
            </div>
            <?php echo form_open_multipart($this->modules_link . '/index', array('class' => 'form-horizontal form-bordered', 'id' => 'form-content')); ?>
            <div class="modal-body">
                <input type="hidden" name="user_id" value="<?php echo encodeId_Url_byHungDEV($item->user_id); ?>">
                <div style="display: block;max-height: 400px;overflow-y: scroll;" id="box_authen_lists">

            </div>
            <div class="modal-footer">
                <button type="submit" name="Create_authentication" value="<?php echo config_item('confirm_key_create'); ?>" id="Create_new_Items" class="btn green btn-outline"><i class="fa fa-check"></i> Phân quyền</button>
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Đóng</button>
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
</div>

<script>
   $(document).ready(function () {
       var check_send_request = true;
       $('#footer_loading').css('display', 'none');
       var page = 0;
       var user_id = 0;
       $('.td_tooltip').tooltip({
           "placement": "top",
           "trigger": "hover"
       });
       // event click open modal
       $('.td_tooltip').on('click', function (e) {
           page = 0;
           check_send_request = true;
           e.preventDefault();
           user_id = $(this).attr('data-user-id');
           $('#modal_body_history #agreement').empty();
           $('#modal_body_history').scrollTop(1);
           $.post("<?php echo site_url('cms-users/get_history'); ?>", {
               user_id: user_id,
               page: page
           }, function (result) {
               if (jQuery.isEmptyObject(result)) {
                   $('#modal_body_history #agreement').append('<p>Không có lịch sử truy cập của người dùng!</p>');
                   $('#modal_body_history').height('100px');
               }
               else {
                   $('#modal_body_history').height('500px');
                   $.each(result, function (index, value) {
                       param = jQuery.parseJSON(value['params']);
                       created_at = value['created_at'];
                       module = value['module'];
                       action = value['action'];
                       ip_address = param['ip_address'] || '';
                       user_agent = param['user_agent'] || '';
   
                       html = '<div class="note note-info" style="overflow:hidden;"><h5 class="block">Phiên làm việc lúc: <strong>' + created_at + ' </strong></h5> <h5 class="block"> <i class="fa fa-info-circle" aria-hidden="true"></i> Module: ' + module + ' </h5> <h5 class="block"> <i class="fa fa-info-circle" aria-hidden="true"></i> Action: ' + action + ' </h5> <h5 class="block"> <i class="fa fa-info-circle" aria-hidden="true"></i> User Agent: ' + user_agent + ' </h5> <h5 class="block"> <i class="fa fa-info-circle" aria-hidden="true"></i> IP Address: ' + ip_address + ' </h5> </div>';
                       $('#modal_body_history #agreement').append(html);
                   })
               }
           });
           //show modal
           $('#td_user_history').modal();
       });
   
       // event scroll end modal
       $('#modal_body_history').scroll(function () {
           var margin_bottom = parseInt($('.note-info').css("margin-bottom"));
           if (($('#agreement').height() + margin_bottom) === ($(this).scrollTop() + $(this).height())) {
               $('#footer_loading').css('display', 'block');
               setTimeout(function () {
                   if (check_send_request) {
                       page++;
                       $.post("<?php echo site_url('cms-users/get_history'); ?>", {
                           user_id: user_id,
                           page: page
                       }, function (result) {
   
                           if (jQuery.isEmptyObject(result)) {
                               check_send_request = false;
                           }
                           else {
                               check_send_request = true;
                               $.each(result, function (index, value) {
                                   param = jQuery.parseJSON(value['params']);
                                   created_at = value['created_at'];
                                   module = value['module'];
                                   action = value['action'];
   
                                   ip_address = param['ip_address'] || '';
                                   user_agent = param['user_agent'] || '';
   
                                   html = '<div class="note note-info" style="overflow:hidden;"><h5 class="block">Phiên làm việc lúc: <strong>' + created_at + ' </strong></h5> <h5 class="block"> <i class="fa fa-info-circle" aria-hidden="true"></i> Module: ' + module + ' </h5> <h5 class="block"> <i class="fa fa-info-circle" aria-hidden="true"></i> Action: ' + action + ' </h5> <h5 class="block"> <i class="fa fa-info-circle" aria-hidden="true"></i> User Agent: ' + user_agent + ' </h5> <h5 class="block"> <i class="fa fa-info-circle" aria-hidden="true"></i> IP Address: ' + ip_address + ' </h5> </div>';
                                   $('#modal_body_history #agreement').append(html);
                               })
                           }
                       });
                   }
                   $('#footer_loading').css('display', 'none');
               }, 1500);
           }
       });
   });
</script>
<style>
   h5.block {
   padding-bottom: 0px;
   padding-top: 0px;
   }
   #modal_body_history {
   height: 500px;
   overflow: auto;
   }
   body.modal-open {
   overflow: hidden !important;
   }
   #footer_loading {
   border-top: none;
   }
   /* style loading */
   #footer_loading {
   position: fixed;
   z-index: 11000;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
   width: 100%;
   background-color: rgba(255, 255, 255, .7);;
   }
   .spinner {
   margin: auto;
   width: 80px;
   height: 50px;
   text-align: center;
   font-size: 10px;
   }
   .spinner > div {
   background-color: #E43A45;
   height: 100%;
   width: 6px;
   display: inline-block;
   -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
   animation: sk-stretchdelay 1.2s infinite ease-in-out;
   }
   .spinner .rect2 {
   -webkit-animation-delay: -1.1s;
   animation-delay: -1.1s;
   }
   .spinner .rect3 {
   -webkit-animation-delay: -1.0s;
   animation-delay: -1.0s;
   }
   .spinner .rect4 {
   -webkit-animation-delay: -0.9s;
   animation-delay: -0.9s;
   }
   .spinner .rect5 {
   -webkit-animation-delay: -0.8s;
   animation-delay: -0.8s;
   }
   @-webkit-keyframes sk-stretchdelay {
   0%, 40%, 100% {
   -webkit-transform: scaleY(0.4)
   }
   20% {
   -webkit-transform: scaleY(1.0)
   }
   }
   @keyframes sk-stretchdelay {
   0%, 40%, 100% {
   transform: scaleY(0.4);
   -webkit-transform: scaleY(0.4);
   }
   20% {
   transform: scaleY(1.0);
   -webkit-transform: scaleY(1.0);
   }
   }

</style>
<script type="text/javascript">
   var BASE_URL_AJAX ='<?php echo site_url(); ?>';
   
       function sidebarData(user_id = false, obj){

           $('#ModalSidebarAuthen input[name=user_id]').val(user_id);

           if(user_id){
               console.log(user_id);
               $.ajax({
                   url:BASE_URL_AJAX + "cms-users/getSidebarData",
                   data:{'user_id' : user_id},
                   type:"POST",
                   success :function(result){

                        $('#box_sidebar_lists').html(result);
                        $("#ModalSidebarAuthen").modal('toggle');

                   }
               })
           
           }
           
       }
   
</script>
    <script type="text/javascript">
        var BASE_URL_AJAX ='<?php echo site_url(); ?>';

        function authenData(user_id = false, obj){

            $('#ModelAuthen input[name=user_id]').val(user_id);

            if(user_id){
                console.log(user_id);
                $.ajax({
                    url:BASE_URL_AJAX + "cms-users/getAuthenData",
                    data:{'user_id' : user_id},
                    type:"POST",
                    success :function(result){

                        $('#box_authen_lists').html(result);
                        $("#ModelAuthen").modal('toggle');

                    }
                })

            }

        }

    </script>