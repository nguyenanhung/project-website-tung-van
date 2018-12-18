<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!--Servisec section Here-->
<section id="our-services" class="padding ptb-xs-40 text-center">

    <div class="container">

        <div class="row pb-60 text-center">
            <?php foreach ($title as $item) {?>
                <div class="col-md-8 col-lg-8 offset-md-2 container text-center" >
                    <h2><span><?php echo $item->name;?></span></h2>
                    <p style="font-size: 16pt; padding-top: 20px;">
                        <?php echo $item->value;?>
                    </p>
                </div>
            <?php }?>
        </div>
        <!--Team Carousel -->
        <div class="row">
            <div id="team-carousel" class="team-carousel nf-carousel-theme">
                <?php foreach ($products as $item) { ?>
                    <div class="item dental">
                        <div class="team-item ">
                            <div class="team-item-img">
                                <div class="featured-item feature-bg-box mb-100 gray-bg">
                                    <div class="image">
                                        <img class="img-responsive" src="<?php echo images_url($item->photo)?>" alt="Photo">
                                    </div>
                                    <div class="title">
                                        <h3><?php echo $item->name ?></h3>
                                    </div>
                                    <div class="desc">
                                        <?php echo $item->summary ?>
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

