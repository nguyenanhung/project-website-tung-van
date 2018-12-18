<!--Footer Section Start-->
		<footer id="footer">
			<div id="footer-widgets" class="container style-1">
				<div class="row">
					<div class="col-lg-4 col-md-6">
						<div class="widget widget_text">
							<h2 class="widget-title"><span>VỀ CHÚNG TÔI</span></h2>
							<div class="textwidget">
								<a href="<?php echo base_url(); ?>" class="footer-logo"> <img src="http://vcms.gviet.vn/assets/images/logo-gviet.png" alt="Awesome Logo"> </a>
								<p>
									<?php echo $this->db_config->get_data('site_description') ?>
								</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="widget widget_links">
							<h2 class="widget-title"><span>DANH MỤC</span></h2>
							<ul class="wprt-links clearfix col2">
								<li>
									<a href="<?php echo base_url('ve-chung-toi') ?>">Giới thiệu chung</a>
								</li>
								<li>
									<a href="<?php echo base_url('dich-vu') ?>">Dịch vụ</a>
								</li>
								<li>
									<a href="<?php echo base_url('san-pham') ?>">Sản phẩm</a>
								</li>
								<li>
									<a href="<?php echo base_url('tin-tuc') ?>">Tin tức</a>
								</li>
								<li>
									<a href="<?php echo base_url('tuyen-dung') ?>">Tuyển dụng</a>
								</li>
								<li>
									<a href="<?php echo base_url('lien-he') ?>">Liên hệ</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="widget widget_information">
							<h2 class="widget-title"><span>LIÊN HỆ</span></h2>
							<ul>
								<li class="address clearfix">
									<span class="hl">Address:</span>
									<span class="text"><?php echo $this->db_config->get_data('contact_company_address_1'); ?></span>
								</li>
								<li class="phone clearfix">
									<span class="hl">Phone:</span>
									<span class="text"><?php echo $this->db_config->get_data('site_phone'); ?></span>
								</li>
								<li class="email clearfix">
									<span class="hl">E-mail:</span>
									<span class="text"><?php echo $this->db_config->get_data('site_email'); ?></span>
								</li>
							</ul>
						</div>
						<div class="widget widget_socials">
							<div class="socials">
								<a target="_blank" href="#"><i class="fa fa-twitter"></i></a>
								<a target="_blank" href="#"><i class="fa fa-facebook"></i></a>
								<a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
								<a target="_blank" href="#"><i class="fa fa-pinterest"></i></a>
								<a target="_blank" href="#"><i class="fa fa-dribbble"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="bottom" class="clearfix style-1">
				<div id="bottom-bar-inner" class="wprt-container">
					<div class="bottom-bar-inner-wrap">
						<div class="bottom-bar-content">
							<div id="copyright" class="text-center">
								&copy; 2018 by <strong>Tùng Vân</strong> - <a href="http://tungvan.vn" style="color: red">tungvan.vn</a>
							</div>
							<!-- /#copyright -->
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!--Footer Section End-->

		<a id="back-to-top" href="#"> <i class="ion-ios-arrow-up"></i> </a>