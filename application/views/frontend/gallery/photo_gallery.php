<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row port">
	<div class="portfolioContainer">
		
			<?php if ($images > 0) { foreach($images as $img) { ?>
				    
			<div class="col-sm-6 col-lg-3 col-md-4 webdesign illustrator">
				<div class="gal-detail thumb">
					<a href="<?php echo base_url('assets/uploads/photo_gallery/'.$img->file_name); ?>" class="image-popup" title="<?php echo $img->caption; ?>">
						<img src="<?php echo base_url('assets/uploads/photo_gallery/'.$img->file_name); ?>" alt="<?php echo $img->caption; ?>" class="thumb-img" alt="work-thumbnail">
					</a>
					<h4 style="display: none;"><?=substr($img->caption, 0, 150); ?></h4>

				</div>
			</div>

			<?php 
					} 
				} else 
				{
					echo 'Photo gallery is empty!';
				}
			?>
	</div>
</div>			
		<div class="clearfix"></div>
		
		<div class="col-md-12 center">
			<div class="row">
				<div class="">
					<ul class="pagination pagination-split">
					
						<!-- Show pagination links -->
						<?php foreach ($links as $link) {
							echo '<li>' . $link . '</li>';
						} ?>
					</ul>
				</div>
			</div>
		</div>
					
<script type="text/javascript">
            $(window).load(function(){
                var $container = $('.portfolioContainer');
                $container.isotope({
                    filter: '*',
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });

                $('.portfolioFilter a').click(function(){
                    $('.portfolioFilter .current').removeClass('current');
                    $(this).addClass('current');

                    var selector = $(this).attr('data-filter');
                    $container.isotope({
                        filter: selector,
                        animationOptions: {
                            duration: 750,
                            easing: 'linear',
                            queue: false
                        }
                    });
                    return false;
                }); 
            });
            $(document).ready(function() {
                $('.image-popup').magnificPopup({
                    type: 'image',
                    closeOnContentClick: true,
                    mainClass: 'mfp-fade',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                    }
                });
            });
</script>