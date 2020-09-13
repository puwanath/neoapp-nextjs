<div class="br-mainpanel">
  <div class="br-pageheader pd-y-5 pd-x-5 pd-md-l-10">
    <nav class="breadcrumb pd-0 mg-0 tx-14">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
      <span class="breadcrumb-item"><?=$pagemain;?></span>
      <span class="breadcrumb-item active"><?=$pagename;?></span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagebody pd-x-5 pd-sm-x-5">
    <div class="adiv card bd-0 shadow-base pd-0">
      <div class="row mg-0">
        <div class="col-md-6 col-xs-12 pd-0">
          <div class="pd-5 text-left">
            <div class="input-group">
              <input type="text" class="form-control" name="search" id="searchkeyword" placeholder="ค้นหาด้วยคีย์เวิร์ด...">
              <span class="input-group-btn">
                <button class="btn bd bg-white tx-gray-600" type="submit"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xs-12 pd-0">
          <div class="pd-5 text-right">
    				<?php echo getMenu_permission_button($mainmenu);?>
    				<a href="javascript:history.back();" class="btn btn-outline-info mg-l-5"> ย้อนกลับ </a>
    	    </div>
        </div>
      </div>
			<div class="gdiv col-lg-12 col-md-12 col-xs-12 col-sm-12 pd-0">
				<div class="ndiv panel">
					<div class="mdiv panel-body">
						<!--BEGIN PAGE -->
            <table id="jqGridlist"></table>
            <div id="jqGridPager"></div>
						<!--END PAGE -->
					</div>
				</div>
			</div>

    </div>
  </div><!-- br-pagebody -->
</div><!-- br-contentpanel -->


<div id="modalform" class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content tx-size-sm">
      <div class="modal-header pd-x-20">
        <h6 class="tx-18 mg-b-0 tx-uppercase tx-inverse tx-bold titleform">TEXT TITLE</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pd-0">
        <form name="frm" action="" id=formdata method="post" enctype="multipart/form-data">
          <input type="hidden" name="action" id="action" value=""/>
          <input type="hidden" name="app_id" id="app_id" value=""/>
          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-12 mg-t--1 mg-md-t-0">
                <div class="row no-gutters">
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force">
                      <label class="form-control-label">Application Name (TH): <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="app_name_th" id="app_name_th" value="" placeholder="...">
                      <span id="app_name_th_msg" class="text-danger"></span>
                    </div>
                  </div>
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force">
                      <label class="form-control-label">Application Name (EN): <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="app_name_en" id="app_name_en" value="" placeholder="...">
                      <span id="app_name_en_msg" class="text-danger"></span>
                    </div>
                  </div>
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force">
                      <label class="form-control-label mg-b-0-force">Main Application: <span class="tx-danger">*</span></label>
                      <select id="select2-a" name="app_main_id" class="form-control" >
                        <option label="Main Application">Main Application</option>
                      </select>
                    </div>
                  </div>

                </div>
              </div><!-- col-8 -->
            </div><!-- row -->
          </div>
        </form>
      </div><!-- modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary tx-size-xs btnsave">บันทึก</button>
        <button type="button" class="btn btn-secondary tx-size-xs" data-dismiss="modal">ออก</button>
      </div>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->


<style type="text/css">
  .graybg{
    background-color: #868e96 !important;
    color: #fff !important;
  }
  .jqgrid-multibox{
    border-right: 1px solid #333 !important;
  }

  html { height: 100%; }
	body { height: calc(100% - 60px); }

	.br-mainpanel { height: 100%; }
	.br-pagebody { height: calc(100% - 50px); }

	.adiv { height: calc(100% - 0px); display: block; }
	.gdiv { height: calc(100% - 45px); }
	.ndiv { height: calc(100% - 10px); }
	.mdiv { height: calc(100% - 0px); }

	#gbox_jqGridlist { height: calc(100% - 35px); }
	#gview_jqGridlist { height: 100%; }
	#gview_jqGridlist .ui-jqgrid-bdiv { height: calc( 100% - 35px ) !important; }

	@media only screen and (max-width: 480px){
		.br-mainpanel { height: 100%; }
		.br-pagebody { height: calc(100% - 40px); }

		.adiv { height: calc(100% - 0px); display: block; }
		.gdiv { height: calc(100% - 105px); }
		.ndiv { height: calc(100% - 20px); }
		.mdiv { height: calc(100% - 0px); }

		#gbox_jqGridlist { height: calc(100% - 20px); }
		#gview_jqGridlist { height: 100%; }
		#gview_jqGridlist .ui-jqgrid-bdiv { height: calc( 100% - 35px ) !important; }
	}


  .ui-jqgrid,
  .ui-jqgrid-view,
  .ui-jqgrid-hdiv,
  .ui-jqgrid-htable,
  .ui-jqgrid-bdiv,
  .ui-jqgrid-btable,
  .ui-jqgrid-pager{
    width: 100% !important;
  }
  .ui-th-column-header,.ui-th-column{text-align: center !important;}
  @media only screen and (max-width: 480px){
    .modal .modal-dialog {
      display: inline-block !important;
    }

    .modal {
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      overflow: hidden;
      z-index: 99999999999;
    }

    .modal-dialog {
      position: fixed;
      margin: 0;
      width: 100%;
      max-width: none;
      height: 100%;
      padding: 0;
      left: 0;
    }

    .modal-content {
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      /*border: 2px solid #3c7dcf;*/
      border-radius: 0;
      box-shadow: none;
    }

    .modal-header {
      position: absolute;
      top: 0;
      right: 0;
      left: 0;
      min-height: 50px;
      height: auto;
      padding: 10px;
      background: rgb(238,174,202);
      background: linear-gradient(30deg, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);
      border: 0;
    }

    .modal-title {
      font-weight: 300;
      font-size: 2em;
      color: #fff;
      line-height: 30px;
    }

    .modal-body {
      position: absolute;
      top: 75px;
      bottom: 60px;
      width: 100%;
      font-weight: 300;
      overflow: auto !important;
    }

    .modal .modal-body {
      overflow: auto !important;
    }

    .modal-footer {
      position: absolute;
      right: 0;
      bottom: 0;
      left: 0;
      height: 60px;
      padding: 10px;
      background: #f1f3f5;
    }

    ::-webkit-scrollbar {
      -webkit-appearance: none;
      width: 10px;
      background: #f1f3f5;
      border-left: 1px solid darken(#f1f3f5, 10%);
    }

    ::-webkit-scrollbar-thumb {
      background: darken(#f1f3f5, 20%);
    }

    .btnsave{
      font-size: 16px;
      color: #000;
      font-weight: 600px;
      padding: 10px;
      border: none;
      border-radius: 3px;
      background: rgb(238,174,202);
      background: linear-gradient(30deg, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 0%);
    }

    .btnclose{
      font-size: 16px;
      color: #000;
      font-weight: 600px;
      padding: 10px;
      border: none;
      border-radius: 3px;
      background: rgb(238,174,202);
      background: linear-gradient(30deg, rgba(238,174,202,1) 100%, rgba(148,187,233,1) 100%);
    }
  }
</style>

<script type="text/javascript">
  $(document).ready(function () {
    $.jgrid.defaults.responsive = false;
    $.jgrid.defaults.styleUI = 'Bootstrap4';

      $("#jqGridlist").jqGrid({
        url: '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=loaddata',
        editurl: '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>',
        datatype: "json",
        colModel: [
          {
				      label: 'ID',
              name: 'app_id',
              width: 60,
						  key: true,
              align: 'center',
						  editable: false,
              classes: 'graybg'
          },
          {
				      label: 'Application',
              name: 'app_name_th',
              width: 300,
						  editable: false,
          },
          {
				      label: 'Main Application',
              name: 'app_main_id',
              width: 200,
						  editable: false,
          },
          {
					    label: 'Created',
              name: 'created',
              width: 120,
              align: 'center',
              editable: false
          },
          {
					    label: 'Manage',
              name: 'btn_act',
              width: 150,
              align: 'right',
              editable: false
          }
        ],
				sortname: 'app_main_id,app_id',
				sortorder : 'asc',
				loadonce: false,
				viewrecords: true,
    		shrinkToFit: false,
    		autowidth: false,
        page: 1,
        // scroll: 1,
        rowNum: 20,
        multiselect: true,
        rowList:[20,20,50,100],
        emptyrecords: 'Scroll to bottom to retrieve new page',
        pager: "#jqGridPager",
        onSelectRow: function(id){
          var data=jQuery("#jqGridlist").jqGrid('getRowData',id);
          ckRow();
        },
        onSelectAll: function(aRowids, status) {
          ckRow();
        },
      });

      $("#jqGridlist").jqGrid('navGrid', '#jqGridPager',
        {
          edit: false,
          add: false,
          del: false,
          search: false,
          view: false
        }
      );

      $("#jqGridlist").jqGrid('inlineNav', '#jqGridPager',
        {
          // del: true,
          edit: false,
          add: false,
          save: false,
          cancel: false,
          addParams: {useFormatter : false},
          editParams: {}
        }
      );

      $("#refresh_jqGridlist").on('click',function(e){
        e.preventDefault();
        ckRow();
      });


      $("#delselect").click( function() {
        var setid;
        setid = $("#jqGridlist").jqGrid('getGridParam','selarrrow');

        if ( 'undefined' != typeof setid) {

          swal({
            title: 'คุณต้องการลบรายการที่เลือกนี้?',
            text: setid.length+' รายการ',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ลบรายการที่เลือก',
            cancelButtonText: 'ยกเลิกไม่ลบ!',
            confirmButtonClass: 'confirm-class',
            cancelButtonClass: 'cancel-class',
            closeOnConfirm: true,
            closeOnCancel: false },
            function(isConfirm) {
            if (isConfirm) {

              $.ajax({
                 type: "post",
                 async: false,
                 url: "<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>",
                 data: {select: 'deleteselect',setid:setid},
                 dataType: "json",
                 success: function(data) {
                   if(data.status=="success"){
                     toastr.success(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
                     $("#jqGridlist").jqGrid().trigger("reloadGrid");
                     $('#delselect').prop('disabled', true);
                   }else{
                     toastr.error(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
                   }
                 }
              });

            }else{
              swal('ยกเลิกแล้ว','ยกเลิกการลบรายการ','error');
            }
          });

        } else toastr.error('Unknown row id','',{timeOut: 5000,closeButton: true});
      });

      /* merge data */
      $("#mergeData").click( function() {
        var setid;
        setid = $("#jqGridlist").jqGrid('getGridParam','selarrrow');

        if ( 'undefined' != typeof setid) {

          // console.log(setid[0]);
          // console.log(setid[1]);
          swal({
            title: 'คุณต้องการรวมรายการที่เลือกนี้?',
            text: 'โอน Transections Visit ของ Source ID '+setid[1]+' ไปยัง Source ID '+setid[0]+' และลบรายการ Source ID '+setid[1],
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยันรวมรายการ',
            cancelButtonText: 'ยกเลิกไม่รวมรายการ!',
            confirmButtonClass: 'confirm-class',
            cancelButtonClass: 'cancel-class',
            closeOnConfirm: true,
            closeOnCancel: false },
            function(isConfirm) {
            if (isConfirm) {

              $.ajax({
                 type: "post",
                 async: false,
                 url: "<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>",
                 data: {select: 'mergedatasources',setid:setid},
                 dataType: "json",
                 success: function(data) {
                   if(data.status=="success"){
                     toastr.success(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
                     $("#jqGridlist").jqGrid().trigger("reloadGrid");
                     $('#mergeData').prop('disabled', true);
                   }else{
                     toastr.error(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
                   }
                 }
              });

            }else{
              swal('ยกเลิกแล้ว','ยกเลิกการรวมรายการ','error');
            }
          });

        } else toastr.error('Unknown row id','',{timeOut: 5000,closeButton: true});
      });


      function ckRow(){
        var s;
        s = $("#jqGridlist").jqGrid('getGridParam','selarrrow');
        if(s.length>0){
          if(s.length>1 && s.length<=2){
            $('#mergeData').prop('disabled', false);
          }else{
            $('#mergeData').prop('disabled', true);
          }
          $('#delselect').prop('disabled', false);
        }else{
          $('#delselect').prop('disabled', true);
          $('#mergeData').prop('disabled', true);
        }
      }


      /* =====================================================================*/
			$("#searchkeyword").on('change',function(e){
				e.preventDefault();
        var search = $(this).val();
        var newurl= '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=loaddata&search='+search;
        $("#jqGridlist").jqGrid().setGridParam({url : newurl,datatype: "json"}).trigger("reloadGrid");

			});

      /*======================================================================*/
      function loadAppmain(id){
        var url_json = '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=loadappmain';
        $.ajax({
					url: url_json,
					type: 'get',
					dataType: 'json',
					timeout: 3000,
					success: function(data, textStatus, jqXHR ) {
						$('#select2-a').append('<option value="">Select Application main</option>');
            if(data==null)
              return false;
						$.each(data.datarow, function(index, value){
							if(id==value.id){
								$('#select2-a').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
							}else{
								$('#select2-a').append('<option value="' + value.id + '">' + value.name + '</option>');
							}
						});

					},
					error: function(jqXHR, textStatus, errorThrown) {

					}
				});
      }


      $("#addform").on('click',function(e){
        e.preventDefault();
        $(".titleform").text('เพิ่ม Application');
        $("#formdata")[0].reset();
        $("#action").empty();
        $("#action").val('add');
        $("#app_id").empty();
        $("#app_id").val('');
        $("#select2-a").empty();
        $("#modalform").modal('show');
        loadAppmain(id=null);
      });

      $(".btnsave").on('click',function(e){
        e.preventDefault();

				if($("#app_name_th").val()==""){
					$('#app_name_th_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}else{
          $('#app_name_th_msg').text('');
        }

				if($("#app_name_en").val()==""){
					$('#app_name_en_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}else{
          $('#app_name_en_msg').text('');
        }

				if($("#app_name_th").val()!='' && $("#app_name_en").val()!=''){
					$("#formdata").submit();
				}else{
					return false;
				}
      });


      $("#formdata").on('submit',function(e){
        e.preventDefault();

				$.ajax({
					 url: "<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=save",
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
							$('#modalform').modal('hide');
							$('#formdata')[0].reset();
              $("#jqGridlist").jqGrid().trigger("reloadGrid");
              // editFunc(data.id);
						}else{
							toastr.error(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
						}
					 }
				});

      });
      /*======================================================================*/

		});


    function editFunc(id){
      $(".titleform").text('แก้ไข Application');
      $("#modalform").modal('show');
      $("#formdata")[0].reset();
      $("#action").empty();
      $("#action").val('edit');

      var url_json = '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=loaddataedit&id='+id;
      $.ajax({
        url: url_json,
        type: 'get',
        dataType: 'json',
        timeout: 3000,
        success: function(data, textStatus, jqXHR ) {

          $("#app_id").val(data.app_id);
          $("#app_name_th").val(data.app_name_th);
          $("#app_name_en").val(data.app_name_en);

          /*=======load type========*/
          $("#select2-a").empty();
          $('#select2-a').append('<option value="">Select Departments main</option>');
          $.each(data.datatype.datarow, function(index, value){
            if(data.app_main_id==value.id){
              $('#select2-a').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
            }else{
              $('#select2-a').append('<option value="' + value.id + '">' + value.name + '</option>');
            }
          });
          /*=======End load type========*/

        },
        error: function(jqXHR, textStatus, errorThrown) {

        }
      });
    }


    function delFunc(id,name){
      if ( 'undefined' != typeof id) {

				swal({
					title: 'คุณต้องการลบรายนี้?',
					text: name,
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'ลบรายการนี้',
					cancelButtonText: 'ยกเลิกไม่ลบ!',
					confirmButtonClass: 'confirm-class',
					cancelButtonClass: 'cancel-class',
					closeOnConfirm: true,
					closeOnCancel: false },
					function(isConfirm) {
					if (isConfirm) {

						$.ajax({
							 type: "post",
							 async: false,
							 url: "<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>",
							 data: {select: 'del',id:id},
							 dataType: "json",
							 success: function(data) {
								 if(data.status=="success"){
  								 toastr.success(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
  								 $("#jqGridlist").jqGrid().trigger("reloadGrid");
  							 }else{
  								 toastr.error(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
  							 }
							 }
						});

					}else{
						swal('ยกเลิกแล้ว','ยกเลิกการลบรายการ','error');
					}
				});


			} else toastr.error('Unknown row id','',{timeOut: 5000,closeButton: true});;
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
             $("#jqGridlist").jqGrid().trigger("reloadGrid");
           }
        });


      } else toastr.warning('Unknown row id.', 'Warning!',{timeOut: 5000,closeButton: true});
    }

    // function sortdata
    function sortRow(line,type,fid,mainid){

      $.ajax({
         type: "get",
         async: false,
         url: "<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>",
         data: {select: 'sortrow',line:line,type:type,fid:fid,mainid:mainid},
         dataType: "json",
         success: function(data) {

          if(data.status=="success"){
           $("#jqGridlist").jqGrid().trigger("reloadGrid");
         }else{
           toastr.error(data.msg,data.status,{timeOut: 5000,closeButton: true});
         }
         }
      });

    }


</script>
