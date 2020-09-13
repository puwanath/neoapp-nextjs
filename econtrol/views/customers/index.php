<div class="br-mainpanel">
  <div class="br-pageheader pd-y-10 pd-md-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
      <span class="breadcrumb-item active"><?=$pagename;?></span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagebody pd-x-5 pd-sm-x-5">
    <div class="card bd-0 shadow-base pd-0">
      <div class="row mg-0">
        <div class="col-md-6 col-xs-12 pd-0">
          <div class="pd-10 bd-b text-left">
            <div class="input-group">
              <input type="text" class="form-control" name="search" id="searchkeyword" placeholder="ค้นหาด้วยคีย์เวิร์ด...">
              <span class="input-group-btn">
                <button class="btn bd bg-white tx-gray-600" type="submit"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xs-12 pd-0">
          <div class="pd-10 bd-b text-right">
    				<?php echo getMenu_permission_button($mainmenu);?>
    				<a href="javascript:history.back();" class="btn btn-outline-info mg-l-5"> ย้อนหลับ </a>
    	    </div>
        </div>
      </div>
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 pd-0">
				<div class="panel">

					<div class="panel-body">
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
          <input type="hidden" name="renter_id" id="renter_id" value=""/>
          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-8 mg-t--1 mg-md-t-0">
                <div class="form-group">
                  <label class="form-control-label">Renter Name: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="renter_name" id="renter_name" value="" placeholder="ชื่อผู้เช่า">
                  <span id="renter_name_msg" class="text-danger"></span>
                </div>
              </div><!-- col-8 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group mg-md-l--1">
                  <label class="form-control-label">TAX NO: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="renter_taxno" id="renter_taxno" value="" placeholder="เลขประจำตัวผู้เสียภาษี">
                  <span id="renter_taxno_msg" class="text-danger"></span>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-6">
                <div class="form-group bd-t-0-force">
                  <label class="form-control-label">Adress1: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="renter_addr1" id="renter_addr1" value="" placeholder="ที่อยู่ 1">
                  <span id="renter_addr1_msg" class="text-danger"></span>
                </div>
              </div><!-- col-8 -->
              <div class="col-md-6 mg-t--1 mg-md-t-0">
                <div class="form-group bd-t-0-force mg-md-l--1">
                  <label class="form-control-label">Adress2: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="renter_addr2" id="renter_addr2" value="" placeholder="ที่อยู่ 2">
                  <span id="renter_addr2_msg" class="text-danger"></span>
                </div>
              </div><!-- col-8 -->
              <div class="col-md-4">
                <div class="form-group bd-t-0-force">
                  <label class="form-control-label">Telephone:</label>
                  <input class="form-control" type="text" name="renter_tel" id="renter_tel" value="" placeholder="โทรศีพท์">
                </div>
              </div><!-- col-8 -->
              <div class="col-md-4">
                <div class="form-group bd-t-0-force mg-md-l--1">
                  <label class="form-control-label">Fax: </label>
                  <input class="form-control" type="text" name="renter_fax" id="renter_fax" value="" placeholder="แฟกซ์">
                </div>
              </div><!-- col-8 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group bd-t-0-force mg-md-l--1">
                  <label class="form-control-label">Renter Cardno:</label>
                  <input class="form-control" type="text" name="renter_cardno" id="renter_cardno" value="" placeholder="เลขประจำตัวประชาชน">
                </div>
              </div><!-- col-8 -->
              <div class="col-md-8">
                <div class="form-group bd-t-0-force">
                  <label class="form-control-label">Note: </label>
                  <textarea class="form-control" name="renter_note" id="renter_note" placeholder="หมายเหตุ"></textarea>
                </div>
              </div><!-- col-8 -->
              <div class="col-md-4">
                <div class="form-group mg-md-l--1 bd-t-0-force">
                  <label class="form-control-label mg-b-0-force">Renter Type: <span class="tx-danger">*</span></label>
                  <select id="select2-a" name="rentertype_id" class="form-control" >
                    <option label="ประเภทผู้เช่า">ประเภทผู้เช่า</option>
                  </select>
                </div>
              </div><!-- col-4 -->
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
  .ui-jqgrid-bdiv{
    /*height: calc(100% - 10px) !important;
    max-height: 500px !important;*/
  }
</style>

<script type="text/javascript">
  // $.jgrid.defaults.width = 100;
  $.jgrid.defaults.responsive = false;
  $.jgrid.defaults.styleUI = 'Bootstrap4';
  $(document).ready(function () {
      $("#jqGridlist").jqGrid({
        url: '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=loaddata',
        editurl: '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>',
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
				      label: 'Name',
              name: 'renter_name',
              width: 400,
						  editable: false,
          },
          {
				      label: 'Type',
              name: 'renter_type',
              width: 100,
						  editable: false,
          },
          {
						  label: 'Address1',
              name: 'renter_addr1',
              width: 200,
              editable: false // must set editable to true if you want to make the field editable
          },
          {
						  label : 'Address2',
              name: 'renter_addr2',
              width: 200,
              editable: false
          },
          {
					    label: 'Tel',
              name: 'renter_tel',
              width: 100,
              editable: false
          },
          {
					    label: 'Fax',
              name: 'renter_fax',
              width: 100,
              editable: false
          },
          {
					    label: 'Card no',
              name: 'renter_cardno',
              width: 100,
              align: 'center',
              editable: false
          },
          {
					    label: 'Tax no',
              name: 'renter_taxno',
              width: 100,
              align: 'center',
              editable: false
          },
          {
					    label: 'Note',
              name: 'renter_note',
              width: 200,
              editable: false
          },
          {
					    label: 'Created',
              name: 'created',
              width: 120,
              align: 'center',
              editable: false
          },
          {
					    label: 'Creator',
              name: 'creator',
              width: 120,
              editable: false
          },
          {
					    label: 'Action',
              name: 'btn_act',
              width: 100,
              align: 'right',
              editable: false
          }
        ],
				sortname: 'renter_id',
				sortorder : 'asc',
				loadonce: false,
				viewrecords: true,
        width: null,
    		shrinkToFit: false,
    		autowidth: true,
        // height: 100,
        page: 1,
        // scroll: 1,
        rowNum: 20,
        rowList:[10,25,50,100],
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
      var height = $(window).height();
      $('.ui-jqgrid-bdiv').height(height-270);

      /* =====================================================================*/
			$("#searchkeyword").on('change',function(e){
				e.preventDefault();
        $('#gmail_loading').show();
        var search = $(this).val();
        // alert(search);
        // return false;
        var newurl= '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=loaddata&search='+search;
        $("#jqGridlist").jqGrid().setGridParam({url : newurl,datatype: "json"}).trigger("reloadGrid");

        $('#gmail_loading').hide();
			});

      /*======================================================================*/
      function loadType(id){
        var url_json = '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=loadrentertype';
        $.ajax({
					url: url_json,
					type: 'get',
					dataType: 'json',
					timeout: 3000,
					success: function(data, textStatus, jqXHR ) {
						/*$('#select2-a').append('<option value="">เลือกประเภทของผู้เช่า</option>');*/
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
        $(".titleform").text('เพิ่มข้อมูลผู้เช่าใหม่');
        $("#action").empty();
        $("#action").val('add');
        $("#modalform").modal('show');
        $("#formdata")[0].reset();
        $("#select2-a").empty();
        loadType(id=null);
      });

      $(".btnsave").on('click',function(e){
        e.preventDefault();

				if($("#renter_name").val()==""){
					$('#renter_name_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}
				if($("#renter_taxno").val()==""){
					$('#renter_taxno_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}
				if($("#renter_addr1").val()==""){
					$('#renter_addr1_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}
				if($("#renter_addr2").val()==""){
					$('#renter_addr2_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}

				if($("#renter_name").val()!='' && $("#renter_taxno").val()!='' && $("#renter_addr1").val()!='' && $("#renter_addr2").val()!=''){
					$("#formdata").submit();
				}else{
					return false;
				}
      });


      $("#formdata").on('submit',function(e){
        e.preventDefault();
        $('#gmail_loading').show();
        var act = $("#action").val();
				$.ajax({
					 url: "<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select="+act,
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
        $('#gmail_loading').hide();
      });
      /*======================================================================*/

		});


    function editFunc(id){
      $(".titleform").text('แก้ไขข้อมูลผู้เช่า');
      $("#action").empty();
      $("#action").val('edit');
      $("#modalform").modal('show');
      $("#formdata")[0].reset();

      var url_json = '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=loaddataedit&id='+id;
      $.ajax({
        url: url_json,
        type: 'get',
        dataType: 'json',
        timeout: 3000,
        success: function(data, textStatus, jqXHR ) {

          $("#renter_id").val(data.renter_id);
          $("#renter_name").val(data.renter_name);
          $("#renter_addr1").val(data.renter_addr1);
          $("#renter_addr2").val(data.renter_addr2);
          $("#renter_tel").val(data.renter_tel);
          $("#renter_fax").val(data.renter_fax);
          $("#renter_taxno").val(data.renter_taxno);
          $("#renter_cardno").val(data.renter_cardno);
          $("#renter_note").val(data.renter_note);

          /*=======load type========*/
          $("#select2-a").empty();
          $.each(data.datatype.datarow, function(index, value){
            if(data.rentertype_id==value.id){
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
				$('#gmail_loading').show();
				swal({
					title: 'คุณต้องการลบผู้ใช้งานรายนี้?',
					text: name,
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'ลบรายการผู้ใช้งานนี้',
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
				$('#gmail_loading').hide();

			} else toastr.error('Unknown row id','',{timeOut: 5000,closeButton: true});;
    }

</script>
