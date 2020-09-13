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
          <input type="hidden" name="shipping_type_id" id="shipping_type_id" value=""/>
          <div class="form-layout form-layout-2">
            <div class="row no-gutters">
              <div class="col-md-8 mg-t--1 mg-md-t-0">
                <div class="row no-gutters">
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force bd-r-0-force">
                      <label class="form-control-label">ชื่อการจัดส่ง: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="shipping_type_name" id="shipping_type_name" value="" placeholder="...">
                      <span id="shipping_type_name_msg" class="text-danger"></span>
                    </div>
                  </div>
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="form-group bd-t-0-force bd-l-0-force bd-r-0-force">
                      <label class="form-control-label">ค่าจัดส่ง: <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="shipping_type_price" id="shipping_type_price" value="" placeholder="...">
                      <span id="shipping_type_price_msg" class="text-danger"></span>
                    </div>
                  </div>


                </div>
              </div><!-- col-8 -->
              <div class="col-md-4 mg-t--1 mg-md-t-0">
                <div class="form-group bd-t-0-force bd-b-0-force bd-r-0-force">
                  <label class="control-label">ภาพ/ไอคอน</label>
                  <div class="d-flex bg-gray-200 ht-250 pos-relative align-items-center imglogo" id="imgcover">
                    <!-- canvas logo econtrol -->
                  </div>
                  <div>
                    <span class="label label-danger"></span>
                    <span style="color:red;"></span>
                  </div>
                </div>
              </div><!-- col-4 -->

            </div><!-- row -->
          </div>
        </form>
      </div><!-- modal-body -->
      <form name="frmupload" method="post" action="" id="fle-form" enctype="multipart/form-data">
				<input type="hidden" name="shipping_type_id" id="id" />
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
            $("#shipping_type_id").val(data.id);
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
              name: 'id',
              width: 60,
						  key: true,
              align: 'center',
						  editable: false,
              classes: 'graybg',
              hidden: true
          },
          {
				      label: 'Icon',
              name: 'shipping_type_icon',
              width: 60,
              align: 'center',
						  editable: false,
          },
          {
				      label: 'ชื่อการจัดส่ง',
              name: 'shipping_type_name',
              width: 200,
						  editable: false,
          },
          {
					    label: 'ค่าจัดส่ง',
              name: 'shipping_type_price',
              width: 150,
              align: 'left',
              editable: false
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
				sortname: 'sort',
				sortorder : 'asc',
				loadonce: false,
				viewrecords: true,
        width: null,
    		shrinkToFit: false,
    		autowidth: false,
        page: 1,
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
        var newurl= '<?=$url;?>/<?=$get_part0;?>?select=loaddata&search='+search;
        $("#jqGridlist").jqGrid().setGridParam({url : newurl,datatype: "json"}).trigger("reloadGrid");
			});

      /*======================================================================*/

      $("#addform").on('click',function(e){
        e.preventDefault();
        $(".titleform").text('เพิ่มรูปแบบการจัดส่งสินค้าใหม่');
        $("#formdata")[0].reset();
        $("#fle-form")[0].reset();
        $("#action").empty();
        $("#action").val('add');
        $("#shipping_type_id").empty();
        $("#shipping_type_id").val('');
        $("#id").empty();
        $("#id").val('');
        $("#modalform").modal('show');
        loadImg(id=null);
      });

      $(".btnsave").on('click',function(e){
        e.preventDefault();

				if($("#shipping_type_name").val()==""){
					$('#shipping_type_name_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}else{
          $('#shipping_type_name_msg').text('');
        }
				if($("#shipping_type_price").val()==""){
					$('#shipping_type_price_msg').text('กรุณากรอกช่องนี้ด้วยครับ');
				}else{
          $('#shipping_type_price_msg').text('');
        }

				if($("#shipping_type_name").val()!='' && $("#shipping_type_price").val()!=''){
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
              $("#fle-form")[0].reset();
              editFunc(data.id);
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
      $(".titleform").text('แก้ไขรูปแบบการจัดส่งสินค้า');
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

          $("#shipping_type_id").val(data.shipping_type_id);
          $("#id").val(data.shipping_type_id);
          $("#shipping_type_name").val(data.shipping_type_name);
          $("#shipping_type_price").val(data.shipping_type_price);

          loadImg(data.shipping_type_id);

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
