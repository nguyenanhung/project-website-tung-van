<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
	<!--  Main Banner Start Here-->
		<div id="banner" class="main-banner banner_up">
			<div id="rev_slider_34_1_wrapper" class="rev_slider_wrapper" data-alias="news-gallery34">
				<!-- START REVOLUTION SLIDER 5.0.7 fullwidth mode -->
				<div id="rev_slider_34_1" class="rev_slider" data-version="5.0.7">
					<ul>
						<?php foreach ($list_item as $item) { ?>
						<!-- SLIDE  -->
						<li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-thumb="assets/images/banner/slider1.jpg"  data-saveperformance="off" >

							<!-- MAIN IMAGE -->
							<img src="<?php echo images_url($item->photos) ?>"  alt=""  class="rev-slidebg" >
							<!-- LAYERS -->
							<!-- LAYER NR. 2 -->
							<div class="tp-caption Newspaper-Title tp-resizeme "
							id="slide-129-layer-1"
							data-x="['left','left','left','left']" data-hoffset="['100','50','50','30']"
							data-y="['center','center','center','center']" data-voffset="['0','0','0','0']"
							data-fontsize="['50','50','50','30']"
							data-lineheight="['55','55','55','35']"
							data-width="['600','600','600','420']"
							data-height="none"
							data-whitespace="normal"
							data-transform_idle="o:1;"
							data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;"
							data-transform_out="auto:auto;s:1000;e:Power3.easeInOut;"
							data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
							data-mask_out="x:0;y:0;s:inherit;e:inherit;"
							data-start="1000"
							data-splitin="none"
							data-splitout="none"
							data-responsive_offset="on" >
								<div class="banner-text">
									<h2><?php echo $item->title; ?></h2>
									<p>
										<?php echo $item->summary;  ?>
									</p>
									<a class="btn-text" href="<?php echo seo_url_post($item->post_id, $item->slugs, $item->cat_slugs); ?>"> Xem thêm</a>
								</div>
							</div>
						</li>
						<?php } ?>
					</ul>
					<div class="tp-bannertimer tp-bottom"></div>
				</div>
			</div>
		</div>
		<!--  Main Banner End Here-->