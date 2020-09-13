<div class="page">
	<div class="page-header page-header-bordered">
		<h1 class="page-title"><?=$pagename;?></h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?=$url;?>">Home</a></li>
			<li class="breadcrumb-item active"><?=$pagename;?></li>
		</ol>
		<div class="page-header-actions">
			<a class="btn btn-sm btn-primary btn-outline" href="javascript:;" id="addform">
				<i class="icon wb-plus" aria-hidden="true"></i>
				<span class="hidden-sm-down">เพิ่ม</span>
			</a>
		</div>
	</div>
	<div class="page-content container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<div class="panel">
					<!-- <div class="panel-heading">
            <div class="panel-actions panel-actions-keep">
              <a class="text-action" href="javascript:void(0)"><i class="icon wb-edit" aria-hidden="true"></i></a>
            </div>
            <h3 class="panel-title">test</h3>
          </div> -->
					<div class="panel-body">
						<!--BEGIN PAGE -->
							<table class="table table-hover dataTable table-striped w-full" id="data_table">
		           <thead>
		               <tr role="row" class="heading">
												<th width="5%"> # </th>
												<th width="20%"> ชื่อเมนู </th>
		                    <th width="10%"> ประเภท </th>
		                    <th width="10%"> จัดการ </th>
		               </tr>
								</thead>
								<tbody> </tbody>
							</table>
						<!--END PAGE -->

					</div>
				</div>
			</div>

		</div>
	<!-- BEGIN PAGE CONTENT INNER -->

	<!-- END PAGE CONTENT INNER -->
  </div>
</div>


<div class="modal fade bs-modal-lg" id="form-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

				<div class="modal-header" style="background-color:#eee;">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title" id="form-title">{texttitle}</h4>
				</div>

				<div class="modal-body">
					<form class="form-horizontal" id="action-form" role="form" action="" method="post" enctype="multipart/form-data">
					<input type="text" name="act" id="act" hidden/>
					<input type="text" name="id" id="id" hidden/>
					<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="form-group">
								<label for="txtname" class="control-label">ชื่อเมนู</label>
								<input type="text" class="form-control" id="txtname" name="txtname" placeholder="Menu Name" required>
							</div>
							<div class="form-group">
								<label for="txtpart" class="control-label">Part Url (Eng only)</label>
								<input type="text" class="form-control" id="txtpart" name="txtpart" placeholder="Menu Part" required>
							</div>
							<div class="form-group">
								<label for="txticon" class="control-label">Icon fontawesome</label>
								<input type="text" class="form-control" id="txticon" name="txticon" placeholder="Ex : fa fa-user" >
							</div>
							<div class="form-group">
								<label for="txtgroup" class="control-label">เมนูหลัก</label>
								<select class="form-control" name="txtgroup" id="txtgroup">
									<option value="0" selected>เลือกเมนูหลัก</option>

								</select>
							</div>
							<div class="form-group">
								<label for="txttype" class="control-label">ประเภทเมนู</label>
								<select class="form-control" name="txttype" id="txttype">
									<option value="1" selected>เมนูแบบเดี่ยว</option>
									<option value="2">เมนูแบบกลุ่ม</option>

								</select>
							</div>
					</div>

					</div>
					</form>
				</div>

				<div class="modal-footer" style="background-color:#eee;">
					<button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
					<button type="button" id="btnsubmit" class="btn btn-primary">บันทึก</button>
				</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>


<script type="text/javascript">

        $(document).ready(function (e) {
			// ATW
			if ( top.location.href != location.href ) top.location.href = location.href;

			var addData;
			var editData;
			var loadData;
			var editRow;

			var table = $('#data_table').dataTable({
				"aProcessing": true,
				"aServerSide": true,
				"language": {
				  "emptyTable": "No data available in table"
				},
				fixedHeader: true,
				scrollY:        '50vh',
        scrollCollapse: false,
        paging:  false,
				retrieve: true,
				ajax: "<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=loaddata",
				"order": [[0, 'asc']],
				"columns" : [
					{"data" : "line","class":"text-center"},
					{"data" : "menuname"},
					// {"data" : "menugroup","class":"text-center"},
					{"data" : "menutype","class":"text-center hidden-xs"},
					{"data" : "act","class":"text-right"}
				],
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

			$('#addform').on('click',function(e){
				e.preventDefault();


				$('#form-title').text('เพิ่ม เมนู');
				$('#action-form')[0].reset();
				$('#act').val('add');
				// $("#id").val('');
				// $("#txtcode").val('');
				// $("#txtcode").prop('readonly', false);
				// $("#txtname").val('');
				$("#txtgroup").val('');
				$("#txttype").val('');
				$('#form-modal').modal('show');
			});


			$('#btnsubmit').on('click',function(e){
				e.preventDefault();

				if($('#txtname')==""){
					$('#txtname').css('border','1px solid red;');
					$('#txtname').val('กรุณากรอกช่องนี้ด้วยครับ');
				}
				if($('#txtpart')==""){
					$('#txtpart').css('border','1px solid red;');
					$('#txtpart').val('กรุณากรอกช่องนี้ด้วยครับ');
				}

				if($('#txtname')!="" && $('#txtpart')!=''){
					$('#action-form').submit();
				}else{
					return false;
				}

			});


			//$('button[id^="adduser"]').click(function() {
			$("#action-form").on('submit',(function(e){
				e.preventDefault();

				//var pid = $(this).val();
				var act = $("#act").val();
				$.ajax({
					 url: "<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select="+act,
					 type: "post",
					 data:  new FormData(this),
					 contentType: false,
					 cache: false,
					 processData:false,
					 timeout: 3000,
					 dataType: "json",
					 success: function(data) {

						if(data.status=="success"){
							$('#gmail_loading').show();

							toastr.success(data.msg,data.respontext,{timeOut: 5000,closeButton: true});

							$('#action-form')[0].reset();
							$('#form-modal').modal('hide');
							$('#data_table').DataTable().ajax.reload();

						}else{
							toastr.error(data.msg,data.respontext,{timeOut: 5000,closeButton: true});
						}
						$('#gmail_loading').hide();
					 }
				});

			}));


			// $('select[id^="txtcatmain"]').on('focus',function(e){
			// 	$('#txtcatmain').empty();
			//
			// 	var q_url = '<?=$url;?>/<?=$get_part0;?>/?select=loadcat';
			// 	$.ajax({
			// 		url: q_url,
			// 		type: 'get',
			// 		dataType: 'json',
			// 		timeout: 3000,
			// 		success: function(data, textStatus, jqXHR ) {
			//
			// 			$.each(data.datarow, function(index, value){
			// 				//$('#lawdata').append('<option value="' + value.id + '">' + value.name + '</option>');
			// 				$('#txtcatmain').append('<option value="' + value.id + '">' + value.name + '</option>');
			// 			});
			//
			// 		},
			// 		error: function(jqXHR, textStatus, errorThrown) {
			//
			// 		}
			//
			// 	});
			//
			// });


		});


		function laodMenu(){
			$('#txtgroup').empty();

			var q_url = '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>/?select=loadmenu';
			$.ajax({
				url: q_url,
				type: 'get',
				dataType: 'json',
				timeout: 3000,
				success: function(data, textStatus, jqXHR ) {

					$.each(data.datarow, function(index, value){
						$('#txtgroup').append('<option value="' + value.id + '">' + value.name + '</option>');
					});

				},
				error: function(jqXHR, textStatus, errorThrown) {

				}

			});
		}
		laodMenu();



		function editRow(id){
			if ('undefined'!= typeof id) {
			//var id = $(this).val();
			$('#act').val('update');
			$.ajax({
				 type: "get",
				 async: false,
				 url: "<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>",
				 data: {select: 'readdata',id:id},
				 dataType: "json",
				 success: function(data) {
					$('#gmail_loading').show();

					$('#form-modal').modal('show');
					$('#form-title').text('แก้ไขเมนู');

					$("#id").val(data.id);
					$("#txtname").val(data.menuname);
					$("#txtpart").val(data.menupart);
					$("#txticon").val(data.menufa);
					$("#txtgroup").val(data.menumain);
					$("#txttype").val(data.menutype);

					$('#gmail_loading').hide();
				 }
			});
			$('#gmail_loading').hide();
			} else alert('Unknown row id.');
		}

		// Remove row
		function removeRow(id,object) {
			if ( 'undefined' != typeof id) {
				swal({
					title: 'คุณต้องการลบ '+object+' ใช่หรือไม่?',
					text: "รายการเลขที่" + id,
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'ลบรายการนี้',
					cancelButtonText: 'ยกเลิกไม่ลบ!',
					confirmButtonClass: 'confirm-class',
					cancelButtonClass: 'cancel-class',
					closeOnConfirm: false,
					closeOnCancel: false },
					function(isConfirm) {
					if (isConfirm) {
						$('#gmail_loading').show();
						$.ajax({
							 type: "post",
							 async: false,
							 url: "<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>",
							 data: {select: 'del',id:id},
							 dataType: "json",
							 success: function(data) {


								toastr.success(data.msg, data.respontext,{timeOut: 5000,closeButton: true});
								$('#data_table').DataTable().ajax.reload();

								swal(data.respontext,data.msg,'success');

								$('#gmail_loading').hide();

							 }
						});
						$('#gmail_loading').hide();

					}else{
						swal('ยกเลิกแล้ว','ยกเลิกการลบรายการ','error');
					}
				});


			} else alert('Unknown row id.');
		}


</script>
