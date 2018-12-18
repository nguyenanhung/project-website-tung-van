<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @Author: thaodt97
 * @Date:   2018-06-12 09:49:54
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-06-20 15:15:52
 */
?>
<!--Intro Section-->
		<div class="page-header">
			<div class="container">
				<h1 class="title">Tin tức</h1>
			</div>
			<div class="breadcrumb-box">
				<div class="container">
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="#">Home</a>
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
					<!-- Post Bar -->
					<div class="col-lg-9 col-md-9 blog-post-hr post-section">
						<div class="blog-post mb-30">
							<div class="post-meta">
								<span>by <a href="javascript:avoid(0);">Admin</a>,</span><span> <a href="javascript:avoid(0);"><i class="fa fa-comment-o"></i> <?php echo $item->comment; ?></a>,</span>
								<div class="fb-share-button" data-href="<?php echo seo_url_post($item->post_id, $item->slugs, $item->cat_slugs) ?>" data-layout="button" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fweb.tungvan.io%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
							</div>
							<div class="post-header">
								<h2><?php echo $item->title ?></h2>
							</div>
							<div class="post-media">
								<img src="<?php echo images_url($item->photo); ?>" alt=""><span class="event-calender blog-date"> <?php echo date('j',strtotime($item->created_at)); ?> <span><?php echo date('F',strtotime($item->created_at)); ?></span> </span>
							</div>
							<div class="post-entry">
								<p>
									<?php echo $item->summary; ?>
								</p>
								<p>
									<?php echo $item->content; ?>
								</p>
								
							</div>
							<div class="post-tag pull-left">
								<i class="fa fa-tag"></i><span><?php echo $item->tags; ?></span>
							</div>
						</div>
						<hr />
						<div class="clearfix"></div>
						<?php echo modules::run('front-end/news/set_comment',$item->id) ?>
					</div>
					<!-- End Post Bar -->
					<?php echo modules::run('front-end/news/news_sidebar','recent') ?>
				</div>
			</div>
		</section>
		<!-- End Blog Post Section -->
				
