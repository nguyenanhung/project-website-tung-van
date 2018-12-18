<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @Author: thaodt97
 * @Date:   2018-06-12 09:49:54
 * @Last Modified by:   thaodt97
 * @Last Modified time: 2018-06-21 09:40:38
 */
?>
<!-- Comment nhúng facebook -->
<div id="facebook-comments">
<h3 id="reply-title">Bình luận</h3>
<fb:comments href="" num_posts="5" width="100%"></fb:comments>
</div>

<!-- Comment hệ thống -->
<!-- <div class="post-comment mtb-30">
	<h4>Bình luận <span class="comment-numb">(<?php echo $count_comment ?>)</span></h4>
	<ul class="comment-list mt-30">
		<?php foreach ($list_comment as $comment) { ?>
		<li>
			<div class="comment-avatar">
				<img src="<?php echo images_url($comment->photo); ?>" alt="">
			</div>
			<div class="">
				<div class="comment-detail">
					<h6><?php echo $comment->name; ?></h6>
					<div class="post-meta">
						<span><?php echo date('F d, Y',strtotime($item->created_at)); ?></span> |<!--  <span><a class="comment-reply-btn"><i class="fa fa-reply"></i>Reply</a></span> -->
					</div>
					<p>
						<?php echo $comment->message;?>
					</p>
				</div> -->
				<!-- <div class="comment-reply">
					<div class="comment-avatar">
						<img src="http://theembazaar.com/demo/nainotheme/gobusiness/assets/images/blog/1.jpg" alt="">
					</div>
					<div class="">
						<div class="comment-detail">
							<h6>Mikal marthin</h6>
							<div class="post-meta">
								<span>March 16, 2016</span> | <span><a class="comment-reply-btn"><i class="fa fa-reply"></i>Reply</a></span>
							</div>
							<p>
								Blandit vel, luctus pulvinar hendrerit id Maecenas tempus tellus eget lorem.
							</p>
						</div>
					</div>
				</div> -->
			<!-- </div>
		</li>
	<?php } ?>
	</ul>
</div>
<div class="mtb-60">
	<h4>Để lại bình luận</h4>

	<div class="row mt-30">
		<div class="col-md-12">
			<form>
				<?php echo form_open_multipart($this->modules_link.'/set_comment', array('class' => 'form-horizontal form-bordered', 'id' => 'form-content')); ?>
				<div class="row">
					<div class="col-md-4 col-lg-4">
						<input type="text" class="input-lg form-full" value="" placeholder="Name" name="name" id="name" required="">
					</div>
					<div class="col-md-4 col-lg-4">
						<input type="text" class="input-lg form-full" value="" placeholder="Email" name="email" id="email2" required="">
					</div>
					<div class="col-md-4 col-lg-4">
						<input type="text" class="input-lg form-full" value="" placeholder="Website" name="website" id="website" required="">
					</div>
					<div class="col-md-12 col-lg-12">
						<textarea placeholder="Message" name="message" id="message" class="form-full" required=""></textarea>
					</div>
					<div class="col-md-12 col-lg-12">
						<button type="submit" class="btn-text" name="Create_new_Items" value="<?php echo config_item('confirm_key_create'); ?>" id="Create_new_Items">
							Post
						</button>
					</div>
				</div>
				<?php echo form_close(); ?>
			</form>
		</div>
	</div>
</div> -->

