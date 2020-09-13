<div class="br-subleft">
  <h6 class="tx-uppercase tx-10 tx-mont tx-spacing-1 mg-t-10 pd-x-10 tx-white-7">Select Date</h6>

  <div class="mg-t-20 pd-x-10 mg-b-40">
    <div id="datepicker"></div>
    <input type="hidden" id="dateselect" value="<?=date("m/d/Y");?>" />
  </div>

  <h6 class="tx-uppercase tx-10 tx-mont tx-spacing-1 mg-t-10 pd-x-10 tx-white-7">Select Users</h6>

  <nav class="nav br-nav-mailbox flex-column">
    <?php echo $model->getarrUser();?>
  </nav>
</div><!-- br-subleft -->
<div class="br-contentpanel">
  <div class="br-pageheader pd-y-15 pd-md-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
      <span class="breadcrumb-item active"><?=$pagename;?></span>
    </nav>
  </div><!-- br-pageheader -->

  <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
    <h5 class="tx-gray-800 mg-b-5"><?=$pagename;?></h5>
  </div>

  <div class="d-flex align-items-center justify-content-start pd-x-20 pd-sm-x-30 mg-b-20 mg-sm-b-30">

    <button id="showSubLeft" class="btn btn-secondary mg-r-10 hidden-lg-up"><i class="fa fa-navicon"></i></button>

    <!-- <div class="mg-l-auto hidden-xs-down">
      <a href="#" class="btn btn-info">New Contact</a>
      <a href="#" class="btn btn-outline-info mg-l-5">Add to Group</a>
    </div> -->

  </div><!-- d-flex -->

  <div class="br-pagebody pd-x-20 pd-sm-x-30">
    <div class="card bd-0 shadow-base pd-5">
      <table id="datatable" class="table table-striped table-responsive display nowrap">
        <thead>
          <tr>
              <th>DATE TIME</th>
              <th>USER</th>
              <th>DESCRIPTION</th>
              <th>BROWSER</th>
              <th>OS</th>
              <th>IP</th>
          </tr>
        </thead>
      </table>
    </div>
  </div><!-- br-pagebody -->
</div><!-- br-contentpanel -->


<script type="text/javascript">


    $(document).ready(function () {


      $('#datatable').DataTable({
        responsive: true,
        language: {
          searchPlaceholder: 'Search...',
          sSearch: '',
        },
        processing: true,
        serverSide: true,
        // scrollY: '50vh',
        // scrollCollapse: true,
        // paging: false,
        ajax: {
          "url" : "<?=$url;?>/setting/logtransection/?select=loaddata&logdate=<?=date("m/d/Y");?>",
          "type" : "POST"
        },
        "responsive": {
            "details": {
                "display": $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return data[1];
                    }
                } ),
                "renderer": $.fn.dataTable.Responsive.renderer.tableAll()
            }
        },
        "language": {
					"lengthMenu": "แสดง _MENU_  รายการ",
					"zeroRecords": "Nothing found - sorry",
					"info": "แสดงรายการที่ _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
					"infoEmpty": "No records available",
					"infoFiltered": "(filtered from _MAX_ total records)",
					"emptyTable": "ไม่มีรายการข้อมูลที่ค้นหา",
					"search": "ค้นหา:",
				}
      });

      $("#datepicker").on("change", function () {
          //  alert($(this).val());
           var dateselect = $(this).val();
           $("#dateselect").val(dateselect);
           var urljson = "<?=$url;?>/setting/logtransection/?select=loaddata&logdate="+dateselect;
           $('#datatable').DataTable().ajax.url(urljson).load();;

      })

			$(".nav-link").on("click",function(){
	        var userid = $(this).data('id');
          var dateselect = $("#dateselect").val();
					var urljson = "<?=$url;?>/setting/logtransection/?select=loaddata&logdate="+dateselect+"&user="+userid;
          $('#datatable').DataTable().ajax.url(urljson).load();;
			});


		});




</script>
