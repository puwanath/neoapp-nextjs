<div class="br-mainpanel">
  <div class="br-pageheader pd-y-5 pd-x-5 pd-md-l-5">
    <nav class="breadcrumb pd-0 mg-0 tx-14">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
      <span class="breadcrumb-item active"><?=$pagename;?></span>
    </nav>
  </div><!-- br-pageheader -->

  <div class="br-pagebody pd-x-5 pd-sm-x-5 mg-b-10">
    <div class="card bd-0 shadow-base pd-0">
			<div class="mg-l-auto hidden-xs-down pd-5 text-right" style="width:100%;">
				<a href="javascript:;" class="btnsave btn btn-success"> บันทึกแก้ไข </a>
				<a href="javascript:history.back();" class="btn btn-secondary mg-l-5"> ย้อนกลับ </a>
	    </div>
			<form role="form" action="#" method="POST" id="action-form" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="<?=$get_part2;?>"/>
        <input type="hidden" name="act" id="act" value="<?=$get_part1;?>"/>
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 bd bd-t bd-3 bd-x-0 bd-b-0">
					<div class="panel">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-9 col-sm-8 col-xs-12 bg-gray-100 pd-t-20">
									<div class="row">
										<div class="col-lg">
											<div class="form-group">
												<label for="newstopic_th" class="control-label">หัวข้อข่าว (TH)</label>
												<input type="text" name="newstopic_th" id="newstopic_th" class="form-control" />
												<span style="color:red;" id="err_newstopic_th"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg">
											<div class="form-group">
                        <label for="newstopic_en" class="control-label">หัวข้อข่าว (EN)</label>
												<input type="text" name="newstopic_en" id="newstopic_en" class="form-control" />
												<span style="color:red;" id="err_newstopic_en"></span>
											</div>
										</div>
									</div>
                  <div class="row">
										<div class="col-lg">
											<div class="form-group">
												<label for="slug" class="control-label">Slug (EN)</label>
												<input type="text" name="slug" id="slug" class="form-control" />
                        <span style="color:red;" id="err_slug"></span>
                      </div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg">
											<div class="form-group">
												<label for="newsdetail_th" class="control-label">รายละเอียด (TH)</label>
                        <textarea class="form-control" name="newsdetail_th" id="edit"></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg">
											<div class="form-group">
												<label for="newsdetail_en" class="control-label">รายละเอียด (EN)</label>
												<textarea class="form-control" name="newsdetail_en" id="edit2"></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg">
											<div class="form-group">
												<label for="tags" class="control-label">Tags</label>
												<input type="text" class="form-control" name="tags" id="tags" data-role="tagsinput" value="" />
											</div>
										</div>
									</div>

									<div class="row" style="border-top:2px solid #333;">
										<div class="col-lg">
											<div class="form-group">
												<label for="seo_title" class="control-label">SEO Title</label>
                        <input type="text" name="seo_title" id="seo_title" class="form-control" placeholder="Title"/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg">
											<div class="form-group">
												<label for="seo_desc" class="control-label">SEO Description</label>
                        <input type="text" name="seo_desc" id="seo_desc" class="form-control" placeholder="Description"/>
											</div>
										</div>
									</div>



								</div>
								<div class="col-lg-3 col-sm-4 col-xs-12 bg-gray-300 pd-t-20">
									<div class="form-group">
    								<label class="control-label"> วันที่ข่าว </label>
    								<input type="text" name="newsdate" id="newsdate" value="<?php echo date("d/m/Y");?>" class="form-control fc-datepicker"  />
    							</div>
									<div class="form-group">
										<label class="control-label">ภาพข่าว</label>
										<div class="d-flex bg-gray-200 ht-250 pos-relative align-items-center imglogo" id="imgnews">
											<!-- canvas logo econtrol -->
										</div>
										<div>
											<span class="label label-danger">NOTE! </span>
											<span style="color:red;"> รูปประจำตัว ควรมีขนาดไม่เกิน 500x500px</span>
										</div>
									</div>
                  <div class="form-group">
    								<label>หมวดหมู่ข่าว</label>
    								<select class="form-control" name="type_id" id="type_id" >
    									<option value="">เลือกหมวดหมู่ข่าว
    									<?php echo implode('',$model->getCat());?>
    								</select>
    							</div>
                  <div class="form-group">
    								<label>แสดงที่หน้า</label>
    								<select class="form-control" name="sitepage" id="sitepage" >
    									<option value="">เลือกหน้าที่ต้องการแสดง
    									<?php echo implode('',$model->getSite());?>
    								</select>
    							</div>

                  <div class="form-group">
    								<label> สร้างโดย </label>
    								<input type="text" name="creator" id="creator" class="form-control" disabled />
    							</div>
    							<div class="form-group">
    								<label> อัพเดทล่าสุด </label>
    								<input type="text" name="updatedate" id="updatedate" class="form-control" disabled />
    							</div>

								</div>
							</div>


						</div>
					</div>
				</div>

			</form>
			<form name="frmupload_logo_econtrol" method="post" action="" id="fle-form" enctype="multipart/form-data">
				<input type="hidden" name="newsid" id="newsid" />
				<input type="file" name="fle" id="fle" style="display:none;">
      </form>
			<div class="hidden-md-up pd-10 bg-gray-600">
				<a href="javascript:;" class="btnsave btn btn-success"> บันทึกแก้ไข </a>
				<a href="javascript:history.back();" class="btn btn-secondary mg-l-5"> ย้อนกลับ </a>
	    </div>
    </div>
  </div><!-- br-pagebody -->
</div><!-- br-contentpanel -->


<script type="text/javascript">

  //begin function no enter
  document.onkeydown = chkEvent
  var formInUse = false;
  function chkEvent(e) {
    var keycode;
    if (window.event) keycode = window.event.keyCode; //*** for IE ***//
    else if (e) keycode = e.which; //*** for Firefox ***//
    if(keycode==13)
    {
      return false;
    }
    // if(keycode==13 || (keycode==8 && formInUse==false))
    // {
      // return false;
    // }
  }
  // clased function no enter

	$(document).ready(function (e) {
		if ( top.location.href != location.href ) top.location.href = location.href;
    $('.fc-datepicker').datetimepicker({
      format: 'DD/MM/YYYY',
    });
		// upload image
    $('#fle').change(function(){
      $('#fle-form').submit();
    });

		$("#fle-form").on('submit',(function(e){
			e.preventDefault();
			$.ajax({
				url: "<?=$url;?>/<?=$get_part0;?>?select=uploadimg",
				type: "POST",
				data:  new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				dataType: "json",
				success: function(data){

					if(data.status=="success"){
						toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
						loadImg(data.id);
						$("#id").val(data.id);
						$("#newsid").val(data.id);
						$("#act").val('update');
					}else{
						toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
					}

				},
				error: function(){}
			});
		}));


		// end data table
		$("#action-form").on('submit',(function(e){
			e.preventDefault();



			var form = $('#action-form')[0];
			$.ajax({
				 url: "<?=$url.'/'.$get_part0;?>?select="+$("#act").val(),
				 type: "post",
				// data:  new FormData(this),
				 data:  new FormData(form),
				 contentType: false,
				 cache: false,
				 processData:false,
				 dataType: "json",
				 success: function(data) {

					if(data.status=="success"){
						toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
						$('#action-form')[0].reset();
						editData(data.id);
					}else{
						toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
					}


				 }
			});

		}));

	});

  $("#newstopic_en").keyup(function(){
    var str = $(this).val();
    var slug = str.replace(' ', '-');
    $("#slug").val(slug);
  });

	//begin function
	$('.btnsave').on('click',function(e){
		e.preventDefault();

			if($("#newstopic_th").val()==''){
				$("#newstopic_th").css('border','1px solid red');
				$("#err_newstopic_th").text('กรุณากรอกช่องนี้ด้วยครับ!');
			}else{
				$("#newstopic_th").css('border','1px solid green');
				$("#err_newstopic_th").text('');
			}
			if($("#newstopic_en").val()==''){
				$("#newstopic_en").css('border','1px solid red');
				$("#err_newstopic_en").text('กรุณากรอกช่องนี้ด้วยครับ!');
			}else{
				$("#newstopic_en").css('border','1px solid green');
				$("#err_newstopic_en").text('');
			}

			if($("#slug").val()==''){
				$("#slug").css('border','1px solid red');
				$("#err_slug").text('กรุณากรอกช่องนี้ด้วยครับ!');
			}else{
				$("#slug").css('border','1px solid green');
				$("#err_slug").text('');
			}

			if($("#newstopic_th").val()=='' || $("#newstopic_en").val()=='' || $("#slug").val()==''){
				return false;
			}else{
				$("#action-form").submit();
			}

	});

	function btngetfile(param){
		$('#'+param).click();
	}

	function editData(id){


		$('#action-form')[0].reset();

		if ('undefined'!= typeof id) {
			$.ajax({
				 type: "get",
				 async: false,
				 url: "<?=$url.'/'.$get_part0;?>",
				 data: {select: 'readdata',id:id},
				 dataType: "json",
				 success: function(data) {

					$("#act").val('update');
					$("#id").val(data.id);
					$("#newsid").val(data.id);
					$("#slug").val(data.slug);
					$("#newstopic_th").val(data.newstopic_th);
					$("#newstopic_en").val(data.newstopic_en);
					$("#edit").val(data.newsdetail_th);
					$("#edit2").val(data.newsdetail_en);
					$("#creator").val(data.creator);
					$("#updatedate").val(data.datecreate);
					$("#newsdate").val(data.newsdate);
					$("#sitepage").val(data.sitepage);
					$("#type_id").val(data.type_id);
					$("#tags").val(data.tags);
					$("#seo_title").val(data.seo_title);
					$("#seo_desc").val(data.seo_desc);

				 }
			});


		} else toastr.warning('Unknown row id.', 'Warning!',{timeOut: 5000,closeButton: true});

	};

	<?php if($get_part1=="edit" and $get_part2!=''){?>
		editData('<?=$get_part2;?>');
		loadImg('<?=$get_part2;?>');
	<?php }else{?>
		loadImg(id=null);
	<?php } ?>

	function loadImg(id=null){
		if ('undefined'!= typeof id) {
			$("#imgnews").empty();

			$.ajax({
				 type: "get",
				 async: false,
				 url: "<?=$url;?>/<?=$get_part0;?>",
				 data: {select: 'readdataimg',id:id},
				 dataType: "json",
				 success: function(data) {
					$("#imgnews").html(data.btnupload);
					$("#imgnews").css('background-image','url('+data.img+')');
				 }
			});

		} else alert('Unknown row id.');
	}



	function delImg(param,id) {
		if ( 'undefined' != typeof id) {

			$.ajax({
				 type: "post",
				 async: false,
				 url: "<?=$url.'/'.$get_part0;?>",
				 data: {select: 'delimg',id:id},
				 dataType: "json",
				 success: function(data) {
					 if(data.status=="success"){
             toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
             loadImg(data.id);
           }else{
             toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
           }

				 }
			});



		} else toastr.warning('Unknown row id.', 'Warning!',{timeOut: 5000,closeButton: true});
	}


</script>
