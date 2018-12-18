<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="page-header" style="background: url('<?php echo $this->db_photo->get_data('banner'); ?>') 0 0 no-repeat">
    <div class="container">
        <h1 class="title"><?php echo $contact[0]->title;?></h1>
    </div>
    <div class="breadcrumb-box">
        <div class="container">
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#"><?php echo $home[0]->title;?></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php echo $contact[0]->title;?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<?php echo modules::run('front-end/contact/form_contact');?>
<!-- Contact Section -->
<style>

</style>
