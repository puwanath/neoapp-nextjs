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
        <input type="hidden" name="ads_id" id="id" value="<?=$get_part2;?>"/>
        <input type="hidden" name="act" id="act" value="<?=$get_part1;?>"/>
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 bd bd-t bd-3 bd-x-0 bd-b-0">
					<div class="panel">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-9 col-sm-8 col-xs-12 bg-gray-100 pd-t-20">
									<div class="row">
										<div class="col-lg">
											<div class="form-group">
												<label for="ads_name" class="control-label">หัวข้อแบนเนอร์</label>
												<input type="text" name="ads_name" id="ads_name" class="form-control" />
												<span style="color:red;" id="err_ads_name"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg">
											<div class="form-group">
												<label for="ads_link" class="control-label">ลิงค์ (URL)</label>
												<input type="text" class="form-control" name="ads_link" id="ads_link" placeholder="Ex: http://kapongidea.com"/>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg">
                      <div class="form-group">
                        <label class="control-label">ตำแหน่งการแสดง</label>
                        <select class="form-control" id="ads_position" name="ads_position">
                          <option value="LEFT_TOP_SLIDE">ด้านซ้าย (บน) ของแบนเนอร์สไลน์ ขนาด 560x180px</option>
                          <option value="LEFT_BOTTOM_SLIDE">ด้านซ้าย (ล่าง) ของแบนเนอร์สไลน์ ขนาด 560x180px</option>
                          <option value="CENTER_PAGE" >กลางหน้า</option>
                          <option value="BEFORE_FOOTER" >ก่อน footer</option>
                        </select>
                      </div>
										</div>
									</div>
                  <div class="row">
										<div class="col-lg">
											<div class="form-group">
												<label for="ads_code" class="control-label">Code Script</label>
												<textarea class="form-control" name="ads_code" id="ads_code"></textarea>
											</div>
										</div>
									</div>
                  <div class="row">
                    <div class="col-lg">
                      <div class="form-group">
    										<label class="control-label">ภาพแบนเนอร์</label>
    										<div class="d-flex bg-gray-200 ht-400 pos-relative align-items-center imglogo" id="ads_img">
    											<!-- canvas logo econtrol -->
    										</div>
    										<div>
    											<span class="label label-danger">NOTE! </span>
    											<span style="color:red;"> รูปแบนเนอร์ ควรมีขนาดไม่เกิน ขนาดของตำแหน่งที่เลือก</span>
    										</div>
    									</div>
                    </div>
                  </div>

								</div>
								<div class="col-lg-3 col-sm-4 col-xs-12 bg-gray-300 pd-t-20">
									<div class="form-group">
    								<label for="datestart" class="control-label"> เริ่มแสดง (m/d/Y)</label>
    								<input type="text" name="datestart" id="datestart" value="<?php echo date("m/d/Y");?>" class="form-control datepicker"  />
                  </div>
									<div class="form-group">
    								<label for="dateend" class="control-label"> สิ้นสุดการแสดง (m/d/Y)</label>
    								<input type="text" name="dateend" id="dateend" value="<?php echo date("m/d/Y");?>" class="form-control datepicker"  />
                  </div>

								</div>
							</div>


						</div>
					</div>
				</div>

			</form>
			<form name="frmupload_logo_econtrol" method="post" action="" id="fle-form" enctype="multipart/form-data">
				<input type="hidden" name="ads_id" class="ads_id" />
				<input type="file" name="fle" id="fle" style="display:none;">
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
						$(".ads_id").val(data.id);
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

			if($("#ads_name").val()==''){
				$("#ads_name").css('border','1px solid red');
				$("#err_ads_name").text('กรุณากรอกช่องนี้ด้วยครับ!');
			}else{
				$("#ads_name").css('border','1px solid green');
				$("#err_ads_name").text('');
			}
			if($("#ads_position").val()==''){
				$("#ads_position").css('border','1px solid red');
				$("#err_ads_position").text('กรุณากรอกช่องนี้ด้วยครับ!');
			}else{
				$("#ads_position").css('border','1px solid green');
				$("#err_ads_position").text('');
			}


			if($("#ads_name").val()=='' || $("#ads_position").val()==''){
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
					$(".ads_id").val(data.id);
					$("#ads_name").val(data.ads_name);
					$("#ads_code").val(data.ads_code);
					$("#ads_link").val(data.ads_link);
					$("#ads_position").val(data.ads_position);
					$("#datestart").val(data.datestart);
					$("#dateend").val(data.dateend);

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
			$("#ads_img").empty();

			$.ajax({
				 type: "get",
				 async: false,
				 url: "<?=$url;?>/<?=$get_part0;?>",
				 data: {select: 'readdataimg',id:id},
				 dataType: "json",
				 success: function(data) {
					$("#ads_img").html(data.btnupload);
					$("#ads_img").css('background-image','url('+data.img+')');
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
