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

          <div class="col-sm-6 col-md-3 col-lg-3 mg-t-5-force">
            <div class="card shadow-base bd-0">
              <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h6 class="card-title tx-uppercase tx-15 mg-b-0">ผู้ใช้</h6>
                <span class="tx-15 tx-uppercase select_date" style="color: #ea4957;"></span>
              </div><!-- card-header -->
              <div class="card-body d-xs-flex justify-content-between align-items-center">
                <h4 class="mg-b-0 tx-inverse tx-lato tx-bold" id="visitors">0</h4>
                <p class="mg-b-0 tx-sm"></p>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-4 -->

          <div class="col-sm-6 col-md-3 col-lg-3 mg-t-5-force">
            <div class="card shadow-base bd-0">
              <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h6 class="card-title tx-uppercase tx-15 mg-b-0">เซสชั่น</h6>
                <span class="tx-15 tx-uppercase select_date" style="color: #ea4957;"></span>
              </div><!-- card-header -->
              <div class="card-body d-xs-flex justify-content-between align-items-center">
                <h4 class="mg-b-0 tx-inverse tx-lato tx-bold" id="sessions">0</h4>
                <p class="mg-b-0 tx-sm"></p>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-4 -->

          <div class="col-sm-6 col-md-3 col-lg-3 mg-t-5-force">
            <div class="card shadow-base bd-0">
              <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h6 class="card-title tx-uppercase tx-15 mg-b-0">ผู้ใช้งานสัปดาห์นี้</h6>
                <span class="tx-15 tx-uppercase showdate_week" style="color: #ea4957;"></span>
              </div><!-- card-header -->
              <div class="card-body d-xs-flex justify-content-between align-items-center">
                <h4 class="mg-b-0 tx-inverse tx-lato tx-bold" id="visitor_this_week">0</h4>
                <p class="mg-b-0 tx-sm"></p>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-4 -->

          <div class="col-sm-6 col-md-3 col-lg-3 mg-t-5-force">
            <div class="card shadow-base bd-0">
              <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                <h6 class="card-title tx-uppercase tx-15 mg-b-0">ผู้ใช้เดือนนี้</h6>
                <span class="tx-15 tx-uppercase showdate_month" style="color: #ea4957;"></span>
              </div><!-- card-header -->
              <div class="card-body d-xs-flex justify-content-between align-items-center">
                <h4 class="mg-b-0 tx-inverse tx-lato tx-bold" id="visitor_this_month">0</h4>
                <p class="mg-b-0 tx-sm"></p>
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col-4 -->
        </div>
      </div>

    </div>
    <!-- section 1 -->
    <div class="row row-sm">
      <div class="col-md-12 col-xs-12 mg-t-15-force">
        <div class="card shadow-base bd-0">
          <div class="card-body d-xs-flex justify-content-between align-items-center">
            <div class="row mg-0-force" style="width:100%;">
              <div class="col-lg-12 col-xs-12">
                <div id="container_visitdaily" style="width:100%;min-height:450px;"></div>
              </div>
            </div>
          </div><!-- card-body -->
        </div><!-- card -->
      </div>
    </div>
    <!-- section 2 -->
    <div class="row row-sm">
      <div class="col-sm-12 col-md-12 col-lg-6 col-sm-6 mg-t-15-force">
        <div class="card shadow-base bd-0">
          <div class="card-body d-xs-flex justify-content-between align-items-center">
            <div id="container_webbrowser" style="width:100%;min-height:450px;"></div>
          </div>
        </div>
      </div>

      <div class="col-sm-12 col-md-12 col-lg-6 col-sm-6 mg-t-15-force">
        <div class="card shadow-base bd-0">
          <div class="card-body d-xs-flex justify-content-between align-items-center">
            <div id="container_device" style="width:100%;min-height:450px;"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- section 3 -->

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

    function loadStatic(startDate,endDate){

      $.ajax({
         type: "GET",
         timeout: 3000,
         url: "<?=$url;?>/<?=$get_part0;?>?select=loadstatic",
         data: { datestart:startDate,dateend:endDate },
         dataType: "json",
         success: function(data) {

          $(".select_date").empty();
          $(".select_date").html(data.selectdate);
          $("#visitors").html(0);
          $("#visitors").html(data.visitors);

          $("#sessions").html(0);
          $("#sessions").html(data.sessions);

          $(".showdate_week").empty();
          $(".showdate_week").html(data.showdate_week);
          $("#visitor_this_week").html(0);
          $("#visitor_this_week").html(data.visitor_this_week);

          $(".showdate_month").empty();
          $(".showdate_month").html(data.showdate_month);
          $("#visitor_this_month").html(0);
          $("#visitor_this_month").html(data.visitor_this_month);

         }
      });
    }


    function calcChart_device(startDate,endDate){

      var options = {
            chart: {
              renderTo: 'container_device',
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
                        format: '<b>{point.name}</b><br>{point.percentage:.2f} %',
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
                name: 'การเข้าชม',
                colorByPoint: true,
                showInLegend: true
            }],
            credits: {
                 enabled: false
            },
        }

        var url =  "<?=$url;?>/<?=$get_part0;?>?select=loadchart_of_device&datestart="+startDate+"&dateend="+endDate;
        $.getJSON(url,  function(data) {
          options.series[0].data = data.txtdata;
          options.title.text = data.chartname;
          options.subtitle.text = data.subtitle;
          var chart = new Highcharts.Chart(options);
        });
    }


    function calcChart_browser(startDate,endDate){

      var options = {
            chart: {
              renderTo: 'container_webbrowser',
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
                        format: '<b>{point.name}</b><br>{point.percentage:.2f} %',
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
                name: 'การเข้าชม',
                colorByPoint: true,
                showInLegend: true
            }],
            credits: {
                 enabled: false
            },
        }

        var url =  "<?=$url;?>/<?=$get_part0;?>?select=loadchart_of_browser&datestart="+startDate+"&dateend="+endDate;
        $.getJSON(url,  function(data) {
          options.series[0].data = data.txtdata;
          options.title.text = data.chartname;
          options.subtitle.text = data.subtitle;
          var chart = new Highcharts.Chart(options);
        });
    }

    function calcChartvisit_bydaily(startDate,endDate){
      var options = {
          chart: {
              renderTo: 'container_visitdaily'
          },
          title: {
              text: []
          },
          tooltip: {
            headerFormat: '<div style="font-size:10px">{point.key}</div><br/>',
            shared: true
          },
          subtitle: {
              text: []
          },
          plotOptions: {
              line: {
                  dataLabels: {
                      enabled: true
                  },
                  enableMouseTracking: true
              }
          },
          yAxis: [{ // Secondary yAxis
            min: 0,
            title: {
                text: 'ยอดวิว',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            labels: {
                format: '{value} ครั้ง',
                style: {
                    color: Highcharts.getOptions().colors[0]
                }
            },
            opposite: true
          },{ // Primary yAxis
            min: 0,
            labels: {
                format: '{value} คน',
                style: {
                    color: Highcharts.getOptions().colors[8]
                }
            },
            title: {
                text: 'จำนวนผู้เข้าชม',
                style: {
                    color: Highcharts.getOptions().colors[8]
                }
            }
          }],
          xAxis: {},
          series: [{
              name: 'จำนวนผู้เข้าชม',
              type: 'column',
              colorByPoint: true,
              showInLegend: true,
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
          },
          {
              name: 'ยอดวิว',
              type: 'line',
              colorByPoint: true,
              showInLegend: true,
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


      var url =  "<?=$url;?>/<?=$get_part0;?>?select=loadchart_by_daily&datestart="+startDate+"&dateend="+endDate;
      $.getJSON(url,  function(data) {
        // options.series[0].name = data.txname;
        options.series[0].tooltip = {valueSuffix: ' คน'};
        options.series[0].data = data.txtdata;
        options.series[0].color = '#c21766';
        options.series[0].yAxis = 1;
        options.series[1].tooltip = {valueSuffix: ' ครั้ง'};
        options.series[1].data = data.txtdataval;
        options.xAxis.categories = data.categories;

        options.title.text = data.chartname;
        options.subtitle.text = data.subtitle;
        var chart = new Highcharts.Chart(options);
      });
    }

    /* =====================================================================*/

    // var start = moment().subtract(29, 'days');
    var start = moment().subtract(6, 'days');
    // var start = moment();
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
        $("#start_date").val(start.format('YYYY-M-D'));
        $("#end_date").val(end.format('YYYY-M-D'));

        setTimeout(function(){
          var startDate = $('#start_date').val();
          var endDate = $('#end_date').val();

          calcChart_device(startDate,endDate);
          calcChart_browser(startDate,endDate);
          loadStatic(startDate,endDate);
          calcChartvisit_bydaily(startDate,endDate);
        }, 2000);

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


    // window.onload = function() {
    //   var urljson = "<?=$url;?>/<?=$get_part0;?>?select=loadstatic";
    //   loadStatic(urljson);
    // };


  });




</script>
