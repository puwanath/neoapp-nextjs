<div class="br-mainpanel">
  <div class="br-pageheader pd-y-5 pd-x-5 pd-md-l-10">
    <nav class="breadcrumb pd-0 mg-0 tx-14">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
      <span class="breadcrumb-item active"><?=$pagename;?></span>
    </nav>
  </div><!-- br-pageheader -->

  <div class="br-pagebody pd-x-5 pd-sm-x-5 mg-b-20">
    <div class="card bd-0 shadow-base pd-0">
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
					<div class="panel">
						<div class="panel-body">
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
                    <div class="col-lg-12 col-md-12 col-xs-12 pd-x-0-force">
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
                      <h5 class="panel-title mg-b-0-force" style="line-height: 1.5;" >ตั้งค่าระดับสิทธิ์การเข้าถึงการใช้งาน
                      <span class="tx-danger">[<?php echo $model->getTextformid("kp_user_level","level_name","level_id",$get_part2);?>]</span></h5>
                    </div>
                    <div class="col-md-6 col-xs-6 text-right pd-x-5">
                      <a href="javascript:void(0);" id="btnsubmit" class="btn btn-info btn-sm"> บันทึก </a>
  										<a href="javascript:history.back();" class="btn btn-secondary mg-l-5 btn-sm"> ย้อนกลับ </a>
                    </div>
			            </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12 pd-x-0-force">
                      <!--BEGIN PAGE -->
                      <form class="form-horizontal" id="action-form" role="form" action="" method="post" enctype="multipart/form-data">
    										<input type="hidden" name="levelid" value="<?=$get_part2;?>"/>
    										<div id="datapermission">{LOAD DATA}</div>
    									</form>
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
  /*.ui-jqgrid,
  .ui-jqgrid-view,
  .ui-jqgrid-hdiv,
  .ui-jqgrid-htable,
  .ui-jqgrid-bdiv,
  .ui-jqgrid-btable,
  .ui-jqgrid-pager{
    width: 100% !important;
  }*/
  .ui-th-column-header,.ui-th-column
  {
    text-align: center !important;
  }

  @media only screen and (max-width: 480px){
    .col-xs-6{ width: 50%;}
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
        url: '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=loaddatalevel',
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
      $('.ui-jqgrid-bdiv').height(height-270);

      /* =====================================================================*/

			$("#addlevel").on('click',function(e){
				e.preventDefault();
				$("#form-title").text('เพิ่มระดับสิทธิ์');
				$("#cmdlevel").val('addlevel');
				$("#form-level").modal('show');
			});

			$("#btnsubmitlevel").on('click',function(e){
				e.preventDefault();

				if($("#txtlevelname").val()==""){
          $("#txtlevelname").focus();
					$("#txtlevelname").css('border','1px solid red;');
					$('#levelerr0').text('กรุณากรอกช่องนี้ด้วยครับ');
				}else{
          $('#levelerr0').text('');
        }

				if($("#txtlevelname").val()!=''){
					$("#action-form-level").submit();
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

			// +++++++++++++++++++++++++++++++++++++++++++++++++++
			$("#btnsubmit").on('click',function(e){
				e.preventDefault();
				if(<?=$get_part2;?>!=''){
					$("#action-form").submit();
				}
			});
			// +++++++++++++++++++++++++++++++++++++++++++++++++++


			$("#action-form").on('submit',(function(e){
				e.preventDefault();

				$.ajax({
					 url: "<?=$url;?>/setting/permission?select=updatepermission",
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
							loaddatapermission(<?=$get_part2;?>);

						}else{
							toastr.error(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
						}

					 }
				});

			}));
			// end permission lecel



		});


		function loaddatapermission(id){
			if ('undefined'!= typeof id) {

			$.ajax({
				 type: "get",
				 async: false,
				 url: "<?=$url;?>/setting/permission",
				 data: {select: 'readdata',id:id},
				 dataType: "json",
				 success: function(data) {

					 $("#datapermission").html(data.textpermission);
					 $("#texttitle").html(data.texttitle);
				 }
			});


			} else alert('Unknown row id.');
		}
		loaddatapermission(<?=$get_part2;?>);

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


		function removeRowlevel(id) {
			if ( 'undefined' != typeof id) {

				swal({
					title: 'คุณต้องการลบ ระดับสิทธิ์ นี้?',
					text: "ลบรายการระดับสิทธิ์",
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


</script>
