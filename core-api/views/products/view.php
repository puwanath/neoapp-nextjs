<div id="feature-15-1" class="c-content-feature-15 c-bg-img-center project-cover" style="background-image: url('<?php echo $model->getData('cover',$get_part0);?>')">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-xs-12">

      </div>
      <div class="col-md-6 col-xs-12">
        <div class="c-feature-15-container c-bg-white project-box-shortdetail" style="background-color: rgba(255, 255, 255, 0.7) !important;">
          <h2 class="c-feature-15-title c-font-bold c-font-uppercase c-theme-border"><?php echo $model->getData('name',$get_part0);?></h2>
          <p class="c-feature-15-desc">
            <?php echo $model->getData('shortdetail',$get_part0);?>
          </p>
          <div class="c-center">
            <h1 class="c-font-bold c-font-uppercase project-price"><?php echo $model->getData('price',$get_part0);?></h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="c-content-box c-no-bottom-padding bg-orange-light" style="padding-bottom:50px;" data-scroll="products-detail" id="products-detail">
	<div class="container">
		<div class="col-lg-12 col-sm-12 col-xs-12 c-center pd-x-50">
			<h1 class="h1-project"><?=$word->wordvar('Description');?></h1>
		</div>
    <div class="col-md-8 col-md-offset-2 col-xs-12">
      <p class="c-feature-15-desc">
        <?php echo $model->getData('detail',$get_part0);?>
      </p>
      <div class="row">
        <?php echo $model->getData('description',$get_part0);?>
      </div>
		</div>
	</div>
</div>
<div class="c-content-box c-no-bottom-padding c-bg-white pd-b-50">
	<div class="container">
    <div class="col-md-12 col-xs-12">
      <?php echo $model->getData('facilities',$get_part0);?>
    </div>
	</div>
</div>
<div class="c-content-box c-no-bottom-padding bg-orange-light project-gallery">
  <div class="container">
    <?php echo $model->getData('gallery',$get_part0);?>
  </div>
  <div id="blueimp-gallery" class="blueimp-gallery">
      <div class="slides"></div>
      <h3 class="title"></h3>
      <a class="prev">‹</a>
      <a class="next">›</a>
      <a class="close">×</a>
      <a class="play-pause"></a>
      <ol class="indicator"></ol>
  </div>
</div>
<div class="c-content-box c-no-bottom-padding pd-x-50" data-scroll="products-plan" id="products-plan">
	<div class="container">
		<div class="col-lg-3 col-sm-12 col-xs-12 c-center">
			<h1 class="h1-project"><?=$word->wordvar('House plan');?></h1>
		</div>
    <div class="col-md-9 col-sm-12 col-xs-12 c-center">
        <?php echo $model->getData('plan',$get_part0);?>
		</div>
	</div>
</div>
<div class="c-content-box c-bg-white c-no-bottom-padding pd-x-50" data-scroll="products-location" id="products-location">
	<div class="container">
		<div class="col-lg-12 col-sm-12 col-xs-12">
      <div class="row">
        <!-- <div class="col-lg-6 col-sm-12 col-xs-12 main-contact-info">
          <div class="contact-info-box" style="width:100%;">
            <?php //echo $model->getContactinfo('contact_info');?>
          </div>
        </div> -->
        <div class="col-lg-12 col-sm-12 col-xs-12 c-center">
          <h1 class="h1-contact"><?=$word->wordvar('Where is the project located?');?></h1>
        </div>
      </div>
		</div>
	</div>
  <div class="c-content-box contact-map-box bg-orange" id="location_map">

  </div>
</div>
<div class="c-content-box c-no-bottom-padding box-contact" style="padding-bottom:100px;" data-scroll="appointment" id="appointment">
	<div class="container">
		<div class="col-lg-6 col-sm-5 col-xs-12">
			<div class="promotion-contact-form">
				<h1><?=$word->wordvar('Contact us or visit the project');?></h1>
				<div class="promotion-form">
					<form class="" id="form-promotion-contact">
            <input type="hidden" name="project" value="<?php echo $model->getData('project_cat_id',$get_part0);?>" />
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
				<?php echo $model->getData('cover-img',$get_part0);?>
			</div>
		</div>
	</div>
</div>


<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9_6ATqCVgB1zlz1u-bMGp9Sd6ClfZIjE&callback=initMap">
</script>
<script type="text/javascript">
  $(document).on('ready', function() {
    $(".gallery-center").slick({
      dots: false,
      lazyLoad: 'ondemand',
      infinite: true,
      centerMode: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      setPosition: 'center center',
      responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 3
          }
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 1
          }
        }
      ]
    });


    /*===========================================*/

      /* begin function add data*/
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
          /*
          if($("#contact_email").val()==''){
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

  <?php if($model->getData('project_location_zoom',$get_part0)!=''):?>
  function initMap(){
    var locations = [
      ['<?php echo $model->getData('project_location_name',$get_part0);?>', <?php echo $model->getData('project_location_lat',$get_part0);?>, <?php echo $model->getData('project_location_lon',$get_part0);?>, <?php echo $model->getData('project_location_zoom',$get_part0);?>],
    ];

    var iconBase = '<?=$url;?>/images/';
    var icons = {
      mainpic: {
        icon: iconBase + 'marker.png'
      },
      info: {
        icon: iconBase + 'marker.png'
      }
    };

    var map = new google.maps.Map(document.getElementById('location_map'), {
      zoom: <?php echo $model->getData('project_location_zoom',$get_part0);?>,
      center: new google.maps.LatLng(<?php echo $model->getData('project_location_lat',$get_part0);?>, <?php echo $model->getData('project_location_lon',$get_part0);?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    /*var infowindow = new google.maps.InfoWindow();*/
    var marker, i;

    for (i = 0; i < locations.length; i++) {

      if(i==0){
        var typeicon = 'mainpic';
        var image = {
          url: icons[typeicon].icon,
          /*size: new google.maps.Size(64, 91),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(0, 91)*/
        };
      }else{
        var typeicon = 'info';
        var image = {
          url: icons[typeicon].icon,
          /*size: new google.maps.Size(32, 47),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(0, 47)*/
        };
      }

      var infowindow = new google.maps.InfoWindow({
        content: "<?php echo $model->getData('logo',$get_part0);?>"
      });

      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: image,
        title: locations[i][0],
        zIndex: locations[i][3]
      });

      infowindow.open(map, marker);
    }
  }
  <?php endif;?>
</script>
