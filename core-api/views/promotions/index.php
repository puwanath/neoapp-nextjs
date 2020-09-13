<div>
  <div class="carousel slide" id="carousel-example-captions" data-ride="carousel">
    <?php echo $model->getBannerslide(null);?>
    <a href="#carousel-example-captions" class="left carousel-control" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
    <a href="#carousel-example-captions" class="right carousel-control" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
  </div>
</div>
<div class="c-content-box c-no-bottom-padding">
  <div class="container" id="loaddata">

  </div>
</div>
<div class="c-content-box c-no-bottom-padding">
  <div class="col-lg">
    <div class="text-center" style="margin-top: 20px;margin-bottom:50px;">
      <input type="hidden" id="limit" value="6"  />
      <input type="hidden" id="alldatapage" value="0"  />
      <a href="#" class="btn c-btn-orange loadmore"><?=$word->wordvar('LOAD MORE');?></a>
    </div>
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function (e) {

		function loaddata(){
			$.ajax({
				 type: "get",
				 async: false,
				 url: "<?=$url.'/'.$get_part0;?>",
				 data: {select: 'loaddata'},
				 dataType: "json",
				 success: function(data) {

					$("#loaddata").html(data.datahtml);
					$("#limit").val(data.limitnum);
					$("#alldatapage").val(data.alldatapage);
					if(data.alldatapage<6){
						$(".loadmore").css('display','none');
					}else{
						$(".loadmore").css('display','inline');
					}

				 }
			});
		}

		loaddata();

		$(".loadmore").on('click',function(e){
			e.preventDefault();
			var limit = $("#limit").val();
			$.ajax({
				 type: "get",
				 async: false,
				 url: "<?=$url.'/'.$get_part0;?>",
				 data: {select: 'loaddata',limit:limit},
				 dataType: "json",
				 success: function(data) {

					$("#loaddata").append(data.datahtml);
					$("#limit").val(data.limitnum);
					$("#alldatapage").val(data.alldatapage);
					if(data.alldatapage<6){
						$(".loadmore").css('display','none');
					}else{
						$(".loadmore").css('display','inline');
					}

				 }
			});

		})
	});

</script>
