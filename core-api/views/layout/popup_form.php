
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pop-register">
  Launch demo modal
</button> -->
<!-- Modal -->
<div class="modal fade" id="pop-register" tabindex="-1"  role="dialog" >
    <div class="modal-dialog" style="background-image:url('<?=getPopup('bg');?>');">
        <div class="modal-content c-square" style="background-color: transparent;border-radius: 0;border: 0px;">
            <div class="modal-header c-no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <div class="popup-header">
                <h3><?=getPopup('name');?></h3>
                <h4><?=getPopup('desc');?></h4>
              </div>
              <div class="popup-form">
      					<div class="row">
                  <div class="col-lg col-md-10 col-md-offset-1">
                    <form id="form-register" name="form-register" >
                      <input type="hidden" name="project" id="project" value="<?php echo $model->getData('project_cat_id',$get_part0);?>"/>
          						<div class="form-group">
          							<input class="form-control promotion-input" id="cust_name" type="text" name="contact_name" placeholder="*<?=$word->wordvar('Firstname-Lastname');?>">
          							<span id="err_cust_name" style="color:red;text-align:left;display: block;width: 100%;"></span>
          						</div>
          						<div class="form-group">
          							<input class="form-control promotion-input" id="cust_tel" type="text" name="contact_tel" placeholder="*<?=$word->wordvar('Contact phone number');?>">
          							<span id="err_cust_tel" style="color:red;text-align:left;display: block;width: 100%;"></span>
          						</div>
          						<div class="form-group">
          							<input class="form-control promotion-input" id="cust_email" type="text" name="contact_email" placeholder="*<?=$word->wordvar('Email');?>">
          							<span id="err_cust_email" style="color:red;text-align:left;display: block;width: 100%;"></span>
          						</div>
          						<div class="form-group">
          							<select class="form-control promotion-input" id="budget" name="budget">
          								<option value="" disabled selected>*งบประมาณในการซื้อ</option>
          								<option value="1.5-2 ล้านบาท">1.5-2 ล้านบาท</option>
          								<option value="2-2.5 ล้านบาท">2-2.5 ล้านบาท</option>
          								<option value="2.5-3 ล้านบาท">2.5-3 ล้านบาท</option>
          								<option value="3-3.5 ล้านบาท">3-3.5 ล้านบาท</option>
          								<option value="4-4.5 ล้านบาท">4-4.5 ล้านบาท</option>
          								<option value="4.5-5 ล้านบาท">4.5-5 ล้านบาท</option>
          								<option value="5-6 ล้านบาท">5-6 ล้านบาท</option>
          								<option value=">7 ล้านบาท">&gt;7 ล้านบาท</option>
          							</select>
          							<span id="err_budget" style="color:red;text-align:left;display: block;width: 100%;"></span>
          						</div>
          						<div class="form-group">
          							<select class="form-control promotion-input" id="time_to_contact" name="contact_time">
          								<option value="" disabled selected>*เวลาที่สะดวกให้ติดต่อ</option>
          								<option value="9.00น.-18.00น.">9.00น.-18.00น.</option>
          								<option value="9.00น.-12.00น.">9.00น.-12.00น.</option>
          								<option value="12.00น.-18.00น.">12.00น.-18.00น.</option>
          							</select>
          							<span id="err_time_to_contact" style="color:red;text-align:left;display: block;width: 100%;"></span>
          						</div>
          					</form>
                  </div>
                </div>
      				</div>
            </div>
            <div class="modal-footer c-no-border" style="text-align:center;">
              <button type="button" class="btn c-btn-light-1 btn c-btn-uppercase c-btn-bold c-btn-slim c-btn-border-2x c-btn-square c-btn-signup btn-register" id="sendform"><?=$word->wordvar('Register');?></button>
            </div>
        </div>
    </div>
</div>

<!-- <script type="text/javascript" src="<?=$dir;?>popup/jquery.cookie.js"></script> -->
<script type="text/javascript">
  $(document).ready(function () {
	<?php if(getPopup('cookie_status')==1):?>
    console.log(Cookies.get('<?php echo $get_part0;?>'));
    if(Cookies.get('register_success')==null || Cookies.get('register_success')==undefined){
      if (Cookies.get('<?php echo $get_part0;?>')==null || Cookies.get('<?php echo $get_part0;?>')==undefined) {
        $('#pop-register').modal('show');
        ExpireCookie(<?=getPopup('cookie_time');?>);
      }
    }


	<?php else:?>
	  $('#pop-register').modal('show');
	<?php endif;?>

    function ExpireCookie(minutes) {
     var date = new Date();
     var m = minutes;
     date.setTime(date.getTime() + (m * 60 * 1000));
     var path = "<?php echo $_SERVER["REQUEST_URI"];?>";
     Cookies.set("<?php echo $get_part0;?>", "<?php echo $get_part0;?>", { expires: date });
    }


    function ExpireCookie_resuccess(minutes) {
     var date = new Date();
     var m = minutes;
     date.setTime(date.getTime() + (m * 60 * 1000));
     var path = "<?php echo $_SERVER["REQUEST_URI"];?>";
     Cookies.set("register_success", "register_success", { expires: date });
    }

    $('.nav-register').on('click',function(e){
        $('#pop-register').modal('show');
      e.preventDefault();
    })


  	/* ================begin popup form ========================*/
  	$("#sendform").on('click',function(e){

  		if($("#cust_name").val()==''){
  			$('#cust_name').css('border','1px solid red');
  			$('#err_cust_name').text('*Please fill in this field.');
  		}else{
  			$('#cust_name').css('border','1px solid orange');
  			$('#err_cust_name').text('');
  		}

  		if($("#cust_tel").val()==''){
  			$('#cust_tel').css('border','1px solid red');
  			$('#err_cust_tel').text('*Please fill in this field.');
  		}else{
  			$('#cust_tel').css('border','1px solid orange');
  			$('#err_cust_tel').text('');
  		}
      /*
  		if($("#cust_email").val()==''){
  			$('#cust_email').css('border','1px solid red');
  			$('#err_cust_email').text('*Please fill in this field.');
  		}else{
  			$('#cust_email').css('border','1px solid orange');
  			$('#err_cust_email').text('');
  		}
      */
  		if($('#cust_name').val()!='' && $('#cust_tel').val()!=''){
  			$('#form-register').submit();
  		}else{
  			return false;
  		}

  		e.preventDefault();
  	});


  	$("#form-register").on('submit',(function(e){
  		e.preventDefault();
  		$.ajax({
  		  url: "<?=$url;?>/register?select=sendregister",
  		  type: "POST",
  		  data:  new FormData(this),
  		  contentType: false,
  		  cache: false,
  		  processData:false,
  		  timeout: 3000,
  		  dataType: "json",
  		  success: function(data){

  			if(data.status=="success"){
  				$('#pop-register').modal('hide');
  				$('#form-register')[0].reset();

          Swal.fire({
            title: "ลงทะเบียนสำเร็จ กรุณาแจ้งรับสิทธิ์ส่วนลดกับฝ่ายขาย",
            text: "เจ้าหน้าที่ฝ่ายขายจะติดต่อท่านตามช่วงเวลาที่ระบุ ขอบคุณค่ะ",
            icon: "success",
            timer: 3000,
          })
          .then((willDelete) => {
              window.location.href = "<?=$urlredirect_register;?>";
          });
          ExpireCookie_resuccess(600000);
  			}else{
  				Swal.fire("Register Error!", "Please register again later.!", "error");
  			}

  		  },
  		  error: function(){}
  		});
  	}));

  });

</script>
