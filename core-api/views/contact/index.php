<div class="c-content-box c-bg-white c-no-bottom-padding">
	<div class="container">
		<div class="col-lg-12 col-sm-12 col-xs-12 c-center pd-x-50">
			<h1 class="h1-contact"><?=$word->wordvar('Contact or complaint');?></h1>
		</div>
		<div class="col-lg-12 col-sm-12 col-xs-12">
      <div class="row">
        <div class="col-lg-6 col-sm-12 col-xs-12 main-contact-info">
          <div class="contact-info-box">
            <?php echo $model->getContactinfo('contact_info');?>
          </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12 c-center">
          <h1 class="h1-contact"><?=$word->wordvar('Head office location');?></h1>
        </div>
      </div>
		</div>
	</div>
  <div class="c-content-box contact-map-box bg-orange" id="location_map">

  </div>
</div>
<div class="c-content-box c-no-bottom-padding bg-orange-light">
	<div class="container">
		<div class="col-lg-12 col-sm-12 col-xs-12 c-center pd-x-50">
			<h1 class="h1-contact"><?=$word->wordvar('Please fill out the form to contact us');?></h1>
		</div>
		<div class="col-md-8 col-md-offset-2 col-xs-12 contact-form">
      <div class="row">
        <form action="" method="post" enctype="text/plain">
          <div class="col-lg-6 col-sm-6 col-xs-12">
            <div class="form-group">
							<input type="text" class="form-control contact-input" name="contact_name" id="contact_name" placeholder="<?=$word->wordvar('Firstname-Lastname');?>" />
						</div>
          </div>
          <div class="col-lg-6 col-sm-6 col-xs-12">
            <div class="form-group">
							<input type="text" class="form-control contact-input" name="contact_tel" id="contact_tel" placeholder="<?=$word->wordvar('Contact phone number');?>" />
						</div>
          </div>
          <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="form-group">
							<input type="text" class="form-control contact-input" name="contact_subject" id="contact_subject" placeholder="<?=$word->wordvar('What to contact us');?>" />
						</div>
          </div>
          <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="form-group">
              <textarea class="form-control contact-text-input" name="contact_desc" id="contact_desc" placeholder="<?=$word->wordvar('Description');?>"></textarea>
						</div>
          </div>
        </form>
        <div class="col-lg-12 col-sm-12 col-xs-12 c-center">
          <button type="button" id="send-form-promotion" class="btn btn-lg c-btn-orange"><?=$word->wordvar('Send');?></button>
        </div>
      </div>
		</div>
	</div>
</div>


<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9_6ATqCVgB1zlz1u-bMGp9Sd6ClfZIjE&callback=initMap">
</script>
<script type="text/javascript">
      function initMap(){
        var locations = [
          ['<?php echo $model->getContactinfo('contact_location_name');?>', <?php echo $model->getContactinfo('contact_location_lat');?>, <?php echo $model->getContactinfo('contact_location_lon');?>, <?php echo $model->getContactinfo('contact_location_zoom');?>],
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
          zoom: <?php echo $model->getContactinfo('contact_location_zoom');?>,
          center: new google.maps.LatLng(<?php echo $model->getContactinfo('contact_location_lat');?>, <?php echo $model->getContactinfo('contact_location_lon');?>),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();
        var marker, i;

        // for (i = 0; i < locations.length; i++) {

          if(i==0){
            var typeicon = 'mainpic';
            var image = {
              url: icons[typeicon].icon,
              // size: new google.maps.Size(64, 91),
              // origin: new google.maps.Point(0, 0),
              // anchor: new google.maps.Point(0, 91)
            };
          }else{
            var typeicon = 'info';
            var image = {
              url: icons[typeicon].icon,
              // size: new google.maps.Size(32, 47),
              // origin: new google.maps.Point(0, 0),
              // anchor: new google.maps.Point(0, 47)
            };
          }

          marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[0][1], locations[0][2]),
            map: map,
            icon: image,
            // shape: shape,
            title: locations[0][0],
            zIndex: locations[0][3]
          });

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent(locations[0][0]);
              infowindow.open(map, marker);
            }
          })(marker, i));
        // }
      }
</script>
