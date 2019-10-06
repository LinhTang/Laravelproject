<?php $__env->startSection(Config::get('chatter.yields.head')); ?>
	<link href="/vendor/devdojo/chatter/assets/css/chatter.css" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div id="chatter" class="discussion">

	<div id="chatter_header" style="background-color:<?php echo e($discussion->color); ?>">
		<div class="container">
			<a class="back_btn" href="/<?php echo e(Config::get('chatter.routes.home')); ?>"><i class="chatter-back"></i></a>
			<h1><?php echo e($discussion->title); ?></h1><span class="chatter_head_details">Posted In <?php echo e(Config::get('chatter.titles.category')); ?><a class="chatter_cat" href="/<?php echo e(Config::get('chatter.routes.home')); ?>/<?php echo e(Config::get('chatter.routes.category')); ?>/<?php echo e($discussion->category->slug); ?>" style="background-color:<?php echo e($discussion->category->color); ?>"><?php echo e($discussion->category->name); ?></a></span>
		</div>
	</div>

	<?php if(Session::has('chatter_alert')): ?>
		<div class="chatter-alert alert alert-<?php echo e(Session::get('chatter_alert_type')); ?>">
			<div class="container">
	        	<strong><i class="chatter-alert-<?php echo e(Session::get('chatter_alert_type')); ?>"></i> <?php echo e(Config::get('chatter.alert_messages.' . Session::get('chatter_alert_type'))); ?></strong>
	        	<?php echo e(Session::get('chatter_alert')); ?>

	        	<i class="chatter-close"></i>
	        </div>
	    </div>
	    <div class="chatter-alert-spacer"></div>
	<?php endif; ?>

	<?php if(count($errors) > 0): ?>
	    <div class="chatter-alert alert alert-danger">
	    	<div class="container">
	    		<p><strong><i class="chatter-alert-danger"></i> <?php echo e(Config::get('chatter.alert_messages.danger')); ?></strong> Please fix the following errors:</p>
		        <ul>
		            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                <li><?php echo e($error); ?></li>
		            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		        </ul>
		    </div>
	    </div>
	<?php endif; ?>	

	<div class="container margin-top">
		
	    <div class="row">

	        <div class="col-md-12">
					
				<div class="conversation">
	                <ul class="discussions no-bg" style="display:block;">
	                	<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                		<li data-id="<?php echo e($post->id); ?>">
		                		<span class="chatter_posts">
		                			<?php if(!Auth::guest() && (Auth::user()->id == $post->user->id)): ?>
		                				<div id="delete_warning_<?php echo e($post->id); ?>" class="chatter_warning_delete">
		                					<i class="chatter-warning"></i>Are you sure you want to delete this response?
		                					<button class="btn btn-sm btn-danger pull-right delete_response">Yes Delete It</button>
		                					<button class="btn btn-sm btn-default pull-right">No Thanks</button>
		                				</div>
			                			<div class="chatter_post_actions">
			                				<p class="chatter_delete_btn">
			                					<i class="chatter-delete"></i> Delete
			                				</p>
			                				<p class="chatter_edit_btn">
			                					<i class="chatter-edit"></i> Edit
			                				</p>
			                			</div>
			                		<?php endif; ?>
			                		<div class="chatter_avatar">
					        			<?php if(Config::get('chatter.user.avatar_image_database_field')): ?>
					        				
					        				<?php $db_field = Config::get('chatter.user.avatar_image_database_field'); ?>
					        				
					        				<!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
					        				<?php if( (substr($post->user->{$db_field}, 0, 7) == 'http://') || (substr($post->user->{$db_field}, 0, 8) == 'https://') ): ?>
					        					<img src="<?php echo e($post->user->{$db_field}); ?>">
					        				<?php else: ?>
					        					<img src="<?php echo e(Config::get('chatter.user.relative_url_to_image_assets') . $post->user->{$db_field}); ?>">
					        				<?php endif; ?>

					        			<?php else: ?>
					        				<span class="chatter_avatar_circle" style="background-color:#<?= \DevDojo\Chatter\Helpers\ChatterHelper::stringToColorCode($post->user->email) ?>">
					        					<?php echo e(ucfirst(substr($post->user->email, 0, 1))); ?>

					        				</span>
					        			<?php endif; ?>
					        		</div>

					        		<div class="chatter_middle">
					        			<span class="chatter_middle_details"><a href="<?php echo e(\DevDojo\Chatter\Helpers\ChatterHelper::userLink($post->user)); ?>"><?php echo e(ucfirst($post->user->{Config::get('chatter.user.database_field_with_user_name')})); ?></a> <span class="ago chatter_middle_details"><?php echo e(\Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans()); ?></span></span>
					        			<div class="chatter_body"><?= $post->body ?></div>
					        		</div>

					        		<div class="chatter_clear"></div>
				        		</span>
		                	</li>
	                	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	           
	                </ul>
	            </div>

	            <?php if(!Auth::guest()): ?>

	            	<div id="new_response">

	            		<div class="chatter_avatar">
		        			<?php if(Config::get('chatter.user.avatar_image_database_field')): ?>

		        				<?php $db_field = Config::get('chatter.user.avatar_image_database_field'); ?>
					        				
		        				<!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
		        				<?php if( (substr(Auth::user()->{$db_field}, 0, 7) == 'http://') || (substr(Auth::user()->{$db_field}, 0, 8) == 'https://') ): ?>
		        					<img src="<?php echo e(Auth::user()->{$db_field}); ?>">
		        				<?php else: ?>
		        					<img src="<?php echo e(Config::get('chatter.user.relative_url_to_image_assets') . Auth::user()->{$db_field}); ?>">
		        				<?php endif; ?>

		        			<?php else: ?>
		        				<span class="chatter_avatar_circle" style="background-color:#<?= \DevDojo\Chatter\Helpers\ChatterHelper::stringToColorCode(Auth::user()->email) ?>">
		        					<?php echo e(strtoupper(substr(Auth::user()->email, 0, 1))); ?>

		        				</span>
		        			<?php endif; ?>
		        		</div>

			            <div id="new_discussion">
			        	

					    	<div class="chatter_loader dark" id="new_discussion_loader">
							    <div></div>
							</div>

				            <form id="chatter_form_editor" action="/<?php echo e(Config::get('chatter.routes.home')); ?>/posts" method="POST">

						        <!-- BODY -->
						    	<div id="editor">
									<label id="tinymce_placeholder">Add the content for your Discussion here</label>
									<textarea id="body" class="richText" name="body" placeholder=""><?php echo e(old('body')); ?></textarea>
								</div>

						        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
						        <input type="hidden" name="chatter_discussion_id" value="<?php echo e($discussion->id); ?>">
						    </form>

						</div><!-- #new_discussion -->

						<button id="submit_response" class="btn btn-success pull-right"><i class="chatter-new"></i> Submit Response</button>
					</div>

				<?php else: ?>

					<div id="login_or_register">
						<p>Please <a href="/<?php echo e(Config::get('chatter.routes.home')); ?>/login">login</a> or <a href="/<?php echo e(Config::get('chatter.routes.home')); ?>/register">register</a> to leave a response.</p>
					</div>

				<?php endif; ?>

	        </div>


	    </div>
	</div>

</div>

<input type="hidden" id="chatter_tinymce_toolbar" value="<?php echo e(Config::get('chatter.tinymce.toolbar')); ?>">
<input type="hidden" id="chatter_tinymce_plugins" value="<?php echo e(Config::get('chatter.tinymce.plugins')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection(Config::get('chatter.yields.footer')); ?>
<script src="/vendor/devdojo/chatter/assets/vendor/tinymce/tinymce.min.js"></script>
<script src="/vendor/devdojo/chatter/assets/js/tinymce.js"></script>
<script>
	var my_tinymce = tinyMCE;
	$('document').ready(function(){

		$('#submit_response').click(function(){
			$('#chatter_form_editor').submit();
		});

		$('#tinymce_placeholder').click(function(){
			my_tinymce.activeEditor.focus();
		});

	});
</script>

<script>



	$('document').ready(function(){
		$('.chatter_edit_btn').click(function(){
			parent = $(this).parents('li');
			parent.addClass('editing');
			id = parent.data('id');
			container = parent.find('.chatter_middle');
			body = container.find('.chatter_body');
			details = container.find('.chatter_middle_details');
			
			// dynamically create a new text area
			container.prepend('<textarea id="post-edit-' + id + '">' + body.html() + '</textarea>');
			container.append('<div class="chatter_update_actions"><button class="btn btn-success pull-right update_chatter_edit"  data-id="' + id + '"><i class="chatter-check"></i> Update Response</button><button href="/" class="btn btn-default pull-right cancel_chatter_edit" data-id="' + id + '">Cancel</button></div>');
			
			initializeNewEditor('post-edit-' + id);

		});

		$('.discussions li').on('click', '.cancel_chatter_edit', function(e){
			post_id = $(e.target).data('id');
			parent_li = $(e.target).parents('li');
			parent_actions = $(e.target).parent('.chatter_update_actions');
			tinymce.remove('#post-edit-' + post_id);
			$('#post-edit-' + post_id).remove();
			parent_actions.remove();

			parent_li.removeClass('editing');
		});

		$('.discussions li').on('click', '.update_chatter_edit', function(e){
			post_id = $(e.target).data('id');
			update_body = tinyMCE.get('post-edit-' + post_id).getContent();
			console.log(update_body);
			$.form('/<?php echo e(Config::get('chatter.routes.home')); ?>/posts/' + post_id, { _token: '<?php echo e(csrf_token()); ?>', _method: 'PATCH', 'body' : update_body }, 'POST').submit();
		});


		// DELETE BUTTON
		$('.chatter_delete_btn').click(function(){
			parent = $(this).parents('li');
			parent.addClass('delete_warning');
			id = parent.data('id');
			$('#delete_warning_' + id).show();
		});

		$('.chatter_warning_delete .btn-default').click(function(){
			$(this).parent('.chatter_warning_delete').hide();
			$(this).parents('li').removeClass('delete_warning');
		});

		$('.delete_response').click(function(){
			post_id = $(this).parents('li').data('id');
			$.form('/<?php echo e(Config::get('chatter.routes.home')); ?>/posts/' + post_id, { _token: '<?php echo e(csrf_token()); ?>', _method: 'DELETE'}, 'POST').submit();
		});

	});


</script>
<script src="/vendor/devdojo/chatter/assets/js/chatter.js"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(Config::get('chatter.master_file_extend'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/my_project 3/vendor/devdojo/chatter/src/Views/discussion.blade.php ENDPATH**/ ?>