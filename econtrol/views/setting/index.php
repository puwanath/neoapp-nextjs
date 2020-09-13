<div class="br-mainpanel">
  <div class="br-pageheader pd-x-15 pd-y-5 pd-md-l-10">
    <nav class="breadcrumb pd-0 mg-0 tx-14">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
      <span class="breadcrumb-item active"><?=$pagename;?></span>
    </nav>
  </div><!-- br-pageheader -->

  <div class="br-pagebody pd-x-15 pd-sm-x-15 mg-b-20">
    <div class="card bd-0 shadow-base pd-0">
      <div class="row pd-y-5 mg-x-0-force bd-b">
        <div class="col-md-6 col-xs-6 pd-x-5">
          <h5 class="panel-title mg-b-0-force ht-40" style="line-height: 2;" ><?=$pagename;?></h5>
        </div>
        <div class="col-md-6 col-xs-6 text-right pd-x-5 hidden-xs-down">
          <?php echo getMenu_permission_button($mainmenu);?>
          <a href="javascript:history.back();" class="btn btn-secondary btn-with-icon hidden-xs-down">
            <div class="ht-40">
              <span class="icon wd-40"><i class="icon ion-reply"></i></span>
              <span class="pd-x-15">ย้อนกลับ</span>
            </div>
          </a>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <form role="form" action="#" method="POST" id="action-form" enctype="multipart/form-data">
    				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
    					<div class="panel">
    						<div class="panel-body">
    							<div class="row">
    								<div class="col-lg-9 col-sm-8 col-xs-12 bg-gray-100  pd-t-20">
    									<div class="row">
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">ชื่อหน่วยงาน/บริษัท (TH)</label>
    												<input type="text" name="txtcompname_th" id="txtcompname_th" class="form-control" />
    												<span style="color:red;" id="errcompname_th"></span>
    											</div>
    										</div>
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">Company Name (EN)</label>
    												<input type="text" name="txtcompname_en" id="txtcompname_en" class="form-control" />
    												<span style="color:red;" id="errcompname_en"></span>
    											</div>
    										</div>
    									</div>
    									<div class="row">
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">ที่อยู่1 (บ้านเลขที่ ซอย ถนน) (TH)</label>
    												<input type="text" name="txtadddess1_th" id="txtadddess1_th" class="form-control" />
    											</div>
    										</div>
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">ที่อยู่2 (แขวง เขต) (TH)</label>
    												<input type="text" name="txtadddess2_th" id="txtadddess2_th" class="form-control" />
    											</div>
    										</div>
    									</div>
    									<div class="row">
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">Address1 (Home number, Soi, Road) (EN)</label>
    												<input type="text" name="txtadddess1_en" id="txtadddess1_en" class="form-control" />
    											</div>
    										</div>
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">Address2 (District, County) (EN)</label>
    												<input type="text" name="txtadddess2_en" id="txtadddess2_en" class="form-control" />
    											</div>
    										</div>
    									</div>
    									<div class="row">
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">จังหวัด/Province</label>
    												<select name="txtprovince" id="txtprovince" class="form-control select2-show-search" data-placeholder="select province"></select>
    											</div>
    										</div>
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">รหัสไปรษณีย์/Postcode</label>
    												<input type="text" name="txtpostcode" id="txtpostcode" maxlenght="5" class="form-control" />
    											</div>
    										</div>
    									</div>
    									<div class="row">
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">ประเภทบริษัท/Type Company</label>
    												<select name="txtbrancetype" id="txtbrancetype" class="form-control">
    													<option value="head-office">สำนักงานใหญ่</option>
    													<option value="brance">สาขา</option>
    												</select>
    											</div>
    										</div>
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">เลขที่สาขา/Brance No.</label>
    												<input type="text" name="txtbranceno" id="txtbranceno" class="form-control" />
    											</div>
    										</div>
    									</div>
    									<div class="row">
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">เบอร์โทร1</label>
    												<input type="text" name="txttel1" id="txttel1" class="form-control" />
    											</div>
    										</div>
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">เบอร์โทร2</label>
    												<input type="text" name="txttel2" id="txttel2" class="form-control" />
    											</div>
    										</div>
    									</div>
    									<div class="row">
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">อีเมล์</label>
    												<input type="text" name="txtemail" id="txtemail" class="form-control" />
    											</div>
    										</div>
    									</div>
                      <div class="row">
                        <div class="col-lg">
                          <div class="form-group">
                            <label class="control-label">ภาพโลโก้ (eControl)</label>
                            <div class="d-flex bg-gray-200 ht-250 pos-relative align-items-center imglogo" id="imglogo">
                              <!-- canvas logo econtrol -->
                            </div>
                            <div>
                              <span class="label label-danger">NOTE! </span>
      											  <span style="color:red;"> รูปประจำตัว ควรมีขนาดไม่เกิน 300x300px</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg">
                          <div class="form-group">
                            <label class="control-label">ภาพโลโก้ (เว็บไซต์)</label>
                            <div class="d-flex bg-gray-200 ht-250 pos-relative align-items-center imglogo" id="imglogoweb">
                              <!-- canvas logo econtrol -->
                            </div>
                            <div>
                              <span class="label label-danger">NOTE! </span>
      											  <span style="color:red;"> รูปประจำตัว ควรมีความกว้างไม่เกิน 300px</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg">
                          <div class="form-group">
                            <label class="control-label">ภาพหัวเอกสาร</label>
                            <div class="d-flex bg-gray-200 ht-250 pos-relative align-items-center imglogo" id="imgheadprint">
                              <!-- canvas logo econtrol -->
                            </div>
                            <div>
                              <span class="label label-danger">NOTE! </span>
      											  <span style="color:red;"> รูปประจำตัว ควรมีขนาดไม่เกิน 1000x200px</span>
                            </div>
                          </div>
                        </div>
                      </div>
    								</div>
    								<div class="col-lg-3 col-sm-4 col-xs-12 bg-gray-300 pd-t-20">
    									<div class="form-group">
    										<label class="control-label">เลขผู้เสียภาษี</label>
    										<input type="text" name="txttax" id="txttax" class="form-control" />
    									</div>
    									<div class="form-group">
    										<label class="control-label">กำหนดอัตราภาษีมูลค่าเพิ่ม VAT 7%</label>
    										<input type="text" name="txtvat7" id="vat7" class="form-control" />
    									</div>
    									<div class="form-group">
    										<label class="control-label">อัตราค่าธรรมเนียม</label>
    										<input type="text" name="txtfee" id="fee" class="form-control" />
    									</div>
    									<div class="form-group">
    										<label class="control-label">Mail Host</label>
    										<input type="text" name="mail_host" id="mail_host" class="form-control" />
    									</div>
    									<div class="form-group">
    										<label class="control-label">Mail Port</label>
    										<input type="text" name="mail_port" id="mail_port" class="form-control" />
    									</div>
    									<div class="form-group">
    										<label class="control-label">Mail Username</label>
    										<input type="text" name="mail_username" id="mail_username" class="form-control" />
    									</div>
    									<div class="form-group">
    										<label class="control-label">Mail Password</label>
    										<input type="text" name="mail_password" id="mail_password" class="form-control" />
    									</div>
    									<div class="form-group">
    										<label class="control-label">วันที่อัพเดทข้อมูล</label>
    										<input type="text" name="txtupdatedate" id="txtupdatedate" class="form-control" disabled/>
    									</div>

    									<div class="form-group">
    										<label class="control-label">สถานะเปิดปิดระบบ</label>
    										<select class="form-control" id="status" name="status">
    											<option value="1" selected>เปิดระบบ</option>
    											<option value="0" >ปิดระบบ</option>
    										</select>


    									</div>

    								</div>
    							</div>


    						</div>
    					</div>
    				</div>

    			</form>
          <form name="frmupload_logo_econtrol" action="" id="fle-form" enctype="multipart/form-data">
            <input type="file" name="fle" id="fle" style="display:none;">
          </form>
          <form name="frmupload_logo_web" action="" id="fleweb-form" enctype="multipart/form-data">
            <input type="file" name="fleweb" id="fleweb" style="display:none;">
          </form>
          <form name="frmupload_head_print" action="" id="fleheadprint-form" enctype="multipart/form-data">
            <input type="file" name="fleheadprint" id="fleheadprint" style="display:none;">
          </form>
        </div>
      </div>
			<div class="hidden-md-up pd-10 bg-gray-600">
				<button type="button" class="btnsave btn btn-primary btn-with-icon">
					<div class="ht-40">
						<span class="icon wd-40"><i class="fa fa-save"></i></span>
						<span class="pd-x-15">บันทึกแก้ไข</span>
					</div>
				</button>
        <a href="javascript:history.back();" class="btn btn-secondary btn-with-icon">
          <div class="ht-40">
            <span class="icon wd-40"><i class="icon ion-reply"></i></span>
            <span class="pd-x-15">ย้อนกลับ</span>
          </div>
        </a>
	    </div>
    </div>
  </div><!-- br-pagebody -->
</div><!-- br-contentpanel -->



<script type="text/javascript">

  function btngetfile(param){
    $('#'+param).click();
  }


	$(document).ready(function(e){
		if ( top.location.href != location.href ) top.location.href = location.href;

		$(".btnsave").on('click',function(e){
			e.preventDefault();
			$("#action-form").submit();
		});

    // upload image
    $('#fle').change(function(){
      $('#fle-form').submit();
    });
    $('#fleweb').change(function(){
      $('#fleweb-form').submit();
    });
    $('#fleheadprint').change(function(){
      $('#fleheadprint-form').submit();
    });

    $("#fle-form").on('submit',(function(e){
      e.preventDefault();
      $.ajax({
        url: "<?=$url;?>/setting/config?select=uploadimg-logo",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType: "json",
        success: function(data){

          if(data.status=="success"){
            toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
            loadData();
          }else{
            toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
          }

        },
        error: function(){}
      });
    }));
    $("#fleweb-form").on('submit',(function(e){
      e.preventDefault();
      $.ajax({
        url: "<?=$url;?>/setting/config?select=uploadimg-logoweb",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType: "json",
        success: function(data){

          if(data.status=="success"){
            toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
            loadData();
          }else{
            toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
          }

        },
        error: function(){}
      });
    }));
    $("#fleheadprint-form").on('submit',(function(e){
      e.preventDefault();
      $.ajax({
        url: "<?=$url;?>/setting/config?select=uploadimg-headlogo",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType: "json",
        success: function(data){

          if(data.status=="success"){
            toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
            loadData();
          }else{
            toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
          }

        },
        error: function(){}
      });
    }));


    // end upload image

		$("#action-form").on('submit',(function(e){
			e.preventDefault();


			$.ajax({
				 url: "<?=$url;?>/setting/config?select=update",
				 type: "post",
				 data:  new FormData(this),
				 contentType: false,
				 cache: false,
				 processData:false,
				 dataType: "json",
				 success: function(data) {

					if(data.status=="success"){
						toastr.success(data.msg, 'Update Config Success!',{timeOut: 5000,closeButton: true});
						loadData();

					}else{
						toastr.error(data.msg, 'Update Config Error!',{timeOut: 5000,closeButton: true});
					}
				 }
			});

		}));



	});

  function delImg(param){
    $.ajax({
      url: "<?=$url;?>/setting/config?select=delimg&f="+param,
      type: "get",
      data: {select: 'delimg'},
      timeout: 3000,
      dataType: "json",
      success: function(data){

        if(data.status=="success"){
          toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
          loadData();
        }else{
          toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
        }

      },
      error: function(){}
    });
  }


	//load data
	function loadData(){

		$.ajax({
			 type: "get",
			 async: false,
			 url: "<?=$url;?>/setting/config",
			 data: {select: 'loaddata'},
			 dataType: "json",
			 success: function(data) {

				$("#txtcompname_th").val(data.companyname);
				$("#txtcompname_en").val(data.companyname_en);
				$("#txtadddess1_th").val(data.companyaddress1);
				$("#txtadddess2_th").val(data.companyaddress2);
				$("#txtadddess1_en").val(data.companyaddress1_en);
				$("#txtadddess2_en").val(data.companyaddress2_en);
				$("#txtpostcode").val(data.companypostcode);
				$("#txttel1").val(data.companytel1);
				$("#txttel2").val(data.companytel2);
				$("#txtemail").val(data.companyemail);
				$("#txttax").val(data.companytax);
				$("#vat7").val(data.vat);
				$("#fee").val(data.fee);
				$("#txtbrancetype").val(data.brancetype);
				$("#txtbranceno").val(data.branceno);
				$("#imglogo").css('background-image','url(' + data.logo + ')');
				$("#imglogo").html(data.btn_logo);
				$("#imglogoweb").css('background-image','url(' + data.logoweb + ')');
				$("#imglogoweb").html(data.btn_logoweb);
				$("#imgheadprint").css('background-image','url(' + data.headlogo + ')');
				$("#imgheadprint").html(data.btn_headlogo);
				$("#txtupdatedate").val(data.dateupdate);
				$("#status").val(data.status);
				$("#mail_host").val(data.mail_host);
				$("#mail_port").val(data.mail_port);
				$("#mail_username").val(data.mail_username);
				$("#mail_password").val(data.mail_password);
        laodProvince(data.companyprovince);

			 }
		});

	};
	loadData();  // ทำงานครั้งแรกทันที 1 ครั้ง

  function laodProvince(prov = null){
    $('#txtprovince').empty();

    var q_url = '<?=$url;?>/<?=$get_part0;?>/config/?select=loadprovince';
    $.ajax({
      url: q_url,
      type: 'get',
      dataType: 'json',
      timeout: 3000,
      success: function(data, textStatus, jqXHR ) {
        $('#txtprovince').append('<option value=""> เลือกจังหวัด </option>');
        $.each(data.datarow, function(index, value){
          if(prov==value.id){
            $('#txtprovince').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
          }else{
            $('#txtprovince').append('<option value="' + value.id + '">' + value.name + '</option>');
          }

        });

      },
      error: function(jqXHR, textStatus, errorThrown) {

      }

    });
  }


	</script>
