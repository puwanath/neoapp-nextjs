<div class="c-content-box">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="">
					<div class="c-content-blog-post-1">

						<div class="c-title c-font-bold c-font-uppercase">
							<a href="javascript:void(0);"><?=$model->getData('newstopic',$get_part0);?></a>
						</div>

						<div class="c-media">
							<?php if(!empty($model->getData('img',$get_part0))){
								$imgmain = $model->getData('img',$get_part0);
								$imgalt = $model->getData('newstopic',$get_part0);
								echo "<img src='$imgmain' alt='$imgalt' class='img-responsive' style='width: 100%;' />";
							}
							?>
						</div>

						<div class="c-panel c-margin-b-30 c-margin-t-30">
							<div class="c-author"><a href="#"><?=$word->wordvar('By');?> <span class="c-font-uppercase"><?=$model->getData('creater',$get_part0);?></span></a></div>
							<div class="c-date"><?=$word->wordvar('on');?> <span class="c-font-uppercase"><?=$model->getData('date',$get_part0);?></span></div>
							<?=$model->getData('tags',$get_part0);?>
						</div>

						<div class="c-desc">
							<?=$model->getData('detail',$get_part0);?>
						</div>

						<div class="c-comments" style="border-top:1px solid #eee;border-bottom:1px solid #eee;padding:10px 0px 10px 0px;">
							<?php include('common/widget/share_btn.php');?>
						</div>

						<div class="c-comments">
							<?php include('common/widget/comment.php');?>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- BEGIN: Other news -->
<div class="c-content-box c-size-md c-bg-grey-1" style="padding-bottom:100px;">
	<div class="container">
		<div class="c-content-blog-post-card-1-slider" data-slider="owl">
			<div class="c-content-title-1">
				<h3 class="c-center c-font-uppercase c-font-bold"><?=$word->wordvar('Other news');?></h3>
				<div class="c-line-center c-theme-bg"></div>
			</div>
			<!-- Begin: Owlcarousel -->
			<div class="owl-carousel owl-theme c-theme c-owl-nav-center" data-items="3" data-slide-speed="8000" data-rtl="false">
				<?php echo $model->otherNews($get_part0);?>
			</div>
			<!-- End-->
		</div>
	</div>
</div>
<!-- END: Other news -->
