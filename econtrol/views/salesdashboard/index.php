<div class="br-mainpanel">
  <div class="pd-x-15 pd-y-10 bg-gray-800">
    <div class="row">
      <div class="col-md-9 col-xs-12 col-sm-6">
        <h5 class="tx-white mg-b-0"><?=$pagename;?></h5>
        <p class="tx-orange mg-b-0"><?=$pagedesc;?></p>
      </div>
      <div class="col-md-3 col-xs-12 col-sm-6">
        <div class="text-right">
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
        </div>

      </div>
    </div>
  </div><!-- d-flex -->

  <div class="br-pagebody pd-10 pd-t-5-force">
    <!-- section 1 -->
    <div class="row row-sm">
      <div class="col-lg-12 col-md-12 col-xs-12" style="">
        <div class="row row-sm" >

          <div class="col-sm-6 col-md-3 col-lg-3 col-sm-4 mg-t-5-force">
            <div class="bg-danger rounded overflow-hidden">
              <div class="pd-20 d-flex align-items-center">
                <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-30">
                  <p class="tx-16 tx-spacing-1 tx-medium tx-uppercase tx-white mg-b-10">ยอดขายวันนี้</p>
                  <p class="tx-26 tx-white tx-lato tx-bold mg-b-2 lh-1">&#3647;<span id="today_sales"></span></p>
                  <span class="tx-12 tx-roboto tx-white-6" id="txt-today"></span>
                </div>
              </div>
            </div>
          </div><!-- col-4 -->

          <div class="col-sm-6 col-md-3 col-lg-3 col-sm-4 mg-t-5-force">
            <div class="bg-danger rounded overflow-hidden">
              <div class="pd-20 d-flex align-items-center">
                <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-30">
                  <p class="tx-16 tx-spacing-1 tx-medium tx-uppercase tx-white mg-b-10">ยอดขายสัปดาห์นี้</p>
                  <p class="tx-26 tx-white tx-lato tx-bold mg-b-2 lh-1">&#3647;<span id="sales_this_week"></span></p>
                  <span class="tx-12 tx-roboto tx-white-6" id="txt-week"></span>
                </div>
              </div>
            </div>
          </div><!-- col-4 -->

          <div class="col-sm-6 col-md-3 col-lg-3 col-sm-4 mg-t-5-force">
            <div class="bg-danger rounded overflow-hidden">
              <div class="pd-20 d-flex align-items-center">
                <i class="ion ion-bag tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-30">
                  <p class="tx-16 tx-spacing-1 tx-medium tx-uppercase tx-white mg-b-10">ยอดขายเดือนนี้</p>
                  <p class="tx-26 tx-white tx-lato tx-bold mg-b-2 lh-1">&#3647;<span id="sales_this_month"></span></p>
                  <span class="tx-12 tx-roboto tx-white-6" id="txt-month"></span>
                </div>
              </div>
            </div>
          </div><!-- col-4 -->

          <div class="col-sm-6 col-md-3 col-lg-3 col-sm-4 mg-t-5-force">
            <div class="bg-primary rounded overflow-hidden">
              <div class="pd-20 d-flex align-items-center">
                <i class="ion ion-person-stalker tx-60 lh-0 tx-white op-7"></i>
                <div class="mg-l-30">
                  <p class="tx-16 tx-spacing-1 tx-medium tx-uppercase tx-white mg-b-10">จำนวนลูกค้าสะสม</p>
                  <p class="tx-26 tx-white tx-lato tx-bold mg-b-2 lh-1"><span id="customers_count"></span></p>
                  <span class="tx-12 tx-roboto tx-white-6" id="txt-cust-between"></span>
                </div>
              </div>
            </div>
          </div><!-- col-4 -->

          <div class="col-sm-12 col-md-12 col-lg-6 col-sm-6 mg-t-15-force">
            <div class="card shadow-base bd-0">
              <div class="card-body d-xs-flex justify-content-between align-items-center">
                <div id="container_sales_product_group" style="width:100%;"></div>
              </div>
            </div>
          </div>

          <div class="col-sm-12 col-md-12 col-lg-6 col-sm-6 mg-t-15-force">
            <div class="card shadow-base bd-0">
              <div class="card-body d-xs-flex justify-content-between align-items-center">
                <div id="container_sales_product_brand" style="width:100%;"></div>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
    <!-- section 2 -->
    <div class="row row-sm">
      <div class="col-md-12 col-xs-12 mg-t-15-force">
        <div class="card shadow-base bd-0">
          <div class="card-header pd-5 bg-transparent d-flex justify-content-between align-items-center">
            <div class="col-md-3 col-xs-12 pd-0">
              <select class="form-control form-xs" id="monthselect"></select>
            </div>
          </div>
          <div class="card-body d-xs-flex justify-content-between align-items-center">
            <div class="row mg-0-force" style="width:100%;">
              <div class="col-lg-12 col-xs-12">
                <div id="container_sales_daily" style="width:100%;"></div>
              </div>
            </div>
          </div><!-- card-body -->
        </div><!-- card -->
      </div>
    </div>
    <!-- section 3 -->
    <div class="row row-sm">
      <div class="col-md-12 col-xs-12 mg-t-15-force">
        <div class="card shadow-base bd-0">
          <div class="card-header pd-5 bg-transparent d-flex justify-content-between align-items-center">
            <div class="col-md-3 col-xs-12 pd-0">
              <select class="form-control form-xs" id="yearselect"></select>
            </div>
          </div>
          <div class="card-body d-xs-flex justify-content-between align-items-center">
            <div class="row mg-0-force" style="width:100%;">
              <div class="col-lg-12 col-xs-12">
                <div id="container_sales_month" style="width:100%;"></div>
              </div>
            </div>
          </div><!-- card-body -->
        </div><!-- card -->
      </div>
    </div>
    <!-- section 4 -->
    <div class="row row-sm">
      <div class="col-md-12 col-xs-12 mg-t-15-force">
        <div class="card shadow-base bd-0">
          <div class="card-body d-xs-flex justify-content-between align-items-center">
            <div class="row mg-0-force" style="width:100%;">
              <div class="col-lg-12 col-md-12 col-xs-12">
                <div id="container_sales_top10" style="width:100%;"></div>
              </div>
            </div>
          </div><!-- card-body -->
        </div><!-- card -->
      </div>
    </div>

  </div><!-- br-pagebody -->

</div><!-- br-mainpanel -->


<style type="text/javascript">
.highcharts-pie-series .highcharts-point {
stroke: #EDE;
stroke-width: 2px;
}
.highcharts-pie-series .highcharts-data-label-connector {
stroke: silver;
stroke-dasharray: 2, 2;
stroke-width: 2px;
}

</style>

<script type="text/javascript">
  $(document).ready(function () {

    function loadStatic(urljson){
      $.ajax({
         type: "GET",
         timeout: 3000,
         url: urljson,
         data: {},
         dataType: "json",
         success: function(data) {

          $("#txt-today").empty();
          $("#txt-today").html(data.datetoday);
          $("#today_sales").html(0);
          $("#today_sales").html(data.today_sales);

          $("#txt-week").empty();
          $("#txt-week").html(data.dateweek);
          $("#sales_this_week").html(0);
          $("#sales_this_week").html(data.sales_this_week);

          $("#txt-month").empty();
          $("#txt-month").html(data.datemonth);
          $("#sales_this_month").html(0);
          $("#sales_this_month").html(data.sales_this_month);

          $("#txt-cust-between").empty();
          $("#txt-cust-between").html(data.datecountcust);
          $("#customers_count").html(0);
          $("#customers_count").html(data.countcust);
         }
      });
    }

    function calcChart_salesofproductgroup(startDate,endDate){

      var options = {
            chart: {
              renderTo: 'container_sales_product_group',
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
            },
            title: {
                text: []
            },
            subtitle: {
                text: []
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                        distance: -50,
                        filter: {
                            property: 'percentage',
                            operator: '>',
                            value: 4
                        }
                    }
                }
            },
            series: [{
                name: 'ยอดขาย'
            }],
            credits: {
                 enabled: false
            },
        }

        var url =  "<?=$url;?>/<?=$get_part0;?>?select=loadsalesproductgroup&datestart="+startDate+"&dateend="+endDate;
        $.getJSON(url,  function(data) {
          options.series[0].data = data.txtdata;
          options.title.text = data.chartname;
          options.subtitle.text = data.subtitle;
          var chart = new Highcharts.Chart(options);
        });
    }


    function calcChart_salesofproductbrand(startDate,endDate){

      var options = {
            chart: {
              renderTo: 'container_sales_product_brand',
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
            },
            title: {
                text: []
            },
            subtitle: {
                text: []
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                        distance: -50,
                        filter: {
                            property: 'percentage',
                            operator: '>',
                            value: 4
                        }
                    }
                }
            },
            series: [{
                name: 'ยอดขาย'
            }],
            credits: {
                 enabled: false
            },
        }

        var url =  "<?=$url;?>/<?=$get_part0;?>?select=loadsalesproductbrand&datestart="+startDate+"&dateend="+endDate;
        $.getJSON(url,  function(data) {
          options.series[0].data = data.txtdata;
          options.title.text = data.chartname;
          options.subtitle.text = data.subtitle;
          var chart = new Highcharts.Chart(options);
        });
    }

    function calcChart_salesofdaily(month){
      var options = {
          chart: {
              renderTo: 'container_sales_daily'
          },
          title: {
              text: []
          },
          tooltip: {
    				headerFormat: '<div style="font-size:10px">ยอดขาย {point.key}</div><br/>',
            shared: true
        	},
          subtitle: {
              text: []
          },
          tooltip: {
              pointFormat: 'ยอดขาย: <b>{point.y} บาท</b>'
          },
          xAxis: {},
          series: [{
              type: 'column',
              colorByPoint: false,
              showInLegend: false,
              dataLabels: {
                  enabled: true,
                  rotation: 0,
                  color: '#000',
                  align: 'right',
                  format: '{point.y}', // one decimal
                  y: 10, // 10 pixels down from the top
                  style: {
                      fontSize: '13px',
                      fontFamily: 'Verdana, sans-serif'
                  }
              }
          }],
          credits: {
               enabled: false
          },

      };


      var url =  "<?=$url;?>/<?=$get_part0;?>?select=loadsalesdaily&month="+month;
      $.getJSON(url,  function(data) {
        // options.series[0].name = data.txname;
        options.series[0].tooltip = {valueSuffix: ' บาท'};
        options.series[0].data = data.txtdata;
        options.series[0].color = '#c21766';
        options.xAxis.categories = data.categories;

        options.title.text = data.chartname;
        options.subtitle.text = data.subtitle;
        var chart = new Highcharts.Chart(options);
      });
    }

    function calcChart_salesofmonth(year){
      var options = {
          chart: {
              renderTo: 'container_sales_month'
          },
          title: {
              text: []
          },
          tooltip: {
    				headerFormat: '<div style="font-size:10px">ยอดขาย {point.key}</div><br/>',
            shared: true
        	},
          subtitle: {
              text: []
          },
          tooltip: {
              pointFormat: 'ยอดขาย: <b>{point.y} บาท</b>'
          },
          xAxis: {},
          series: [{
              type: 'column',
              colorByPoint: false,
              showInLegend: false,
              dataLabels: {
                  enabled: true,
                  rotation: 0,
                  color: '#000',
                  align: 'right',
                  format: '{point.y}', // one decimal
                  y: 10, // 10 pixels down from the top
                  style: {
                      fontSize: '13px',
                      fontFamily: 'Verdana, sans-serif'
                  }
              }
          }],
          credits: {
               enabled: false
          },

      };


      var url =  "<?=$url;?>/<?=$get_part0;?>?select=loadsalesmonth&year="+year;
      $.getJSON(url,  function(data) {
        // options.series[0].name = data.txname;
        options.series[0].tooltip = {valueSuffix: ' บาท'};
        options.series[0].data = data.txtdata;
        options.series[0].color = '#c21766';
        options.xAxis.categories = data.categories;

        options.title.text = data.chartname;
        options.subtitle.text = data.subtitle;
        var chart = new Highcharts.Chart(options);
      });
    }

    function calcChart_top10product(startDate,endDate){
      var options = {
          chart: {
              renderTo: 'container_sales_top10',
              inverted: true,
              polar: false
          },
          title: {
              text: []
          },
          tooltip: {
    				headerFormat: '<div style="font-size:10px">ยอดขาย {point.key}</div><br/>',
            shared: true
        	},
          subtitle: {
              text: []
          },
          tooltip: {
              pointFormat: 'ยอดขาย: <b>{point.y} บาท</b>'
          },
          xAxis: {},
          series: [{
              type: 'column',
              colorByPoint: false,
              showInLegend: false,
              dataLabels: {
                  enabled: true,
                  rotation: 0,
                  color: '#000',
                  align: 'right',
                  format: '{point.y}', // one decimal
                  y: 10, // 10 pixels down from the top
                  style: {
                      fontSize: '13px',
                      fontFamily: 'Verdana, sans-serif'
                  }
              }
          }],
          credits: {
               enabled: false
          },

      };


      var url =  "<?=$url;?>/<?=$get_part0;?>?select=loadsalestop10products&datestart="+startDate+"&dateend="+endDate;
      $.getJSON(url,  function(data) {
        // options.series[0].name = data.txname;
        options.series[0].tooltip = {valueSuffix: ' บาท'};
        options.series[0].data = data.txtdata;
        options.series[0].color = '#138D75';
        options.xAxis.categories = data.categories;

        options.title.text = data.chartname;
        options.subtitle.text = data.subtitle;
        var chart = new Highcharts.Chart(options);
      });
    }


    function loadMonthselect(){
      var url_json = '<?="$url/$get_part0";?>?select=selectmonth';
  		$('#monthselect').empty();
  		$.ajax({
  			url: url_json,
  			type: 'get',
  			dataType: 'json',
  		}).then(function(data) {
  			// $('#monthselect').append('<option value="all"></option>');
        if(data==null)
          return false;

  			$.each(data.datarow, function(index, value){
  				$('#monthselect').append(`<option value="${value.id}">${value.name}</option>`);
  			});
  		});
    }

    function loadYearselect(){
      var url_json = '<?="$url/$get_part0";?>?select=selectyear';
  		$('#yearselect').empty();
  		$.ajax({
  			url: url_json,
  			type: 'get',
  			dataType: 'json',
  		}).then(function(data) {
  			// $('#monthselect').append('<option value="all"></option>');
        if(data==null)
          return false;

  			$.each(data.datarow, function(index, value){
  				$('#yearselect').append(`<option value="${value.id}">${value.name}</option>`);
  			});
  		});
    }

    loadMonthselect();
    loadYearselect();

    /* =====================================================================*/

    var start = moment().subtract(29, 'days');
    // var start = moment().subtract(6, 'days');
    // var start = moment();
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
        $("#start_date").val(start.format('YYYY-M-D'));
        $("#end_date").val(end.format('YYYY-M-D'));

        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        calcChart_salesofproductgroup(startDate,endDate);
        calcChart_salesofproductbrand(startDate,endDate);
        calcChart_top10product(startDate,endDate);
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

    /*===============================================================*/
    var start2 = moment();
    function dateonly(start2){
      $('#dateonly span').html(start2.format('MMM D, YYYY'));
      $("#datepicker").val(start2.format('YYYY-M-D'));

      var datepik = start2.format('YYYY-M-D');
      // txandrx_perhours(datepik,'alldomain');
    }

    $('#dateonly').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
    }, dateonly);

    dateonly(start2);
    window.onload = function() {
      var urljson = "<?=$url;?>/<?=$get_part0;?>?select=loadstatic";
      loadStatic(urljson);
      calcChart_salesofdaily($("#monthselect").val());
      calcChart_salesofmonth($("#yearselect").val());
    };

    $("#monthselect").on("change",function(e){
      calcChart_salesofdaily($(this).val());
    });

    $("#yearselect").on("change",function(e){
      calcChart_salesofmonth($(this).val());
    });

  });


</script>
