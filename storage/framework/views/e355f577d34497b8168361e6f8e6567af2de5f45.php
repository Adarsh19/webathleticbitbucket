 <footer <?php if($hasUI): ?> style="background:#<?php echo e($company_data['ui']['footer']); ?> !important;" <?php endif; ?>>
    <?php if(0): ?>
        <div class="footer-image ">
             <?php Helper::renderSiteImage(3); ?> 
            <?php $information =  Helper::getFooterLinks('information'); ?>
            <?php $join =  Helper::getFooterLinks('join'); ?>
            <?php $coaching =  Helper::getFooterLinks('coaching'); ?>
            <?php $conditions =  Helper::getFooterLinks('conditions'); ?>
            <?php $contact =  Helper::getFooterLinks('contact'); ?>
        </div>

        <div class="row navlinks">
            <div class="col-lg-2">
                <h3>information</h3>
                <ul class="footer-links">
                <?php $__currentLoopData = $information; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <?php if(isAdmin()): ?>
                    <li><a href=" "><?php echo e($page->page_name); ?> </a> <i class="fa fa-edit fa-stack-1x client-edit" data-id="<?php echo e($page->id); ?>" ></i></li>
                 <?php else: ?>
                 <li><a href=" "><?php echo e($page->page_name); ?> </a></li>
                 <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <div class="col-lg-1 ">
                <h3>join</h3>
                <ul class="footer-links" >
                <?php $__currentLoopData = $join; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isAdmin()): ?>
                        <li><a href=" "><?php echo e($page->page_name); ?> </a> <i class="fa fa-edit fa-stack-1x client-edit" data-id="<?php echo e($page->id); ?>" ></i></li>
                     <?php else: ?>
                     <li><a href=" "><?php echo e($page->page_name); ?> </a></li>
                     <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <div class="col-lg-3 ">
                <h3>web<span class="orange ">A</span>thletic coaching</h3>
                <ul class="footer-links" >
                    <?php $__currentLoopData = $coaching; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isAdmin()): ?>
                            <li><a href=" "><?php echo e($page->page_name); ?> </a> <i class="fa fa-edit fa-stack-1x client-edit" data-id="<?php echo e($page->id); ?>" ></i></li>
                         <?php else: ?>
                         <li><a href=" "><?php echo e($page->page_name); ?> </a></li>
                         <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="col-lg-2 ">
                <h3>conditions</h3>
                <ul class="footer-links" >
                    <?php $__currentLoopData = $conditions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php if(isAdmin()): ?>
                        <li><a href=" "><?php echo e($page->page_name); ?> </a> <i class="fa fa-edit fa-stack-1x client-edit" data-id="<?php echo e($page->id); ?>" ></i></li>
                     <?php else: ?>
                     <li><a href=" "><?php echo e($page->page_name); ?> </a></li>
                     <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

            <div class="col-lg-2 ">
                <h3>contact</h3>
                <ul class="footer-links" >
                     <?php $__currentLoopData = $contact; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php if(isAdmin()): ?>
                        <li><a href=" "><?php echo e($page->page_name); ?> </a> <i class="fa fa-edit fa-stack-1x client-edit" data-id="<?php echo e($page->id); ?>" ></i></li>
                     <?php else: ?>
                     <li><a href=" "><?php echo e($page->page_name); ?> </a></li>
                     <?php endif; ?>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
        <p class="text-center p5 ">
            <span class="orange ">&copy;</span> 2018 <?php if(!$is_company): ?> WebAthletic-Coaching.nl <?php else: ?> <?php echo e($company_data['name']); ?> <?php endif; ?>
        </p>
    </footer>



    <!-- edit page modal -->
        <div id="edit-page-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
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
                                Edit Page
                            </h4>
                        </div>
                        <form role="form" id="page_edit_form" method="post" enctype="multipart/form-data">
                            <?php echo e(method_field('PATCH')); ?>

                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="page_id" id="edit-page-id">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="page_name">Page Name</label>
                                    <input type="text" name="page_name" class="form-control" id="edit-page-name" placeholder="ex: page">
                                    <span class="text-danger page-name-error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="page_slug">Page Slug</label>
                                    <input type="text" name="page_slug" class="form-control" id="edit-page-slug" placeholder="ex: page_slug">
                                    <span class="text-danger page-slug-error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="page_content">Page Content</label>
                                    <textarea name="page_content" class="form-control pages-content" id="edit-page-content" placeholder="ex: page content"></textarea>
                                    <span class="text-danger page-content-error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="edit-page-featured-image" class="drop-image" id="drop-image-3" > Drop Image or Click Here </label>
                                    <input 
                                    type="file"
                                    name="page_featured_image"
                                    id="edit-page-featured-image"
                                    class="form-control"
                                    style="display: none" 
                                    >
                                    <span class="text-danger page-featured-image-error"></span>
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

                                <div class="form-group">
                                    <label for="meta_title">Meata Title</label>
                                    <input type="text" name="meta_title" class="form-control" id="edit-meta-title" placeholder="ex: page title">
                                    <span class="text-danger meta-title-error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="meta_keywords">Meata Keywords</label>
                                    <input type="text" name="meta_keywords" class="form-control" id="edit-meta-keywords" placeholder="ex: page, title">
                                    <span class="text-danger meta-keywords-error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <textarea name="meta_description" class="form-control" id="edit-meta-description" rows="3" placeholder="ex: page dscription"></textarea>
                                    <span class="text-danger meta-description-error"></span>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><?php echo app('translator')->getFromJson('common.close'); ?></button>
                                <button type="button" class="btn btn-info btn-flat update-page-button"><?php echo app('translator')->getFromJson('common.update'); ?></button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- /.edit page modal -->
