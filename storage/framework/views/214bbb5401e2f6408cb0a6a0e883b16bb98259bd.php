<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 <main>
        <section class="stories">
            <div class="story-container">
                <div class="caption">
                    <div class="line"></div>
                    <div class="section-caption">
                        <h2>Echte verhalen,</h2>
                        <h2 class="orange">echt resultaat!</h2>
                    </div>
                    <div class="line"></div>
                </div>

                <div class="row">

                    <?php $__currentLoopData = $clients->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="col-lg-6">
                     <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="story edit-client-button" >
                            <div class="client" style="position: relative;">
                            <?php if(Auth::check()): ?>
                            <?php if(Auth::User()->id == 1): ?>
                            <i class="fa fa-edit fa-stack-1x client-edit" data-id="<?php echo e($client->id); ?>"></i>
                            <?php endif; ?>
                            <?php endif; ?>
                                <div class="image">
                                 <?php if(empty($client->thumb)): ?>
                                    <img src="<?php echo e(asset('story_featured_image/'.$client->story_featured_image)); ?>" alt="">
                                 <?php else: ?>
                                    <img src="<?php echo e(asset('story_featured_image/'.$client->thumb)); ?>" alt="">
                                 <?php endif; ?>
                                </div>
                                <div class="info">

                                    <h3><?php echo e($client->name); ?></h3>
                                    <small><?php echo e($client->possition); ?></small>
                                </div>
                            </div>
                            <div class="text"><?php echo $client->content; ?></div>
                        </div>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </div>

        </section>

        <section class="image-gallery stories">
            <div class="caption">
                <div class="line"></div>
                <div class="section-caption">
                    <h2>Soms zeggen beelden,</h2>
                    <h2 class="orange">meer dan woorden!</h2>
                </div>
                <div class="line"></div>
            </div>

            <div class="slider">
                <div class="pages">
                    <span class="page-1"></span>
                    <span class="page-2"></span>
                    <span class="page-3"></span>
                    <span class="page-4"></span>
                    <span class="page-5"></span>
                </div>
                <div class="images">
                    <div class="image-slide">
                        
                       <?php $__currentLoopData = $gallery_images->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <div class="image-row">
	                        <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g_image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                            <div class="message-image edit-gallery-button"  >
	                            
	                                <p class="message"> 
	                                	<?php if(Auth::check()): ?>
                            			<?php if(Auth::User()->id == 1): ?>
                                     <i class="fa fa-edit fa-stack-1x client-edit" data-id="<?php echo e($g_image->id); ?>"></i>
                                     <?php endif; ?>
                                     <?php endif; ?>
	                                <?php echo e($g_image->caption); ?> </p>
	                                <?php if(empty($g_image->thumb)): ?>
	                                <img src="<?php echo e(asset('gallery_image/'.$g_image->image)); ?>" alt="">
	                                <?php else: ?>
	                                <img src="<?php echo e(asset('gallery_image/'.$g_image->thumb)); ?>" alt="">
	                                <?php endif; ?>
	                            </div>
	                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="page-btns">
                    <?php echo e($gallery_images->links()); ?>

                </div>
            </div>

        </section>

        <section class="e-book ">
            <div class="row ebook-block ">
                <div class="col-lg-8 block-text ">
                    <h1 class="white ">Saboteer jij jouw resultaat?</h1>
                    <p class="lighten ">Tegenwoordig is er via het internet onwijs veel informatie beschikbaar. Maar is deze informatie wel allemaal correct? Niet vaak! Dit gratis E-book telt 52 pagina's en is een goudmijn aan waardevolle informatie op het gebied van training en voeding. Vele gemaakte fouten, die jouw resultaat saboteert, worden in dit boek op wetenschappelijke wijze gecorrigeerd om je te helpen met het creëren van meer resultaat. </p>
                </div>
                <div class="col-lg-4 ">
                    <div class="form-card " data-aos="zoom-in-up">
                        <h2>Download mijn E-book en kom erachter</h2>
                        <form action="<?php echo e(url('subscribe')); ?>" method="post">
                            <input type="text " placeholder="Your name here ">
                            <input type="text " placeholder="Your email here ">
                            <button class="theme-btn ">Download</button>

                            <?php if( Auth::check() && (Auth::User()->role_id == 1 || Auth::User()->role_id == 3)): ?>
                            
                            <button class="upload-button btn btn-md btn-info">Upload</button>
                            <?php endif; ?>

                            <?php if(Auth::check() && Auth::User()->role_id == 1): ?>
                            
                            <button class="upload-button btn btn-md btn-default">Voorbeeld</button>
                            <?php endif; ?>
                            <?php if(Auth::check() && Auth::User()->role_id == 1): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('/admin/dashboard')); ?>">Dashboard</a>
                            </li>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ebook -->
    </main>


<!-- edit gallery modal -->

    <section class="login-modal-bg">

       	<!-- edit gallery modal -->
		<div id="edit-gallery-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header" style="display: block;">
						<button type="button" class="close" data-dismiss="modal" aria-label="<?php echo app('translator')->getFromJson('common.close'); ?>">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">
								<span class="fa-stack fa-sm">
									<i class="fa fa-square-o fa-stack-2x"></i>
									<i class="fa fa-edit fa-stack-1x"></i>
								</span>
								Edit Gallery
							</h4>
						</div>
						<form role="form" id="gallery_edit_form" method="post" enctype="multipart/form-data">
							<?php echo e(method_field('PATCH')); ?>

							<?php echo e(csrf_field()); ?>

							<input type="hidden" name="gallery_id" id="edit-gallery-id">
							<div class="modal-body">
								<div class="form-group">
									<label for="caption">Caption</label>
									<input type="text" name="caption" class="form-control" id="edit-caption" placeholder="ex: gallery">
									<span class="text-danger caption-error"></span>
								</div>
								<div class="form-group">
									<label 
									for="edit-story-gallery-image" 
									class="drop-image" id="drop-image-1"
									viewport-width ="330"
								    viewport-height ="235"
								    boundary-width ="400"
								    boundary-width ="400"
									 > Drop Image or Click Here </label>
									<input 
									type="file"
									name ="image"
									id="edit-story-gallery-image"
									class="crope_this_image"
									viewport-width ="330"
								    viewport-height ="235"
								    boundary-width ="400"
								    boundary-width ="400"
								    style="display: none"
									>
									<span class="text-danger image-error"></span>
								</div>

								<div class="form-group">
									<label>Publication Status</label>
									<select class="form-control" name="publication_status" id="edit-publication-status">
										<option selected disabled>Select One</option>
										<option value="1">Published</option>
										<option value="0">Unpublished</option>
									</select>
									<span class="text-danger publication-status-error"></span>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><?php echo app('translator')->getFromJson('common.close'); ?></button>
								<button type="button" class="btn btn-info btn-flat update-gallery-button"><?php echo app('translator')->getFromJson('common.update'); ?></button>
							</div>
						</form>

					</div>
				</div>
			</div>
			<!-- /.edit gallery modal -->


            	<!-- edit Story modal -->
		<div id="edit-story-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header" style="display: block;">
						<button type="button" class="close" data-dismiss="modal" aria-label="<?php echo app('translator')->getFromJson('common.close'); ?>">
							<span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">
								<span class="fa-stack fa-sm">
									<i class="fa fa-square-o fa-stack-2x"></i>
									<i class="fa fa-edit fa-stack-1x"></i>
								</span>
								Edit Story
							</h4>
						</div>
						<form role="form" id="story_edit_form" method="post" enctype="multipart/form-data">
							<?php echo e(method_field('PATCH')); ?>

							<?php echo e(csrf_field()); ?>

							<input type="hidden" name="story_id" id="edit-story-id">
							<div class="modal-body">
								<div class="form-group">
									<label for="name">Name</label>
									<input type="text" name="name" class="form-control" id="edit-name" placeholder="ex: name">
									<span class="text-danger name-error"></span>
								</div>
								<div class="form-group">
									<label for="possition">Possition</label>
									<input type="text" name="possition" class="form-control" id="edit-possition" placeholder="ex: possition">
									<span class="text-danger possition-error"></span>
								</div>
								<div class="form-group">
									<label for="content">Story Content</label>
									<textarea name="content" class="form-control story-content" id="edit-content" placeholder="ex: content"></textarea>
									<span class="text-danger content-error"></span>
								</div>
								<div class="form-group" >
									<label for="edit-story-featured-image" class="drop-image" id="drop-image-2" > Drop Image or Click Here </label>
									<input 
									type="file"
									id="edit-story-featured-image"
									name="story_featured_image" 
									class="crope_this_image"
									style="display: none;" 
									>
									<!-- viewport-width ="250"
								    viewport-height ="250"
								    boundary-width ="300"
								    boundary-width ="250" -->
									<span class="text-danger story-featured-image-error"></span>
								</div>
								<div class="form-group">
									<label>Publication Status</label>
									<select class="form-control" name="publication_status" id="edit-publication-status">
										<option selected disabled>Select One</option>
										<option value="1">Published</option>
										<option value="0">Unpublished</option>
									</select>
									<span class="text-danger publication-status-error"></span>
								</div>

								<div class="bs-callout bs-callout-success">
									<h4>SEO Information</h4>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><?php echo app('translator')->getFromJson('common.close'); ?></button>
								<button type="button" class="btn btn-info btn-flat update-button"><?php echo app('translator')->getFromJson('common.update'); ?></button>
							</div>
						</form>

					</div>
				</div>
			</div>
			<!-- /.end Story modal -->
    </div>
            <!-- /.edit gallery modal -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <?php echo $__env->make('scripts.client_js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>