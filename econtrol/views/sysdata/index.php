<div class="br-mainpanel">
  <div class="br-pageheader pd-y-15 pd-md-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
      <span class="breadcrumb-item active"><?=$pagename;?></span>
    </nav>
  </div><!-- br-pageheader -->

  <!-- <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
    <h5 class="tx-gray-800 mg-b-5"><?//=$pagename;?></h5>
  </div> -->

  <div class="br-pagebody pd-x-20 pd-sm-x-30 mg-b-20">
    <div class="card bd-0 shadow-base pd-0 pd-t-20">
			<div class="mg-l-auto hidden-xs-down mg-b-10 pd-10">
				<a href="javascript:;" class="btn btn-info btnsave"> บันทึกแก้ไข </a>
				<a href="javascript:history.back();" class="btn btn-secondary mg-l-5"> ย้อนหลับ </a>
	    </div>
			<form role="form" action="#" method="POST" id="action-form" enctype="multipart/form-data">
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
					<div class="panel">

						<div class="panel-body">
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">ข้อมูลบริษัท</h6>
                <div class="form-layout form-layout-6 mg-b-20">

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      ชื่อบริษัท [ภาษาอังกฤษ]:
                    </div>
                    <div class="col-7 col-sm-8">
                      <input class="form-control" type="text" name="company_name" id="company_name" placeholder="Company name">
                      <span style="color:red;" id="err_company_name"></span>
                    </div>
                  </div>
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      ชื่อบริษัท [ภาษาไทย]:
                    </div>
                    <div class="col-7 col-sm-8">
                      <input class="form-control" type="text" name="company_name_th" id="company_name_th" placeholder="ชื่อบริษัท">
                      <span style="color:red;" id="err_company_name_th"></span>
                    </div>
                  </div>
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      ที่อยู่:
                    </div>
                    <div class="col-7 col-sm-8">
                      <input class="form-control" type="text" name="company_addr1" id="company_addr1" placeholder="ที่อยู่....">
                    </div>
                  </div>
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      ที่อยู่:
                    </div>
                    <div class="col-7 col-sm-8">
                      <input class="form-control" type="text" name="company_addr2" id="company_addr2" placeholder="ที่อยู่....">
                    </div>
                  </div>
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      โทรศัพท์:
                    </div>
                    <div class="col-7 col-sm-8">
                      <input class="form-control" type="text" name="company_tel" id="company_tel" placeholder="เบอร์โทรศัพท์....">
                    </div>
                  </div>

                </div>
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">ข้อมูลภาษี</h6>
                <div class="form-layout form-layout-6 mg-b-20">

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      ร้อยละ ภาษีมูลค่าเพิ่ม:
                    </div>
                    <div class="col-7 col-sm-8">
                      <input class="form-control" type="text" name="vat_percentage" id="vat_percentage" placeholder="Vat%">
                      <span style="color:red;" id="err_vat_percentage"></span>
                    </div>
                  </div>
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      เลขประจำตัวผู้เสียภาษี:
                    </div>
                    <div class="col-7 col-sm-8">
                      <input class="form-control" type="text" name="tax_no" id="tax_no" placeholder="เลขประจำตัวผู้เสียภาษี">
                      <span style="color:red;" id="err_tax_no"></span>
                    </div>
                  </div>
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      ร้อยละ ภาษีนิติบุคคล:
                    </div>
                    <div class="col-7 col-sm-8">
                      <input class="form-control" type="text" name="juristic_percentage" id="juristic_percentage" placeholder="....">
                    </div>
                  </div>

                </div>
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">หน้าสัญญา</h6>
                <div class="form-layout form-layout-6 mg-b-20">

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      บรรทัดที่ 1:
                    </div>
                    <div class="col-7 col-sm-8">
                      <input class="form-control" type="text" name="lease_line1" id="lease_line1" placeholder="....">
                      <span style="color:red;" id="err_lease_line1"></span>
                    </div>
                  </div>
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      บรรทัดที่ 2:
                    </div>
                    <div class="col-7 col-sm-8">
                      <input class="form-control" type="text" name="lease_line2" id="lease_line2" placeholder="....">
                      <span style="color:red;" id="err_lease_line2"></span>
                    </div>
                  </div>
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      บรรทัดที่ 3:
                    </div>
                    <div class="col-7 col-sm-8">
                      <input class="form-control" type="text" name="lease_line3" id="lease_line3" placeholder="....">
                      <span style="color:red;" id="err_lease_line3"></span>
                    </div>
                  </div>

                </div>
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">KIOSK</h6>
                <div class="form-layout form-layout-6 mg-b-20">

                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      ค่าปรับชำระเลยกำหนด (วันละ):
                    </div>
                    <div class="col-7 col-sm-8">
                      <input class="form-control" type="text" name="kiosk_fine_perday" id="kiosk_fine_perday" placeholder="....">
                      <span style="color:red;" id="err_kiosk_fine_perday"></span>
                    </div>
                  </div>
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      สัญญาเช่า พยานที่ 1:
                    </div>
                    <div class="col-7 col-sm-8">
                      <input class="form-control" type="text" name="klease_witness1" id="klease_witness1" placeholder="....">
                      <span style="color:red;" id="err_klease_witness1"></span>
                    </div>
                  </div>
                  <div class="row no-gutters">
                    <div class="col-5 col-sm-4">
                      สัญญาเช่า พยานที่ 2:
                    </div>
                    <div class="col-7 col-sm-8">
                      <input class="form-control" type="text" name="klease_witness2" id="klease_witness2" placeholder="....">
                      <span style="color:red;" id="err_klease_witness2"></span>
                    </div>
                  </div>

                </div>

						</div>
					</div>
				</div>

			</form>
			<div class="hidden-md-up pd-10 bg-gray-600">
				<a href="javascript:;" class="btn btn-info btnsave"> บันทึกแก้ไข </a>
				<a href="javascript:history.back();" class="btn btn-secondary mg-l-5"> ย้อนหลับ </a>
	    </div>
    </div>
  </div><!-- br-pagebody -->
</div><!-- br-contentpanel -->



<script type="text/javascript">

  function btngetfile(param){
    $('#'+param).click();
  }


	$(document).ready(function(e){
		if ( top.location.href != location.href ) top.location.href = location.href;

		$(".btnsave").on('click',function(e){
			e.preventDefault();
			$("#action-form").submit();
		});


		$("#action-form").on('submit',(function(e){
			e.preventDefault();

			$('#gmail_loading').show();
			$.ajax({
				 url: "<?=$url;?>/setting/sysdata?select=update",
				 type: "post",
				 data:  new FormData(this),
				 contentType: false,
				 cache: false,
				 processData:false,
				 dataType: "json",
				 success: function(data) {

					if(data.status=="success"){
						toastr.success(data.msg, 'Update Data Success!',{timeOut: 5000,closeButton: true});
						loadData();

					}else{
						toastr.error(data.msg, 'Update Data Error!',{timeOut: 5000,closeButton: true});
					}
				 }
			});
			$('#gmail_loading').hide();
		}));

	});

	//load data
	function loadData(){
		$('#gmail_loading').show();
		$.ajax({
			 type: "get",
			 async: false,
			 url: "<?=$url;?>/setting/sysdata",
			 data: {select: 'loaddata'},
			 dataType: "json",
			 success: function(data) {

				$("#company_name").val(data.company_name);
				$("#company_name_th").val(data.company_name_th);
				$("#company_addr1").val(data.company_addr1);
				$("#company_addr2").val(data.company_addr2);
				$("#company_tel").val(data.company_tel);

				$("#vat_percentage").val(data.vat_percentage);
				$("#tax_no").val(data.tax_no);
				$("#juristic_percentage").val(data.juristic_percentage);

				$("#lease_line1").val(data.lease_line1);
				$("#lease_line2").val(data.lease_line2);
				$("#lease_line3").val(data.lease_line3);

				$("#kiosk_fine_perday").val(data.kiosk_fine_perday);
				$("#klease_witness1").val(data.klease_witness1);
				$("#klease_witness2").val(data.klease_witness2);
        $('#gmail_loading').hide();
			 }
		});

	};
	loadData();  // ทำงานครั้งแรกทันที 1 ครั้ง

	</script>
