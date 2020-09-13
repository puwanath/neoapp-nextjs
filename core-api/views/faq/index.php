<div class="content-page">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div class="input-group">
          <input type="text" class="form-control" id="txtkeyword" placeholder="ค้นหาคำถามของคุณ...">
          <span class="input-group-btn">
            <button class="btn btn-default btn-search" type="button"><i class="fa fa-search"></i> ค้นหา</button>
          </span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div style="border-bottom:1px solid #999;margin-top:10px;">
          <?=$model->getGroup();?>
        </div>

      </div>
    </div>
    <div class="row">
      <div class="col-md-12 col-xs-12">
        <div id="datalist" style="margin-top:10px;"></div>

      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
$(document).ready(function (e) {
  jQuery(function($){
  	var urljson = "<?=$url;?>/<?=$get_part0;?>/?select=loaddata";
  	$.ajax({
  		 url: urljson,
  		 type: "get",
  		 dataType: "json",
  		 success: function(data) {
  			 $("#datalist").html(data);
  		 }
  	});
  });

  $(".item-group").on('click',function(e){
    e.preventDefault();
    var id = $(this).data("id");
    var urljson = "<?=$url;?>/<?=$get_part0;?>/?select=loaddata";
  	$.ajax({
  		 url: urljson,
  		 type: "get",
       data: {'group':id},
  		 dataType: "json",
  		 success: function(data) {
  			 $("#datalist").html(data);
  		 }
  	});

  })

  $(".btn-search").on('click',function(e){
    e.preventDefault();
    var keyword = $("#txtkeyword").val();
    var urljson = "<?=$url;?>/<?=$get_part0;?>/?select=loaddata";
  	$.ajax({
  		 url: urljson,
  		 type: "get",
       data: {'searchkeyword':keyword},
  		 dataType: "json",
  		 success: function(data) {
  			 $("#datalist").html(data);
  		 }
  	});
  })


});

</script>
