<div class="carousel slide" id="carousel-example-captions" data-ride="carousel">
  <?php echo $model->getBannerslide($get_part0);?>
</div>
<div class="c-content-box c-bg-white c-no-bottom-padding">
	<div class="container">
		<div class="col-lg-12 col-sm-12 col-xs-12 c-center pd-x-20">
			<h1 class="h1-promotion"><?=$word->wordvar('This promotion will run out within');?></h1>
		</div>
		<div class="col-lg-12 col-sm-12 col-xs-12">
			<div class="row">
				<?php if(date("Y-m-d")<=$model->getData('end_date_check',$get_part0)):?>
				<div id="getting-started" style="display:none;"></div>
				<div class="col-lg-1 col-sm-1 col-xs-1"></div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-countdown">
					<div class="box-countdown">
						<div id="countdown-week">6</div>
						<div class="fdtext"><?=$word->wordvar('Week');?></div>
					</div>
				</div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-countdown">
					<div class="box-countdown">
						<div id="countdown-day">6</div>
						<div class="fdtext"><?=$word->wordvar('Day');?></div>
					</div>
				</div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-countdown">
					<div class="box-countdown">
						<div id="countdown-hour">6</div>
						<div class="fdtext"><?=$word->wordvar('Hour');?></div>
					</div>
				</div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-countdown">
					<div class="box-countdown">
						<div id="countdown-minute">6</div>
						<div class="fdtext"><?=$word->wordvar('minute');?></div>
					</div>
				</div>
				<div class="col-lg-2 col-sm-2 col-xs-2 col-countdown">
					<div class="box-countdown">
						<div id="countdown-second">6</div>
						<div class="fdtext"><?=$word->wordvar('second');?></div>
					</div>
				</div>
				<div class="col-lg-1 col-sm-1 col-xs-1"></div>
				<?php else:?>
					<div class="col-lg c-center">
						<div class="fdtext"><?=$word->wordvar('Promotion has expired.');?></div>
					</div>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>
<div class="c-content-box c-no-bottom-padding box-contact">
	<div class="container">
		<div class="col-lg-6 col-sm-5 col-xs-12">
			<div class="promotion-contact-form">
				<h1><?=$word->wordvar('Contact us or visit the project');?></h1>
				<div class="promotion-form">
					<form class="" id="form-promotion-contact" >
            <input type="hidden" name="project" value="<?php echo $model->getData('promotion_id',$get_part0);?>" />
            <input type="hidden" name="linkpage" value="<?php echo $uri;?>" />
						<div class="form-group">
							<input type="text" class="form-control promotion-input" name="contact_name" id="contact_name" placeholder="<?=$word->wordvar('Firstname-Lastname');?>" />
              <span id="msg_contact_name" class="text-danger"></span>
						</div>
						<div class="form-group">
							<input type="text" class="form-control promotion-input" name="contact_tel" id="contact_tel" placeholder="<?=$word->wordvar('Contact phone number');?>" />
              <span id="msg_contact_tel" class="text-danger"></span>
						</div>
						<div class="form-group">
							<input type="text" class="form-control promotion-input" name="contact_email" id="contact_email" placeholder="<?=$word->wordvar('Email');?>" />
              <span id="msg_contact_email" class="text-danger"></span>
						</div>
						<div class="form-group">
              <select class="form-control promotion-input" name="contact_time" id="contact_time">
                <option value="" disabled selected>*<?=$word->wordvar('Convenient time to contact');?></option>
								<option value="9.00น.-18.00น.">9.00น.-18.00น.</option>
								<option value="9.00น.-12.00น.">9.00น.-12.00น.</option>
								<option value="12.00น.-18.00น.">12.00น.-18.00น.</option>
              </select>
              <span id="msg_contact_time" class="text-danger"></span>
						</div>
					</form>
					<div>
						<button type="button" id="send-form-promotion" class="btn btn-lg c-btn-orange"><?=$word->wordvar('Send');?></button>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-sm-7 col-xs-12">
			<div class="promotion-img c-center">
				<?php echo $model->getData('imgbig',$get_part0);?>
			</div>
		</div>
	</div>
</div>

<div class="c-content-box c-bg-white c-no-bottom-padding box-contact">
	<div class="container">
		<div class="col-md-8 col-md-offset-2">
			<?php echo $model->getData('projects',$get_part0);?>
		</div>
	</div>
</div>
<div class="c-content-box c-bg-white c-no-bottom-padding box-contact" style="border-top:1px solid #eee;">
	<div class="container">
		<div class="col-md-8 col-md-offset-2" style="padding-top:50px;padding-bottom:80px;">
			<?php echo $model->getData('condition',$get_part0);?>
		</div>
	</div>
</div>


<script type="text/javascript">
	$('#getting-started').countdown('<?php echo $model->getData('end_date_countdown',$get_part0);?>', function(event) {
		$("#countdown-week").html(event.strftime('%w'));
		$("#countdown-day").html(event.strftime('%d'));
		$("#countdown-hour").html(event.strftime('%H'));
		$("#countdown-minute").html(event.strftime('%M'));
		$("#countdown-second").html(event.strftime('%S'));
    /*$(this).html(event.strftime('%w weeks %d days %H:%M:%S'));*/
  });


  $(document).ready(function (e) {

    $("#send-form-promotion").on('click',function(e){
        if($("#contact_name").val()==''){
          $("#contact_name").focus();
          $("#msg_contact_name").text('Please fill out this field too.');
        }else{
          $("#msg_contact_name").text('');
        }
        if($("#contact_tel").val()==''){
          $("#contact_tel").focus();
          $("#msg_contact_tel").text('Please fill out this field too.');
        }else{
          $("#msg_contact_tel").text('');
        }
        /*if($("#contact_email").val()==''){
          $("#contact_email").focus();
          $("#msg_contact_email").text('Please fill out this field too.');
        }else{
          $("#msg_contact_email").text('');
        }*/
        if($("#contact_time").val()==''){
          $("#contact_time").focus();
          $("#msg_contact_time").text('Please fill out this field too.');
        }else{
          $("#msg_contact_time").text('');
        }

        if($("#contact_name").val()=='' || $("#contact_tel").val()=='' || $("#contact_time").val()==''){
          return false;
        }else{
          $("#form-promotion-contact").submit();
        }

    });

    /* begin function add data*/
		$("#form-promotion-contact").on('submit',(function(e){
			e.preventDefault();

			var form = $('#form-promotion-contact')[0];
			$.ajax({
				 url: "<?=$url;?>/register?select=sendregister",
				 type: "post",
				 data:  new FormData(form),
				 contentType: false,
				 cache: false,
				 processData:false,
				 dataType: "json",
				 success: function(data) {

					if(data.status=="success"){

            $('#form-promotion-contact')[0].reset();
            Swal.fire({
              title: "ลงทะเบียนสำเร็จ กรุณาแจ้งรับสิทธิ์ส่วนลดกับฝ่ายขาย",
              text: "เจ้าหน้าที่ฝ่ายขายจะติดต่อท่านตามช่วงเวลาที่ระบุ ขอบคุณค่ะ",
              type: "success",
              timer: 5000
            })
            .then((willDelete) => {
                window.location.href = "<?=$urlredirect_register;?>";
            });

					}else{
						Swal.fire("Register Error!", "Please register again later.!", "error");
					}

				 }
			});

		}));
    /* end form submit*/



  });


</script>
