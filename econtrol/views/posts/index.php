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
  .ndiv { height: calc(100% - 10px); }
  .mdiv { height: calc(100% - 0px); }

  #gbox_jqGridlist { height: calc(100% - 35px); }
  #gview_jqGridlist { height: 100%; }
  #gview_jqGridlist .ui-jqgrid-bdiv { height: calc( 100% - 35px ) !important; }

  @media only screen and (max-width: 480px){
    .br-mainpanel { height: 100%; }
    .br-pagebody { height: calc(100% - 50px); }

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

    $(document).ready(function (e) {
      $.jgrid.defaults.responsive = false;
      $.jgrid.defaults.styleUI = 'Bootstrap4';
			// ATW
			if ( top.location.href != location.href ) top.location.href = location.href;

      $("#jqGridlist").jqGrid({
        url: '<?=$url;?>/<?=$get_part0;?>?select=loaddata',
        editurl: '<?=$url;?>/<?=$get_part0;?>',
        datatype: "json",
        colModel: [
          {
              label: 'ลำดับ',
              name: 'row',
              width: 50,
              key: true,
              align: 'center',
              editable: false
          },
          {
              label: 'รูปภาพ',
              name: 'img',
              width: 50,
              align: 'center',
              editable: false,
          },
          {
              label: 'หัวข้อบทความ (TH)',
              name: 'postname_th',
              width: 200,
              editable: false,
          },
          {
              label: 'Slug',
              name: 'slug',
              width: 150,
              editable: false,
          },
          {
              label: 'วันที่โพส',
              name: 'postdate',
              width: 100,
              editable: false,
              align: 'center'
          },
          {
              label: 'หมวดหมู่บทความ',
              name: 'cat_id',
              width: 100,
              editable: false,
              align: 'center'
          },
          {
              label: 'แสดงที่หน้า',
              name: 'site_id',
              width: 100,
              editable: false,
              align: 'center'
          },
          {
              label: 'จำนวนเข้าชม',
              name: 'rating',
              width: 100,
              editable: false,
              align: 'center'
          },
          {
              label: 'จัดการ',
              name: 'btn_act',
              width: 150,
              align: 'right',
              editable: false
          }
        ],
        sortname: 'postdate',
        sortorder : 'desc',
        loadonce: false,
        viewrecords: true,
        width: null,
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

		});

    function editFunc(id){
      var url = "<?php echo $url;?>/<?=$get_part0;?>/edit/"+id;
      window.location.href = url;
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

    function isFuncShowmenu(status,id){
      if ('undefined'!= typeof id) {

        $.ajax({
           type: "get",
           async: false,
           url: "<?=$url.'/'.$get_part0;?>",
           data: {select: 'isshowmenu',id:id,status:status},
           dataType: "json",
           success: function(data) {
             $("#jqGridlist").jqGrid().trigger("reloadGrid");
           }
        });


      } else toastr.warning('Unknown row id.', 'Warning!',{timeOut: 5000,closeButton: true});
    }


		// Remove row
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
