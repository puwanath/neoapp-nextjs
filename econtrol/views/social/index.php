<div class="br-mainpanel">
  <div class="br-pageheader pd-x-5 pd-y-5 pd-md-l-10">
    <nav class="breadcrumb pd-0 mg-0 tx-14">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
      <span class="breadcrumb-item active"><?=$pagename;?></span>
    </nav>
  </div><!-- br-pageheader -->

  <div class="br-pagebody pd-x-5 pd-sm-x-10 mg-b-20">
    <div class="adiv card bd-0 shadow-base pd-0">
			<div class="mg-l-auto hidden-xs-down pd-5 text-right">
        <?php echo getMenu_permission_button($mainmenu);?>
        <a href="javascript:history.back();" class="btn btn-secondary btn-with-icon hidden-xs-down">
          <div class="ht-40">
            <span class="icon wd-40"><i class="icon ion-reply"></i></span>
            <span class="pd-x-15">ย้อนกลับ</span>
          </div>
        </a>
	    </div>
			<form role="form" action="#" method="POST" id="action-form" enctype="multipart/form-data">
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 bd-t bd-2">
					<div class="panel">
						<div class="panel-body pd-t-10">
							<div class="row">
								<div class="col-lg">
									<div class="form-group">
										<label class="control-label">ลิงค์เว็บไซต์</label>
										<input type="text" name="txtlink" id="txtlink" class="form-control" />
									</div>
								</div>
								<div class="col-lg">
									<div class="form-group">
										<label class="control-label">facebook</label>
										<input type="text" name="txtfacebook" id="txtfacebook" class="form-control" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg">
									<div class="form-group">
										<label class="control-label">facebook chat</label>
										<input type="text" name="txtfacebookchat" id="txtfacebookchat" class="form-control" />
									</div>
								</div>
								<div class="col-lg">
									<div class="form-group">
										<label class="control-label">google+</label>
										<input type="text" name="txtgoogle" id="txtgoogle" class="form-control" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg">
									<div class="form-group">
										<label class="control-label">line@</label>
										<input type="text" name="txtlineadd" id="txtlineadd" class="form-control" />
									</div>
								</div>
								<div class="col-lg">
									<div class="form-group">
										<label class="control-label">line ID</label>
										<input type="text" name="txtlineid" id="txtlineid" class="form-control" />
									</div>
								</div>
							</div>
							<div class="row">
									<div class="col-lg">
										<div class="form-group">
											<label class="control-label">youtube</label>
											<input type="text" name="txtyoutube" id="txtyoutube" class="form-control" />
										</div>
									</div>
									<div class="col-lg">
										<div class="form-group">
											<label class="control-label">instagram</label>
											<input type="text" name="txtinstagram" id="txtinstagram" class="form-control" />
										</div>
									</div>
							</div>
							<div class="row">
								<div class="col-lg">
									<div class="form-group">
										<label class="control-label">วันที่อัพเดทข้อมูล</label>
										<input type="text" name="txtupdatedate" id="txtupdatedate" class="form-control" disabled/>
									</div>
								</div>
							</div>


						</div>
					</div>
				</div>

			</form>
			<div class="mg-l-auto hidden-md-up">
				<a href="javascript:;" id="btnsave" class="btn btn-info"> บันทึกแก้ไข </a>
				<a href="javascript:history.back();" class="btn btn-outline-info mg-l-5"> ย้อนหลับ </a>
	    </div>
    </div>
  </div><!-- br-pagebody -->
</div><!-- br-contentpanel -->
<style type="text/css">
  html { height: 100%; }
  body { height: calc(100% - 60px); }

  .br-mainpanel { height: 100%; }
  .br-pagebody { height: calc(100% - 60px); }

  .adiv { height: calc(100% - 0px); display: block; }
  .gdiv { height: calc(100% - 45px); }
  .ndiv { height: calc(100% - 20px); }
  .mdiv { height: calc(100% - 0px); }

</style>

<script type="text/javascript">

	$(document).ready(function(e){
		if ( top.location.href != location.href ) top.location.href = location.href;

		$(".btnsave").on('click',function(e){
			e.preventDefault();
			$("#action-form").submit();
		});



		$("#action-form").on('submit',(function(e){
			e.preventDefault();

			$.ajax({
				 url: "<?=$url;?>/setting/social?select=update",
				 type: "post",
				 data:  new FormData(this),
				 contentType: false,
				 cache: false,
				 processData:false,
				 dataType: "json",
				 success: function(data) {

					if(data.status=="success"){
						toastr.success(data.msg, 'Update Social link Success!',{timeOut: 5000,closeButton: true});
						loadData();

					}else{
						toastr.error(data.msg, 'Update Social link Error!',{timeOut: 5000,closeButton: true});
					}
				 }
			});

		}));



	});



	//load data
	function loadData(){

		$.ajax({
			 type: "get",
			 async: false,
			 url: "<?=$url;?>/setting/social",
			 data: {select: 'loaddata'},
			 dataType: "json",
			 success: function(data) {

				$("#txtlink").val(data.linkurl);
				$("#txtfacebook").val(data.facebook);
				$("#txtfacebookchat").val(data.facebookchat);
				$("#txtgoogle").val(data.google);
				$("#txtlineadd").val(data.lineadd);
				$("#txtlineid").val(data.line);
				$("#txtyoutube").val(data.youtube);
				$("#txtinstagram").val(data.instagram);
				$("#txtupdatedate").val(data.updatedate);
			 }
		});

	};

	loadData();  // ทำงานครั้งแรกทันที 1 ครั้ง


	</script>
