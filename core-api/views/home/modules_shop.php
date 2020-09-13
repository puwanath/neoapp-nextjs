<div class="c-content-box c-size-md c-bg-white" id="shop">
	<div class="container">
		<!-- Begin: Testimonals 1 component -->
		<div class="c-content-client-logos-slider-1" data-slider="owl">
			<!-- Begin: Title 1 component -->
			<div class="c-content-title-1">
				<h3 class="c-center c-font-uppercase c-font-bold"><?=$word->wordvar('Our Shop');?></h3>
				<div class="c-line-center c-theme-bg"></div>
			</div>
			<!-- End-->
			<!-- Begin: Owlcarousel -->
			<div class="owl-carousel owl-theme c-theme c-owl-nav-center" data-items="5" data-desktop-items="4" data-desktop-small-items="3" data-tablet-items="3" data-mobile-items="2" data-mobile-small-items="1"  data-auto-play="false" data-rtl="false" data-slide-speed="5000" data-auto-play-hover-pause="true">
		 	 	<?php echo $model->getShop();?>
			</div>
	        <!-- End-->
	   </div>
	    <!-- End-->
	</div>
</div>
