<div class="br-mainpanel">
  <div class="br-pageheader pd-x-5 pd-y-5 pd-md-l-10">
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
            <table id="jqGridlist" class="table table-hover table-striped"></table>
            <div id="jqGridPager"></div>
						<!--END PAGE -->
					</div>
				</div>
			</div>

    </div>
  </div><!-- br-pagebody -->
</div><!-- br-contentpanel -->

<style type="text/css">
  html { height: 100%; }
  body { height: calc(100% - 60px); }

  .br-mainpanel { height: 100%; }
  .br-pagebody { height: calc(100% - 50px); }

  .adiv { height: calc(100% - 0px); display: block; }
  .gdiv { height: calc(100% - 45px); }
  .ndiv { height: calc(100% - 20px); }
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
  .ui-jqgrid-bdiv{
    /*height: calc(100% - 10px) !important;
    max-height: 500px !important;*/
  }
</style>

<!--++++++++++++++++start form+++++++++++++++++++++++-->
<div id="form-modal" class="modal fade" aria-hidden="false">
	 <div class="modal-dialog modal" role="document" style="width:100%;">
		 <div class="modal-content bd-0 tx-14">
			 <form class="form-horizontal" id="action-form" role="form" action="" method="post" enctype="multipart/form-data">
				 <input type="hidden" name="id" id="id" value=""/>
 				<input type="hidden" name="act" id="act" value=""/>
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
 							<label for="type_name_th">หมวดหมู่ (TH)</label>
 							<input type="text" class="form-control" name="type_name_th" id="type_name_th" placeholder="หมวดหมู่ (TH)..." request>
 							<span style="color:red;" id="err_type_name_th"></span>
 						</div>

 						<div class="form-group">
 							<label for="type_name_en">หมวดหมู่ (EN)</label>
 							<input type="text" class="form-control" name="type_name_en" id="type_name_en" placeholder="หมวดหมู่ (EN)..." request>
 							<span style="color:red;" id="err_type_name_en"></span>
 						</div>

 						<div class="form-group">
 							<label for="slug">Slug (EN)</label>
 							<input type="text" class="form-control" name="slug" id="slug" placeholder="..." request>
 							<span style="color:red;" id="err_slug"></span>
 						</div>

					 </div>

				 </div>
			 </div>
			 </form>
			 <div class="modal-footer">
				 <button type="button" id="btnsubmit" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">Save</button>
				 <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Close</button>
			 </div>
		 </div>
	 </div><!-- modal-dialog -->
 </div><!-- modal -->




<!--+++++++++++++++++++++end form+++++++++++++++++++++++++-->
<script type="text/javascript">
$.jgrid.defaults.responsive = false;
$.jgrid.defaults.styleUI = 'Bootstrap4';
	$(document).ready(function (e) {
		if ( top.location.href != location.href ) top.location.href = location.href;

    $("#jqGridlist").jqGrid({
      url: '<?=$url;?>/<?=$get_part0;?>?select=loaddata',
      editurl: '<?=$url;?>/<?=$get_part0;?>',
      datatype: "json",
      colModel: [
        {
            label: 'No',
            name: 'row',
            width: 60,
            key: true,
            align: 'center',
            editable: false
        },
        {
            label: 'หมวดหมู่ (TH)',
            name: 'type_name_th',
            width: 150,
            editable: false,
        },
        {
            label: 'หมวดหมู่ (EN)',
            name: 'type_name_en',
            width: 150,
            editable: false,
        },
        {
            label: 'Slug',
            name: 'slug',
            width: 100,
            editable: false,
        },
        {
            label: 'Action',
            name: 'btn_act',
            width: 150,
            align: 'right',
            editable: false
        }
      ],
      sortname: 'sort',
      sortorder : 'asc',
      loadonce: false,
      viewrecords: true,
      width: null,
      shrinkToFit: false,
      autowidth: false,
      // height: 100,
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
      // alert(search);
      // return false;
      var newurl= '<?=$url;?>/<?=$get_part0;?>?select=loaddata&search='+search;
      $("#jqGridlist").jqGrid().setGridParam({url : newurl,datatype: "json"}).trigger("reloadGrid");


    });

    /*======================================================================*/

		$("#addform").on('click',(function(e){
			e.preventDefault();

			$('#form-title').text('เพิ่ม หมวดหมู่');
			$('#act').val('add');
			$('#form-modal').modal('show');

		}));

    $("#type_name_en").keyup(function(){
      var str = $(this).val();
      var slug = str.replace(' ', '-');
      $("#slug").val(slug);
    });

		$("#btnsubmit").on('click',function(e){
			e.preventDefault();

			if($("#type_name_th").val()==''){
				$("#type_name_th").css('border','1px solid red');
				$("#err_type_name_th").text('กรุณากรอกช่องนี้ ด้วยครับ!');
			}

			if($("#type_name_en").val()==''){
				$("#type_name_en").css('border','1px solid red');
				$("#err_type_name_en").text('กรุณากรอกช่องนี้ ด้วยครับ!');
			}

			if($("#slug").val()==''){
				$("#slug").css('border','1px solid red');
				$("#err_slug").text('กรุณากรอกช่องนี้ ด้วยครับ!');
			}

			if($("#type_name_th").val()!='' || $("#type_name_en").val()!='' || $("#slug").val()!=''){
				$("#action-form").submit();
			}else{
				return false;
			}

		})



		$("#action-form").on('submit',(function(e){
			e.preventDefault();


			var act = $('#act').val();
			var form = $('#action-form')[0];
			$.ajax({
				 url: "<?=$url.'/'.$get_part0;?>?select="+act,
				 type: "post",
				// data:  new FormData(this),
				 data:  new FormData(form),
				 contentType: false,
				 cache: false,
				 processData:false,
				 dataType: "json",
				 success: function(data) {

					if(data.status=="success"){
						toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
						$('#action-form')[0].reset();
						$('#form-modal').modal('hide');
						$("#jqGridlist").jqGrid().trigger("reloadGrid");

					}else{
						toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
					}
				 }
			});

		}));

	});

	//begin function

	function editRow(id){
    if ('undefined'!= typeof id) {
  		$('#form-title').text('แก้ไข หมวดหมู่');
  		$('#act').val('update');
  		$('#form-modal').modal('show');


			$.ajax({
				 type: "get",
				 async: false,
				 url: "<?=$url.'/'.$get_part0;?>",
				 data: {select: 'readdata',id:id},
				 dataType: "json",
				 success: function(data) {

					$("#id").val(data.id);
					$("#slug").val(data.slug);
					$("#type_name_th").val(data.type_name_th);
					$("#type_name_en").val(data.type_name_en);


				 }
			});


		} else toastr.warning('Unknown row id.', 'Warning!',{timeOut: 5000,closeButton: true});
	};


  // function sortdata
  function sortRow(line,type){

    $.ajax({
       type: "get",
       async: false,
       url: "<?=$url;?>/<?=$get_part0;?>",
       data: {select: 'sortrow',line:line,type:type},
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

</script>
