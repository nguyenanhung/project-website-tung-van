<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- We best Section -->
<section class="we-best">
	<div class="booking-section">
		<div class="left-block bg-color" >
			<div class="treatment light-color">
				<h2 class="mb-20"><?php echo $title_info[0]->name ?></h2>
				<p>
					<?php echo $title_info[0]->value  ?>
				</p>
				<ul>
					<?php foreach ($list_info as $info) { ?>
						<li>
							<i class="<?php echo $info->icon_font ?>"></i><strong><?php echo $info->name; ?></strong>
							<p>
								<?php echo $info->value; ?>
							</p>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="right-block bg-side hidden-md-down" style="background: url('<?php echo $this->db_photo->get_data('side_info') ?>') 50% 50% / cover no-repeat ">
			 
		</div>
	</div>
</section>
