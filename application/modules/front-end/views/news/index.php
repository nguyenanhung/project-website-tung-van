<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @Author: thaodt97
 * @Date:   2018-06-12 09:49:43
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-06-26 13:55:10
 */
?>
<!--Blog Section-->
<div id="blog-section" class="ptb ptb-xs-40">
	<div class="container">
		<div class="row pb-30 text-center">
			<div class=" col-lg-8 offset-lg-2">
				<div class="heading_box mb-20">
					<h2><span>Tin tức</span> sự kiện</h2>
					<span class="b-line"></span>
				</div>
				<p>
					<?php echo $this->db_config->get_data('site_news'); ?>
				</p>
			</div>
		</div>

		<div class="row">
			<?php foreach ($list_item as $item) { ?>
				<div class="col-lg-4 mb-xs-30 mb-sm-30">
					<div class="blog-post">
						<div class="post-media ">
							<img src="<?php echo images_url($item->photos) ?>" alt="" style='height: 255px;width: 322px;'><span class="event-calender blog-date"> <?php echo date('j',strtotime($item->created_at)); ?> <span><?php echo date('F',strtotime($item->created_at)); ?></span> </span>
						</div>
						<div class="post-meta">
							<span>by <a href="javascript:avoid(0);">Admin</a>,</span><span> <a href="javascript:avoid(0);"><i class="fa fa-comment-o"></i> <?php echo $item->comment ?></a>,</span>
							<div class="fb-share-button" data-href="<?php echo seo_url_post($item->post_id, $item->slugs, $item->cat_slugs) ?>" data-layout="button" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fweb.tungvan.io%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
						</div>
						<div class="post-header">
							<h3><a href="<?php echo seo_url_post($item->post_id, $item->slugs, $item->cat_slugs) ?>"><?php echo $item->title; ?></a></h3>
						</div>
						<div class="post-entry">
							<p>
								<?php echo character_limiter($item->summary,90); ?>
							</p>
						</div>
						<div class="post-more-link pull-left">
							<a href="<?php echo seo_url_post($item->post_id, $item->slugs, $item->cat_slugs) ?>" class="btn-text">Xem thêm</a>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<!--Blog Section End-->
