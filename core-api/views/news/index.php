<?php
if(count($model->getSlidenews($get_part0))>0):?>
<section class="c-layout-revo-slider c-layout-revo-slider-12" dir="ltr">
	<div class="tp-banner-container tp-fullscreen tp-fullscreen-mobile c-arrow-darken" data-bullets-pos="center">
		<div class="tp-banner rev_slider" data-version="5.0">
			<ul>
				<!--BEGIN: SLIDE -->
				<?php echo implode('',$model->getSlidenews($get_part0));?>
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
			<div class="row">
				<div class="col-lg col-md-3">
					<h1 style="font-size: 25px;font-weight: bold;">เลือกดูข่าว</h1>
				</div>
				<div class="col-lg col-md-3">
					<div class="form-group">
						<select class="form-control style-search" name="year" id="year">
							<option value="" disabled selected hidden>ปี</option>
							<?php echo $model->getYearfromnews();?>
						</select>
					</div>
				</div>
				<div class="col-lg col-md-3">
					<div class="form-group">
						<select class="form-control style-search" name="month" id="month">
							<option value="" disabled selected hidden>เดือน</option>
							<?php echo $model->getMonthfromnews();?>
						</select>
					</div>
				</div>
				<div class="col-lg col-md-3">
					<div class="form-group">
						<button type="button" class="btn btn-lg btn-search">ค้นหา</button>
					</div>
				</div>
			</div>
			<div class="row" id="datanews">

			</div>
			<div class="row">
				<div class="col-lg">
					<div class="text-center" style="margin-top: 20px;">
						<input type="hidden" id="limit" value="6"  />
						<input type="hidden" id="alldatapage" value="0"  />
						<a href="#" class="btn c-btn-orange loadmorenews"><?=$word->wordvar('LOAD MORE');?></a>
					</div>
				</div>
			</div>
	</div>
</div>


<script type="text/javascript">
  $(document).on('ready', function() {


    /*===========================================*/
		$(".btn-search").on('click',function(e){
			e.preventDefault();
			var type_id = '<?php echo $model->getTextformid("kp_type_news","type_id","slug",$get_part0);?>';
			var year = $("#year").val();
			var month = $("#month").val();
			loadposts(type_id,year,month);
		});

		function loadposts(type_id,year,month){
			$.ajax({
				 type: "get",
				 async: false,
				 url: "<?=$url.'/'.$get_part0;?>",
				 data: {select: 'loaddatanews',type_id:type_id,year:year,month:month},
				 dataType: "json",
				 success: function(data) {

					$("#datanews").html(data.datahtml);
					$("#limit").val(data.limitnum);
					$("#alldatapage").val(data.alldatapage);
					if(data.alldatapage<6){
						$(".loadmorenews").css('display','none');
					}else{
						$(".loadmorenews").css('display','inline');
					}

				 }
			});
		}

		loadposts('<?php echo $model->getTextformid("kp_type_news","type_id","slug",$get_part0);?>',null,null);

		$(".loadmorenews").on('click',function(e){
			e.preventDefault();
			var limit = $("#limit").val();
			var type_id = '<?php echo $model->getTextformid("kp_type_news","type_id","slug",$get_part0);?>';
			var year = $("#year").val();
			var month = $("#month").val();


			$.ajax({
				 type: "get",
				 async: false,
				 url: "<?=$url.'/'.$get_part0;?>",
				 data: {select: 'loaddatanews',type_id:type_id,year:year,month:month,limit:limit},
				 dataType: "json",
				 success: function(data) {

					$("#datanews").append(data.datahtml);
					$("#limit").val(data.limitnum);
					$("#alldatapage").val(data.alldatapage);
					if(data.alldatapage<6){
						$(".loadmorenews").css('display','none');
					}else{
						$(".loadmorenews").css('display','inline');
					}

				 }
			});

		});


  });

</script>
