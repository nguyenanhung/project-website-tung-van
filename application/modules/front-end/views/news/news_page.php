<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
		<!--Intro Section-->
		<div class="page-header" style="background: url('<?php echo $this->db_photo->get_data('banner'); ?>') 0 0 no-repeat">
			<div class="container">
				<h1 class="title">Tin tức</h1>
			</div>
			<div class="breadcrumb-box">
				<div class="container">
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="<?php echo base_url();?>">Trang chủ</a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">
								Tin tức
							</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
		<!--Intro Section-->
		<!-- Blog Post Section -->
		<section class="ptb ptb-xs-60">
			<div class="container">
				<div class="row">
					<!-- Post Item -->
					<div class="col-md-9 col-lg-9">
						<div class="row">
							<div class="col-md-12 col-lg-12 blog-post-hr">
								<?php foreach ($item_list as $item) { ?>
								<div class="blog-post mb-45">
									<div class="post-media">
										<img src="<?php echo images_url($item->photos) ?>" alt="" /><span class="event-calender blog-date"> <?php echo date('j',strtotime($item->created_at)); ?> <span><?php echo date('F',strtotime($item->created_at)); ?></span> </span>
									</div>
									<div class="post-meta">
										<span>by <a href="javascript:avoid(0);">Admin</a>,</span><span> <a href="javascript:avoid(0);"><i class="fa fa-comment-o"></i> <?php echo $item->comment; ?></a>,</span>
										<div class="fb-share-button" data-href="<?php echo seo_url_post($item->post_id, $item->slugs, $item->cat_slugs) ?>" data-layout="button" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fweb.tungvan.io%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
									</div>
									<div class="post-header">
										<h2><a href="<?php echo seo_url_post($item->post_id, $item->slugs, $item->cat_slugs) ?>"><?php echo $item->title; ?></a></h2>
									</div>
									<div class="post-entry">
										<p>
											<?php echo $item->summary;?>
										</p>
									</div>
									<div class="post-more-link pull-left">
										<a href="<?php echo seo_url_post($item->post_id, $item->slugs, $item->cat_slugs);  ?>" class="btn-text">Xem thêm</a>
									</div>
								</div>

								<hr />
								<?php } ?>
							</div>
						</div>
						<!-- Pagination Nav -->
						<div class="pagination-nav text-left mt-60 mtb-xs-30">
							<ul>
								<?php echo $paginations; ?>
							</ul>
						</div>
						<!-- End Pagination Nav -->
					</div>
					<!-- End Post Item -->
					<?php echo modules::run('front-end/news/news_sidebar','recent','tin-tuc') ?>
				</div>
			</div>
		</section>
		<!-- End Blog Post Section -->
		