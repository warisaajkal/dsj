<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


	
	<!-- <div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 ">
			<div class="portfolioFilter">
				<a href="#" data-filter="*" class="current">All</a>
				<a href="#" data-filter=".webdesign">Web Design</a>
				<a href="#" data-filter=".graphicdesign">Graphic Design</a>
				<a href="#" data-filter=".illustrator">Illustrator</a>
				<a href="#" data-filter=".photography">Photography</a>
			</div>
		</div>
	</div> -->
                        
	<div class="row port">
		<div class="portfolioContainer">
		
		<?php foreach( $images as $img) : ?>
		
			<div class="col-sm-6 col-lg-3 col-md-4 webdesign illustrator">
				<div class="gal-detail thumb">
					<a href="<?php echo base_url('assets/uploads/slider/'.$img->file_name); ?>" class="image-popup" title="<?php echo $img->caption; ?>">
						<img src="<?php echo base_url('assets/uploads/slider/'.$img->file_name); ?>" alt="<?php echo $img->caption; ?>" class="thumb-img" alt="work-thumbnail">
					</a>
					
					<p class="m-t-10 btn-group-xs text-center">
						<a class="btn btn-primary btn-custom" href="<?php echo base_url('admin/slider/edit/'.$img->id); ?>" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
						<a class="btn btn-danger btn-custom" href="<?php echo base_url('admin/slider/delete/'.$img->id); ?>" onclick="return confirm('Are you sure?')" data-toggle="tooltip" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
					</p>
				</div>
			</div>
			
		<?php endforeach; ?>
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