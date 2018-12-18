<?php
/**
 * Created by PhpStorm.
 * User: HOANG LIEN
 * Date: 09/07/2018
 * Time: 10:27 SA
 */
?>
<section class="ptb ptb-xs-60">
    <div class="container">
        <div class="row">
            <!--  Content  -->
            <?php foreach ($contact_us as $item) {?>
                <div class="col-md-8 col-lg-8 offset-md-2 container text-center" >
                    <h2><span><?php echo $item->name;?></span></h2>
                    <p style="font-size: 16pt; padding-top: 20px;">
                        <?php echo $item->value;?>
                    </p>
                </div>
            <?php }?>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 contact pb-60 pt-30">
                <div class="row text-center">
                    <div class="col-md-4 col-lg-4 pb-xs-30 hvr-icon-buzz">
                        <i class="ion-android-call icon-circle pos-s hvr-icon"></i><a href="#" class="mt-15 i-block"><?php echo $this->db_config->get_data('site_phone');?></a>
                    </div>
                    <div class="col-md-4 col-lg-4 pb-xs-30 hvr-icon-grow-rotate">
                        <i class="ion-ios-location icon-circle pos-s hvr-icon"></i>
                        <p  class="mt-15">
                            <?php echo $this->db_config->get_data('contact_company_address_1');?>
                        </p>
                    </div>
                    <div class="col-md-4 col-lg-4 pb-xs-30 hvr-icon-wobble-vertical">
                        <i class="ion-ios-email icon-circle pos-s hvr-icon"></i><a href="mailto:Construc@support.com"  class="mt-15 i-block"><?php echo $this->db_config->get_data('site_email');?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Map Section -->
    <div class="maps">
        <div id="maps">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.648820101098!2d105.80480031450433!3d21.006709786010344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac9f47793771%3A0x665279d4e396c436!2zMSDEkMaw4budbmcgTMOqIFbEg24gTMawxqFuZywgTmjDom4gQ2jDrW5oLCBUaGFuaCBYdcOibiwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1529289131793" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
    <!-- Map Section -->
    <div class="container contact-form pt-80 pt-xs-60 mt-up" >
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <?php foreach ($message as $item) {?>
                    <div class="get-contact">
                        <h4><?php echo $item->name;?></h4>
                        <p><?php echo $item->value;?></p>
                    </div>
                <?php } ?>

                <?php echo modules::run('front-end/contact/send_message');?>
            </div>
        </div>
    </div>
    </div>
</section>
