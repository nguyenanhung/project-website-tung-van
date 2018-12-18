<!--Intro Section End-->
<!-- Service Section -->
<div id="services-section" class="padding pt-xs-60">
    <div class="container">
        <div class="row">

            <div class="col-md-9 col-sm-8">
                <h3><?php echo $post->title ?></h3>
                <?php echo $post->content?>
            </div>
            <div class="col-md-3 col-sm-4 col-sx-12">
                <div class="sidebar-widget">
                    <h5>Công việc tương tự</h5>
                    <hr>
                    <ul class="categories">
                        <?php foreach ($related_job as $item ) { ?>
                            <li>
                                <a href="<?php echo site_url('tuyen-dung/' . $item->slugs) ?>"><?php echo $item->title; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="sidebar-widget">
                    <h5>Tin tức</h5>
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
                    <h5>Bài viết nổi bật</h5>
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
            </div>
        </div>
    </div>
</div>
<style>
    div#services-section .col-md-9{
        text-align: justify;
    }
</style>

