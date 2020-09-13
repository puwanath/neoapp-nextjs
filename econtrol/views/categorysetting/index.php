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
        <h6 class="tx-16 mg-b-0 tx-uppercase tx-inverse tx-bold titleform">TEXT TITLE</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pd-0">
        <form name="frm" action="" id=formdata method="post" enctype="multipart/form-data">
          <input type="hidden" name="action" id="action" value=""/>
          <input type="hidden" name="cat_id" id="cat_id" value=""/>
          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-8 mg-t--1 mg-md-t-0">
                <div class="row no-gutters">
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force">
                      <label class="form-control-label">ชื่อหมวดหมู่ (TH): <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="cat_name_th" id="cat_name_th" value="" placeholder="...">
                      <span id="cat_name_th_msg" class="text-danger"></span>
                    </div>
                  </div>
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force">
                      <label class="form-control-label">ชื่อหมวดหมู่ (EN): <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="cat_name_en" id="cat_name_en" value="" placeholder="...">
                      <span id="cat_name_en_msg" class="text-danger"></span>
                    </div>
                  </div>
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force">
                      <label class="form-control-label">Slug (EN only): <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="cat_slug" id="cat_slug" value="" placeholder="...">
                      <span id="cat_slug_msg" class="text-danger"></span>
                    </div>
                  </div>


                </div>
              </div><!-- col-8 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group bd-t-0-force bd-l-0-force bd-r-0-force">
                  <label class="control-label">ภาพหมวดหมู่/ไอคอน</label>
                  <div class="d-flex bg-gray-200 ht-250 pos-relative align-items-center imglogo" id="imgcover">
                    <!-- canvas logo econtrol -->
                  </div>
                  <div>
                    <span class="label label-danger">NOTE! </span>
                    <span style="color:red;"> รูปควรมีขนาดไม่เกิน 300x300px</span>
                  </div>
                </div>
              </div><!-- col-4 -->
              <div class="col-md-12 mg-t--1 mg-md-t-0">
                <div class="row no-gutters">

                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force">
                      <label class="form-control-label">รายละเอียด (TH): </label>
                      <textarea class="form-control edit-box" name="cat_detail_th" id="cat_detail_th" ></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force">
                      <label class="form-control-label">รายละเอียด (EN): </label>
                      <textarea class="form-control edit-box2" name="cat_detail_en" id="cat_detail_en" ></textarea>
                    </div>
                  </div>
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force">
                      <label class="form-control-label mg-b-0-force">หมวดหมู่หลัก: <span class="tx-danger">*</span></label>
                      <select id="select2-a" name="cat_id_main" class="form-control" >
                        <option label="หมวดหมู่หลัก">หมวดหมู่หลัก</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force">
                      <label class="form-control-label" for="seo_title">SEO Title: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="seo_title" id="seo_title" value="" maxlength="165" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force">
                      <label class="form-control-label" for="seo_desc">SEO Description: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="seo_desc" id="seo_desc" value="" maxlength="255" placeholder="">
                    </div>
                  </div>
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force">
                      <label class="form-control-label" for="seo_keyword">SEO Keyword: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="seo_keyword" id="seo_keyword" value="" maxlength="300" data-role="tagsinput" placeholder="Ex: กระเป๋า,เสื้อผ้า">
                    </div>
                  </div>


                </div>
              </div>

            </div><!-- row -->
          </div>
        </form>
      </div><!-- modal-body -->
      <form name="frmupload" method="post" action="" id="fle-form" enctype="multipart/form-data">
				<input type="hidden" name="cat_id" id="id" value=""/>
				<input type="file" name="fle" id="fle" style="display:none;">
      </form>
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

  .graybg{
    background-color: #868e96 !important;
  }

  #display
  {
    width:100%;
    display:none;
    background-color:#dedede;
    border-left:solid 1px #dedede;
    border-right:solid 1px #dedede;
    border-bottom:solid 1px #dedede;
    overflow:hidden;
    position: absolute !important;
    z-index: 9999 !important;
  }
  .display_box
  {
    padding:4px;
    border-top:solid 1px #dedede;
    background-color: #333;
    font-size:13px;
    height:30px;
    color:#fff;

  }
  .display_box:hover
  {
    background-color:#333;
    color:#FFFFFF;
  }
  .bggray{
    background-color: #eee !important;
    padding-left: 10px !important;
  }

  .bootstrap-tagsinput{
    border: 0px !important;
    box-shadow: none;
  }


  /*====================  full modal ===========================*/

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
    top: 50px;
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

  .jodit.jodit_dialog_box{
    z-index: 99999999999 !important;
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
            $("#cat_id").val(data.id);
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
              name: 'cat_id',
              width: 60,
						  key: true,
              align: 'center',
						  editable: false,
              classes: 'graybg',
              hidden: true
          },
          {
				      label: 'รูปภาพ',
              name: 'cat_img',
              width: 60,
              align: 'center',
						  editable: false,
          },
          {
				      label: 'หมวดหมู่ (TH)',
              name: 'cat_name_th',
              width: 200,
						  editable: false,
          },
          {
				      label: 'หมวดหมู่ (EN)',
              name: 'cat_name_en',
              width: 200,
						  editable: false,
          },
          {
				      label: 'หมวดหมู่หลัก',
              name: 'cat_id_main',
              width: 200,
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
        onSelectRow:function(rowid, status) {
          ckRow();
        },
        onSelectAll: function(aRowids, status) {
          ckRow();
        },
				sortname: 'cat_id_main,cat_id',
				sortorder : 'asc',
				loadonce: false,
				viewrecords: true,
        width: null,
    		shrinkToFit: false,
    		autowidth: false,
        // page: 1,
        scroll: 1,
        rowNum: 20,
        rowList:[20,30,50,100],
        multiselect: true,
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
                 data: {select: 'delselect',setid:setid},
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

      function ckRow(){
        var s;
        s = $("#jqGridlist").jqGrid('getGridParam','selarrrow');
        // console.log(s);
        // console.log(s.length);
        if(s.length>0){
          $('#delselect').prop('disabled', false);
        }else{
          $('#delselect').prop('disabled', true);
        }

      }

      // set auto height
      // var height = $(window).height();
      // $('.ui-jqgrid-bdiv').height(height-270);

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
      function loadCatmain(id){
        var url_json = '<?=$url;?>/<?=$get_part0;?>?select=loadcategorymain';
        $.ajax({
					url: url_json,
					type: 'get',
					dataType: 'json',
					timeout: 3000,
					success: function(data, textStatus, jqXHR ) {
						$('#select2-a').append('<option value="">เลือกหมวดหมู่หลัก</option>');
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
        $(".titleform").text('เพิ่มหมวดหมู่สินค้าใหม่');
        $("#formdata")[0].reset();
        $("#fle-form")[0].reset();
        $("#action").empty();
        $("#action").val('add');
        $("#cat_id").empty();
        $("#cat_id").val('');
        $("#id").empty();
        $("#id").val('');
        $("#select2-a").empty();
        $("#seo_keyword").tagsinput('removeAll');
        $('#seo_keyword').tagsinput('add', '');
        $("#modalform").modal('show','static');

        editor.val('');
        editor2.val('');

        loadImg(id=null);
        loadCatmain(id=null);
      });

      $(".btnsave").on('click',function(e){
        e.preventDefault();

				if($("#cat_name_th").val()==""){
					$('#cat_name_th_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}else{
          $('#cat_name_th_msg').text('');
        }
				if($("#cat_name_en").val()==""){
					$('#cat_name_en_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}else{
          $('#cat_name_en_msg').text('');
        }
				if($("#cat_slug").val()==""){
					$('#cat_slug_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}else{
          $('#cat_slug_msg').text('');
        }

				if($("#cat_name_th").val()!='' && $("#cat_name_en").val()!='' && $("#cat_slug").val()!=''){
					$("#formdata").submit();
				}else{
					return false;
				}
      });


      $("#cat_name_en").keyup(function(){
        var str = $(this).val();
        var slug = str.replace(" ", "-");
        $("#cat_slug").val(slug);
      })


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
          $(".titleform").text('แก้ไขหมวดหมู่สินค้า : '+data.cat_name_th);
          $("#cat_id").val(data.cat_id);
          $("#id").val(data.cat_id);
          $("#cat_name_th").val(data.cat_name_th);
          $("#cat_name_en").val(data.cat_name_en);
          $("#cat_slug").val(data.cat_slug);
          editor.val(data.cat_detail_th);
          editor2.val(data.cat_detail_en);
          // $("#cat_detail_th").val(data.cat_detail_th);
          // $("#cat_detail_en").val(data.cat_detail_en);
          $("#seo_title").val(data.seo_title);
          $("#seo_desc").val(data.seo_desc);
          $("#seo_keyword").tagsinput('removeAll');
          $('#seo_keyword').tagsinput('add', data.seo_keyword);
          $("#seo_keyword").val(data.seo_keyword);


          /*=======load type========*/
          $("#select2-a").empty();
          $('#select2-a').append('<option value="">เลือกหมวดหมู่หลัก</option>');
          $.each(data.datatype.datarow, function(index, value){
            if(data.cat_id_main==value.id){
              $('#select2-a').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
            }else{
              $('#select2-a').append('<option value="' + value.id + '">' + value.name + '</option>');
            }
          });
          /*=======End load type========*/

          loadImg(data.cat_id);

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

    function isFuncShow(status,id){
      if ('undefined'!= typeof id) {

        $.ajax({
           type: "get",
           async: false,
           url: "<?=$url.'/'.$get_part0;?>",
           data: {select: 'isshow',id:id,status:status},
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

      } else alert('Unknown row id.');
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
