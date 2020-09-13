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

  <h6 class="tx-uppercase tx-10 tx-mont tx-spacing-1 mg-t-10 pd-x-10 tx-white-7">Select Users</h6>

  <nav class="nav br-nav-mailbox flex-column">
    <?php echo $model->getarrUser();?>
  </nav>
</div><!-- br-subleft -->
<div class="br-contentpanel">
  <div class="br-pageheader pd-x-5 pd-y-5 pd-md-l-10">
    <nav class="breadcrumb pd-0 mg-0 tx-14">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
      <span class="breadcrumb-item active"><?=$pagename;?></span>
    </nav>
  </div><!-- br-pageheader -->

  <button id="showSubLeft" class="btn btn-secondary rounded-circle mg-r-10 hidden-lg-up"><i class="fa fa-navicon"></i></button>

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
        <div class="col-md-6 col-xs-12 pd-0 hidden-xs-down">
          <div class="pd-5 text-right">
    				<?php //echo getMenu_permission_button($mainmenu);?>
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
				<div class="ndiv panel bd-t">
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

<style type="text/css">
  html { height: 100%; }
  body { height: calc(100% - 60px); }

  .br-contentpanel { height: 100%; }
  .br-pagebody { height: calc(100% - 55px); }

  .adiv { height: calc(100% - 0px); display: block; }
  .gdiv { height: calc(100% - 45px); }
  .ndiv { height: calc(100% - 10px); }
  .mdiv { height: calc(100% - 0px); }

  #gbox_jqGridlist { height: calc(100% - 35px); }
  #gview_jqGridlist { height: 100%; }

  #gview_jqGridlist .ui-jqgrid-bdiv { height: calc( 100% - 35px ) !important; }


  @media only screen and (max-width: 480px){
    html { height: 100%; }
    body { height: calc(100% - 75px); }

    .br-contentpanel{ height: 100%; }
    .br-pagebody { height: calc(100% - 25px); }

    .adiv { height: calc(100% - 0px); display: block; }
    .gdiv { height: calc(100% - 60px); }
    .ndiv { height: calc(100% - 5px); }
    .mdiv { height: calc(100% - 0px); }

    #gbox_jqGridlist { height: calc(100% - 30px); }
    #gview_jqGridlist { height: 100%; }
    #gview_jqGridlist .ui-jqgrid-bdiv { height: calc( 100% - 34px ) !important; }
  }

  .ui-jqgrid,
  .ui-jqgrid-view,
  .ui-jqgrid-hdiv,
  .ui-jqgrid-htable,
  .ui-jqgrid-bdiv,
  .ui-jqgrid-btable,
  .ui-jqgrid-pager{ width: 100% !important; }
  .ui-th-column-header,.ui-th-column{text-align: center !important;}
  .ui-jqgrid-bdiv{}
</style>
<script type="text/javascript">
  // $.jgrid.defaults.width = 100;
  $.jgrid.defaults.responsive = false;
  $.jgrid.defaults.styleUI = 'Bootstrap4';

  $(document).ready(function () {

    $("#jqGridlist").jqGrid({
      url: "<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=loaddata&logdatestart="+$('#start_date').val()+"&logdateend="+$('#end_date').val(),
      datatype: "json",
      colModel: [
        {
            label: 'Date Time',
            name: 'log_time',
            width: 150,
            key: true,
            editable: false
        },
        {
            label: 'User',
            name: 'log_user',
            width: 120,
            editable: false
        },
        {
            label: 'Description',
            name: 'log_desc',
            width: 300,
            editable: false
        },
        {
            label : 'Browser',
            name: 'log_browser',
            width: 150,
            editable: false
        },
        {
            label: 'OS',
            name: 'log_os',
            width: 150,
            editable: false
        },
        {
            label: 'IP',
            name: 'log_ip',
            width: 150,
            editable: false
        }
      ],
      sortname: 'log_time',
      sortorder : 'desc',
      loadonce: false,
      viewrecords: true,
      shrinkToFit: false,
      autowidth: false,
      page: 1,
      // scroll: 0,
      rowNum: 20,
      rowList:[20,30,50,100],
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


    /* =====================================================================*/
    $("#searchkeyword").on('change',function(e){
      e.preventDefault();
      $('#gmail_loading').show();
      var search = $(this).val();
      var startDate = $('#start_date').val();
      var endDate = $('#end_date').val();
      // alert(search);
      // return false;
      var newurl= '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=loaddata&search='+search+'&logdatestart='+startDate+'&logdateend='+endDate;
      $("#jqGridlist").jqGrid().setGridParam({url : newurl,datatype: "json"}).trigger("reloadGrid");

      $('#gmail_loading').hide();
    });

		$(".nav-user").on("click",function(){
        var userid = $(this).data('id');
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        var urljson = "<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=loaddata&logdatestart="+startDate+"&logdateend="+endDate+"&user="+userid;
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
        var urljson = "<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=loaddata&logdatestart="+startDate+"&logdateend="+endDate;
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
