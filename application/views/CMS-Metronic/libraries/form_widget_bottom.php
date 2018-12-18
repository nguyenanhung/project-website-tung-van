<!--[if lt IE 9]>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/respond.min.js"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/excanvas.min.js"></script> 
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<!--<script src="--><?php //echo assets_themes('metronic'); ?><!--global/plugins/jquery.min.js" type="text/javascript"></script>-->
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- <script src="<?php //echo assets_themes('metronic'); ?>global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script> -->
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo editor_url('ckeditor_admin/ckeditor.js?v=1.2.6'); ?>"></script>
<script src="<?php echo editor_url('ckeditor_assets/js/ckeditor_posts.js?v=1.2.6'); ?>"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/autosize/autosize.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo assets_themes('metronic'); ?>global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo assets_themes('metronic'); ?>pages/scripts/components-bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>pages/scripts/components-form-tools.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>pages/scripts/components-select2.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>pages/scripts/components-bootstrap-tagsinput.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo assets_themes('metronic'); ?>layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?php echo assets_themes('metronic'); ?>layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<script type="text/javascript">
    $(document).ready(function () {
        // check upload ảnh hay paste link ảnh --- CMS NEWS POST
        $('#paste_url_image').css('display', 'none');
        $('#check_upload').on('switchChange.bootstrapSwitch', function() {
            if ($("#check_upload").is(':checked')) {
                $('#select_image_to_upload').css('display', 'block');
                $('#paste_url_image').css('display', 'none');
            }
            else {
                $('#select_image_to_upload').css('display', 'none');
                $('#paste_url_image').css('display', 'block');
            }
        });

        // check có change password hay không? USERS MEGAVIEW360
        $('#check_change_pw').on('switchChange.bootstrapSwitch', function() {
            if ($("#check_change_pw").is(':checked')) {
                $('#change_pw').css('display', 'block');
            }
            else {
                $('#change_pw').css('display', 'none');
            }
        });
    });

    CKEDITOR.replace( 'editor1', {
        extraPlugins: 'image'
    });
</script>

<!-- Add more config in create config -->
<script type="text/javascript">
    $(document).ready(function(){
        var i=1;

        $('#add_config').click(function(){
            i++;
            $('#config_field').append('<tr id="row'+i+'" class="dynamic-added odd gradeX">\n' +
                '<td><input name="id[]" placeholder="Nhập ID cấu hình" type="text" required="required" class="form-control">\n' +
                '<td><input name="label[]" placeholder="Nhập tên nhãn" type="text" class="form-control">\n'+
                '<td><input name="value[]" placeholder="Nhập giá trị" type="text" required="required" class="form-control">\n' +
                '<td><select name="type[]" class="select2-multiple form-control" data-style="blue">\n' +
                '                                        <option value="0">Chuỗi</option>\n' +
                '                                        <option value="1">Số</option>\n' +
                '                                        <option value="2">Json</option>\n' +
                '                                    </select></td>\n' +
                '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove_options">-</button></td></tr>');
        });
        $(document).on('click', '.btn_remove_options', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
    });
</script>

<!-- Add more option in create option -->
<script type="text/javascript">
    $(document).ready(function(){
        var i=1;

        $('#add_options').click(function(){
            i++;
            $('#options_field').append('<tr id="row'+i+'" class="dynamic-added odd gradeX"><td><input name="name[]" placeholder="Nhập tên option" type="text" class="form-control">\n' +
                '<td><input name="value[]" placeholder="Nhập giá trị" type="text" required="required" class="form-control">\n' +
                '<td><input name="type[]" placeholder="Nhập loại" type="text" required="required" class="form-control">\n' +
                '<td><input name="order_stt[]" placeholder="Nhập stt" type="text" class="form-control">\n' +
                '<td><input name="icon_font[]" placeholder="Nhập icon" type="text" class="form-control">\n' +
                '<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove_options">-</button></td></tr>');
        });
        $(document).on('click', '.btn_remove_options', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
    });
</script>

<!-- auto input slug -->
<script type="text/javascript">
$(document).ready(function(){
    $('#input_name').keyup(function(){
        var title, slug;
 
                //Lấy text từ thẻ input title 
                title = document.getElementById("input_name").value;
 
                //Đổi chữ hoa thành chữ thường
                slug = title.toLowerCase();
 
                //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
                document.getElementById('slug').value = slug;
    })
})
</script>

