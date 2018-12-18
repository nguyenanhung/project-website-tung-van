<!-- HEADER -->
<header id="header" class="header">
	<div id="top-bar" class="top-bar-section top-bar-bg-color hidden-sm-down">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Top Contact -->
					<div class="top-contact link-hover-black hidden-xs">
						<div class="info">
							<div class="info-item">
								<span class="fa fa-phone"></span> <?php echo $this->db_config->get_data('site_phone'); ?>
							</div>
							<div class="info-item">
								<span class="fa fa-clock-o"></span> <?php echo $this->db_config->get_data('service_day'); ?>
							</div>
							<div class="info-item">
								<span class="fa fa-envelope-o"></span><a href="mailto:info0@support0.com" title=""> <?php echo $this->db_config->get_data('site_email'); ?></a>
							</div>

						</div>
					</div>
					<!-- Top Social Icon -->
					<div class="top-social-icon icons-hover-black">
						<div class="icons-hover-black">
							<a href="javascript:avoid(0);"> <i class="fa fa-facebook"></i> </a><a href="javascript:avoid(0);"> <i class="fa fa-twitter"></i> </a><a href="javascript:avoid(0);"> <i class="fa fa-youtube"></i> </a><a href="javascript:avoid(0);"> <i class="fa fa-dribbble"></i> </a><a href="javascript:avoid(0);"> <i class="fa fa-linkedin"></i> </a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

			<!-- <div class="nav-wrap">
				<div class="container">
					<div class="row">
						<div class="col-md-3">
							<div class="logo">
								<a href="javascript:avoid(0);"><img src="http://theembazaar.com/demo/nainotheme/gobusiness/assets/images/logo.png" alt="Mega business"></a>
							</div>
							<!-- Phone Menu button -->
							<!-- <button id="menu" class="menu hidden-md-up"></button>
						</div>
						<div class="col-md-9 nav-bg">
							<nav class="navigation">
								<ul>
									<li>
										<a href="#">Trang chủ</a> <i class="ion-ios-plus-empty hidden-md-up"></i>
										<ul class="sub-nav">
											<li>
												<a href="index.html">Homepage 1</a>
											</li>
											<li>
												<a href="index2.html">Homepage 2</a>
											</li>
										</ul>
									</li>
									<li> -->
										<!-- <a href="<?php //echo config_item('modules_url_frontend_web_tung_van_about_details'); ?>">Về chúng tôi</a> -->
										<!-- <a href="<?php echo base_url('front-end/about/details') ?>">Về chúng tôi</a>
									</li>
									
									<li>
										<a href="<?php echo base_url('front-end/product/details') ?>">Sản phẩm</a><i class="ion-ios-plus-empty hidden-md-up"></i>
									</li>
									<li>
										<a href="#">Dịch vụ</a><i class="ion-ios-plus-empty hidden-md-up"></i>
									</li>
									<li>
										<a href="<?php echo base_url('front-end/news/news_page') ?>">Tin tức</a><i class="ion-ios-plus-empty hidden-md-up"></i>
									</li>
									<li>
										<a href="#">Tuyển dụng</a><i class="ion-ios-plus-empty hidden-md-up"></i>
										<ul class="sub-nav">
											<li>
												<a href="blog.html">Blog</a>
											</li>
											<li>
												<a href="blog-detail.html">Blog Details</a>
											</li>
										</ul>
									</li>
									<li>
										<a href="<?php echo base_url('front-end/contact/details') ?>">Liên hệ</a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div> -->

			<div class="nav-wrap">
				<div class="container">
					
					<div class="col-md-3">
						<div class="logo">
							<a href="<?php echo base_url(); ?>"><img src="http://vcms.gviet.vn/assets/images/logo-gviet.png" alt="Mega business"></a>
						</div>
						<!-- Phone Menu button -->
						
					</div>
					<div class="col-md-9 nav-bg">
						<button id="menu" class="menu hidden-md-up"></button>
						<nav class="navigation">
							<?php echo $this->showmenu->showCategories();	 ?>
						</nav>
					</div>
				</div>
			</div>

			
		</header>
		<!-- HEADER-END -->
		<style>

			.active {
				color: #0c90ce !important;
			}
	</style>