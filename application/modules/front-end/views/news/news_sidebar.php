<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @Author: thaodt97
 * @Date:   2018-06-12 14:23:12
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-07-09 15:12:29
 */
?>
<!-- Sidebar -->
<div class="col-md-3 col-lg-3 mt-sm-60">
	<!-- <div class="sidebar-widget">
		<h5>Tìm kiếm</h5>
		<div class="widget-search pt-15">
			<input class="form-full input-lg" type="text" value="" placeholder="Search Here" name="search" id="wid-search">
			<input type="submit" value="" name="email" id="wid-s-sub">
		</div>
	</div>
-->	<div class="sidebar-widget">
	<h5>Danh mục</h5>
	<hr>
	<ul class="categories">
		<?php foreach ($list_category as $category ) { ?>
			<li>
				<a href="<?php echo site_url('tin-tuc/' . $category->cat_slugs) ?>"><?php echo $category->cat_name; ?></a>
			</li>
		<?php } ?>
	</ul>
</div>
<div class="sidebar-widget">
	<h5>Bài viết mới nhất</h5>
	<hr>
	<ul class="widget-post pt-15">
		<?php foreach ($list_item as $item) { ?>
			<li>
				<a class="widget-post-media" href="<?php echo seo_url_post($item->post_id, $item->slugs, $item->cat_slugs) ?>"> <img src="<?php echo images_url($item->thumbnail); ?>" alt=""> </a>
				<div class="widget-post-info">
					<h6><a href="<?php echo seo_url_post($item->post_id, $item->slugs, $item->cat_slugs); ?>"><?php echo character_limiter($item->title, 30) ?></a></h6>
					<div class="post-meta">
						<span> <a href="<?php echo seo_url_post($item->post_id, $item->slugs, $item->cat_slugs) ?>"><i class="fa fa-comment-o"></i> <?php echo $item->comment; ?></a>, </span><span><?php echo date('j F',strtotime($item->created_at)); ?></span>
					</div>
				</div>
			</li>
		<?php } ?>
	</ul>
</div>
	<!-- <div class="sidebar-widget">
		<h5>Tags phổ biến</h5>
		<hr>
		<ul class="widget-tag pt-15">
			<?php foreach ($array_tag as $tag) { ?>
			<li>
				<a><?php echo $tag; ?></a>
			</li>
			<?php } ?>
		</ul>
	</div> -->
	<div class="sidebar-widget">
		<h5>Tin tuyển dụng</h5>
		<hr>
		<ul class="categories">

			<?php foreach ($list_job as $job ) {
				if ($job->created_at >= config_item('cf_date')) {
					$type = "new";
				} else {
					$type = $job->type == 2 ? 'hot' : '';
				}
				?>
				<li><a class="<?php echo $type ?>"
					href="<?php echo base_url('tuyen-dung/') . $job->slugs ?>"><?php echo $job->title ?></a>
				</li>
			<?php } ?>
		</ul>
	</div>
</div>
<!-- End Sidebar -->
<style>
.hot {
	background: url(<?php echo base_url('assets/images/').'hot.gif' ?>) right 10px  no-repeat;
	padding-right: 24px !important;
}

.new {
	background: url(<?php echo base_url('assets/images/').'new.gif' ?>) right top no-repeat;
	background-size: 35px 28px;
	padding-right: 35px;
	height: 70px;
	margin: 0 0 15px;
	overflow: hidden;
	width: 100%;
}

a.hot {
	display: inline-block !important;
}

</style>