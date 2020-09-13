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
								<div class="form-group">
									<label class="control-label">Title</label>
									<input type="text" name="txttitle" id="txttitle" class="form-control" />
									<span id="title_err" style="color:red;"></span>
								</div>
								<div class="form-group">
									<label class="control-label">Description</label>
									<input type="text" name="txtdesc" id="txtdesc" class="form-control" />
								</div>
								<div class="form-group">
									<label class="control-label">Keyword</label>
									<input type="text" class="form-control" name="txtkeyword" id="txtkeyword" data-role="tagsinput" value="" style="width:100%;"/>
								</div>
								<div class="form-group">
									<label class="control-label">Google ID</label>
									<input type="text" name="txtgoogle" id="txtgoogle" class="form-control" />
								</div>
								<div class="form-group">
									<label class="control-label">Google Domain</label>
									<input type="text" name="txtgoogledomain" id="txtgoogledomain" class="form-control" />
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
			if($("#txttitle").val()==''){
				$("#txttitle").css('border','1px solid red');
				$("#title_err").text('กรุณากรอก Title เว็บไซต์ด้วยครับ!');
				return false;
			}else{
				$("#action-form").submit();
			}
		});


		$("#action-form").on('submit',(function(e){
			e.preventDefault();


			$.ajax({
				 url: "<?=$url;?>/setting/seo?select=update",
				 type: "post",
				 data:  new FormData(this),
				 contentType: false,
				 cache: false,
				 processData:false,
				 dataType: "json",
				 success: function(data) {

					if(data.status=="success"){
						toastr.success(data.msg, 'Update SEO Success!',{timeOut: 5000,closeButton: true});
						loadData();

					}else{
						toastr.error(data.msg, 'Update SEO Error!',{timeOut: 5000,closeButton: true});
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
			 url: "<?=$url;?>/setting/seo",
			 data: {select: 'loaddata'},
			 dataType: "json",
			 success: function(data) {

				$("#txttitle").val(data.seotitle);
				$("#txtdesc").val(data.seodesc);
				$("#txtkeyword").val(data.seokeyword);
				$("#txtgoogle").val(data.googleid);
				$("#txtgoogledomain").val(data.googledomain);
			 }
		});

	};

	loadData();  // ทำงานครั้งแรกทันที 1 ครั้ง
</script>
