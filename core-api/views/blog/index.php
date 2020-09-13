<?php if(count($model->getSlidepost($get_part0))>0):?>
<section class="c-layout-revo-slider c-layout-revo-slider-12" dir="ltr">
	<div class="tp-banner-container tp-fullscreen tp-fullscreen-mobile c-arrow-darken" data-bullets-pos="center">
		<div class="tp-banner rev_slider" data-version="5.0">
			<ul>
				<!--BEGIN: SLIDE -->
				<?php echo implode('',$model->getSlidepost($get_part0));?>
				<!--END -->
			</ul>
		</div>
	</div>
</section>
<?php endif;?>



<div class="c-content-box c-size-md" >
	<div class="container">
			<!-- <div class="c-content-title-1">
				<h3 class="c-font-uppercase c-center c-font-bold" style="letter-spacing: 1px;"><?=$word->wordvar('Blog and posts');?></h3>
				<div class="c-line-center"></div>
			</div> -->
			<div class="row" id="datapost">

			</div>
			<div class="row">
				<div class="col-lg">
					<div class="text-center" style="margin-top: 20px;">
						<input type="hidden" id="limit" value="6"  />
						<input type="hidden" id="alldatapage" value="0"  />
						<a href="#" class="btn c-btn-orange loadmoreposts"><?=$word->wordvar('LOAD MORE');?></a>
					</div>
				</div>
			</div>
	</div>
</div>

<div class="c-content-box c-size-md" >
		<div class="container">
      <a href="<?=$url;?>/in-ayutthaya">
        <div class="col-md-3 col-xs-12 c-center box-orange-1">
  				<h1 class="nav-cat"><?=$word->wordvar('In Ayutthaya');?></h1>
  			</div>
      </a>
			<a href="<?=$url;?>/House-knowledge">
        <div class="col-md-3 col-xs-12 c-center box-orange-2">
  				<h1 class="nav-cat"><?=$word->wordvar('House knowledge');?></h1>
  			</div>
      </a>
			<a href="<?=$url;?>/Narawadee-Society">
        <div class="col-md-3 col-xs-12 c-center box-orange-1">
  				<h1 class="nav-cat"><?=$word->wordvar('Narawadee Society');?></h1>
  			</div>
      </a>
			<a href="#">
        <div class="col-md-3 col-xs-12 c-center box-orange-2">
  				<h1 class="nav-cat"><?=$word->wordvar('Customer review');?></h1>
  			</div>
      </a>
		</div>
</div>



<script type="text/javascript">
  $(document).on('ready', function() {


    /*===========================================*/


		function loadposts(cat_id){
			$.ajax({
				 type: "get",
				 async: false,
				 url: "<?=$url.'/'.$get_part0;?>",
				 data: {select: 'loaddatapost',cat_id:cat_id},
				 dataType: "json",
				 success: function(data) {

					$("#datapost").html(data.datahtml);
					$("#limit").val(data.limitnum);
					$("#alldatapage").val(data.alldatapage);
					if(data.alldatapage<6){
						$(".loadmoreposts").css('display','none');
					}else{
						$(".loadmoreposts").css('display','inline');
					}

				 }
			});
		}

		loadposts('<?php echo $model->getTextformid("kp_cat_post","cat_id","slug",$get_part0);?>');

		$(".loadmoreposts").on('click',function(e){
			e.preventDefault();
			var limit = $("#limit").val();
			var cat_id = '<?php echo $model->getTextformid("kp_cat_post","cat_id","slug",$get_part0);?>';

			$.ajax({
				 type: "get",
				 async: false,
				 url: "<?=$url.'/'.$get_part0;?>",
				 data: {select: 'loaddatapost',cat_id:cat_id,limit:limit},
				 dataType: "json",
				 success: function(data) {

					$("#datapost").append(data.datahtml);
					$("#limit").val(data.limitnum);
					$("#alldatapage").val(data.alldatapage);
					if(data.alldatapage<6){
						$(".loadmoreposts").css('display','none');
					}else{
						$(".loadmoreposts").css('display','inline');
					}

				 }
			});

		});


  });

</script>
