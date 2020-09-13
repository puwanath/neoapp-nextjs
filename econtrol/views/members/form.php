<div class="br-mainpanel">
  <div class="br-pageheader pd-y-10 pd-md-l-20">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
      <span class="breadcrumb-item active"><?=$pagename;?></span>
    </nav>
  </div><!-- br-pageheader -->

  <!-- <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
    <h5 class="tx-gray-800 mg-b-5"><?//=$pagename;?></h5>
  </div> -->

  <div class="br-pagebody pd-x-20 pd-sm-x-30 mg-b-20">
    <div class="card bd-0 shadow-base pd-0">
			<div class="mg-l-auto hidden-xs-down pd-5 text-right" style="border-bottom:2px solid #333;width:100%;">
        <a href="javascript:;" class="btn btn-success btn-with-icon btnsave">
          <div class="ht-40">
            <span class="icon wd-40"><i class="fa fa-save"></i></span>
            <span class="pd-x-15">SAVE</span>
          </div>
        </a>
				<a href="javascript:history.back();" class="btn btn-secondary mg-l-5"> BACK </a>
	    </div>
			<form role="form" action="#" method="POST" id="action-form" enctype="multipart/form-data">
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 pd-l-0 pd-r-0">
					<div class="panel">
						<div class="panel-body pd-t-0">
              <input type="hidden" name="action" id="action"  value="add"/>
              <div class="form-layout form-layout-2">
                <div class="row no-gutters">
                  <div class="col-md-9 mg-t--1 mg-md-t-0">
                    <div class="row mg-0">
                      <div class="col-md-6 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                        <div class="form-group pd-10-force bd-l-0-force bd-t-0-force">
                          <label class="form-control-label tx-bold mg-t-10">CUSTOMER NAME: <span class="tx-danger">*</span></label>
                          <input type="hidden" name="cust_id" id="cust_id"  />
                          <input class="form-control bggray" type="text" name="cust_name" id="cust_name" value="" placeholder="นายทดสอบ">
                          <span class="text-danger" id="cust_name_msg"></span>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                        <div class="form-group pd-10-force bd-l-0-force  bd-t-0-force">
                          <label class="form-control-label tx-bold mg-t-10">CUSTOMER LASTNAME: </label>
                          <input class="form-control bggray" type="text" name="cust_lastname" id="cust_lastname" placeholder="นามสกุลทดสอบ"/>
                          <span class="text-danger" id="cust_lastname_msg"></span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                        <div class="form-group pd-10-force bd-l-0-force  bd-t-0-force">
                          <label class="form-control-label tx-bold mg-t-10">CUSTOMER NICKNAME: </label>
                          <input class="form-control" type="text" name="cust_nickname" id="cust_nickname" placeholder="Customer Nickname"/>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                        <div class="form-group pd-10-force bd-l-0-force  bd-t-0-force">
                          <label class="form-control-label tx-bold mg-t-10">TELEPHONE: </label>
                          <input class="form-control" type="text" name="cust_phone" id="cust_phone" placeholder="Customer Phone"/>
                          <span class="text-danger" id="cust_phone_msg"></span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                        <div class="form-group pd-10-force bd-l-0-force  bd-t-0-force">
                          <label class="form-control-label tx-bold mg-t-10">EMAIl: </label>
                          <input class="form-control" type="text" name="cust_email" id="cust_email" placeholder="Customer Email"/>
                          <span class="text-danger" id="cust_email_msg"></span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                        <div class="form-group pd-10-force bd-l-0-force  bd-t-0-force">
                          <label class="form-control-label tx-bold mg-t-10">COUNTRIES: </label>
                          <select class="form-control select2-show-search" name="cust_countries" id="cust_countries" data-placeholder="select Countries">
                            <option value="">select Countries</option>
                            <?php echo $model->selectCountries();?>
                          </select>
                          <span class="text-danger" id="cust_countries_msg"></span>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                        <div class="form-group pd-10-force bd-l-0-force  bd-t-0-force">
                          <label class="form-control-label tx-bold mg-t-10">NATIONALITY: </label>
                          <input class="form-control" type="text" name="nationality" id="nationality" placeholder="Nationaliity" readonly/>
                        </div>
                      </div>
                      <div class="col-md-4 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                        <div class="form-group pd-10-force bd-l-0-force  bd-t-0-force">
                          <label class="form-control-label tx-bold mg-t-10">GENDER: </label>
                          <select class="form-control" name="cust_gender" id="cust_gender" data-placeholder="select Gender">
                            <option value="">select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                          <span class="text-danger" id="cust_gender_msg"></span>
                        </div>
                      </div>

                    </div>
                  </div><!-- col-8 -->
                  <div class="col-md-3 mg-t--1 mg-md-t-0">
                    <div class="row mg-0">
                      <div class="col-md-12 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                        <div class="form-group pd-10-force bd-t-0-force">
                          <label class="form-control-label tx-bold mg-t-10">TRANSECTION ID: </label>
                          <input class="form-control bggray" type="text" name="trn_id" id="trn_id" readonly/>
                        </div>
                      </div>
                      <div class="col-md-12 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                        <div class="form-group pd-10-force bd-t-0-force">
                          <label class="form-control-label tx-bold mg-t-10">TRANSECTION DATE: </label>
                          <input class="form-control fc-datepicker bggray" type="text" name="trn_date" id="trn_date" value="<?=date("d/m/Y");?>"/>
                        </div>
                      </div>
                      <div class="col-md-12 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                        <div class="form-group pd-10-force bd-l-0-force  bd-t-0-force">
                          <label class="form-control-label tx-bold mg-t-10">CONTACT TYPE: </label>
                          <select class="form-control" name="ct_id" id="ct_id" data-placeholder="select contact type">
                            <option value="">select contact type</option>
                            <?php echo $model->selectContacttype();?>
                          </select>
                          <span class="text-danger" id="ct_id_msg"></span>
                        </div>
                      </div>

                    </div>
                  </div><!-- col-4 -->

                </div><!-- row -->
                <div class="row mg-0" style="border-top:2px solid #333;">
                  <div class="col-md-3 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                    <div class="form-group pd-10-force bd-l-0-force  bd-t-0-force">
                      <label class="form-control-label tx-bold mg-t-10">BUDGET: </label>
                      <select class="form-control" name="budget_id" id="budget_id" data-placeholder="select budget">
                        <option value="">select budget</option>
                        <?php echo $model->selectBudget();?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                    <div class="form-group pd-10-force bd-l-0-force  bd-t-0-force">
                      <label class="form-control-label tx-bold mg-t-10">PROJECTS: </label>
                      <select class="form-control" name="project_id" id="project_id" data-placeholder="select project">
                        <option value="">select project</option>
                        <?php echo $model->selectProject();?>
                      </select>
                      <span class="text-danger" id="project_id_msg"></span>
                    </div>
                  </div>
                  <div class="col-md-3 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                    <div class="form-group pd-10-force bd-l-0-force  bd-t-0-force">
                      <label class="form-control-label tx-bold mg-t-10">UNIT TYPE: </label>
                      <select class="form-control" name="unittype_id" id="unittype_id" data-placeholder="select unit type">
                        <option value="">select unit type</option>
                        <?php echo $model->selectUnittype();?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                    <div class="form-group pd-10-force bd-l-0-force  bd-t-0-force">
                      <label class="form-control-label tx-bold mg-t-10">PURPOSE: </label>
                      <select class="form-control" name="pp_id" id="pp_id" data-placeholder="select purpose">
                        <option value="">select purpose</option>
                        <?php echo $model->selectPurpose();?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                    <div class="form-group pd-10-force bd-l-0-force bd-t-0-force">
                      <label class="form-control-label tx-bold mg-t-10">SOURCES: <span class="tx-danger">*</span></label>
                      <input type="hidden" name="so_id" id="so_id"  />
                      <input class="form-control bggray" type="text" name="so_name" id="so_name" value="" placeholder="EX : facebook">
                      <div id="display_sources"></div>
                      <span id="so_name_msg" class="text-danger"></span>
                      <span class="text-danger" id="so_name_msg"></span>
                    </div>
                  </div>
                  <div class="col-md-3 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                    <div class="form-group pd-10-force bd-l-0-force  bd-t-0-force">
                      <label class="form-control-label tx-bold mg-t-10">DECISION: </label>
                      <select class="form-control" name="is_decision" id="is_decision" data-placeholder="select decision">
                        <option value="">select decision</option>
                        <option value="1">Decide to buy</option>
                        <option value="2">Under consideration</option>
                        <option value="0">Not yet decided to buy</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                    <div class="form-group pd-10-force bd-l-0-force bd-t-0-force">
                      <label class="form-control-label tx-bold mg-t-10">Reason to Buy: <span class="tx-danger">*</span></label>
                      <input type="hidden" name="rtb_id" id="rtb_id"  />
                      <input class="form-control bggray" type="text" name="rtb_desc" id="rtb_desc" value="" placeholder="">
                      <div id="display_rtb"></div>
                      <span id="rtb_desc_msg" class="text-danger"></span>
                      <span class="text-danger" id="rtb_desc_msg"></span>
                    </div>
                  </div>
                  <div class="col-md-3 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                    <div class="form-group pd-10-force bd-l-0-force bd-t-0-force">
                      <label class="form-control-label tx-bold mg-t-10">Reason Not to Buy: <span class="tx-danger">*</span></label>
                      <input type="hidden" name="rntb_id" id="rntb_id"  />
                      <input class="form-control bggray" type="text" name="rntb_desc" id="rntb_desc" value="" placeholder="">
                      <div id="display_rntb"></div>
                      <span id="rntb_desc_msg" class="text-danger"></span>
                      <span class="text-danger" id="rntb_desc_msg"></span>
                    </div>
                  </div>
                </div>
                <div class="row mg-0" style="border-top:2px solid #333;">
                  <div class="col-md-9 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                    <div class="form-group pd-10-force bd-l-0-force  bd-t-0-force">
                      <label class="form-control-label tx-bold mg-t-10">DETAIL: </label>
                      <textarea class="form-control" id="trn_remark" name="trn_remark" style="line-height: 22px !important;height: 85% !important;"></textarea>
                    </div>
                  </div>
                  <div class="col-md-3 mg-t--1 mg-md-t-0 pd-0">
                    <div class="row mg-0">
                      <div class="col-md-12 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                        <div class="form-group pd-10-force bd-t-0-force">
                          <label class="form-control-label tx-bold mg-t-10">SELLERS (NEGO): </label>
                          <select class="form-control select2-show-search" name="sell_id" id="sell_id" data-placeholder="select Nego">
                            <option value="">select nego</option>
                            <?php echo $model->selectSellers();?>
                          </select>
                          <span class="text-danger" id="sell_id_msg"></span>
                        </div>
                      </div>
                      <div class="col-md-12 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                        <div class="form-group pd-10-force bd-t-0-force">
                          <label class="form-control-label tx-bold mg-t-10">UPDATE: </label>
                          <input class="form-control bggray" type="text" name="dateupdate" id="dateupdate" readonly/>
                        </div>
                      </div>
                      <div class="col-md-12 col-xs-12 mg-t--1 mg-md-t-0 pd-0">
                        <div class="form-group pd-10-force bd-t-0-force">
                          <label class="form-control-label tx-bold mg-t-10">CREATOR: </label>
                          <input class="form-control bggray" type="text" name="creator" id="creator" readonly/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


						</div>
					</div>
				</div>
			</form>
			<div class="hidden-md-up pd-10 bg-gray-600">
        <a href="javascript:;" class="btn btn-primary btn-with-icon btnsave">
          <div class="ht-40">
            <span class="icon wd-40"><i class="fa fa-save"></i></span>
            <span class="pd-x-15">SAVE</span>
          </div>
        </a>
				<a href="javascript:history.back();" class="btn btn-secondary mg-l-5"> BACK </a>
	    </div>
    </div>
  </div><!-- br-pagebody -->
</div><!-- br-contentpanel -->

<style type="text/css">

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
  #display_sources
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
  #display_rntb
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
  #display_rtb
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
    padding: 5px;
    border-top: solid 1px #dedede;
    font-size: 12px;
    height: 30px;
    color: #fff;
    /*position: absolute;*/
    background-color: #000;
    /*width: 100%;*/
    /*display: flex;*/
    /*z-index: 99;*/
  }
  .display_box:hover
  {
  	background-color:#333;
  	color:#FFFFFF;
  }
  .bggray{
    background-color: #eee !important;
    padding-left: 10px !important;
  }
</style>

<script type="text/javascript">

	$(document).ready(function(e){
		if ( top.location.href != location.href ) top.location.href = location.href;

    window.onbeforeunload = function(event) {
        event.preventDefault();
        // outofPage();
        // return;
        return 'Dialog text here.';
    };

    // window.onbeforeunload = outofPage;

    // $(window).bind('beforeunload', function(){
    //   outofPage();
    // });

    // Datepicker
    $('.fc-datepicker').datepicker({
      showOtherMonths: true,
      selectOtherMonths: true,
      dateFormat: 'dd/mm/yy'
    });

    $("#cust_name").keyup(function(){
      var searchbox = $(this).val();
      var datastring = 'searchword='+searchbox;

      if(searchbox==''){
        $("#display").hide();
        return false;
      }else{
        $.ajax({
          type: "post",
          url: "<?=$url;?>/<?=$get_part0;?>?select=loadcustomers",
          data: datastring,
          cache: false,
          success: function(html){

            $("#display").html(html).show();
            if(html=='')
            $("#cust_id").val('');
          }
        });
      }
    });

    $("#so_name").keyup(function(){
      var searchbox = $(this).val();
      var datastring = 'searchword='+searchbox;

      if(searchbox==''){
        $("#display_sources").hide();
        return false;
      }else{
        $.ajax({
          type: "post",
          url: "<?=$url;?>/<?=$get_part0;?>?select=loadsources",
          data: datastring,
          cache: false,
          success: function(html){

            $("#display_sources").html(html).show();
            if(html=='')
            $("#so_id").val('');
          }
        });
      }
    });

    $("#rntb_desc").keyup(function(){
      var searchbox = $(this).val();
      var datastring = 'searchword='+searchbox;

      if(searchbox==''){
        $("#display_rntb").hide();
        return false;
      }else{
        $.ajax({
          type: "post",
          url: "<?=$url;?>/<?=$get_part0;?>?select=loadrntb",
          data: datastring,
          cache: false,
          success: function(html){

            $("#display_rntb").html(html).show();
            if(html=='')
            $("#rntb_id").val('');
          }
        });
      }
    });

    $("#rtb_desc").keyup(function(){
      var searchbox = $(this).val();
      var datastring = 'searchword='+searchbox;

      if(searchbox==''){
        $("#display_rtb").hide();
        return false;
      }else{
        $.ajax({
          type: "post",
          url: "<?=$url;?>/<?=$get_part0;?>?select=loadrtb",
          data: datastring,
          cache: false,
          success: function(html){

            $("#display_rtb").html(html).show();
            if(html=='')
            $("#rtb_id").val('');
          }
        });
      }
    });

    $("#cust_countries").on('change',function(){
        var num_code = $(this).val();
        var datastring = 'id='+num_code;

        $.ajax({
          type: "post",
          url: "<?=$url;?>/<?=$get_part0;?>?select=loaddatacountries",
          data: datastring,
          cache: false,
          success: function(html){
            $("#nationality").val(html);
          }
        });
    });


    /*===================================================*/
		$(".btnsave").on('click',function(e){
			e.preventDefault();

      if($("#cust_name").val()==''){
        $("#cust_name").focus();
        $("#cust_name_msg").text('Please fill in this field too.!');
      }else{
        $("#cust_name_msg").text('');
      }
      if($("#cust_lastname").val()==''){
        $("#cust_lastname").focus();
        $("#cust_lastname_msg").text('Please fill in this field too.!');
      }else{
        $("#cust_lastname_msg").text('');
      }
      if($("#cust_phone").val()==''){
        $("#cust_phone").focus();
        $("#cust_phone_msg").text('Please fill in this field too.!');
      }else{
        $("#cust_phone_msg").text('');
      }
      if($("#cust_email").val()==''){
        $("#cust_email").focus();
        $("#cust_email_msg").text('Please fill in this field too.!');
      }else{
        $("#cust_email_msg").text('');
      }
      if($("#cust_countries").val()==''){
        $("#cust_countries").focus();
        $("#cust_countries_msg").text('Please fill in this field too.!');
      }else{
        $("#cust_countries_msg").text('');
      }
      if($("#cust_gender").val()==''){
        $("#cust_gender").focus();
        $("#cust_gender_msg").text('Please fill in this field too.!');
      }else{
        $("#cust_gender_msg").text('');
      }
      if($("#sell_id").val()==''){
        $("#sell_id").focus();
        $("#sell_id_msg").text('Please fill in this field too.!');
      }else{
        $("#sell_id_msg").text('');
      }
      if($("#ct_id").val()==''){
        $("#ct_id").focus();
        $("#ct_id_msg").text('Please fill in this field too.!');
      }else{
        $("#ct_id_msg").text('');
      }
      if($("#project_id").val()==''){
        $("#project_id").focus();
        $("#project_id_msg").text('Please fill in this field too.!');
      }else{
        $("#project_id_msg").text('');
      }

      if($("#cust_name").val() != '' && $("#cust_lastname").val() != '' && $("#cust_phone").val() != '' && $("#cust_email").val() != '' && $("#cust_countries").val() != '' && $("#cust_gender").val() != '' && $("#sell_id").val() != '' && $("#ct_id").val() != '' && $("#project_id").val() != ''){
        $("#action-form").submit();
      }else{
        return false;
      }
		});


		$("#action-form").on('submit',(function(e){
			e.preventDefault();

			$('#gmail_loading').show();
			$.ajax({
				 url: "<?=$url;?>/<?=$get_part0;?>?select="+$("#action").val(),
				 type: "post",
				 data:  new FormData(this),
				 contentType: false,
				 cache: false,
				 processData:false,
				 dataType: "json",
				 success: function(data) {

					if(data.status=="success"){
            $("#action-form")[0].reset();
						toastr.success(data.msg, 'Create Data Success!',{timeOut: 5000,closeButton: true});
            $('#trn_id').val(data.id);
            loadData();
            $(window).unbind("beforeunload");
					}else{
						toastr.error(data.msg, 'Create Data Error!',{timeOut: 5000,closeButton: true});
					}
				 }
			});
			$('#gmail_loading').hide();
		}));

	});


	//load data
  //get function edit
  <?php if($get_part1=='edit'){?>
    window.onload = function(){
      $('#trn_id').val('<?=$get_part2;?>');
      loadData();
    };
  <?php }else{?>

  <?php } ?>

  function outofPage(){

    if($("input[type=text]").val()!=''){

      swal({
        title: 'คุณต้องการบันทึกข้อมูล ก่อนออกจากหน้านี้หรือไม่?',
        text: "หากไม่ต้องการบันทึกสามารถกดที่ปุ่มไม่บันทึกได้เลย!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'บันทึก! แล้วออกจากหน้า',
        cancelButtonText: 'ไม่บันทึก! แล้วออกจากหน้า',
        confirmButtonClass: 'confirm-class',
        cancelButtonClass: 'cancel-class',
        closeOnConfirm: true,
        closeOnCancel: true },
        function(isConfirm) {
          if (isConfirm) {
            $("#action-form").submit();
            window.location.href = '<?=$url;?>/visit-transections';
          }else{
            window.location.href = '<?=$url;?>/visit-transections';
          }
      });
      // return false;

    }else{
      window.location.href = '<?=$url;?>/visit-transections';
    }
    $('#gmail_loading').hide();

  }


	function loadData(){
		$('#gmail_loading').show();
    var trn_id = $('#trn_id').val();
		$.ajax({
			 type: "get",
			 timeout: 3000,
			 url: "<?=$url;?>/<?=$get_part0;?>",
			 data: {select: 'loaddataedit',id:trn_id},
			 dataType: "json",
			 success: function(data) {
         $("#action").val('edit');

         $("#cust_id").val(data.cust_id);
         $("#cust_name").val(data.cust_name);
         $("#cust_lastname").val(data.cust_lastname);
         $("#cust_nickname").val(data.cust_nickname);
         $("#cust_email").val(data.cust_email);
         $("#cust_phone").val(data.cust_phone);
         $("#cust_countries").select2().val(data.cust_countries).trigger("change");
         $("#nationality").val(data.nationality);
         $("#cust_gender").val(data.cust_gender);
         $("#trn_id").val(data.trn_id);
         $("#trn_date").val(data.trn_date);
         $("#sell_id").select2().val(data.sell_id).trigger("change");
         $("#ct_id").val(data.ct_id);
         $("#budget_id").val(data.budget_id);
         $("#project_id").val(data.project_id);
         $("#unittype_id").val(data.unittype_id);
         $("#pp_id").val(data.pp_id);
         $("#so_id").val(data.so_id);
         $("#so_name").val(data.so_name);
         $("#is_decision").val(data.is_decision);
         $("#rntb_id").val(data.rntb_id);
         $("#rntb_desc").val(data.rntb_desc);
         $("#rtb_id").val(data.rtb_id);
         $("#rtb_desc").val(data.rtb_desc);
         $("#trn_remark").val(data.trn_remark);

         $("#dateupdate").val(data.dateupdate);
         $("#creator").val(data.creator);

        $('#gmail_loading').hide();
			 }
		});
	};

  /*===============================================*/
  // fill puth data from renter_name search
  function fill(cust_id,cust_name,cust_lastname,cust_nickname,cust_email,cust_phone,cust_gender,cust_countries,nationality){
    $("#cust_id").val(cust_id);
    $("#cust_name").val(cust_name);
    $("#cust_lastname").val(cust_lastname);
    $("#cust_nickname").val(cust_nickname);
    $("#cust_email").val(cust_email);
    $("#cust_phone").val(cust_phone);
    $("#cust_gender").val(cust_gender);
    $("#cust_countries").select2().val(cust_countries).trigger("change");
    $("#nationality").val(nationality);

    $("#display").hide();
  }
  function fill_sources(so_id,so_name){
    $("#so_id").val(so_id);
    $("#so_name").val(so_name);

    $("#display_sources").hide();
  }
  function fill_rntb(rntb_id,rntb_desc){
    $("#rntb_id").val(rntb_id);
    $("#rntb_desc").val(rntb_desc);

    $("#display_rntb").hide();
  }
  function fill_rtb(rtb_id,rtb_desc){
    $("#rtb_id").val(rtb_id);
    $("#rtb_desc").val(rtb_desc);

    $("#display_rtb").hide();
  }

  // add commas to currency
  function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
  }


	</script>
