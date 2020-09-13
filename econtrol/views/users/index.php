<div class="br-mainpanel">
  <div class="br-pageheader pd-x-5 pd-y-5 pd-md-l-10">
    <nav class="breadcrumb pd-0 mg-0 tx-14">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
      <span class="breadcrumb-item active"><?=$pagename;?></span>
    </nav>
  </div><!-- br-pageheader -->

  <div class="br-pagebody pd-x-5 pd-sm-x-5 mg-b-20">
    <div class="adiv card bd-0 shadow-base pd-0">
				<div class="gdiv col-lg-12 col-md-12 col-xs-12 col-sm-12">
					<div class="ndiv panel">
						<div class="mdiv panel-body">
							<div class="row">
								<div class="col-lg-4 col-sm-4 col-xs-12 bg-gray-300">
									<div class="row pd-y-5" style="border-bottom:2px solid #333;">
                    <div class="col-md-6 col-xs-6 pd-x-5">
                      <h5 class="panel-title mg-b-0-force" style="line-height: 1.5;" >จัดการกลุ่มระดับสิทธิ์</h5>
                    </div>
                    <div class="col-md-6 col-xs-6 text-right pd-x-5">
                      <a class="btn btn-info btn-sm" href="javascript:void(0)" id="addlevel"> เพิ่มระดับสิทธิ์ </a>
                    </div>
			            </div>
                  <div class="row">
                    <div class="gdiv col-lg-12 col-md-12 col-xs-12 pd-x-0-force">
                      <!--BEGIN PAGE -->
                      <table id="jqGridlist_permission" class="table table-striped"></table>
                      <div id="jqGridPager_permission"></div>
          						<!--END PAGE -->
                    </div>
                  </div>

								</div>
								<div class="col-lg-8 col-sm-8 col-xs-12 bg-gray-100">
                  <div class="row pd-y-5" style="border-bottom:2px solid #333;">
                    <div class="col-md-6 col-xs-6 pd-x-5">
                      <h5 class="panel-title mg-b-0-force" style="line-height: 1.5;" >รายชื่อผู้ใช้งานระบบ</h5>
                    </div>
                    <div class="col-md-6 col-xs-6 text-right pd-x-5">
                      <a href="javascript:void(0);" id="adduser" class="btn btn-info btn-sm"> เพิ่มผู้ใช้งานระบบ </a>
  										<a href="javascript:history.back();" class="btn btn-secondary btn-sm mg-l-5"> ย้อนกลับ </a>
                    </div>
			            </div>
                  <div class="row pd-y-5" style="border-bottom:2px solid #333;background-color:#333;">
                    <div class="col-md-6 col-xs-6 pd-x-5">
                      <div class="input-group">
                        <input type="text" class="form-control" name="search" id="searchkeyword" placeholder="ค้นหาด้วยคีย์เวิร์ด...">
                        <span class="input-group-btn">
                          <button class="btn bd bg-white tx-gray-600" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                      </div>
                    </div>
			            </div>
                  <div class="row">
                    <div class="gdiv col-lg-12 col-md-12 col-xs-12 pd-x-0-force">
                      <!--BEGIN PAGE -->
                      <table id="jqGridlist"></table>
                      <div id="jqGridPager"></div>
          						<!--END PAGE -->
                    </div>
                  </div>

								</div>
							</div>


						</div>
					</div>
				</div>
    </div>
  </div><!-- br-pagebody -->
</div><!-- br-contentpanel -->


<!-- form add user -->
<div id="add-modal" class="modal fade" aria-hidden="false">
	 <div class="modal-dialog modal-lg" role="document" style="width:100%;">
		 <div class="modal-content bd-0 tx-14">
			 <form name="frm" class="form-horizontal" id="action-form" role="form" method="post" action="">
 				<input type="hidden" name="iduser" id="iduser" />
 				<input type="hidden" name="cmduser" id="cmduser" value="add" />
			 <div class="modal-header pd-y-20 pd-x-25">
				 <h6 class="tx-16 mg-b-0 tx-uppercase tx-inverse tx-bold" id="formuser-title">{TEXT TITLE}</h6>
				 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <span aria-hidden="true">&times;</span>
				 </button>
			 </div>
			 <div class="modal-body pd-t-0-force pd-b-0-force">
				 <div class="row">
					 <div class="col-lg-8 col-xs-12 bg-gray-100 pd-t-10-force pd-b-10-force">
						 <div class="form-group">
							 <label for="txtname" class="control-label">ชื่อจริง</label>
							 <input type="text" class="form-control" id="txtname" name="txtname" placeholder="Firstname" required>
							 <span id="usererr0" style="color:red;"></span>
						 </div>
						 <div class="form-group">
							 <label for="txtlastname" class="control-label">นามสกุล</label>
							 <input type="text" class="form-control" id="txtlastname" name="txtlastname" placeholder="Lastname" required>
						 </div>
						 <div class="form-group">
							 <label for="txtemail" class="control-label">อีเมล์</label>
							 <input type="email" class="form-control" id="txtemail" name="txtemail" placeholder="Email" required>
						 </div>
						 <div class="form-group">
							 <label for="txttel" class="control-label">โทร</label>
							 <input type="tel" class="form-control" id="txttel" name="txttel" placeholder="Tel" required>
						 </div>

						 <div class="form-group">
							 <label for="txttel" class="control-label">USERNAME</label>
							 <input type="text" class="form-control" id="txtusername" name="txtusername" placeholder="Username" required>
							 <span id="usererr1" style="color:red;"></span>
						 </div>
						 <div class="form-group">
							 <label for="txttel" class="control-label">PASSWORD</label>
							 <input type="text" class="form-control" id="txtpassword" name="txtpassword" placeholder="Password" required>
							 <span id="usererr2" style="color:red;"></span>
						 </div>
					 </div>
					 <div class="col-lg-4 col-xs-12 bg-gray-300 pd-t-10-force pd-b-10-force">

						 <div class="form-group">
							 <label class="control-label">รูปภาพ</label>
							 <div class="d-flex bg-gray-200 ht-250 pos-relative align-items-center imglogo" id="imgavatar">
									 <div class="sk-rotating-plane" style="margin: 0 auto;">
  						 				<button type="button" onclick="btngetfile('fle')" class="btn btn-primary btn-oblong
  						 				bd-2 pd-x-30 pd-y-15 tx-uppercase tx-bold tx-spacing-6 tx-12">
  						 					<i class="fa fa-upload"></i> อัพโหลดภาพ
  						 				</button>
  						 		 </div>
							 </div>
							 <div>
								 <span class="label label-danger">NOTE! </span>
								 <span style="color:red;"> รูปประจำตัว ควรมีขนาดไม่เกิน 300x300px</span>
							 </div>
						 </div>
						 <div class="form-group">
							 <label for="txtlevel" class="control-label">ระดับสิทธิ์</label>
							 <select class="form-control" name="txtlevel" id="txtlevel">
								 <!-- <option value="1">ผู้ดูแลระบบ</option>
								 <option value="2" selected>ผู้ใช้งานทั่วไป</option> -->

							 </select>
						 </div>
						 <div class="form-group">
							 <label for="txtstatus" class="control-label">สถานะ</label>
							 <select class="form-control" name="txtstatus" id="txtstatus">
								 <option value="0">ไม่อนุญาติให้ใช้งาน</option>
								 <option value="1" selected>อนุญาติให้ใช้งาน</option>

							 </select>
						 </div>
					 </div>

				 </div>
			 </div>
			 </form>
			 <form name="frmupload_logo_econtrol" action="" id="fle-form" method="post" enctype="multipart/form-data">
				 <input type="hidden" name="uid" id="uid" />
         <input type="file" name="fle" id="fle" style="display:none;">
       </form>
			 <div class="modal-footer">
				 <button type="button" id="btnsubmituser" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Save</button>
				 <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium btn-close-form" data-dismiss="modal">Close</button>
			 </div>
		 </div>
	 </div><!-- modal-dialog -->
 </div><!-- modal -->
<!-- form add user -->

<!-- ++++++++++++++++++++++++++++++++form level -->
<div id="form-level" class="modal fade" aria-hidden="false">
	 <div class="modal-dialog" role="document" style="width:100%;">
		 <div class="modal-content bd-0 tx-16">
			 <form class="form-horizontal" id="action-form-level" role="form" action="" method="post" enctype="multipart/form-data">
 				<input type="hidden" name="cmdlevel" id="cmdlevel" value=""/>
 				<input type="hidden" name="levelid" id="levelid" value=""/>
			 <div class="modal-header pd-y-20 pd-x-25">
				 <h6 class="tx-16 mg-b-0 tx-uppercase tx-inverse tx-bold" id="form-title">{TEXT TITLE}</h6>
				 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					 <span aria-hidden="true">&times;</span>
				 </button>
			 </div>
			 <div class="modal-body pd-25">
				 <div class="row">
					 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							 <div class="form-group">
								 <label for="txtlevelname" class="control-label">ชื่อระดับสิทธิ์</label>
								 <input type="text" class="form-control" id="txtlevelname" name="txtlevelname" placeholder="Level Name" required>
								 <span id="levelerr0" style="color:red;"></span>
							 </div>
							 <div class="form-group">
								 <label for="txtlevelstatus" class="control-label">สถานะ</label>
								 <select class="form-control" name="txtstatus" id="txtlevelstatus" >
									 <option value="0">ปิดใช้งาน</option>
									 <option value="1" selected>เปิดใช้งาน</option>
								 </select>
							 </div>
					 </div>

				 </div>
			 </div>
			 </form>
			 <div class="modal-footer">
				 <button type="button" id="btnsubmitlevel" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Save</button>
				 <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
			 </div>
		 </div>
	 </div><!-- modal-dialog -->
 </div><!-- modal -->
<!-- ++++++++++++++++++++++++++++++++form level -->


<style type="text/css">
  html { height: 100%; }
  body { height: calc(100% - 60px); }

  .br-mainpanel { height: 100%; }
  .br-pagebody { height: calc(100% - 60px); }

  .adiv { height: calc(100% - 0px); display: block; }
  .gdiv { height: calc(100% - 45px); }
  .ndiv { height: calc(100% - 20px); }
  .mdiv { height: calc(100% - 0px); }



  @media only screen and (max-width: 480px){
    .br-mainpanel { height: 100%; }
    .br-pagebody { height: calc(100% - 60px); }

    .adiv { height: calc(100% - 0px); display: block; }
    .gdiv { height: calc(100% - 50px); }
    .ndiv { height: calc(100% - 20px); }
    .mdiv { height: calc(100% - 0px); }

    .col-xs-6{ width: 50%;}
  }

  .ui-th-column-header,.ui-th-column
  {
    text-align: center !important;
  }

  .ui-jqgrid-bdiv{
    /*height: calc(100% - 10px) !important;
    max-height: 500px !important;*/
  }
</style>

<script type="text/javascript">
$.jgrid.styleUI.Bootstrap.base.rowTable = "table table-bordered table-striped";
// $.jgrid.defaults.width = 100;
$.jgrid.defaults.responsive = true;
$.jgrid.defaults.styleUI = 'Bootstrap4';

    $(document).ready(function (e) {
			// ATW
			if ( top.location.href != location.href ) top.location.href = location.href;

      $("#jqGridlist_permission").jqGrid({
        url: '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=loaduserlevel',
        editurl: '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>',
        datatype: "json",
        colModel: [
          {
				      label: '#',
              name: 'row',
              width: 40,
						  key: true,
              align: 'center',
              frozen : false,
						  editable: false
          },
          {
				      label: 'ระดับสิทธิ์',
              name: 'level_name',
              width: 150,
						  editable: false,
          },
          {
					    label: 'จัดการ',
              name: 'btn_act',
              width: 100,
              align: 'right',
              editable: false
          }
        ],
				sortname: 'level_id',
				sortorder : 'asc',
				loadonce: false,
				viewrecords: true,
    		shrinkToFit: true,
    		autowidth: true,
        page: 1,
        colMenu : false,
        altRows : false,
        scroll: 1,
        rowNum: 10,
        rowList:[10,25,50,100],
        emptyrecords: 'Scroll to bottom to retrieve new page',
        pager: "#jqGridPager_permission"
      });

      $("#jqGridlist_permission").jqGrid('navGrid', '#jqGridPager_permission',
        {
          edit: false,
          add: false,
          del: false,
          search: false,
          view: false
        }
      );

      $("#jqGridlist_permission").jqGrid('setFrozenColumns');

      // set auto height
      var height = $(window).height();
      $('.ui-jqgrid-bdiv').height(height-230);

      /* =====================================================================*/


      $("#jqGridlist").jqGrid({
        url: '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=loaddata',
        editurl: '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>',
        datatype: "json",
        colModel: [
          {
				      label: '#',
              name: 'row',
              width: 50,
						  key: true,
              align: 'center',
              frozen : false,
						  editable: false
          },
          {
				      label: 'Img',
              name: 'user_img',
              width: 60,
              align: 'center',
						  editable: false,
          },
          {
				      label: 'ชื่อ - สกุล',
              name: 'user_fullname',
              width: 200,
						  editable: false,
          },
          {
				      label: 'Username',
              name: 'user_name',
              width: 150,
						  editable: false,
          },
          {
				      label: 'ระดับสิทธิ์',
              name: 'user_level',
              width: 150,
						  editable: false,
          },
          {
				      label: 'เข้าสู่ระบบล่าสุด',
              name: 'user_last_login',
              width: 200,
						  editable: false,
          },
          {
					    label: 'จัดการ',
              name: 'btn_act',
              width: 150,
              align: 'right',
              editable: false
          }
        ],
				sortname: 'user_fullname',
				sortorder : 'asc',
				loadonce: false,
				viewrecords: true,
        // width: null,
    		shrinkToFit: false,
    		autowidth: true,
        // height: 100,
        page: 1,
        colMenu : false,
        altRows : false,
        scroll: 1,
        rowNum: 20,
        rowList:[20,30,50,100],
        emptyrecords: 'Scroll to bottom to retrieve new page',
        pager: "#jqGridPager"
      });

      $("#jqGridlist").jqGrid('navGrid', '#jqGridPager',
        {
          edit: false,
          add: false,
          del: false,
          search: false,
          view: true
        }
      );

      $("#jqGridlist").jqGrid('setFrozenColumns');

      // set auto height
      var height = $(window).height();
      $('#gview_jqGridlist .ui-jqgrid-bdiv').height(height-290);

      /* =====================================================================*/
      $("#searchkeyword").on('keyup',function(e){
        e.preventDefault();

        var search = $(this).val();
        // alert(search);
        // return false;
        var newurl= '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=loaddata&search='+search;
        $("#jqGridlist").jqGrid().setGridParam({url : newurl,datatype: "json"}).trigger("reloadGrid");


      });

      /*======================================================================*/

      /* =====================================================================*/

      // upload image
	    $('#fle').change(function(){
	      $('#fle-form').submit();
	    });

			$("#fle-form").on('submit',(function(e){
	      e.preventDefault();
	      $.ajax({
	        url: "<?=$url;?>/setting/users?select=uploadimg",
	        type: "POST",
	        data:  new FormData(this),
	        contentType: false,
	        cache: false,
	        processData:false,
	        dataType: "json",
	        success: function(data){

	          if(data.status=="success"){
              // $('#add-modal').modal('hide');
	            toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
	            loadImg(data.id);
              $("#cmduser").val('update');
              $("#iduser").val(data.id);
              $("#uid").val(data.id);
	          }else{
	            toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
	          }

	        },
	        error: function(){}
	      });
	    }));
			// end function upload

			$("#adduser").on('click',function(e){
				e.preventDefault();
				$('#action-form')[0].reset();
				$('#fle-form')[0].reset();
				$("#formuser-title").text('เพิ่มผู้ใช้งานระบบ');
				$("#cmduser").val('add');
				$("#add-modal").modal('show');
        loadImg(null);
        loadPermissionLevel(null);
			});

			$("#addlevel").on('click',function(e){
				e.preventDefault();
				$("#form-title").text('เพิ่มระดับสิทธิ์');
				$("#cmdlevel").val('addlevel');
				$("#form-level").modal('show');
			});

			$("#btnsubmitlevel").on('click',function(e){
				e.preventDefault();

				if($("#txtlevelname").val()==""){
					$("#txtlevelname").css('border','1px solid red;');
					$('#levelerr0').text('กรุณากรอกช่องนี้ด้วยครับ');
				}

				if($("#txtlevelname").val()!=''){
					$("#action-form-level").submit();
				}else{
					return false;
				}
			});

			$("#btnsubmituser").on('click',function(e){
				e.preventDefault();

				if($("#txtname").val()==""){
          $("#txtname").focus();
					$("#txtname").css('border','1px solid red;');
					$('#usererr0').text('กรุณากรอกช่องนี้ด้วยครับ');
				}else{
          $('#usererr0').text('');
        }
				if($("#txtusername").val()==""){
          $("#txtusername").focus();
					$("#txtusername").css('border','1px solid red;');
					$('#usererr1').text('กรุณากรอกช่องนี้ด้วยครับ');
				}else{
          $('#usererr1').text('');
        }

				if($("#txtname").val()!='' && $("#txtusername").val()!=''){
					$("#action-form").submit();
				}else{
					return false;
				}
			});

			$("#action-form-level").on('submit',(function(e){
				e.preventDefault();

				var cmd = $("#cmdlevel").val();
				$.ajax({
					 url: "<?=$url;?>/setting/users?select="+cmd,
					 type: "post",
					 data:  new FormData(this),
					 contentType: false,
					 cache: false,
					 processData:false,
					 timeout: 3000,
					 dataType: "json",
					 success: function(data) {

						if(data.status=="success"){

							toastr.success(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
							$('#form-level').modal('hide');
							$("#jqGridlist_permission").jqGrid().trigger("reloadGrid");
							$('#action-form-level')[0].reset();

						}else{
							toastr.error(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
						}

					 }
				});

			}));
			// end permission lecel


			//$('button[id^="adduser"]').click(function() {
			$("#action-form").on('submit',(function(e){
				e.preventDefault();
				var cmduser = $("#cmduser").val();

				$.ajax({
					 url: "<?=$url;?>/setting/users?select="+cmduser,
					 type: "post",
					 data:  new FormData(this),
					 contentType: false,
					 cache: false,
					 processData:false,
					 timeout: 3000,
					 dataType: "json",
					 success: function(data) {

						if(data.status=="success"){

							toastr.success(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
							$('#add-modal').modal('hide');
							$("#jqGridlist").jqGrid().trigger("reloadGrid");

							$('#action-form')[0].reset();
							$('#fle-form')[0].reset();
							// $("#fle").val('');
							//$("#imgavatar").attr("src",'');

						}else{
							toastr.error(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
						}
					 }
				});



			}));


      $(".btn-close-form").on('click',function(e){
        e.preventDefault();
        // alert('test');
        // return false;
        $('#add-modal').modal('hide');
      })


			function editRow(id){
				if ('undefined'!= typeof id) {
					$("#cmduser").val('update');

					$("#formuser-title").text('แก้ไขผู้ใช้งานระบบ');
					$("#imgavatar").empty();
				//var id = $(this).val();
				$.ajax({
					 type: "get",
					 async: false,
					 url: "<?=$url;?>/setting/users",
					 data: {select: 'readdata',id:id},
					 dataType: "json",
					 success: function(data) {

						$('#add-modal').modal('show');

						$("#iduser").val(data.id);
						$("#uid").val(data.id);
						$("#txtname").val(data.fullname);
						$("#txtlastname").val(data.lastname);
						$("#txtusername").val(data.username);
						$("#txtemail").val(data.email);
						$("#txttel").val(data.tel);
						$("#imgavatar").css('background-image','url('+data.img+')');
            loadImg(data.id);
            loadPermissionLevel(data.level);
						// $("#txtlevel").val(data.level);
						$("#txtstatus").val(data.status);

					 }
				});

				} else alert('Unknown row id.');
			}

			function loadImg(id=null){
				if ('undefined'!= typeof id) {
					$("#imgavatar").empty();

  				$.ajax({
  					 type: "get",
  					 async: false,
  					 url: "<?=$url;?>/setting/users",
  					 data: {select: 'readdataimg',id:id},
  					 dataType: "json",
  					 success: function(data) {
               $("#imgavatar").css('background-image','url('+data.img+')');
  						 $("#imgavatar").html(data.btnupload);
  					 }
  				});

				} else alert('Unknown row id.');
			}


		});

    function btngetfile(param){
			$('#'+param).click();
		}
		function editRow(id){
			if ('undefined'!= typeof id) {


				$("#formuser-title").text('แก้ไขผู้ใช้งานระบบ');
				$("#imgavatar").empty();

			//var id = $(this).val();
			$.ajax({
				 type: "get",
				 async: false,
				 url: "<?=$url;?>/setting/users",
				 data: {select: 'readdata',id:id},
				 dataType: "json",
				 success: function(data) {

					$('#add-modal').modal('show');
          $("#cmduser").val('update');
					$("#iduser").val(data.id);
					$("#uid").val(data.id);
					$("#txtname").val(data.fullname);
					$("#txtlastname").val(data.lastname);
					$("#txtusername").val(data.username);
					$("#txtemail").val(data.email);
					$("#txttel").val(data.tel);
					$("#imgavatar").css('background-image','url('+data.img+')');
					loadImg(data.id);
          loadPermissionLevel(data.level);
					$("#txtlevel").val(data.level);
					$("#txtstatus").val(data.status);

				 }
			});

			} else alert('Unknown row id.');
		}

    function loadImg(id=null){
      if ('undefined'!= typeof id) {
        $("#imgavatar").empty();

        $.ajax({
           type: "get",
           async: false,
           url: "<?=$url;?>/setting/users",
           data: {select: 'readdataimg',id:id},
           dataType: "json",
           success: function(data) {
            $("#imgavatar").html(data.btnupload);
            $("#imgavatar").css('background-image','url('+data.img+')');
           }
        });

      } else alert('Unknown row id.');
    }

		// Remove row
		function removeRow(id) {
			if ( 'undefined' != typeof id) {

				swal({
					title: 'คุณต้องการลบผู้ใช้งานรายนี้?',
					text: "ลบรายการผู้ใช้งาน",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'ลบรายการผู้ใช้งานนี้',
					cancelButtonText: 'ยกเลิกไม่ลบ!',
					confirmButtonClass: 'confirm-class',
					cancelButtonClass: 'cancel-class',
					closeOnConfirm: false,
					closeOnCancel: false },
					function(isConfirm) {
					if (isConfirm) {

						$.ajax({
							 type: "post",
							 async: false,
							 url: "<?=$url;?>/setting/users",
							 data: {select: 'del',id:id},
							 dataType: "json",
							 success: function(data) {

								if(data.status=="success"){

								 toastr.success(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
								 $("#jqGridlist").jqGrid().trigger("reloadGrid");
								 swal(data.textrespon,data.msg,'success');
							 }else{
								 toastr.error(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
							 }
							 }
						});


					}else{
						swal('ยกเลิกแล้ว','ยกเลิกการลบรายการ','error');
					}
				});


			} else alert('Unknown row id.');
		}

		function editRowlevel(id){
			if ('undefined'!= typeof id) {
			$("#cmdlevel").val('updatelevel');

			$("#form-title").text('แก้ไขระดับสิทธิ์');
			$.ajax({
				 type: "get",
				 async: false,
				 url: "<?=$url;?>/setting/users",
				 data: {select: 'readdatalevel',id:id},
				 dataType: "json",
				 success: function(data) {

					$('#form-level').modal('show');

					$("#levelid").val(data.id);
					$("#txtlevelname").val(data.levelname);
					$("#txtlevelstatus").val(data.status);


				 }
			});


			} else alert('Unknown row id.');
		}


    function delImg(param,id){

      $.ajax({
        url: "<?=$url;?>/setting/users?select=delimg",
        type: "get",
        data: {f:param,id:id},
        timeout: 3000,
        dataType: "json",
        success: function(data){

          if(data.status=="success"){
            toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
            loadImg(data.id);
          }else{
            toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
          }

        },
        error: function(){}
      });

    }


		function removeRowlevel(id,object) {
			if ( 'undefined' != typeof id) {

				swal({
					title: 'คุณต้องการลบ ระดับสิทธิ์ '+object+' นี้ใช่หรือไม่?',
					text: "ลบรายการระดับสิทธิ์ "+object,
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'ลบระดับสิทธิ์นี้',
					cancelButtonText: 'ยกเลิกไม่ลบ!',
					confirmButtonClass: 'confirm-class',
					cancelButtonClass: 'cancel-class',
					closeOnConfirm: false,
					closeOnCancel: false },
					function(isConfirm) {
					if (isConfirm) {

						$.ajax({
							 type: "post",
							 async: false,
							 url: "<?=$url;?>/setting/users",
							 data: {select: 'dellevel',id:id},
							 dataType: "json",
							 success: function(data) {

								 if(data.status=="success"){

			 							toastr.success(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
			 							$("#jqGridlist_permission").jqGrid().trigger("reloadGrid");
										swal(data.textrespon,data.msg,'success');
			 						}else{
			 							toastr.error(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
			 						}


							 }
						});


					}else{
						swal('ยกเลิกแล้ว','ยกเลิกการลบรายการ','error');
					}
				});




			} else alert('Unknown row id.');
		}

    function isFuncStatusUser(status,id){
      if ('undefined'!= typeof id) {

        $.ajax({
           type: "get",
           async: false,
           url: "<?=$url.'/'.$get_part0.'/'.$get_part1;?>",
           data: {select: 'isstatususer',id:id,status:status},
           dataType: "json",
           success: function(data) {
             $("#jqGridlist").jqGrid().trigger("reloadGrid");
           }
        });


      } else toastr.warning('Unknown row id.', 'Warning!',{timeOut: 5000,closeButton: true});
    }

    function isFuncStatus(status,id){
      if ('undefined'!= typeof id) {

        $.ajax({
           type: "get",
           async: false,
           url: "<?=$url.'/'.$get_part0.'/'.$get_part1;?>",
           data: {select: 'isstatus',id:id,status:status},
           dataType: "json",
           success: function(data) {
             $("#jqGridlist_permission").jqGrid().trigger("reloadGrid");
           }
        });


      } else toastr.warning('Unknown row id.', 'Warning!',{timeOut: 5000,closeButton: true});
    }

    function loadPermissionLevel(id){
      var url_json = '<?=$url.'/'.$get_part0.'/'.$get_part1;?>?select=loadpermissionlevel';
      $('#txtlevel').empty();
      $.ajax({
        url: url_json,
        type: 'get',
        dataType: 'json',
        timeout: 3000,
        success: function(data, textStatus, jqXHR ) {
          $('#txtlevel').append('<option value="">เลือกระดับสิทธิ์</option>');
          if(data!=null){
            $.each(data.datarow, function(index, value){
              if(id==value.id){
                $('#txtlevel').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
              }else{
                $('#txtlevel').append('<option value="' + value.id + '">' + value.name + '</option>');
              }
            });
          }

        },
        error: function(jqXHR, textStatus, errorThrown) {

        }
      });
    }

</script>
