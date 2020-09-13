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
            <a href="javascript:history.back();" class="btn btn-secondary btn-with-icon hidden-xs-down">
							<div class="ht-40">
								<span class="icon wd-40"><i class="icon ion-reply"></i></span> <span class="pd-x-15">ย้อนกลับ</span>
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
        <h6 class="tx-16 mg-b-0 tx-uppercase tx-inverse tx-bold titleform">TEXT TITLE</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pd-0">
        <form name="frm" action="" id=formdata method="post" enctype="multipart/form-data">
          <input type="hidden" name="action" id="action" value=""/>
          <input type="hidden" name="coupon_id" id="coupon_id" value=""/>
          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-12 mg-t--1 mg-md-t-0">
                <div class="row no-gutters">
                  <div class="col-md-7 col-xs-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force">
                      <label class="form-control-label">ชื่อคูปอง: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="coupon_name" id="coupon_name" value="" placeholder="Ex : ส่วนลด 50%">
                      <span id="coupon_name_msg" class="text-danger"></span>
                    </div>
                  </div>
                  <div class="col-md-5 col-xs-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force bd-r-0-force">
                      <label class="form-control-label">รหัสส่วนลดคูปอง: <span class="tx-danger">* ใส่ได้ 10 ตัวอักษร</span></label>
                      <input class="form-control" type="text" name="coupon_code" id="coupon_code" value="" maxlength="10" placeholder="Ex : EVENT999">
                      <span id="coupon_code_msg" class="text-danger"></span>
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force">
                      <label class="form-control-label">รูปแบบคูปอง: <span class="tx-danger">*</span></label>
                      <select class="form-control" name="coupon_type" id="coupon_type">
                        <option value="amount">ส่วนลดแบบจำนวนเงิน</option>
                        <option value="percent">ส่วนลดแบบเปอร์เซ็นต์</option>
                      </select>
                      <span id="coupon_type_msg" class="text-danger"></span>
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force bd-r-0-force">
                      <label class="form-control-label">จำนวนส่วนลด: <span class="tx-danger">* ใส่เป็นตัวเลขเท่านั้น</span></label>
                      <input class="form-control" type="number" name="coupon_amt" id="coupon_amt" value="" placeholder="...">
                      <span id="coupon_amt_msg" class="text-danger"></span>
                    </div>
                  </div>
                  <div class="col-md-6 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force">
                      <label class="form-control-label">จำนวนคูปอง (ที่ให้ใช้ได้): <span class="tx-danger">* ใส่ 0 ถ้าไม่กำหนดจำนวน</span></label>
                      <input class="form-control" type="text" name="coupon_limit" id="coupon_limit" value="0" placeholder="...">
                      <span id="coupon_limit_msg" class="text-danger"></span>
                    </div>
                  </div>
                  <div class="col-md-6 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force bd-r-0-force">
                      <label class="form-control-label">สั่งซื้อขั้นต่ำ (ที่ให้ใช้ได้): <span class="tx-danger">* ใส่ 0 ถ้าไม่กำหนดขั้นต่ำ</span></label>
                      <input class="form-control" type="text" name="coupon_min_sales" id="coupon_min_sales" value="0" placeholder="...">
                      <span id="coupon_min_sales_msg" class="text-danger"></span>
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force">
                      <label class="form-control-label mg-b-0-force">วันที่เริ่มใช้คูปอง: <span class="tx-danger">*</span></label>
                      <input class="form-control datetime" type="text" name="coupon_start" id="coupon_start" value="<?=date("d/m/Y");?>" placeholder="...">
                    </div>
                  </div>
                  <div class="col-md-6 col-xs-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force bd-r-0-force">
                      <label class="form-control-label mg-b-0-force">วันที่สิ้นสุดการใช้คูปอง: <span class="tx-danger">*</span></label>
                      <input class="form-control datetime" type="text" name="coupon_end" id="coupon_end" value="<?=date("d/m/Y");?>" placeholder="...">
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
    .mdiv { height: calc(100% - 5px); }

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

  $(document).ready(function () {
    // $.jgrid.defaults.width = 100;
    $.jgrid.defaults.responsive = false;
    $.jgrid.defaults.styleUI = 'Bootstrap4';
    $('.datetime').datetimepicker({
      format: 'DD/MM/YYYY',
    });

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
						  editable: false
          },
          {
				      label: 'รหัส',
              name: 'coupon_code',
              width: 100,
						  editable: false,
              align: 'center',
          },
          {
				      label: 'ชื่อคูปอง',
              name: 'coupon_name',
              width: 200,
						  editable: false,
          },
          {
				      label: 'ส่วนลด',
              name: 'coupon_amt',
              width: 120,
						  editable: false,
              align: 'center',
          },
          {
				      label: 'รูปแบบส่วนลด',
              name: 'coupon_type',
              width: 100,
						  editable: false,
              align: 'center',
          },
          {
				      label: 'จำนวนจำกัด',
              name: 'coupon_limit',
              width: 100,
						  editable: false,
              align: 'center',
          },
          {
				      label: 'ยอดสั่งซื้อขั้นต่ำ',
              name: 'coupon_min_sales',
              width: 100,
						  editable: false,
              align: 'center',
          },
          {
				      label: 'ระหว่างการใช้งาน',
              name: 'coupon_between',
              width: 180,
						  editable: false,
              align: 'center',
          },
          // {
					//     label: 'Created',
          //     name: 'created',
          //     width: 120,
          //     align: 'center',
          //     editable: false
          // },
          {
					    label: 'สร้างโดย',
              name: 'creator',
              width: 100,
              editable: false
          },
          {
					    label: 'จัดการ',
              name: 'btn_act',
              width: 150,
              align: 'right',
              editable: false
          }
        ],
				sortname: 'coupon_id',
				sortorder : 'asc',
				loadonce: false,
				viewrecords: true,
    		shrinkToFit: false,
    		autowidth: false,
        page: 1,
        // scroll: 1,
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

      /* =====================================================================*/
			$("#searchkeyword").on('change',function(e){
				e.preventDefault();

        var search = $(this).val();
        var newurl= '<?=$url;?>/<?=$get_part0;?>?select=loaddata&search='+search;
        $("#jqGridlist").jqGrid().setGridParam({url : newurl,datatype: "json"}).trigger("reloadGrid");

			});

      /*======================================================================*/

      $("#addform").on('click',function(e){
        e.preventDefault();
        $(".titleform").text('เพิ่มคูปองใหม่');
        $("#formdata")[0].reset();
        $("#action").empty();
        $("#action").val('add');
        $("#id").empty();
        $("#modalform").modal('show');

      });

      $(".btnsave").on('click',function(e){
        e.preventDefault();

				if($("#coupon_name").val()==""){
					$('#coupon_name_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}else{
          $('#coupon_name_msg').text(' ');
        }
				if($("#coupon_code").val()==""){
					$('#coupon_code_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}else{
          $('#coupon_code_msg').text('');
        }
				if($("#coupon_amt").val()==""){
					$('#coupon_amt_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}else{
          $('#coupon_amt_msg').text('');
        }

				if($("#coupon_name").val()!='' && $("#coupon_code").val()!='' && $("#coupon_amt").val()!=''){
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
						}else{
							toastr.error(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
						}
					 }
				});

      });
      /*======================================================================*/

		});


    function editFunc(id){
      $(".titleform").text('แก้ไขคูปอง ');
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

          $("#coupon_id").val(data.coupon_id);
          $("#coupon_name").val(data.coupon_name);
          $("#coupon_code").val(data.coupon_code);
          $("#coupon_amt").val(data.coupon_amt);
          $("#coupon_limit").val(data.coupon_limit);
          $("#coupon_min_sales").val(data.coupon_min_sales);
          $("#coupon_type").val(data.coupon_type);
          $("#coupon_start").val(data.coupon_start);
          $("#coupon_end").val(data.coupon_end);

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

</script>
