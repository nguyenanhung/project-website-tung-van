<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!--Intro Section-->
<div class="page-header" style="background: url('<?php echo $this->db_photo->get_data('banner'); ?>') 0 0 no-repeat">
    <div class="container">
        <h1 class="title"><?php echo $about[0]->title;?></h1>
    </div>
    <div class="breadcrumb-box">
        <div class="container">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#"><?php echo $home[0]->title;?></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php echo $about[0]->title;?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!--Intro Section-->
<section class="about-section__block gray-bg pt-90 pb-70 ptb-xs-60" >
    <div class="container">
        <div class="row">
            <div class="row container">
                <div class="about-wrap container">
                    <div class="row mt-40">
                        <?php foreach ($list_item as $item) {?>
                            <div class="col-sm-4">
                                <div class="about__inner">
                                    <div class="service_box hi-icon-effect-3 hi-icon-effect-3b active__tab"">
                                        <div class="service_icon">
                                            <i class="hi-icon fa fa-plane" aria-hidden="true"></i>
                                        </div>
                                        <div class="service_details">
                                            <h5 class="font-color_base no_stripe"><?php echo $item->name; ?></h5>
                                        </div>
                                        <div class="inner__tab-text">
                                            <p><?php echo $item->value; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Section End-->
<!-- Want to learn -->
<div class="padding ptb-xs-40">
    <div class="container">
        <div class="row pb-30 text-center">
            <div class="col-md-12 col-lg-12 mb-20">
                <h2><span><?php echo $strength[0]->name;?></span></h2>
                <span class="b-line"></span>
            </div>
        </div>
        <div class="row">
            <?php foreach ($list_item_1 as $item) {?>
                    <div class="col-md-4 col-lg-4 service">
                        <div class="details">
                            <div class="service_icon">
                                <i class="<?php echo $item->icon_font; ?>"></i>
                            </div>
                            <div class="service_details">
                                <h3><?php echo $item->name; ?></h3>
                            </div>
                            <div class="service_content">
                                <p>
                                    <?php echo $item->value; ?>
                                </p>
                            </div>
                        </div>

                    </div>
            <?php }?>
        </div>
    </div>
</div>
<!-- Want to learn End-->

<!-- Team Section -->
<?php echo modules::run('front-end/about/staff');?>
<!-- End Team Section -->

<!-- Client Logos Section -->
<section id="client-logos" class="wow fadeIn ptb ptb-sm-80">
    <div class="container">
        <div class="owl-carousel client-carousel nf-carousel-theme" >
            <?php foreach ($logo as $item) {?>
                <div class="item">
                    <div class="client-logo">
                        <img src="<?php echo images_url($item->photo);?>" alt="Lỗi" />
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
</section>
<!-- End Client Logos Section -->
<style>


</style>