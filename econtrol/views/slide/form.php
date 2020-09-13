<div class="br-mainpanel">
  <div class="br-pageheader pd-y-5 pd-x-5 pd-md-l-5">
    <nav class="breadcrumb pd-0 mg-0 tx-14">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
      <span class="breadcrumb-item active"><?=$pagename;?></span>
    </nav>
  </div><!-- br-pageheader -->

  <div class="br-pagebody pd-x-5 pd-sm-x-5 mg-b-20">
    <div class="card bd-0 shadow-base pd-0">
			<div class="mg-l-auto hidden-xs-down pd-5 bd-b text-right" style="width:100%;">
        <a href="javascript:;" class="btn btn-success btn-with-icon btnsave">
          <div class="ht-40">
            <span class="icon wd-40"><i class="fa fa-save"></i></span>
            <span class="pd-x-15">บันทึกแก้ไข</span>
          </div>
        </a>
        <a href="javascript:history.back();" class="btn btn-secondary btn-with-icon">
          <div class="ht-40">
            <span class="icon wd-40"><i class="icon ion-reply"></i></span>
            <span class="pd-x-15">ย้อนกลับ</span>
          </div>
        </a>
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
												<label for="slidename_th" class="control-label">หัวข้อแบนเนอร์ (TH)</label>
												<input type="text" name="slidename_th" id="slidename_th" class="form-control" />
												<span style="color:red;" id="err_slidename_th"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg">
											<div class="form-group">
                        <label for="slidename_en" class="control-label">หัวข้อแบนเนอร์ (EN)</label>
												<input type="text" name="slidename_en" id="slidename_en" class="form-control" />
												<span style="color:red;" id="err_slidename_en"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg">
											<div class="form-group">
												<label for="slidedetail_th" class="control-label">รายละเอียด (TH)</label>
                        <textarea class="form-control" name="slidedetail_th" id="slidedetail_th"></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg">
											<div class="form-group">
												<label for="slidedetail_en" class="control-label">รายละเอียด (EN)</label>
												<textarea class="form-control" name="slidedetail_en" id="slidedetail_en"></textarea>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg">
											<div class="form-group">
												<label for="slide_link" class="control-label">ลิงค์ (URL)</label>
												<input type="text" class="form-control" name="slide_link" id="slide_link" placeholder="Ex: http://kapongidea.com"/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6">
                      <div class="form-group">
                        <label class="control-label">ตำแหน่งภาพ / Posision X (แนวนอน)</label>
                        <select class="form-control" id="slide_position_x" name="slide_position_x">
                          <option value="center" selected>Center</option>
                          <option value="left" >Left</option>
                          <option value="right" >Right</option>
                        </select>
                      </div>
										</div>
										<div class="col-lg-6">
                      <div class="form-group">
                        <label class="control-label">ตำแหน่งภาพ / Position Y (แนวตั้ง)</label>
                        <select class="form-control" id="slide_position_y" name="slide_position_y">
                          <option value="center" selected>Center</option>
                          <option value="top" >Top</option>
                          <option value="bottom" >Bottom</option>
                        </select>
                      </div>
										</div>
									</div>
                  <div class="row">
										<div class="col-lg">
											<div class="form-group">
												<label for="slide_youtube" class="control-label">ลิงค์ Youtube (เฉพาะแสดงวีดีโอ)</label>
												<input type="text" class="form-control" name="slide_youtube" id="slide_youtube" placeholder="Ex: https://www.youtube.com/watch?v=TKThIUjnEv8"/>
											</div>
										</div>
									</div>
                  <div class="row">
                    <div class="col-lg">
                      <div class="form-group">
    										<label class="control-label">ภาพแบนเนอร์ (Desktop)</label>
    										<div class="d-flex bg-gray-200 ht-400 pos-relative align-items-center imglogo" id="slide_img">
    											<!-- canvas logo econtrol -->
    										</div>
    										<div>
    											<span class="label label-danger">NOTE! </span>
    											<span style="color:red;"> รูปแบนเนอร์ ควรมีขนาดไม่เกิน 1440x868px</span>
    										</div>
    									</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg">
                      <div class="form-group">
    										<label class="control-label">ภาพแบนเนอร์ (Tablet)</label>
    										<div class="d-flex bg-gray-200 ht-400 pos-relative align-items-center imglogo" id="slide_img_tablet">
    											<!-- canvas logo econtrol -->
    										</div>
    										<div>
    											<span class="label label-danger">NOTE! </span>
    											<span style="color:red;"> รูปแบนเนอร์ ควรมีขนาดไม่เกิน 778x960px</span>
    										</div>
    									</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg">
                      <div class="form-group">
    										<label class="control-label">ภาพแบนเนอร์ (Mobile)</label>
    										<div class="d-flex bg-gray-200 ht-400 pos-relative align-items-center imglogo" id="slide_img_mobile">
    											<!-- canvas logo econtrol -->
    										</div>
    										<div>
    											<span class="label label-danger">NOTE! </span>
    											<span style="color:red;"> รูปแบนเนอร์ ควรมีขนาดไม่เกิน 480x720px</span>
    										</div>
    									</div>
                    </div>
                  </div>



								</div>
								<div class="col-lg-3 col-sm-4 col-xs-12 bg-gray-300 pd-t-20">
									<div class="form-group">
    								<label for="slide_start_date" class="control-label"> เริ่มแสดง (m/d/Y)</label>
    								<input type="text" name="slide_start_date" id="slide_start_date" value="<?php echo date("m/d/Y");?>" class="form-control datepicker"  />
                  </div>
									<div class="form-group">
    								<label for="slide_end_date" class="control-label"> สิ้นสุดการแสดง (m/d/Y)</label>
    								<input type="text" name="slide_end_date" id="slide_end_date" value="<?php echo date("m/d/Y");?>" class="form-control datepicker"  />
                  </div>
                  <div class="form-group">
    								<label>แสดงที่หน้า</label>
    								<select class="form-control" name="sitepage" id="sitepage" >
    									<option value="">Select Site Setting
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
				<input type="hidden" name="slideid" class="slideid" />
				<input type="file" name="fle" id="fle" style="display:none;">
      </form>
			<form name="frmupload_logo_econtrol" method="post" action="" id="fle-form-tablet" enctype="multipart/form-data">
				<input type="hidden" name="slideid" class="slideid" />
				<input type="file" name="fle_tablet" id="fle_tablet" style="display:none;">
      </form>
			<form name="frmupload_logo_econtrol" method="post" action="" id="fle-form-mobile" enctype="multipart/form-data">
				<input type="hidden" name="slideid" class="slideid" />
				<input type="file" name="fle_mobile" id="fle_mobile" style="display:none;">
      </form>
			<div class="hidden-md-up pd-10 bg-gray-600">
				<a href="javascript:;" class="btn btn-info btnsave"> บันทึกแก้ไข </a>
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


		// upload image
    $('#fle').change(function(){
      $('#fle-form').submit();
    });
    $('#fle_tablet').change(function(){
      $('#fle-form-tablet').submit();
    });
    $('#fle_mobile').change(function(){
      $('#fle-form-mobile').submit();
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
						$(".slideid").val(data.id);
						$("#act").val('update');
					}else{
						toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
					}

				},
				error: function(){}
			});
		}));
		$("#fle-form-tablet").on('submit',(function(e){
			e.preventDefault();
			$.ajax({
				url: "<?=$url;?>/<?=$get_part0;?>?select=uploadimg_tablet",
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
						$(".slideid").val(data.id);
						$("#act").val('update');
					}else{
						toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
					}

				},
				error: function(){}
			});
		}));
		$("#fle-form-mobile").on('submit',(function(e){
			e.preventDefault();
			$.ajax({
				url: "<?=$url;?>/<?=$get_part0;?>?select=uploadimg_mobile",
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
						$(".slideid").val(data.id);
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
				 data:  new FormData(form),
				 contentType: false,
				 cache: false,
				 processData:false,
				 dataType: "json",
				 success: function(data) {

					if(data.status=="success"){
						toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
						editData(data.id);
					}else{
						toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
					}


				 }
			});

		}));

	});

	//begin function
	$('.btnsave').on('click',function(e){
		e.preventDefault();

			if($("#slidename_th").val()==''){
				$("#slidename_th").css('border','1px solid red');
				$("#err_slidename_th").text('กรุณากรอกช่องนี้ด้วยครับ!');
			}else{
				$("#slidename_th").css('border','1px solid green');
				$("#err_slidename_th").text('');
			}
			if($("#slidename_en").val()==''){
				$("#slidename_en").css('border','1px solid red');
				$("#err_slidename_en").text('กรุณากรอกช่องนี้ด้วยครับ!');
			}else{
				$("#slidename_en").css('border','1px solid green');
				$("#err_slidename_en").text('');
			}


			if($("#slidename_th").val()=='' || $("#slidename_en").val()==''){
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
					$(".slideid").val(data.id);
					$("#slidename_th").val(data.slide_name_th);
					$("#slidename_en").val(data.slide_name_en);
					$("#slidedetail_th").val(data.slide_detail_th);
					$("#slidedetail_en").val(data.slide_detail_en);
					$("#slide_link").val(data.slide_link);
					$("#slide_youtube").val(data.slide_youtube);
					$("#slide_position_x").val(data.slide_position_x);
					$("#slide_position_y").val(data.slide_position_y);
					$("#creator").val(data.creator);
					$("#updatedate").val(data.datecreate);
					$("#slide_start_date").val(data.datestart);
					$("#slide_end_date").val(data.dateend);
					$("#sitepage").val(data.site_id);

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
			$("#imgavatar").empty();

			$.ajax({
				 type: "get",
				 async: false,
				 url: "<?=$url;?>/<?=$get_part0;?>",
				 data: {select: 'readdataimg',id:id},
				 dataType: "json",
				 success: function(data) {
					$("#slide_img").html(data.btnupload);
					$("#slide_img_tablet").html(data.btnupload_tablet);
					$("#slide_img_mobile").html(data.btnupload_mobile);
					$("#slide_img").css('background-image','url('+data.img+')');
					$("#slide_img_tablet").css('background-image','url('+data.img_tablet+')');
					$("#slide_img_mobile").css('background-image','url('+data.img_mobile+')');
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
				 data: {select: 'delimg',id:id,f:param},
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
