<div class="br-mainpanel">
  <div class="br-pageheader pd-y-5 pd-x-5 pd-md-l-10">
    <nav class="breadcrumb pd-0 mg-0 tx-14">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
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
            <a href="javascript:history.back();" class="btn btn-secondary btn-with-icon">
              <div class="ht-40">
                <span class="icon wd-40"><i class="icon ion-reply"></i></span>
                <span class="pd-x-15">ย้อนกลับ</span>
              </div>
            </a>
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content tx-size-sm">
      <div class="modal-header pd-x-20">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold titleform">TEXT TITLE</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pd-0">
        <form name="frm" action="" id=formdata method="post" enctype="multipart/form-data">
          <input type="hidden" name="action" id="action" value=""/>
          <input type="hidden" name="var_id" id="var_id" value=""/>
          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-12 mg-t--1 mg-md-t-0">
                <div class="form-group bd-t-0-force bd-l-0-force bd-r-0-force">
                  <label class="form-control-label">หัวข้อคุณลักษณะ (TH): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="var_name_th" id="var_name_th" value="" placeholder="Ex : ขนาด">
                  <span id="var_name_th_msg" class="text-danger"></span>
                </div>

              </div>
              <div class="col-md-12 mg-t--1 mg-md-t-0">
                <div class="form-group bd-t-0-force bd-l-0-force bd-r-0-force">
                  <label class="form-control-label">หัวข้อคุณลักษณะ (EN): <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="var_name_en" id="var_name_en" value="" placeholder="Ex : Size">
                  <span id="var_name_en_msg" class="text-danger"></span>
                </div>

              </div>
              <div class="col-md-12 mg-t--1 mg-md-t-0">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group bd-t-0-force bd-b-0-force bd-l-0-force bd-r-0-force">
                      <label class="form-control-label">Attribute Param (EN only): <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="var_param" id="var_param" value="" placeholder="ex : size">
                      <span id="var_param_msg" class="text-danger"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group bd-t-0-force bd-b-0-force bd-r-0-force">
                      <label class="form-control-label">ชนิดของคุณลักษณะ: <span class="tx-danger">*</span></label>
                      <select class="form-control" name="var_input_type" id="var_input_type" data-placeholder="เลือกชนิดของการรับข้อมูล">
                        <option value="text">ชนิดข้อความ Text box</option>
                        <option value="number">ชนิดตัวเลข Number box</option>
                        <option value="color">ชนิดกล่องสี RGB Color box</option>
                      </select>
                      <span id="var_input_type_msg" class="text-danger"></span>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- row -->
          </div>
        </form>
      </div><!-- modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary tx-size-xs btnsave">Save</button>
        <button type="button" class="btn btn-secondary tx-size-xs" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->


<style type="text/css">
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
    .ndiv { height: calc(100% - 0px); }
    .mdiv { height: calc(100% - 0px); }

    #gbox_jqGridlist { height: calc(100% - 35px); }
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

</style>

<script type="text/javascript">
  // $.jgrid.defaults.width = 100;
  $.jgrid.defaults.responsive = false;
  $.jgrid.defaults.styleUI = 'Bootstrap4';
  $(document).ready(function () {

      $("#jqGridlist").jqGrid({
        url: '<?=$url;?>/<?=$get_part0;?>?select=loaddata',
        editurl: '<?=$url;?>/<?=$get_part0;?>',
        datatype: "json",
        colModel: [
          {
				      label: 'ID',
              name: 'id',
              width: 60,
						  key: true,
              align: 'center',
						  editable: false,
              hidden: true
          },
          {
				      label: 'หัวข้อคุณลักษณะ (TH)',
              name: 'var_name_th',
              width: 200,
						  editable: false,
          },
          {
				      label: 'หัวข้อคุณลักษณะ (EN)',
              name: 'var_name_en',
              width: 200,
						  editable: false,
          },
          {
				      label: 'Attribute Param (EN only)',
              name: 'var_param',
              width: 200,
						  editable: false,
          },
          {
				      label: 'ชนิดคุณลักษณะ',
              name: 'var_input_type',
              width: 150,
						  editable: false,
          },
          {
					    label: 'จัดการ',
              name: 'btn_act',
              width: 200,
              align: 'right',
              editable: false
          }
        ],
				sortname: 'sort',
				sortorder : 'asc',
				loadonce: false,
				viewrecords: true,
    		shrinkToFit: false,
    		autowidth: false,
        page: 1,
        scroll: 1,
        rowNum: 20,
        rowList:[20,30,50,100],
        cellEdit: true,
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

      // set auto height
      // var height = $(window).height();
      // $('.ui-jqgrid-bdiv').height(height-300);

      /* =====================================================================*/
			$("#searchkeyword").on('change',function(e){
				e.preventDefault();
        var search = $(this).val();
        // alert(search);
        // return false;
        var newurl= '<?=$url;?>/<?=$get_part0;?>?select=loaddata&search='+search;
        $("#jqGridlist").jqGrid().setGridParam({url : newurl,datatype: "json"}).trigger("reloadGrid");
			});

      /*======================================================================*/

      $("#addform").on('click',function(e){
        e.preventDefault();
        $(".titleform").text('เพิ่มคุณสมบัติสินค้าใหม่');
        $("#formdata")[0].reset();
        $("#action").empty();
        $("#var_id").empty();
        $("#action").val('add');
        $("#modalform").modal('show');
      });

      $(".btnsave").on('click',function(e){
        e.preventDefault();

				if($("#var_name_th").val()==""){
					$('#var_name_th_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}else{
          $('#var_name_th_msg').text('');
        }
				if($("#var_name_en").val()==""){
					$('#var_name_en_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}else{
          $('#var_name_en_msg').text('');
        }
				if($("#var_param").val()==""){
					$('#var_param_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}else{
          $('#var_param_msg').text('');
        }
				if($("#var_input_type").val()==""){
					$('#var_var_input_type_msg').text('กรุณาเลือกช่องนี้ด้วยครับ');
				}else{
          $('#var_var_input_type_msg').text('');
        }

				if($("#var_name_th").val()!='' && $("#var_name_en").val()!='' && $("#var_param").val()!='' && $("#var_input_type").val()!=''){
					$("#formdata").submit();
				}else{
					return false;
				}
      });


      $("#formdata").on('submit',function(e){
        e.preventDefault();

        var act = $("#action").val();
				$.ajax({
					 url: "<?=$url;?>/<?=$get_part0;?>?select="+act,
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
              editFunc(data.id);
						}else{
							toastr.error(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
						}
					 }
				});

      });
      /*======================================================================*/

		});


    function editFunc(id){
      $(".titleform").text('แก้ไขคุณสมบัติสินค้า');
      $("#modalform").modal('show');
      $("#formdata")[0].reset();
      $("#action").empty();
      $("#action").val('edit');

      var url_json = '<?=$url;?>/<?=$get_part0;?>?select=loaddataedit&id='+id;
      $.ajax({
        url: url_json,
        type: 'get',
        dataType: 'json',
        timeout: 3000,
        success: function(data, textStatus, jqXHR ) {

          $("#var_id").val(data.var_id);
          $("#var_name_th").val(data.var_name_th);
          $("#var_name_en").val(data.var_name_en);
          $("#var_param").val(data.var_param);
          $("#var_input_type").val(data.var_input_type);

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
							 url: "<?=$url;?>/<?=$get_part0;?>",
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
           url: "<?=$url.'/'.$get_part0;?>",
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
         url: "<?=$url;?>/<?=$get_part0;?>",
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
