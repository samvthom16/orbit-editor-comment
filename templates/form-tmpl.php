<div class="row">
	<div class="orbit-oec-wrapper" >
		<div class="colo-sm-12 text-center">
			<h4 class="oec-title">Youth Ki Awaaz Editor Notes</h4>	
		</div>
		<div class="col-sm-12">
			<ul class="orbit-oec-comments"> <?php
				if(is_array($comments) && count($comments) ) : 
					foreach ($comments as $key => $comment) : 
						$user = get_userdata($comment['commented_by'])->data; ?>
						
						<li class="comment"> 
							<div class="comment-item <?php $this->is_me((int)$comment['commented_by']) ? _e('comment-strong'):''; ?>"> <?php 

								_e(stripslashes($comment['comment'])); ?>

								<div class="comment-meta">
									<a href="<?php _e( get_author_posts_url( $user->ID )); ?>"> <?php
										_e($user->display_name); ?>
									</a> on <?php _e($comment['commented_on'])?>
									<?php $this->delete_link($comment)?>
								</div>
							</div>
						</li> <?php 
					endforeach;
				endif; ?>	
			</ul>
		</div>
	</div>
</div>
