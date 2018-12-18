<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-header">
    <div class="container">
        <h1 class="title">Dịch vụ</h1>
    </div>
    <div class="breadcrumb-box">
        <div class="container">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Dịch vụ
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!--Intro Section End-->
<!--Services Section-->
<section class="services-section__block pt-90 pb-70 ptb-xs-60">
    <div class="container">
        <div class="row">
            <?php foreach ($list_pages as $item ): ?>
                <div class="col-sm-4 mb-30">
                    <div class="about-block img-scale  mb-xs-40 clearfix border__b">
                        <figure>
                            <a href="<?php echo base_url('chi-tiet-dich-vu/').$item->slugs?>"><img class="img-responsive" src="<?php echo images_url($item->photo)?>" alt="Photo"></a>
                        </figure>
                        <div class="text-box mt-25">
                            <div class="box-title mb-15">
                                <h3><a href="<?php echo base_url('chi-tiet-dich-vu/').$item->slugs?>"><?php echo $item->title?></a></h3>
                            </div>
                            <div class="text-content mb-20">
                                <p>
                                    <?php echo character_limiter($item->summary,60) ?>
                                </p>
                                <a href="<?php echo base_url('chi-tiet-dich-vu/').$item->slugs?>" class="read__more"><i class="ion-ios-arrow-thin-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php	endforeach ?>
        </div>
    </div>
</section>