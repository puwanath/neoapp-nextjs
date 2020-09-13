<div class="br-mainpanel">
  <div class="br-pageheader pd-x-5 pd-y-5 pd-md-l-10">
    <nav class="breadcrumb pd-0 mg-0 tx-14">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
      <span class="breadcrumb-item active"><?=$pagename;?></span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagebody pd-x-5 px-y-5 pd-sm-x-5">
    <div class="adiv card bd-0 shadow-base pd-0">
      <div class="row mg-0">
        <div class="col-md-3 col-xs-12 pd-0">
          <div class="pd-5 text-left">
            <div class="input-group">
              <input type="text" class="form-control" name="search" id="searchkeyword" placeholder="Search From Keyword...">
              <span class="input-group-btn">
                <button class="btn bd bg-white tx-gray-600" type="submit"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-2 col-xs-12 pd-0">
          <div class="pd-5 text-left">
            <select class="form-control" id="order_status">
              <option value="all">สถานะทั้งหมด</option>
              <option value="pending">รอตรวจสอบ</option>
              <option value="pending-payment">รอการชำระเงิน</option>
              <option value="pending-review">ตรวจสอบโอนเงิน</option>
              <option value="success">สำเร็จ</option>
              <option value="cancel">ยกเลิก</option>
            </select>
          </div>
        </div>
        <div class="col-md-3 col-xs-12 pd-0">
          <div class="pd-5 text-left">
            <div class="form-control">
              <div id="reportrange" style="background: #fff; cursor: pointer; width: 100%">
                  <i class="fa fa-calendar"></i>&nbsp;
                  <span></span> <i class="fa fa-caret-down"></i>
              </div>
              <input type="hidden" class="form-control" id="start_date" value="<?=$startdate;?>" name="start" />
              <input type="hidden" class="form-control" id="end_date" value="<?=$enddate;?>" name="end" />
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-12 pd-0 hidden-xs-down">
          <div class="pd-5 text-right">
            <button type="button" id="excelOrder" class="btn btn-success btn-with-icon hidden-xs-down">
							<div class="ht-40">
								<span class="icon wd-40"><i class="fa fa-file-excel-o"></i></span> <span class="pd-x-15">EXCEL</span>
							</div>
						</button>
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
            <table id="jqGridlist" class="table table-striped"></table>
            <div id="jqGridPager"></div>
						<!--END PAGE -->
					</div>
				</div>
			</div>

    </div>
  </div><!-- br-pagebody -->
</div><!-- br-contentpanel -->


<div id="modalform" class="modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content tx-size-sm">
      <div class="modal-header pd-x-20">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold titleform">TEXT TITLE</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="show_detail"></div><!-- col-8 -->
      </div><!-- modal-body -->
      <div class="modal-footer">
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
    .gdiv { height: calc(100% - 155px); }
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
  #display
  {
  	width:100%;
  	display:none;
  	background-color:#FFF;
  	border-left:solid 1px #dedede;
  	border-right:solid 1px #dedede;
  	border-bottom:solid 1px #dedede;
  	overflow:hidden;
    position: absolute !important;
    z-index: 9999 !important;
  }
  .display_box
  {
    padding: 7px;
    border-top: solid 1px #dedede;
    font-size: 15px;
    height: 35px;
    color: #010f2a;
    /*position: absolute;
    background-color: #eee;
    width: 100%;
    display: flex;
    z-index: 99;*/
    cursor: pointer;
    line-height: 17px;
  }
  .display_box:hover
  {
  	background-color:#333;
  	color:#FFFFFF;
    cursor: pointer;
  }
  td.bootstrap_dropdown {
    overflow:visible !important;
    white-space: normal !important;
  }
</style>

<script type="text/javascript">
  $(document).ready(function () {
    $.jgrid.defaults.responsive = false;
    $.jgrid.defaults.styleUI = 'Bootstrap4';
    // Datepicker
    $('.fc-datepicker').datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      dateFormat: 'dd/mm/yy'
    });

    var start = moment().subtract(29, 'days');
    var end = moment();

    // $(".br-pagebody").focusout(function(){
    //   $(".display_box").hide();
    // });

    var order_status= $("#order_status").val();
    $("#jqGridlist").jqGrid({
      url: '<?=$url;?>/<?=$get_part0;?>?select=loaddata&datestart='+start.format("YYYY-M-D")+'&dateend='+end.format("YYYY-M-D")+'&order_status='+order_status,
      // url: '<?=$url;?>/<?=$get_part0;?>?select=loaddata',
      editurl: '<?=$url;?>/<?=$get_part0;?>',
      datatype: "json",
      colModel: [
        {
			      label: 'เลขที่สั่งซื้อ',
            name: 'order_id',
            width: 150,
					  key: true,
            align: 'left',
					  editable: false,
            exportcol: true
        },
        // {
			  //     label: 'Order ID',
        //     name: 'order_id',
        //     width: 100,
        //     align: 'center',
				// 	  editable: false,
        //     exportcol: true
        // },
        {
			      label: 'ชื่อลูกค้า/อีเมล์',
            name: 'member_desc',
            width: 250,
            align: 'left',
					  editable: false,
            exportcol: true
        },
        // {
        //     label: 'Customer Email',
        //     name: 'member_email',
        //     width: 150,
        //     align: 'center',
        //     editable: false,
        //     formatter:checkContactType
        // },
        {
			      label: 'ยอดสั่งซื้อ',
            name: 'order_amount',
            width: 120,
            align: 'right',
					  editable: false,
        },
        {
			      label: 'รูปแบบจัดส่ง',
            name: 'shipping_type_id',
            width: 120,
            align: 'center',
					  editable: false,
        },
        {
			      label: 'ค่าจัดส่ง',
            name: 'shipping_amt',
            align: 'right',
            width: 120,
					  editable: false,
        },
        {
			      label: 'รูปแบบการชำระเงิน',
            name: 'payment_desc',
            width: 120,
            align: 'center',
					  editable: false,
        },
        {
			      label: 'อ้างอิงการชำระเงิน/RefNo ',
            name: 'payment_resultcode',
            width: 150,
            align: 'center',
					  editable: false,
        },
        // {
			  //     label: 'Payment RefNo ',
        //     name: 'payment_reference_no',
        //     width: 150,
        //     align: 'center',
				// 	  editable: false,
        // },
        {
			      label: 'จำนวนเงินที่ชำระ',
            name: 'payment_amount',
            width: 120,
            align: 'right',
					  editable: false,
        },
        {
			      label: 'แจ้งการชำระเงิน',
            name: 'payment_confirm',
            width: 150,
            align: 'center',
					  editable: false,
        },
        {
			      label: 'สถานะการชำระเงิน',
            name: 'payment_status',
            width: 150,
            align: 'center',
					  editable: false,
        },
        // {
			  //     label: 'สถานะการสั่งซื้อ',
        //     name: 'order_status',
        //     width: 150,
        //     align: 'center',
				// 	  editable: false,
        // },
        {
			      label: 'คะแนน',
            name: 'order_point',
            align: 'center',
            width: 100,
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
			sortname: 'order_date',
			sortorder : 'desc',
			loadonce: false,
			viewrecords: true,
      width: null,
  		shrinkToFit: false,
  		autowidth: false,
      // height: 100,
      page: 1,
      scroll: 1,
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


      function checkContactType(ct){
        if(ct=='Registation'){
          var textct = '<span style="color:red;">'+ct+'</span>';
        }else{
          var textct = '<span>'+ct+'</span>';
        }

        return textct;
      }


      /* =====================================================================*/
			$("#searchkeyword").keyup(function(e){
				e.preventDefault();
        var search = $(this).val();
        var order_status = $("#order_status").val();
        var newurl= '<?=$url;?>/<?=$get_part0;?>?select=loaddata&search='+search+'&order_status='+order_status;
        $("#jqGridlist").jqGrid().setGridParam({url : newurl,datatype: "json"}).trigger("reloadGrid");
			});

			$("#order_status").on('change',function(e){
				e.preventDefault();
        var order_status = $(this).val();
        var newurl= '<?=$url;?>/<?=$get_part0;?>?select=loaddata&order_status='+order_status;
        $("#jqGridlist").jqGrid().setGridParam({url : newurl,datatype: "json"}).trigger("reloadGrid");
        $(".display_box").hide();
			});

      /*======================================================================*/

      $("#excelOrder").on("click", function(){
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        var order_status = $("#order_status").val();
        var search = $("#searchkeyword").val();

        let url = '<?=$url;?>/<?=$get_part0;?>/export-excel?order_status='+order_status+'&searchkeyword='+search+'&start_date='+startDate+'&end_date='+endDate;
        window.open(url, 'myPopup', 'width=1000,height=600,toolbar=0, menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=250,top=150');
      });

      /*======================================================================*/

      function cb(start, end) {
          $('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
          $("#start_date").val(start.format('YYYY-M-D'));
          $("#end_date").val(end.format('YYYY-M-D'));
          var order_status = $("#order_status").val();
          var startDate = $('#start_date').val();
          var endDate = $('#end_date').val();
          var urljson = "<?=$url;?>/<?=$get_part0;?>/?select=loaddata&datestart="+startDate+"&dateend="+endDate+"&order_status="+order_status;
          $("#jqGridlist").jqGrid().setGridParam({url : urljson,datatype: "json"}).trigger("reloadGrid");
      }

      $('#reportrange').daterangepicker({
          startDate: start,
          endDate: end,
          ranges: {
             'Today': [moment(), moment()],
             'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
             'Last 7 Days': [moment().subtract(6, 'days'), moment()],
             'Last 30 Days': [moment().subtract(29, 'days'), moment()],
             'This Month': [moment().startOf('month'), moment().endOf('month')],
             'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          }
      }, cb);
      cb(start, end);

      /*======================================================================*/

		});

    function printOrder(order_id){
			// alert(order_id);
			let url = '<?=$url;?>/views/orders/print_order.php?order_id='+order_id;
			window.open(url, 'myPopup', 'width=1000,height=600,toolbar=0, menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=250,top=150');
		}


    function editFunc(id){
      var url = '<?=$url;?>/<?=$get_part0;?>/edit/'+id;
      window.location.href = url;
    }

    function viewPaymentFunc(id){
      $.ajax({
         type: "post",
         async: false,
         url: "<?=$url;?>/<?=$get_part0;?>",
         data: {select: 'getdetailConfirm',id:id},
         dataType: "json",
         success: function(data) {
           $("#modalform").modal('show');
           $(".titleform").html('Order ID : '+data.order_id+' Date : '+data.order_date);
           $("#show_detail").html(data.detail);
         }
      });

    }

    function changeStatus(id){
      if ( 'undefined' != typeof id) {
        var status = $("#"+id).val();
        if('undefined' != typeof status){
          $.ajax({
             type: "post",
             async: false,
             url: "<?=$url;?>/<?=$get_part0;?>",
             data: {select: 'updatestatus',id:id,status:status},
             dataType: "json",
             success: function(data) {
               if(data.status=='success'){
                 toastr.success('Update Status Success!',data.msg,{timeOut: 5000,closeButton: true});
                 $("#jqGridlist").jqGrid().trigger("reloadGrid");

                 if(data.order_status=='success'){
                   $.ajax({
                      type: "post",
                      async: true,
                      url: "<?=$url;?>/<?=$get_part0;?>",
                      data: {select: 'sendemailconfirm',order_id:data.order_id},
                      dataType: "json",
                      success: function(data) {

                      }
                   });
                 }

               }else{
                 toastr.error('Update Status Error!',data.msg,{timeOut: 5000,closeButton: true});
                 $("#jqGridlist").jqGrid().trigger("reloadGrid");
               }
             }
          });
        }
      } else toastr.error('Unknown row id','',{timeOut: 5000,closeButton: true});;
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
