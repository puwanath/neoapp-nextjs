<div class="br-mainpanel">
  <div class="br-pageheader pd-y-5 pd-x-5 pd-md-l-10">
    <nav class="breadcrumb pd-0 mg-0 tx-14">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
      <span class="breadcrumb-item active"><?=$pagename;?></span>
    </nav>
  </div><!-- br-pageheader -->

  <div class="br-pagebody pd-x-5 pd-sm-x-10 mg-b-10">
    <div class="card bd-0 shadow-base pd-0">
      <div class="row pd-y-5 mg-x-0-force" style="border-bottom:2px solid #333;">
        <div class="col-md-6 col-xs-6 pd-x-5">
          <h5 class="panel-title mg-b-0-force" style="line-height: 1.5;" ><?=$pagename;?></h5>
        </div>
        <div class="col-md-6 col-xs-6 text-right pd-x-5">
          <a href="javascript:;" class="btnsave btn btn-info btn-sm"> บันทึกแก้ไข </a>
  				<a href="javascript:history.back();" class="btn btn-secondary btn-sm mg-l-5"> ย้อนกลับ </a>
        </div>
      </div>
      <div class="row mg-0-force">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pd-l-0 pd-r-0 bd bd-t">
          <form role="form" action="#" method="POST" id="action-form" enctype="multipart/form-data">
    				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
    					<div class="panel">
    						<div class="panel-body">
    							<div class="row">
    								<div class="col-lg-10 col-sm-9 col-xs-12 bg-gray-100  pd-t-20">
    									<div class="row">
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">ชื่อร้านค้า/บริษัท (TH)</label>
    												<input type="text" name="contact_name_th" id="contact_name_th" class="form-control" />
    												<span style="color:red;" id="err_contact_name_th"></span>
    											</div>
    										</div>
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">ชื่อร้านค้า/บริษัท (EN)</label>
    												<input type="text" name="contact_name_en" id="contact_name_en" class="form-control" />
    												<span style="color:red;" id="err_contact_name_en"></span>
    											</div>
    										</div>
    									</div>
    									<div class="row">
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">ที่อยู่ (TH)</label>
                            <textarea class="form-control" id="contact_address_th" name="contact_address_th"></textarea>
    											</div>
    										</div>
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">ที่อยู่ (TH)</label>
    												<textarea class="form-control" id="contact_address_en" name="contact_address_en"></textarea>
    											</div>
    										</div>
    									</div>
    									<div class="row">
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">โทรศัพท์ (TH)</label>
    												<input type="text" name="contact_tel_th" id="contact_tel_th" class="form-control" />
    											</div>
    										</div>
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">โทรศัพท์ (EN)</label>
    												<input type="text" name="contact_tel_en" id="contact_tel_en" class="form-control" />
    											</div>
    										</div>
    									</div>
    									<div class="row">
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">Email</label>
    												<input type="text" name="contact_email" id="contact_email" class="form-control" />
    											</div>
    										</div>
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">Line</label>
    												<input type="text" name="contact_lineid" id="contact_lineid" class="form-control" />
    											</div>
    										</div>
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">Facebook</label>
    												<input type="text" name="contact_facebook" id="contact_facebook" class="form-control" />
    											</div>
    										</div>
    									</div>
    									<div class="row">
    										<div class="col-lg">
    											<div class="form-group">
    												<label class="control-label">Email (สำหรับรับ Email จาก Contact Form)</label>
    												<input type="text" name="contact_receive_mail" id="contact_receive_mail" class="form-control" />
                            <span style="color:red;" id="err_contact_receive_mail"></span>
    											</div>
    										</div>

    									</div>

                      <div class="row" style="border-top:2px solid #333;">
                        <div class="col-lg">
                          <div class="form-group pd-t-10-force">
                            <div class="row">
                                <div class="col-md-4 mg-md-t-0">
                                  <label class="form-control-label tx-bold">Google Map</label>
                                </div>
                                <div class="col-md-8 text-right mg-md-t-0">
                                  <div class="input-group">
                        						<input type="text" class="form-control" name="namePlace" id="namePlace" placeholder="ค้นหาสถานที่..." style="border: 1px solid #17a2b8;padding-left: 10px;">
                        						<span class="input-group-btn">
                        						  <button type="button" class="btn btn-info btn-flat" name="SearchPlace" id="SearchPlace">ค้นหา!</button>
                        						</span>
                        					</div>
                                </div>
                            </div>
                            <div class="row mg-md-t-10">
                              <div class="col-lg">
                                <div id="map_canvas"></div>
                    						<input name="lat_value" type="hidden" id="lat_value" value="" size="17" />
                    						<input name="lon_value" type="hidden" id="lon_value" value="" size="17" />
                    						<input name="zoom_value" type="hidden" id="zoom_value" value="" size="5" />
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-lg">
                          <div class="form-group">
                            <label class="control-label">Photomap</label>
                            <div class="d-flex bg-gray-200 ht-250 pos-relative align-items-center imglogo" id="photomap">
                              <!-- canvas logo econtrol -->
                            </div>
                            <div>
                              <span class="label label-danger">NOTE! </span>
      											  <span style="color:red;"> รูปแผนที่ ควรมีขนาดไม่เกิน 800x600px</span>
                            </div>
                          </div>
                        </div>

                      </div>
    								</div>
    								<div class="col-lg-2 col-sm-3 col-xs-12 bg-gray-300 pd-t-20">
    									<div class="form-group">
    										<label class="control-label">วันที่อัพเดทข้อมูล</label>
    										<input type="text" name="txtupdatedate" id="txtupdatedate" class="form-control" disabled/>
    									</div>

    								</div>
    							</div>


    						</div>
    					</div>
    				</div>

    			</form>
          <form name="frmupload_photomap" action="" id="fle-form" enctype="multipart/form-data">
            <input type="file" name="fle" id="fle" style="display:none;">
          </form>
        </div>
      </div>
			<div class="hidden-md-up pd-10 bg-gray-600">
				<a href="javascript:;" class="btnsave btn btn-info"> บันทึกแก้ไข </a>
				<a href="javascript:history.back();" class="btn btn-secondary mg-l-5"> ย้อนกลับ </a>
	    </div>
    </div>
  </div><!-- br-pagebody -->
</div><!-- br-contentpanel -->


<style type="text/css">

  /* css กำหนดความกว้าง ความสูงของแผนที่ */
  #map_canvas {
    width:100%;
    height:300px;
    margin:auto;
  	margin-top:10px;
  }
  #display
  {
  	width:100%;
  	display:none;
  	background-color:#FFF;
  	border-left:solid 1px #dedede;
  	border-right:solid 1px #dedede;
  	border-bottom:solid 1px #dedede;
  	overflow:hidden;
  }
  .display_box
  {
  	padding:4px;
  	border-top:solid 1px #dedede;
  	font-size:12px;
  	height:30px;
  	color:#000;

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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuSCYUQ9Fda4-WjtinctOwxHk34IE2zEI&callback=initialize"  defer></script>
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

    // upload image
    $('#fle').change(function(){
      $('#fle-form').submit();
    });


    $("#fle-form").on('submit',(function(e){
      e.preventDefault();
      $.ajax({
        url: "<?=$url;?>/<?=$get_part0;?>?select=uploadimg-photomap",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType: "json",
        success: function(data){

          if(data.status=="success"){
            toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
            loadData();
          }else{
            toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
          }

        },
        error: function(){}
      });
    }));

    // end upload image

    //begin function
  	$('#btnsubmit').on('click',function(e){
  		e.preventDefault();

  			if($("#contact_name_th").val()==''){
  				$("#contact_name_th").css('border','1px solid red');
  				$("#err_contact_name_th").text('กรุณากรอกช่องนี้ด้วยครับ!');
  			}else{
  				$("#contact_name_th").css('border','1px solid green');
  				$("#err_contact_name_th").text('');
  			}
  			if($("#contact_name_en").val()==''){
  				$("#contact_name_en").css('border','1px solid red');
  				$("#err_contact_name_en").text('กรุณากรอกช่องนี้ด้วยครับ!');
  			}else{
  				$("#contact_name_en").css('border','1px solid green');
  				$("#err_contact_name_en").text('');
  			}
  			if($("#contact_receive_mail").val()==''){
  				$("#contact_receive_mail").css('border','1px solid red');
  				$("#err_contact_receive_mail").text('กรุณากรอกช่องนี้ด้วยครับ!');
  			}else{
  				$("#contact_receive_mail").css('border','1px solid green');
  				$("#err_contact_receive_mail").text('');
  			}


  			if($("#contact_name_th").val()=='' || $("#contact_name_en").val()=='' || $("#contact_receive_mail").val()==''){
  				return false;
  			}else{
  				$("#action-form").submit();
  			}

  	});

		$("#action-form").on('submit',(function(e){
			e.preventDefault();

			$.ajax({
				 url: "<?=$url;?>/<?=$get_part0;?>?select=update",
				 type: "post",
				 data:  new FormData(this),
				 contentType: false,
				 cache: false,
				 processData:false,
				 dataType: "json",
				 success: function(data) {

					if(data.status=="success"){
						toastr.success(data.msg, 'Update Config Success!',{timeOut: 5000,closeButton: true});
						loadData();

					}else{
						toastr.error(data.msg, 'Update Config Error!',{timeOut: 5000,closeButton: true});
					}
				 }
			});

		}));



	});

  function delImg(param){
    $.ajax({
      url: "<?=$url;?>/<?=$get_part0;?>?select=delimg&f="+param,
      type: "get",
      data: {select: 'delimg'},
      timeout: 3000,
      dataType: "json",
      success: function(data){

        if(data.status=="success"){
          toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
          loadData();
        }else{
          toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
        }

      },
      error: function(){}
    });
  }


	//load data
	function loadData(){

		$.ajax({
			 type: "get",
			 async: false,
			 url: "<?=$url;?>/<?=$get_part0;?>",
			 data: {select: 'loaddata'},
			 dataType: "json",
			 success: function(data) {

				$("#contact_name_th").val(data.contact_name_th);
				$("#contact_name_en").val(data.contact_name_en);
				$("#contact_address_th").val(data.contact_address_th);
				$("#contact_address_en").val(data.contact_address_en);
				$("#contact_tel_th").val(data.contact_tel_th);
				$("#contact_tel_en").val(data.contact_tel_en);
				$("#contact_email").val(data.contact_email);
				$("#contact_lineid").val(data.contact_lineid);
				$("#contact_facebook").val(data.contact_facebook);
				$("#contact_receive_mail").val(data.contact_receive_mail);
        $("#namePlace").val(data.contact_location_name);
        $("#lon_value").val(data.contact_location_lon);
        $("#lat_value").val(data.contact_location_lat);
        $("#zoom_value").val(data.contact_location_zoom);
				$("#photomap").css('background-image','url(' + data.contact_photomap + ')');
				$("#photomap").html(data.btn_contact_photomap);
				$("#txtupdatedate").val(data.dateupdate);
			 }
		});

	};
	loadData();  // ทำงานครั้งแรกทันที 1 ครั้ง


  //=================================google map==========================================//
  var geocoder; // กำหนดตัวแปรสำหรับ เก็บ Geocoder Object ใช้แปลงชื่อสถานที่เป็นพิกัด
  var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
  var my_Marker; // กำหนดตัวแปรสำหรับเก็บตัว marker
  var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น
  var txtlat;
  var txtlon;
  var txtzoom;


  function initialize() { // ฟังก์ชันแสดงแผนที่
    GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
    geocoder = new GGM.Geocoder(); // เก็บตัวแปร google.maps.Geocoder Object
    // กำหนดจุดเริ่มต้นของแผนที่
    var my_Latlng  = new GGM.LatLng(13.761728449950002,100.6527900695800);

    //var my_Latlng  = new GGM.LatLng(13.761728449950002,100.6527900695800);
    var my_mapTypeId=GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง
    // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
    var my_DivObj=$("#map_canvas")[0];
    // กำหนด Option ของแผนที่
    var myOptions = {

      zoom: 13, // กำหนดขนาดการ zoom
      center: my_Latlng , // กำหนดจุดกึ่งกลาง จากตัวแปร my_Latlng
      mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่ จากตัวแปร my_mapTypeId
    };
    map = new GGM.Map(my_DivObj,myOptions); // สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map

    my_Marker = new GGM.Marker({ // สร้างตัว marker ไว้ในตัวแปร my_Marker
      position: my_Latlng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
      map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
      draggable:true, // กำหนดให้สามารถลากตัว marker นี้ได้
      title:"คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!" // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
    });

    // กำหนด event ให้กับตัว marker เมื่อสิ้นสุดการลากตัว marker ให้ทำงานอะไร
    GGM.event.addListener(my_Marker, 'dragend', function() {
      var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
      map.panTo(my_Point); // ให้แผนที่แสดงไปที่ตัว marker
      $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
      $("#lon_value").val(my_Point.lng());  // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
      $("#zoom_value").val(map.getZoom());  // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_valu
    });

    // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
    GGM.event.addListener(map, 'zoom_changed', function() {
      $("#zoom_value").val(map.getZoom());   // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
    });

  }

  $(function(){
    // ส่วนของฟังก์ชันค้นหาชื่อสถานที่ในแผนที่
    var searchPlace=function(){ // ฟังก์ชัน สำหรับคันหาสถานที่ ชื่อ searchPlace
      var AddressSearch=$("#namePlace").val();// เอาค่าจาก textbox ที่กรอกมาไว้ในตัวแปร
      if(geocoder){ // ตรวจสอบว่าถ้ามี Geocoder Object
        geocoder.geocode({
           address: AddressSearch // ให้ส่งชื่อสถานที่ไปค้นหา
        },function(results, status){ // ส่งกลับการค้นหาเป็นผลลัพธ์ และสถานะ
          if(status == GGM.GeocoderStatus.OK) { // ตรวจสอบสถานะ ถ้าหากเจอ
            var my_Point=results[0].geometry.location; // เอาผลลัพธ์ของพิกัด มาเก็บไว้ที่ตัวแปร
            map.setCenter(my_Point); // กำหนดจุดกลางของแผนที่ไปที่ พิกัดผลลัพธ์
            my_Marker.setMap(map); // กำหนดตัว marker ให้ใช้กับแผนที่ชื่อ map
            my_Marker.setPosition(my_Point); // กำหนดตำแหน่งของตัว marker เท่ากับ พิกัดผลลัพธ์
            $("#lat_value").val(my_Point.lat());  // เอาค่า latitude พิกัดผลลัพธ์ แสดงใน textbox id=lat_value
            $("#lon_value").val(my_Point.lng());  // เอาค่า longitude พิกัดผลลัพธ์ แสดงใน textbox id=lon_value
            $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_valu
          }else{
            // ค้นหาไม่พบแสดงข้อความแจ้ง
            alert("Geocode was not successful for the following reason: " + status);
            $("#namePlace").val("");// กำหนดค่า textbox id=namePlace ให้ว่างสำหรับค้นหาใหม่
           }
        });
      }
    }
    $("#SearchPlace").click(function(){ // เมื่อคลิกที่ปุ่ม id=SearchPlace ให้ทำงานฟังก์ฃันค้นหาสถานที่
      searchPlace();  // ฟังก์ฃันค้นหาสถานที่
    });
    $("#namePlace").keyup(function(event){ // เมื่อพิมพ์คำค้นหาในกล่องค้นหา
      if(event.keyCode==13){  //  ตรวจสอบปุ่มถ้ากด ถ้าเป็นปุ่ม Enter ให้เรียกฟังก์ชันค้นหาสถานที่
        searchPlace();      // ฟังก์ฃันค้นหาสถานที่
      }
    });


    function getmap(){
      GGM=new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
      geocoder = new GGM.Geocoder(); // เก็บตัวแปร google.maps.Geocoder Object

      var txtlat = $("#lat_value").val();
      var txtlon = $("#lon_value").val();
      var txtzoom = $("#zoom_value").val();

      var my_Latlng  = new GGM.LatLng(txtlat,txtlon);

      //var my_Latlng  = new GGM.LatLng(13.761728449950002,100.6527900695800);
      var my_mapTypeId=GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง
      // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
      var my_DivObj=$("#map_canvas")[0];
      // กำหนด Option ของแผนที่
      var myOptions = {

        zoom: 15, // กำหนดขนาดการ zoom
        center: my_Latlng , // กำหนดจุดกึ่งกลาง จากตัวแปร my_Latlng
        mapTypeId:my_mapTypeId // กำหนดรูปแบบแผนที่ จากตัวแปร my_mapTypeId
      };
      map = new GGM.Map(my_DivObj,myOptions); // สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map

      my_Marker = new GGM.Marker({ // สร้างตัว marker ไว้ในตัวแปร my_Marker
        position: my_Latlng,  // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
        map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
        draggable:true, // กำหนดให้สามารถลากตัว marker นี้ได้
        title:"คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!" // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
      });

      // กำหนด event ให้กับตัว marker เมื่อสิ้นสุดการลากตัว marker ให้ทำงานอะไร
      GGM.event.addListener(my_Marker, 'dragend', function() {
        var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
        map.panTo(my_Point); // ให้แผนที่แสดงไปที่ตัว marker
        $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
        $("#lon_value").val(my_Point.lng());  // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
        $("#zoom_value").val(map.getZoom());  // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_valu
      });

      // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
      GGM.event.addListener(map, 'zoom_changed', function() {
        $("#zoom_value").val(map.getZoom());   // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
      });
    }

    getmap();

  });
  //=================================google map==========================================//

	</script>
