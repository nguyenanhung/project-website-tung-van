<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-header" style="background: url('<?php echo $this->db_photo->get_data('banner'); ?>') 0 0 no-repeat">
    <div class="container">
        <h1 class="title"><?php echo $product[0]->title;?></h1>
    </div>
    <div class="breadcrumb-box">
        <div class="container">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#"><?php echo $home[0]->title;?></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php echo $product[0]->title;?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!--Intro Section-->

<!-- Work Section -->
<section id="work" class="padding ptb-xs-60">
    <div class="container">
        <div class="row text-center pb-30">
            <div class="col-md-12 col-lg-12">
                <div class="heading-box ">
                    <h2><?php echo $title[0]->value; ?></h2>
                    <span class="b-line"></span>
                </div>
            </div>
        </div>
        <!-- work Filter -->
        <div class="row">
            <div class="col-md-12">
                <ul class="container-filter categories-filter">
                    <li>
                        <a class="categories active" data-filter="*" name="all">All</a>
                    </li>
                    <?php
                    foreach ($categories as $item ) { ?>
                        <li>
                            <a id="categories "class="categories" data-filter=".<?php echo $item->id?>"><?php echo $item->title?></a>
                        </li>
                    <?php }
                    ?>
                </ul>
            </div>
        </div>
        <!-- End work Filter -->
        <div class="row container-grid nf-col-3">
            <?php
            foreach ($list_product as $item ): ?>
                <div class="nf-item <?php echo $item->categories ?> spacing">
                    <div class="item-box" style="height: 350px">
                        <a style="color: white;"> <img alt="1" src="<?php echo images_url($item->photo);  ?>" class="item-container" style="height: 300px" > <?php echo $item->photo ?> </a>
                        <div class="link-zoom">
                            <a href="<?php echo $item->link ?>"  class="project_links"> <i class="fa fa-link"> </i> </a>
                            <a href="<?php echo images_url($item->photo) ?>" class="fancylight popup-btn" data-fancybox-group="light" > <i class="fa fa-search-plus"></i> </a>
                        </div>
                        <div class="gallery-heading">
                            <h4><a href="<?php echo base_url('front-end/product/details/').$item->name ?>"><?php echo $item->name;?></a></h4>
                            <p>
                                <?php echo character_limiter($item->summary,100)?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
