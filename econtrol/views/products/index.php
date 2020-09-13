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
        <div class="col-md-4 col-xs-12 pd-0">
          <div class="pd-5 text-left">
            <div class="input-group">
              <input type="text" class="form-control" name="search" id="searchkeyword" placeholder="ค้นหาด้วยคีย์เวิร์ด...">
              <span class="input-group-btn">
                <button class="btn bd bg-white tx-gray-600" type="submit"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-xs-12 pd-0">
          <div class="pd-5 text-left">
            <select class="form-control select2-show-search" id="select2-a" data-placeholder="หมวดหมู่สินค้า"></select>
          </div>
        </div>
        <div class="col-md-5 col-xs-12 pd-0">
          <div class="pd-5 text-right">
    				<?php echo getMenu_permission_button($mainmenu);?>
            <a href="javascript:history.back();" class="btn btn-secondary btn-with-icon hidden-md-down hidden-xs-down">
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
    .gdiv { height: calc(100% - 155px); }
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

  .select2-container{
    width: 100% !important;
  }

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
              name: 'prodid',
              width: 60,
						  key: true,
              align: 'center',
						  editable: false,
              hidden: true
          },
          {
				      label: 'SKU',
              name: 'prodcode',
              width: 60,
              align: 'center',
						  editable: false
          },
          {
				      label: 'Picture',
              name: 'prodimg',
              width: 40,
              align: 'center',
						  editable: false,
          },
          {
				      label: 'Product Name (TH)',
              name: 'prodname_th',
              width: 200,
						  editable: false,
          },
          // {
				  //     label: 'ราคา',
          //     name: 'prodprice',
          //     width: 100,
					// 	  editable: false,
          //     align: 'right',
          // },
          // {
				  //     label: 'ราคา (โปรโมชั่น)',
          //     name: 'prodprice_promotion',
          //     width: 100,
					// 	  editable: false,
          //     align: 'right',
          // },
          // {
				  //     label: 'จำนวน',
          //     name: 'qty',
          //     width: 60,
					// 	  editable: false,
          //     align: 'center',
          // },
          {
				      label: 'Category',
              name: 'cat_id',
              width: 150,
						  editable: false,
          },
          {
				      label: 'Brand',
              name: 'brand_id',
              width: 150,
						  editable: false,
          },
          {
				      label: 'Application',
              name: 'app_id',
              width: 150,
						  editable: false,
          },
          {
				      label: 'Process',
              name: 'process_id',
              width: 150,
						  editable: false,
          },
          {
				      label: 'Suppliers',
              name: 'supp_id',
              width: 150,
						  editable: false,
          },
          {
					    label: 'Manage',
              name: 'btn_act',
              width: 130,
              align: 'right',
              editable: false
          }
        ],
				sortname: 'cat_id,prodname_th',
				sortorder : 'asc',
				loadonce: false,
				viewrecords: true,
    		shrinkToFit: false,
    		autowidth: false,
        page: 1,
        // scroll: 1,
        rowNum: 20,
        rowList:[20,30,50,100,200],
        multiselect: true,
        cellEdit: true,
        emptyrecords: 'Scroll to bottom to retrieve new page',
        pager: "#jqGridPager",
        onSelectRow:function(rowid, status) {
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

      /* =====================================================================*/
			$("#searchkeyword").on('change',function(e){
				e.preventDefault();
        var search = $(this).val();
        var newurl= '<?=$url;?>/<?=$get_part0;?>?select=loaddata&search='+search;
        $("#jqGridlist").jqGrid().setGridParam({url : newurl,datatype: "json"}).trigger("reloadGrid");
			});

      /*======================================================================*/
      function loadCatmain(id){
        var url_json = '<?=$url;?>/<?=$get_part0;?>?select=loadcategory';
        $.ajax({
					url: url_json,
					type: 'get',
					dataType: 'json',
					timeout: 3000,
					success: function(data, textStatus, jqXHR ) {
						$('#select2-a').append('<option value="all">หมวดหมู่ทั้งหมด</option>');
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

      loadCatmain();
      /*======================================================================*/
      $('#select2-a').on("change",function(e){
        var cat_id = $(this).val();
        var search = $("#searchkeyword").val();
        var newurl= '<?=$url;?>/<?=$get_part0;?>?select=loaddata&search='+search+"&cat_id="+cat_id;
        $("#jqGridlist").jqGrid().setGridParam({url : newurl,datatype: "json"}).trigger("reloadGrid");
      });
      /*======================================================================*/

		});

    function editFunc(id){
      var url = "<?php echo $url;?>/<?=$get_part0;?>/edit/"+id;
      window.location.href = url;
    }


    function delFunc(id,name){
      if ( 'undefined' != typeof id) {

        swal({
          title: 'คุณต้องการลบรายการนี้?',
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


    function cloneFunc(id,name){
      if ( 'undefined' != typeof id) {

        swal({
          title: 'คุณต้องการคัดลอกรายการนี้?',
          text: name,
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'คัดลอกรายการนี้',
          cancelButtonText: 'ยกเลิกไม่คัดลอก!',
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
               data: {select: 'cloneitem',id:id},
               dataType: "json",
               success: function(data) {
                 if(data.status=="success"){
                   toastr.success(data.msg,data.msgtitle,{timeOut: 5000,closeButton: true});
                   $("#jqGridlist").jqGrid().trigger("reloadGrid");
                 }else{
                   toastr.error(data.msg,data.msgtitle,{timeOut: 5000,closeButton: true});
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
