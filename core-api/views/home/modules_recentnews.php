<!-- BEGIN: CONTENT/BLOG/RECENT-POSTS -->
<div class="c-content-box c-size-md c-bg-grey-1" id="news">
	<div class="container">
		<!-- Begin: Testimonals 1 component -->
		<div class="c-content-blog-post-card-1-slider" data-slider="owl">
			<!-- Begin: Title 1 component -->
			<div class="c-content-title-1">
				<h3 class="c-center c-font-uppercase c-font-bold"><?=$word->wordvar('LATEST NEWS');?></h3>
				<div class="c-line-center c-theme-bg"></div>
			</div>
			<!-- End-->
			<!-- Begin: Owlcarousel -->
			<div class="owl-carousel owl-theme c-theme c-owl-nav-center" data-items="3" data-slide-speed="8000" data-rtl="false">
					<?php echo $model->getLastnews();?>
			</div>
	        <!-- End-->
	  </div>
	    <!-- End-->
	</div>
</div><!-- END: CONTENT/BLOG/RECENT-POSTS -->
