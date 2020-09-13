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
          <input type="hidden" name="m_id" id="m_id" value=""/>
          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-8 mg-t--1 mg-md-t-0">
                <div class="row no-gutters">
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force bd-r-0-force">
                      <label class="form-control-label">ชื่อทีมงาน (TH): <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="m_name_th" id="m_name_th" value="" placeholder="...">
                      <span id="m_name_th_msg" class="text-danger"></span>
                    </div>
                  </div>
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force bd-r-0-force">
                      <label class="form-control-label">ชื่อทีมงาน (EN): <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="m_name_en" id="m_name_en" value="" placeholder="...">
                      <span id="m_name_en_msg" class="text-danger"></span>
                    </div>
                  </div>
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force bd-r-0-force">
                      <label class="form-control-label">ตำแหน่ง: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="m_position" id="m_position" value="" placeholder="...">
                      <span id="m_position_msg" class="text-danger"></span>
                    </div>
                  </div>
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force bd-r-0-force">
                      <label class="form-control-label">แผนก/ฝ่าย: <span class="tx-danger">*</span></label>
                      <select id="select2-a" name="dep_id" class="form-control" >
                        <option label="แผนก/ฝ่าย">แผนก/ฝ่าย</option>
                      </select>
                      <span id="dep_id_msg" class="text-danger"></span>
                    </div>
                  </div>
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force bd-r-0-force">
                      <label class="form-control-label">เบอร์โทรศัพท์: </label>
                      <input class="form-control" type="text" name="m_tel" id="m_tel" value="" placeholder="...">
                    </div>
                  </div>
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force bd-r-0-force bd-b-0-force">
                      <label class="form-control-label">อีเมล์: </label>
                      <input class="form-control" type="text" name="m_email" id="m_email" value="" placeholder="...">
                    </div>
                  </div>
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force bd-r-0-force bd-b-0-force">
                      <label class="form-control-label">ไลน์: </label>
                      <input class="form-control" type="text" name="m_line" id="m_line" value="" placeholder="...">
                    </div>
                  </div>
                  <!-- <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force bd-r-0-force">
                      <label class="form-control-label">รายละเอียด (TH): </label>
                      <textarea class="form-control" name="m_desc_th" id="m_desc_th" maxlength="255"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force bd-r-0-force bd-b-0-force">
                      <label class="form-control-label">รายละเอียด (EN): </label>
                      <textarea class="form-control" name="m_desc_en" id="m_desc_en" maxlength="255" ></textarea>
                    </div>
                  </div> -->

                </div>
              </div><!-- col-8 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group bd-t-0-force bd-r-0-force bd-b-0-force">
                  <label class="control-label">รูปภาพ</label>
                  <div class="d-flex bg-gray-200 ht-250 pos-relative align-items-center imglogo" id="imgcover">
                    <!-- canvas logo econtrol -->
                  </div>
                  <div>
                    <span class="label label-danger">NOTE! </span>
                    <span style="color:red;"> รูปควรมีขนาดไม่เกิน 500x500px</span>
                  </div>
                </div>
              </div><!-- col-4 -->

            </div><!-- row -->
          </div>
        </form>
      </div><!-- modal-body -->
      <form name="frmupload" method="post" action="" id="fle-form" enctype="multipart/form-data">
			<input type="hidden" name="m_id" id="id" value="" />
			<input type="file" name="fle" id="fle" style="display:none;">
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary tx-size-xs btnsave">Save</button>
        <button type="button" class="btn btn-secondary tx-size-xs btnclose" data-dismiss="modal">Close</button>
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
  // $.jgrid.defaults.width = 100;
  $.jgrid.defaults.responsive = false;
  $.jgrid.defaults.styleUI = 'Bootstrap4';
  $(document).ready(function () {
    // upload image
    $('#fle').change(function(){
      $('#fle-form').submit();
    });

    $("#fle-form").on('submit',(function(e){
      e.preventDefault();
      $.ajax({
        url: "<?=$url;?>/<?=$get_part0;?>?select=uploadimg",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType: "json",
        success: function(data){

          if(data.status=="success"){
            toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
            loadImg(data.id);
            $("#id").val(data.id);
            $("#m_id").val(data.id);
            $("#action").val('edit');
          }else{
            toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
          }

        },
        error: function(){}
      });
    }));


      $("#jqGridlist").jqGrid({
        url: '<?=$url;?>/<?=$get_part0;?>?select=loaddata',
        editurl: '<?=$url;?>/<?=$get_part0;?>',
        datatype: "json",
        colModel: [
          {
				      label: 'ID',
              name: 'm_id',
              width: 60,
						  key: true,
              align: 'center',
						  editable: false,
              hidden: true
          },
          {
				      label: 'รูปภาพ',
              name: 'm_img',
              width: 60,
						  editable: false,
              align: 'center'
          },
          {
				      label: 'ชื่อทีมงาน (TH)',
              name: 'm_name_th',
              width: 200,
						  editable: false,
          },
          {
				      label: 'เบอร์โทรศัพท์',
              name: 'm_tel',
              width: 120,
						  editable: false,
          },
          {
				      label: 'อีเมล์',
              name: 'm_email',
              width: 120,
						  editable: false,
          },
          {
				      label: 'Line',
              name: 'm_line',
              width: 120,
						  editable: false,
          },
          {
				      label: 'ตำแหน่ง',
              name: 'm_position',
              width: 150,
						  editable: false,
          },
          {
				      label: 'แผนก/ฝ่าย',
              name: 'dep_id',
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
    		autowidth: true,
        page: 1,
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

      /* =====================================================================*/
			$("#searchkeyword").on('change',function(e){
				e.preventDefault();
        var search = $(this).val();
        var newurl= '<?=$url;?>/<?=$get_part0;?>?select=loaddata&search='+search;
        $("#jqGridlist").jqGrid().setGridParam({url : newurl,datatype: "json"}).trigger("reloadGrid");
			});

      /*======================================================================*/
      function loadAppmain(id){
        $('#select2-a').empty();
        var url_json = '<?="{$url}/{$get_part0}";?>?select=loaddep';
        $.ajax({
					url: url_json,
					type: 'get',
					dataType: 'json',
					timeout: 3000,
					success: function(data, textStatus, jqXHR ) {
						$('#select2-a').append('<option value="">Select Department</option>');
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

      loadAppmain(null);


      /*======================================================================*/
      $("#addform").on('click',function(e){
        e.preventDefault();
        $(".titleform").text('เพิ่มทีมงานใหม่');
        $("#formdata")[0].reset();
        $("#fle-form")[0].reset();
        $("#action").empty();
        $("#action").val('add');
        $("#m_id").empty();
        $("#id").empty();
        $("#modalform").modal('show');
        loadImg(id=null);
      });

      $(".btnsave").on('click',function(e){
        e.preventDefault();

				if($("#m_name_th").val()==""){
					$('#m_name_th_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}else{
          $('#m_name_th_msg').text('');
        }
				if($("#m_name_en").val()==""){
					$('#m_name_en_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}else{
          $('#m_name_en_msg').text('');
        }
				if($("#dep_id").val()==""){
					$('#dep_id_msg').text('กรุณาเลือกข้อมูลในช่องนี้ด้วยครับ');
				}else{
          $('#dep_id_msg').text('');
        }

				if($("#m_name_th").val()!='' && $("#m_name_en").val()!='' && $("#dep_id").val()!=''){
					$("#formdata").submit();
				}else{
					return false;
				}
      });


      $("#formdata").on('submit',function(e){
        e.preventDefault();

        var act = $("#action").val();
				$.ajax({
					 url: "<?=$url;?>/<?=$get_part0;?>?select=save",
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
              $("#fle-form")[0].reset();
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
      $(".titleform").text('แก้ไขทีมงาน');
      $("#modalform").modal('show');
      $("#formdata")[0].reset();
      $("#fle-form")[0].reset();
      $("#action").empty();
      $("#action").val('edit');

      var url_json = '<?=$url;?>/<?=$get_part0;?>?select=loaddataedit&id='+id;
      $.ajax({
        url: url_json,
        type: 'get',
        dataType: 'json',
        timeout: 3000,
        success: function(data, textStatus, jqXHR ) {

          $("#m_id").val(data.m_id);
          $("#id").val(data.m_id);
          $("#m_name_th").val(data.m_name_th);
          $("#m_name_en").val(data.m_name_en);
          $("#m_tel").val(data.m_tel);
          $("#m_email").val(data.m_email);
          $("#m_line").val(data.m_line);
          $("#m_position").val(data.m_position);
          $("#dep_id").val(data.dep_id);

          /*=======load type========*/
          $("#select2-a").empty();
          $('#select2-a').append('<option value="">Select Departments</option>');
          $.each(data.datatype.datarow, function(index, value){
            if(data.dep_id==value.id){
              $('#select2-a').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
            }else{
              $('#select2-a').append('<option value="' + value.id + '">' + value.name + '</option>');
            }
          });
          /*=======End load type========*/



          loadImg(data.m_id);

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


			} else toastr.error('Unknown row id','',{timeOut: 5000,closeButton: true});
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


    function btngetfile(param){
      $('#'+param).click();
    }

    function loadImg(id=null){
      if ('undefined'!= typeof id) {
        $("#imgcover").empty();

        $.ajax({
           type: "get",
           async: false,
           url: "<?=$url;?>/<?=$get_part0;?>",
           data: {select: 'readdataimg',id:id},
           dataType: "json",
           success: function(data) {
            $("#imgcover").html(data.btnupload);
            $("#imgcover").css('background-image','url('+data.img+')');
           }
        });

      } else toastr.warning('Unknown row id.', 'Warning!',{timeOut: 5000,closeButton: true});
    }

    function delImg(param,id) {
      if ( 'undefined' != typeof id) {
        $.ajax({
           type: "post",
           async: false,
           url: "<?=$url.'/'.$get_part0;?>",
           data: {select: 'delimg',id:id},
           dataType: "json",
           success: function(data) {
             if(data.status=="success"){
               toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
               loadImg(data.id);
             }else{
               toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
             }

           }
        });
      } else toastr.warning('Unknown row id.', 'Warning!',{timeOut: 5000,closeButton: true});
    }

</script>
