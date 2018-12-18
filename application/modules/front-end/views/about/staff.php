<?php
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 09/07/2018
 * Time: 10:14 SA
 */
?>
<!-- Team Section -->
<section id="team" class="gray-bg ptb ptb-sm-80 text-center">
    <div class="container">
        <div class="row pb-30 text-center">
            <?php foreach ($humans as $item) {?>
                <div class="col-md-8 offset-md-2">
                    <div class="heading_box mb-20">
                        <h2><span><?php echo $item->name;?></span></h2>

                    </div>
                    <p>
                        <?php echo $item->value;?>
                    </p>
                </div>
            <?php }?>
        </div>
        <!--Team Carousel -->
        <div class="row mt-10">
            <div id="members-carousel" class="team-carousel nf-carousel-theme">
                <?php foreach ($staff as $item) {?>
                    <div class="item dental">

                        <div class="team-item ">
                            <div class="team-item-img ">
                                <img src="<?php echo images_url($item->photo); ?>" alt="" style="width: 100%; height: 50%;"/>
                                <div class="team-item-detail">
                                    <div class="team-item-detail-inner light-color">

                                        <ul class="social">
                                            <li>
                                                <a href="<?php echo $item->link_fb ;?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $item->link_twitter ;?>;"><i class="fa fa-twitter"></i></a>
                                            </li>

                                            <li>
                                                <a href="<?php echo $item->link_google ;?>;"><i class="fa fa-google-plus"></i></a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                            <div class="team-item-info">
                                <h5><?php echo $item->name;?></h5>
                                <p class="">
                                    <?php echo $item->position;?>
                                </p>
                            </div>

                        </div>

                    </div>
                <?php }?>
            </div>
        </div>
        <!--End Team Carousel -->
    </div>
</section>
<!-- End Team Section -->
