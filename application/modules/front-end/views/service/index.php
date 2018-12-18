<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--Servisec section Here-->
<section id="our-services" class="padding ptb-xs-40 text-center">

    <div class="container">

        <div class="row pb-60 text-center">
            <div class=" col-lg-8 offset-lg-2">
                <div class="heading_box mb-20">
                    <h2>Sản phẩm</h2>
                    <span class="b-line"></span>
                </div>
                <p>
                    Các dịch vụ đã thực hiện
                </p>
            </div>
        </div>
        <!--Team Carousel -->
        <div class="row">
            <div id="team-carousel" class="team-carousel nf-carousel-theme">
                <?php foreach ($services as $item) { ?>
                    <div class="item dental">
                        <div class="team-item ">
                            <div class="team-item-img">
                                <div class="featured-item feature-bg-box mb-100 gray-bg">
                                    <div class="icon">
                                        <i class="<?php echo $item->icon_font?>"></i>
                                    </div>
                                    <div class="title">
                                        <h3><?php echo $item->name ?></h3>
                                    </div>
                                    <div class="desc">
                                        <?php echo $item->value ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!--End Team Carousel -->
    </div>
</section>

<style>
#our-services{
    background: #fff;
}
</style>
<!--Servisec section Here-->
