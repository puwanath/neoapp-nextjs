<div class="br-subleft">
  <h6 class="tx-uppercase tx-10 tx-mont tx-spacing-1 mg-t-10 pd-x-10 tx-white-7">Select Date</h6>

  <div class="mg-t-20 pd-x-10 mg-b-40">
    <!-- date -->
    <div class="example">
      <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
          <i class="fa fa-calendar"></i>&nbsp;
          <span></span> <i class="fa fa-caret-down"></i>
      </div>
      <input type="hidden" class="form-control" id="start_date" value="<?=$startdate;?>" name="start" />
      <input type="hidden" class="form-control" id="end_date" value="<?=$enddate;?>" name="end" />
    </div>
    <!-- date -->
    <!-- <div id="datepicker"></div>
    <input type="hidden" id="dateselect" value="<?=date("m/d/Y");?>" /> -->
  </div>

  <h6 class="tx-uppercase tx-10 tx-mont tx-spacing-1 mg-t-10 pd-x-10 tx-white-7">Select Domain</h6>

  <nav class="nav br-nav-mailbox flex-column">
    <?php echo $model->getarrDomain();?>
  </nav>
</div><!-- br-subleft -->
<div class="br-contentpanel">
  <div class="br-pageheader pd-y-15 pd-md-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
      <span class="breadcrumb-item active"><?=$pagename;?></span>
    </nav>
  </div><!-- br-pageheader -->

  <div class="d-flex align-items-center justify-content-start pd-x-20 pd-sm-x-30 mg-b-20 mg-sm-b-30 hidden-lg-up">
    <button id="showSubLeft" class="btn btn-secondary mg-r-10 hidden-lg-up"><i class="fa fa-navicon"></i></button>

    <!-- <div class="mg-l-auto hidden-xs-down">
      <a href="#" class="btn btn-info">New Contact</a>
      <a href="#" class="btn btn-outline-info mg-l-5">Add to Group</a>
    </div> -->

  </div><!-- d-flex -->

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
    				<?php //echo getMenu_permission_button($mainmenu);?>
    				<a href="javascript:history.back();" class="btn btn-outline-info mg-l-5"> ย้อนหลับ </a>
    	    </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 pd-0">
				<div class="panel">
					<div class="panel-body">
              <!--BEGIN PAGE -->
              <table id="jqGridlist" class="table table-striped table-responsive display nowrap"></table>
              <div id="jqGridPager"></div>
              <!--END PAGE -->
          </div>
        </div>
      </div>
    </div>
  </div><!-- br-pagebody -->
</div><!-- br-contentpanel -->

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
  .ui-th-column-header,.ui-th-column
  {
    text-align: center !important;
  }
  .ui-jqgrid-bdiv{
    /*height: calc(100% - 10px) !important;
    max-height: 500px !important;*/
  }

  .tx-color{
    background-color: yellow !important;
    color:#000;
  }
  .rx-color{
    background-color: green !important;
    color: #fff;
  }
</style>
<script type="text/javascript">
  // $.jgrid.defaults.width = 100;
  $.jgrid.defaults.responsive = false;
  $.jgrid.defaults.styleUI = 'Bootstrap4';

  $(document).ready(function () {

    $("#jqGridlist").jqGrid({
      url: "<?=$url;?>/<?=$get_part0;?>?select=loaddata&logdatestart="+$('#start_date').val()+"&logdateend="+$('#end_date').val(),
      datatype: "json",
      colModel: [
        {
            label: 'Date Time',
            name: 'logdata_time',
            width: 100,
            key: true,
            editable: false,
            align: 'center'
        },
        {
            label: 'Domain',
            name: 'logdata_domain',
            width: 120,
            editable: false
        },
        {
            label: 'IP Address',
            name: 'logdata_ip',
            width: 100,
            editable: false,
            align: 'center'
        },
        {
            label : '<i class="icon ion-arrow-up-a"></i> TX (Bytes)',
            name: 'logdata_tx',
            width: 60,
            editable: false,
            align: 'right',
            classes: 'tx-color'
        },
        {
            label: '<i class="icon ion-arrow-down-a"></i> RX (Bytes)',
            name: 'logdata_rx',
            width: 60,
            editable: false,
            align: 'right',
            classes: 'rx-color'
        },
        {
            label: 'URL',
            name: 'logdata_url',
            width: 300,
            editable: false
        }
      ],
      sortname: 'access_time',
      sortorder : 'desc',
      loadonce: true,
      viewrecords: true,
      width: null,
      shrinkToFit: false,
      autowidth: false,
      // height: 100,
      // page: 1,
      // scroll: 1,
      rowNum: 20,
      emptyrecords: 'Scroll to bottom to retrieve new page',
      pager: "#jqGridPager"
    });

    $("#jqGridlist").jqGrid('navGrid', '#jqGridPager',
      {
        edit: false,
        add:false,
        del:false,
        search:false
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
      var startDate = $('#start_date').val();
      var endDate = $('#end_date').val();
      // alert(search);
      // return false;
      var newurl= '<?=$url;?>/<?=$get_part0;?>?select=loaddata&search='+search+'&logdatestart='+startDate+'&logdateend='+endDate;
      $("#jqGridlist").jqGrid().setGridParam({url : newurl,datatype: "json"}).trigger("reloadGrid");

      $('#gmail_loading').hide();
    });

		$(".nav-link").on("click",function(){
        var domain = $(this).data('id');
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        var urljson = "<?=$url;?>/<?=$get_part0;?>/?select=loaddata&logdatestart="+startDate+"&logdateend="+endDate+"&domain="+domain;
        $("#jqGridlist").jqGrid().setGridParam({url : urljson,datatype: "json"}).trigger("reloadGrid");
		});

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
        $("#start_date").val(start.format('YYYY-M-D'));
        $("#end_date").val(end.format('YYYY-M-D'));

        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        var urljson = "<?=$url;?>/<?=$get_part0;?>/?select=loaddata&logdatestart="+startDate+"&logdateend="+endDate;
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

  });




</script>
