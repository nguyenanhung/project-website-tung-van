<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-header" style="background: url('<?php echo $this->db_photo->get_data('banner'); ?>') 0 0 no-repeat">
    <div class="container">
        <h1 class="title">About</h1>
    </div>
    <div class="breadcrumb-box">
        <div class="container">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        About
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!--Intro Section End-->
<!-- Service Section -->
<div id="services-section" class="padding pt-xs-60">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-5 col-sx-12">
                <div class="single-sidebar-widget">
                    <div class="special-links">
                        <ul>
                            <li>
                                <a href="<?php echo base_url('dich-vu')?>">All Services</a>
                            </li>
                            <?php
                            foreach ($list_pages as $item ) : ?>
                                <li>
                                    <a href="<?php echo base_url('chi-tiet-dich-vu/').$item->slugs?>"><?php echo $item->title ?></a>
                                </li>
                            <?php endforeach     ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-7">
                <div class="full-pic">
                    <figure>
                        <img src="<?php echo images_url($page->photo)?>" alt="">
                    </figure>
                </div>
                <div class="text-box mt-40">
                    <div class="box-title mb-20">
                        <h2><?php echo $page->title ?></h2>
                    </div>
                    <div class="text-content">
                        <p>
                            <?php echo $page->summary ?>
                        </p>

                        <p>
                            <?php echo $page->content ?>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>