<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!--About Section-->
    <section id="about" class="padding pb-sm-60 ptb-xs-40 gray-bg">
        <div class="container">
            <div class="row pb-30 pb-md0 text-center">
                <?php for ($i = 0; $i < count($about_us); $i++) {?>
                <div class=" col-lg-8 offset-lg-2 <?php echo $i?>">
                    <div class="heading_box mb-20">
                        <h2><span><?php echo $about_us[0]->name; ?></span></h2>
                    </div>
                    <p><?php echo $about_us[0]->value;?></p>
                </div>
                <?php }?>
            </div>
            <div class="row text-center">
                <?php foreach ($about_us_1 as $item) {?>
                <div class="col-lg-4 bg-pic-2 ptb-20 ptb-xs-0 ">
                    <div class="section-bar-text <?php echo $i?>">
                        <div class="icon-wrap">
                            <span><i class="<?php echo $item->icon_font;?>"></i></span>
                        </div>
                        <h3 class="heading"><?php echo $item->name;?></h3>
                        <div class="desc">
                            <p><?php echo $item->value;?></p>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </section>
<!--Section End-->
<!--Counter UP Section Start-->
<section class="counterUp_wrapper__block padding ptb-sm-80 ptb-xs-40">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-6 mb-sm-30 mb-xs-30 text-center text-lg-left">
                <h2><strong><?php echo $intro[0]->value; ?></strong></h2>
                <a href="<?php echo base_url() .'tuyen-dung/'; ?>" class="btn-white-line mt-20 hidden-md-down">Ứng tuyển ngay</a>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="counter_wrap__block text-center">
                    <div class="row">
                        <div class="col-md-4 mb-xs-30">
                            <div class="single-counterup">
                                <i class="fa fa-trophy"></i>
                                <p class="counterup">
                                    <span class="counter" data-count="<?php echo $projects; ?>">0</span>
                                </p>
                                <p>
                                    Dự án
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-xs-30">
                            <div class="single-counterup">
                                <i class="fa fa-users"></i>
                                <p class="counterup">
                                    <span class="counter" data-count="<?php echo $members;?>">0</span>
                                </p>
                                <p>
                                    Thành viên
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-counterup">
                                <i class="fa fa-smile-o"></i>
                                <p class="counterup">
                                    <span class="counter" data-count="<?php echo $partners?>">0</span>
                                </p>
                                <p>
                                    Đối tác
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Counter UP Section End-->
<!-- Team Section -->
<?php echo modules::run('front-end/about/staff');?>
<!-- End Team Section -->



