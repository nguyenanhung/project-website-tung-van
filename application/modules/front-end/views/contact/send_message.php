<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Contact FORM -->

<form class="contact-form mt-45" id="contact">
    <!-- IF MAIL SENT SUCCESSFULLY -->
    <div id="success">
        <div role="alert" class="alert alert-success">
            <strong>Gửi thành công.</strong>
        </div>
    </div>
    <div id="fail" style="display: none; background-color: #f5f5f5">
        <div role="alert" class="alert alert-success">
            <strong style="color: red;">Điền đầy đủ và chính xác thông tin.</strong>
        </div>
    </div>
    <!-- END IF MAIL SENT SUCCESSFULLY -->
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="form-field">
                <input class="input-sm form-full" id="name" type="text" name="form-name" placeholder="Your Name">
            </div>
            <div class="form-field">
                <input class="input-sm form-full" id="email" type="text" name="form-email" placeholder="Email" >
            </div>
            <div class="form-field">
                <input class="input-sm form-full" id="sub" type="text" name="form-subject" placeholder="Subject">
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="form-field">
                <textarea class="form-full" id="message" rows="7" name="form-message" placeholder="Your Message" ></textarea>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 mt-30">
            <input value="SEND MESSAGE" class="btn-text btn-primary btn send_message" name="Create_new_Items"  type="button" confirm_key_create="<?php echo config_item('confirm_key_create'); ?>" id="Create_new_Items">
        </div>
    </div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- END Contact FORM -->
<style>
    .col-md-12.col-lg-12.mt-30{
        padding-bottom: 55px;
    }
</style>
<script type="text/javascript">
    $('#Create_new_Items').click(function() {
        var name = $('#name').val();
        var email = $('#email').val();
        var sub = $('#sub').val();
        var message = $('#message').val();


        if(name == '' || email == ''){
            $('#fail').show();
        }
        else {
            //lay gia tri cua the co id la nhu the
            var Create_new_Items = $('#Create_new_Items').attr('confirm_key_create');
            $.ajax({
                type : 'POST', //kiểu post
                url  : "<?php echo base_url().'lien-he/send-message' ?>", //gửi dữ liệu sang controller
                data : {
                    Create_new_Items : Create_new_Items, // a:b a la bien ben controller, b la trong database
                    username : name,
                    email : email,
                    sub : sub,
                    message : message
                },
                dataType:"json",
                success: function(result){
                    setTimeout(function() {
                        $('#name').val('');
                        $('#email').val('');
                        $('#sub').val('');
                        $('#message').val('');

                        $('#success').fadeIn(400);

                        $('#success').find('div').fadeIn();
                        setTimeout(function() {
                            $('#success').find('div').fadeOut();

                        }, 2500)
                    }, 400);
                    $('#success').show();
                    $('#fail').hide();
                },
                error: function(err){
                    console.log(err);
                },
            });
        }

    });

    // });
</script>