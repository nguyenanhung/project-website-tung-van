<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
<?php echo $data['meta_equiv']; ?>
<?php echo $data['meta_content']; ?>
<?php echo $data['meta_property']; ?>
	<base href="<?php echo base_url(); ?>">
	<title><?php echo $data['site_title']; ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700,800%7CRoboto:300,300i,400,400i" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="<?php echo assets_themes('Go-Bussiness'); ?>css/bootstrap.min.css<?php echo config_item('template_assets_version') ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo assets_themes('Go-Bussiness'); ?>css/font-awesome.css<?php echo config_item('template_assets_version') ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo assets_themes('Go-Bussiness'); ?>css/ionicons.css<?php echo config_item('template_assets_version') ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo assets_themes('Go-Bussiness'); ?>css/simple-line-icons.css<?php echo config_item('template_assets_version') ?>" rel="stylesheet" type="text/css">
	<!--Light box-->
	<link href="<?php echo assets_themes('Go-Bussiness'); ?>css/jquery.fancybox.css<?php echo config_item('template_assets_version') ?>" rel="stylesheet" type="text/css">

	<!--Main Slider-->
	<link href="<?php echo assets_themes('Go-Bussiness'); ?>css/settings.css<?php echo config_item('template_assets_version') ?>" type="text/css" rel="stylesheet" media="screen">
	<link href="<?php echo assets_themes('Go-Bussiness'); ?>css/layers.css<?php echo config_item('template_assets_version') ?>" type="text/css" rel="stylesheet" media="screen">
	<!-- carousel -->
	<link href="<?php echo assets_themes('Go-Bussiness'); ?>css/owl.carousel.css<?php echo config_item('template_assets_version') ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo assets_themes('Go-Bussiness'); ?>css/owl.transitions.css<?php echo config_item('template_assets_version') ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo assets_themes('Go-Bussiness'); ?>css/style.css<?php echo config_item('template_assets_version') ?>" rel="stylesheet">
	<?php $this->load->view('libraries/favicon') ?>

</head>
<body>

	<!-- Go to www.addthis.com/dashboard to customize your tools -->
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b29fec9f2f28c3c"></script>

	<?php $this->load->view($this->web_header); ?>
	<div class="body-wrapper">
		<div id="main">
			<div class="page animated fadeinright">
				<?php 
				if (isset($sub)) {
					if (isset($data)) {
						$this->load->view($sub, $data);
					} else {
						$this->load->view($sub);
					}
				}
				?>
				<!-- Footer -->
			</div><!-- End of Page Contents -->
		</div>
	</div>
	<?php $this->load->view($this->web_footer); ?>
	<script type="text/javascript" src="<?php echo assets_themes('Go-Bussiness'); ?>js/jquery.min.js<?php echo config_item('template_assets_version') ?>"></script>
	<script type="text/javascript" src="<?php echo assets_themes('Go-Bussiness'); ?>js/tether.min.js<?php echo config_item('template_assets_version') ?>"></script>
	<script type="text/javascript" src="<?php echo assets_themes('Go-Bussiness'); ?>js/bootstrap.min.js<?php echo config_item('template_assets_version') ?>"></script>
	<!-- revolution Js -->
	<script type="text/javascript" src="<?php echo assets_themes('Go-Bussiness'); ?>js/jquery.themepunch.tools.min.js<?php echo config_item('template_assets_version') ?>"></script>
	<script type="text/javascript" src="<?php echo assets_themes('Go-Bussiness'); ?>js/jquery.themepunch.revolution.min.js<?php echo config_item('template_assets_version') ?>"></script>
	<script type="text/javascript" src="<?php echo assets_themes('Go-Bussiness'); ?>js/revolution.extension.slideanims.min.js<?php echo config_item('template_assets_version') ?>"></script>
	<script type="text/javascript" src="<?php echo assets_themes('Go-Bussiness'); ?>js/revolution.extension.layeranimation.min.js<?php echo config_item('template_assets_version') ?>"></script>
	<script type="text/javascript" src="<?php echo assets_themes('Go-Bussiness'); ?>js/revolution.extension.navigation.min.js<?php echo config_item('template_assets_version') ?>"></script>
	<script type="text/javascript" src="<?php echo assets_themes('Go-Bussiness'); ?>js/revolution.extension.parallax.min.js<?php echo config_item('template_assets_version') ?>"></script>
	<script type="text/javascript" src="<?php echo assets_themes('Go-Bussiness'); ?>js/jquery.revolution.js<?php echo config_item('template_assets_version') ?>"></script>
	<script src="https://unpkg.com/ionicons@4.1.2/dist/ionicons.js<?php echo config_item('template_assets_version') ?>"></script>
	<!-- fancybox Js -->
	<script src="<?php echo assets_themes('Go-Bussiness'); ?>js/jquery.mousewheel-3.0.6.pack.js<?php echo config_item('template_assets_version') ?>" type="text/javascript"></script>
	<script src="<?php echo assets_themes('Go-Bussiness'); ?>js/jquery.fancybox.pack.js<?php echo config_item('template_assets_version') ?>" type="text/javascript"></script>

	<!-- masonry,isotope Effect Js -->
	<script src="<?php echo assets_themes('Go-Bussiness'); ?>js/imagesloaded.pkgd.min.js<?php echo config_item('template_assets_version') ?>" type="text/javascript"></script>
	<script src="<?php echo assets_themes('Go-Bussiness'); ?>js/isotope.pkgd.min.js<?php echo config_item('template_assets_version') ?>" type="text/javascript"></script>
	<script src="<?php echo assets_themes('Go-Bussiness'); ?>js/masonry.pkgd.min.js<?php echo config_item('template_assets_version') ?>" type="text/javascript"></script>
	<script src="<?php echo assets_themes('Go-Bussiness'); ?>js/jquery.appear.js<?php echo config_item('template_assets_version') ?>" type="text/javascript"></script>

	<!-- parallax Js -->
	<script src="<?php echo assets_themes('Go-Bussiness'); ?>js/jquery.parallax-1.1.3.js<?php echo config_item('template_assets_version') ?>" type="text/javascript"></script>
	<script src="<?php echo assets_themes('Go-Bussiness'); ?>js/jquery.appear.js<?php echo config_item('template_assets_version') ?>" type="text/javascript"></script>
	<!-- carousel Js -->
	<script src="<?php echo assets_themes('Go-Bussiness'); ?>/js/owl.carousel.js<?php echo config_item('template_assets_version') ?>" type="text/javascript"></script>
	<!-- map -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="<?php echo assets_themes('Go-Bussiness'); ?>js/map.js<?php echo config_item('template_assets_version') ?>"></script>
	<script type="text/javascript" src="<?php echo assets_themes('Go-Bussiness'); ?>js/validation.js<?php echo config_item('template_assets_version') ?>"></script>
	<script src="<?php echo assets_themes('Go-Bussiness'); ?>js/custom.js<?php echo config_item('template_assets_version') ?>" type="text/javascript"></script>
	<!-- Load Facebook SDK for JavaScript -->
	<div id="fb-root"></div>
	<script>
		window.fbAsyncInit = function() {
			FB.init({
				appId      : '395048484335689',
				xfbml      : true,
				version    : 'v3.0'
			});

			FB.AppEvents.logPageView();

		};

		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "https://connect.facebook.net/vi_VN/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<!--xử lý them cv-->
	<script type="text/javascript">

		$(document).ready(function(){
			$('.blink').each(function() {
				var elem = $(this);
				setInterval(function() {
					if (elem.css('visibility') == 'hidden') {
						elem.css('visibility', 'visible');
					} else {
						elem.css('visibility', 'hidden');
					}
				}, 400);
			});
		});

	</script>
	<!-- filter job -->
	<script type="text/javascript">
        $(document).ready(function () {
            // $('#result_filter').hide();
            //khai báo nút submit form
            var submit = $("button[type='submit']");
            // alert('ok');
            //khi thực hiện kích vào nút Login
            submit.click(function () {
                // alert('ok');
                var keyword = $("#keyword").val();
                var url = $(this).attr("data-url");
                // alert(url);
                if (keyword == '') {
                    $("#result").html("Bạn cần nhập từ khóa").css('color','red');
                    return false;
                }else{
                    $.ajax({
                        type : 'GET', //kiểu GET
                        url  : url, //gửi dữ liệu sang trang submit.php
                        data : {
                            keyword:keyword
                        },
                        dataType:"json",
                        success: function(result){
                            // console.log(result);
                            var html = '';
                            html += '<h3 style="color: red"> Kết quả tìm kiếm:</h3>'
                            html += '<ul>';
                            // vong lap
                            $.each (result, function (key, item){
                                html +=  '<li>';
                                html +=  '<a href ="<?php echo base_url('tuyen-dung/') ?>'+item['slugs']+ ' " >';
                                html +=  item['title'];
                                html +=  '</a>';
                                html +=  '</li>';
                            });

                            html +=  '</ul>';
                            // var list_job =
                            $('#result_filter').html(html);
                            // $('#list_job').hide();
                            // $('#img').hide();
                        }
                    });
                    return false;
                }
            });
        });
    </script>
</body>
</html>
