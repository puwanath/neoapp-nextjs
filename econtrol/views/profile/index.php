<div class="br-mainpanel">
  <div class="br-pageheader pd-y-5 pd-x-5 pd-md-l-10">
    <nav class="breadcrumb pd-0 mg-0 tx-14">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
      <span class="breadcrumb-item active"><?=$pagename;?></span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagebody pd-x-5 pd-sm-x-5">
    <div class="card bd-0 shadow-base pd-0">
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
					<div class="panel">
						<!-- <div class="panel-heading">
	            <div class="panel-actions panel-actions-keep">
	              <a class="text-action" href="javascript:void(0)"><i class="icon wb-edit" aria-hidden="true"></i></a>
	            </div>
	            <h3 class="panel-title">test</h3>
	          </div> -->
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-3 col-sm-4 col-xs-12 bg-gray-300 pd-0 pd-l-0 pd-r-0">
                  <div class="card">
                    <img class="card-img-top img-fluid" id="imgava" src="<?=$url;?>/images/userimg.jpg" alt="Image">
                    <div class="btn-group" role="group" aria-label="" style="width:100%;">
                      <button type="button" onclick="clickFle();" class="btn btn-secondary pd-x-25" style="width:50%;">เปลี่ยนรูปโปรไฟล์</button>
                      <button type="button" onclick="window.location.href='?logout'" class="btn btn-secondary pd-x-25" style="width:50%;">ออกจากระบบ</button>
                    </div>
                    <div class="card-body">
                      <h4 class="profile-user"><span id="userfullname">{Profile Name}</span></h4>
                      <p class="profile-job"><?php echo $levelname;?></p>
                      <p></p>
                    </div>
                  </div><!-- card -->

                  <form method="post" action="" id="imgupload" enctype="multipart/form-data" >
                    <input type="file" id="profilepic" name="fle"  style="width:0px;height:0px;display:none;"/>
                  </form>

								</div>
								<div class="col-lg-9 col-sm-8 col-xs-12 bg-gray-100 pd-t-20">
                  <!-- Panel -->
                  <div class="panel">
                    <div class="panel-body nav-tabs-animate nav-tabs-horizontal" data-plugin="tabs">
                      <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                        <li class="nav-item" role="presentation"><a class="active nav-link" data-toggle="tab" href="#profile" aria-controls="profile" role="tab">Profile</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#changepassword" aria-controls="chanepassword" role="tab">Change Password</a></li>
                      </ul>
                      <div class="tab-content" style="padding-top:10px;">
                        <div class="tab-pane active animation-slide-left" id="profile" role="tabpanel" style="padding:20px;">
        									<form role="form" action="#" method="POST" enctype="multipart/form-data">
        										<input type="hidden" id="userid" name="userid"/>
        										<div class="form-group">
        											<label class="control-label">ชื่อจริง</label>
        											<input type="text" name="txtname" id="txtname" class="form-control" />
        										</div>
        										<div class="form-group">
        											<label class="control-label">นามสกุล</label>
        											<input type="text" name="txtlastname" id="txtlastname" class="form-control" />
        										</div>
        										<div class="form-group">
        											<label class="control-label">เบอร์โทร</label>
        											<input type="text" name="txttel" id="txttel" class="form-control" />
        										</div>
        										<div class="form-group">
        											<label class="control-label">อีเมล์</label>
        											<input type="text" name="txtemail" id="txtemail" class="form-control" />
        										</div>

        										<div class="margiv-top-10">

        											<a href="javascript:updateData();" class="btn btn-primary"> บันทึกแก้ไข </a>
        											<a href="javascript:history.back();" class="btn btn-danger"> ยกเลิก </a>
        										</div>
        									</form>
                        </div>
                        <div class="tab-pane animation-slide-left" id="changepassword" role="tabpanel" style="padding:20px;">
        									<form action="#">
        										<div class="form-group">
        											<label class="control-label">รหัสผ่านเดิม</label>
        											<input type="password" name="currentpass" id="currentpass" class="form-control" required /> </div>
        										<div class="form-group">
        											<label class="control-label">รหัสผ่านใหม่</label>
        											<input type="password" name="newpass" id="newpass" class="form-control" required /> </div>
        										<div class="form-group">
        											<label class="control-label">ยืนยันรหัสผ่านใหม่อีกครั้ง</label>
        											<input type="password" name="confirmpass" id="confirmpass" class="form-control" required /> </div>
        										<div class="margin-top-10">
        											<a href="javascript:changePassword();" class="btn btn-primary"> บันทึกเปลี่ยนรหัสผ่าน </a>
        											<a href="javascript:history.back();" class="btn btn-danger"> ยกเลิก </a>
        										</div>
        									</form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End Panel -->

								</div>
							</div>


						</div>
					</div>
				</div>
    </div>
  </div><!-- br-pagebody -->
</div><!-- br-contentpanel -->




<script type="text/javascript">

			var updateData;
			var updateImg;
			var changePassword;
			var loadData;
			function updateData(){
				//var pid = $(this).val();
				var id = $("#userid").val();
				var fullname = $("#txtname").val();
				var lastname = $("#txtlastname").val();
				var tel = $("#txttel").val();
				var email =	$("#txtemail").val();
				$.ajax({
					 type: "post",
					 async: false,
					 url: "<?=$url;?>/setting/profile",
					 data: {
						 select: 'update',
						 id:id,
						 fullname: fullname,
						 lastname: lastname,
						 tel:tel,
						 email:email
					 },
					 dataType: "json",
					 success: function(data) {

						if(data.status=="success"){
							loadData();

							toastr.success('อัพเดทโปรไฟล์สำเร็จ!', 'Update Success!',{timeOut: 5000,closeButton: true})

						}
					 }
				});

			}


			function clickFle(){
				$('#profilepic').click();
			}

			$(document).ready(function (e){
				if ( top.location.href != location.href ) top.location.href = location.href;
				$('#profilepic').change(function(){
				 $('#imgupload').submit();
			 });

				$("#imgupload").on('submit',(function(e){
				e.preventDefault();
				$.ajax({
				url: "<?=$url;?>/setting/profile?select=uploadimg",
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
			});


			function changePassword(){
				var id = $("#userid").val();
				var currentpass = $("#currentpass").val();
				var newpass = $("#newpass").val();
				var confirmpass = $("#confirmpass").val();
				$.ajax({
					 type: "post",
					 async: false,
					 url: "<?=$url;?>/setting/profile",
					 data: {
						 select: 'updatepassword',
						 id:id,
						 currentpass: currentpass,
						 newpass: newpass,
						 confirmpass: confirmpass
					 },
					 dataType: "json",
					 success: function(data) {

						if(data.status=="success"){
							loadData();
							toastr.success(data.msg, 'Update Success!',{timeOut: 5000,closeButton: true});

						}else{
							toastr.warning(data.msg, 'Change password warning!',{timeOut: 5000,closeButton: true});
						}

						$("#currentpass").val('');
						$("#newpass").val('');
						$("#confirmpass").val('');
					 }
				});

			}

			//load data
			function loadData(){

				$.ajax({
					 type: "get",
					 async: false,
					 url: "<?=$url;?>/setting/profile",
					 data: {select: 'loaddata',id:'<?=$user;?>'},
					 dataType: "json",
					 success: function(data) {
						$('#gmail_loading').show();
						$("#userid").val(data.id);
						$("#txtname").val(data.fullname);
						$("#txtlastname").val(data.lastname);
						$("#txttel").val(data.tel);
						$("#txtemail").val(data.email);
						$("#userfullname").text(data.fullname +' '+ data.lastname);
						$("#avatar").attr("src", data.img);
						$("#imgavatar").attr("src", data.img);
						$("#imgava").attr("src", data.imgbig);
						$('#gmail_loading').hide();
					 }
				});

			};

			loadData();  // ทำงานครั้งแรกทันที 1 ครั้ง


	</script>
