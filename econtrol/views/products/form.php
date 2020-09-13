<div class="br-mainpanel">
  <div class="br-pageheader pd-y-5 pd-x-15">
    <nav class="breadcrumb pd-0 mg-0 tx-14">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
      <span class="breadcrumb-item active"><?=$pagename;?></span>
    </nav>
  </div><!-- br-pageheader -->

  <div class="br-pagebody pd-x-15 pd-sm-x-15 mg-b-15" >
    <div class="card bd-0 shadow-base pd-0">
			<div class="mg-l-auto hidden-xs-down pd-5" style="border-bottom:2px solid #333;width:100%;">
        <div class="row no-gutters">
          <div class="col-md-7 col-sm-7 col-xs-12">
            <h4 class="mg-t-5" id="title-product">เพิ่มสินค้าใหม่</h4>
          </div>
          <div class="col-md-5 col-sm-5 col-xs-12 text-right">
            <a href="javascript:;" class="btn btn-success btn-with-icon btnsave">
              <div class="ht-40">
                <span class="icon wd-40"><i class="fa fa-save"></i></span>
                <span class="pd-x-15">บันทึก</span>
              </div>
            </a>
            <a href="javascript:history.back();" class="btn btn-secondary btn-with-icon">
              <div class="ht-40">
                <span class="icon wd-40"><i class="icon ion-reply"></i></span>
                <span class="pd-x-15">ย้อนกลับ</span>
              </div>
            </a>
          </div>
        </div>

	    </div>
			<form role="form" action="#" method="POST" id="action-form" enctype="multipart/form-data" >
				<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 pd-l-0 pd-r-0">
					<div class="panel" >
						<div class="panel-body pd-t-0" >
              <input type="hidden" name="action" id="action"  value="add"/>
              <input type="hidden" name="prodid" id="prodid"  />
              <div class="form-layout form-layout-2" >
                <div class="row no-gutters">
                  <div class="col-md-9 mg-t--1 mg-md-t-0">
                    <div class="row">
                      <div class="col-md-12 mg-t--1 mg-md-t-0">
                        <div class="form-group pd-10-force bd-l-0-force">
                          <label class="form-control-label tx-bold">ชื่อสินค้า (TH): <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="prodname_th" id="prodname_th" value="" placeholder="">
                          <span class="text-danger" id="errmsg_prodname_th"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mg-t--1 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force">
                          <label class="form-control-label tx-bold">ชื่อสินค้า (EN): <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="prodname_en" id="prodname_en" value="" placeholder="">
                          <span class="text-danger" id="errmsg_prodname_en"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mg-t--1 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force">
                          <label class="form-control-label tx-bold">Slug (EN): <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="slug" id="slug" value="" placeholder="">
                          <span class="text-danger" id="errmsg_slug"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mg-t--1 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force">
                          <label class="form-control-label tx-bold">หมวดหมู่สินค้า: <span class="tx-danger">*</span></label>
                          <select class="form-control select2-show-search" name="cat_id[]" id="cat_id" data-placeholder="select category" multiple></select>
                          <span class="text-danger" id="errmsg_cat_id"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mg-t--1 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force">
                          <label class="form-control-label tx-bold">Application: <span class="tx-danger">*</span></label>
                          <select class="form-control select2-show-search" name="app_id[]" id="app_id" data-placeholder="select applications" multiple></select>
                          <span class="text-danger" id="errmsg_app_id"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mg-t--1 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force">
                          <label class="form-control-label tx-bold">Process: <span class="tx-danger">*</span></label>
                          <select class="form-control select2-show-search" name="process_id[]" id="process_id" data-placeholder="select process" multiple></select>
                          <span class="text-danger" id="errmsg_process_id"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mg-t--1 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force">
                          <label class="form-control-label tx-bold">รายละเอียดสินค้าย่อ (TH):</label>
                          <textarea class="form-control" name="prodshortdetail_th" id="prodshortdetail_th" maxlength="255"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mg-t--1 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force">
                          <label class="form-control-label tx-bold">รายละเอียดสินค้าย่อ (EN):</label>
                          <textarea class="form-control" name="prodshortdetail_en" id="prodshortdetail_en" maxlength="255"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mg-t--1 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force">
                          <label class="form-control-label tx-bold">รายละเอียดสินค้า (TH):</label>
                          <textarea class="form-control" name="proddetail_th" id="edit" ></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mg-t--1 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force">
                          <label class="form-control-label tx-bold">รายละเอียดสินค้า (EN):</label>
                          <textarea class="form-control" name="proddetail_en" id="edit2" ></textarea>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row">
                      <div class="col-md-12 mg-t--1 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force">
                          <label class="form-control-label tx-bold">Url Refer 1: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="prodlink" id="prodlink" value="" placeholder="Url Link">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mg-t--1 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force">
                          <label class="form-control-label tx-bold">Url Refer 2: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="prodlink2" id="prodlink2" value="" placeholder="Url Link 2">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mg-t--1 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force">
                          <label class="form-control-label tx-bold">Url Refer 3: <span class="tx-danger">*</span></label>
                          <input class="form-control" type="text" name="prodlink3" id="prodlink3" value="" placeholder="Url Link 3">
                        </div>
                      </div>
                    </div> -->
                    <!-- <div class="row">

                      <div class="col-lg mg-t--1 mg-md-t-0 ">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force bd-r-0-force">
                          <label class="form-control-label tx-bold">น้ำหนัก: <span class="tx-danger">*</span></label>
                          <div class="input-group bd rounded">
                            <input type="text" class="form-control pd-l-10-force" id="weight" name="weight" placeholder="10.5">
                            <span class="input-group-addon tx-size-sm lh-2 bd-0">kg</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg mg-t--1 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force bd-r-0-force">
                          <label class="form-control-label tx-bold">ขนาด (กว้าง): <span class="tx-danger">*</span></label>
                          <div class="input-group bd rounded">
                            <input type="text" class="form-control pd-l-10-force" id="size_width" name="size_width" placeholder="10">
                            <span class="input-group-addon tx-size-sm lh-2 bd-0">cm</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg mg-t--1 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force bd-r-0-force">
                          <label class="form-control-label tx-bold">ขนาด (ยาว): <span class="tx-danger">*</span></label>
                          <div class="input-group bd rounded">
                            <input type="text" class="form-control pd-l-10-force" id="size_long" name="size_long" placeholder="10">
                            <span class="input-group-addon tx-size-sm lh-2 bd-0">cm</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg mg-t--1 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force">
                          <label class="form-control-label tx-bold">ขนาด (สูง): <span class="tx-danger">*</span></label>
                          <div class="input-group bd rounded">
                            <input type="text" class="form-control pd-l-10-force" id="size_height" name="size_height" placeholder="10">
                            <span class="input-group-addon tx-size-sm lh-2 bd-0">cm</span>
                          </div>
                        </div>
                      </div>

                    </div> -->

                  </div><!-- col-8 -->
                  <div class="col-md-3 mg-md-t-0">
                    <div class="row">
                      <div class="col-md-12 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force bd-r-0-force">
                          <label class="form-control-label tx-bold">รหัสสินค้า (SKU): <span class="tx-danger">*</span></label>
                          <input class="form-control bggray" type="text" name="prodcode" id="prodcode" value="" placeholder="">
                          <span class="text-danger" id="errmsg_prodcode"></span>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row">
                      <div class="col-md-12 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force bd-r-0-force">
                          <label class="form-control-label tx-bold">ราคา (ปกติ): <span class="tx-danger">*</span></label>
                          <input class="form-control bggray" type="text" name="prodprice" id="prodprice" value="" placeholder="">
                          <span class="text-danger" id="errmsg_prodprice"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force bd-r-0-force">
                          <label class="form-control-label tx-bold">ราคา (โปรโมชั่น): <span class="tx-danger">*</span></label>
                          <input class="form-control bggray" type="text" name="prodprice_promotion" id="prodprice_promotion" value="" placeholder="">
                          <span class="text-danger" id="errmsg_prodprice_promotion"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force bd-r-0-force">
                          <label class="form-control-label tx-bold">จำนวนสินค้า: <span class="tx-danger">*</span></label>
                          <input class="form-control bggray" type="text" name="qty" id="qty" value="0" placeholder="">
                          <span class="text-danger" id="errmsg_qty"></span>
                        </div>
                      </div>
                    </div> -->
                    <div class="row">
                      <div class="col-md-12 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force bd-r-0-force">
                          <label class="form-control-label tx-bold">แบรนด์สินค้า: <span class="tx-danger">*</span></label>
                          <select class="form-control select2-show-search" name="brand_id" id="brand_id" data-placeholder="select brand"></select>
                          <span class="text-danger" id="errmsg_brand_id"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force bd-r-0-force">
                          <label class="form-control-label tx-bold">ผู้ผลิต: <span class="tx-danger">*</span></label>
                          <select class="form-control select2-show-search" name="supp_id" id="supp_id" data-placeholder="select Supplier"></select>
                          <span class="text-danger" id="errmsg_supp_id"></span>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row">
                      <div class="col-md-12 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force bd-r-0-force">
                          <label class="form-control-label tx-bold">สถานะสินค้า: <span class="tx-danger">*</span></label>
                          <select class="form-control bggray" name="prodstatus" id="prodstatus"></select>
                          <span class="text-danger" id="errmsg_prodstatus"></span>
                        </div>
                      </div>
                    </div> -->
                    <!-- <div class="row">
                      <div class="col-md-12 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force bd-r-0-force">
                          <label class="form-control-label tx-bold">ประเภทสินค้า: <span class="tx-danger">*</span></label>
                          <select class="form-control select2" name="prodtype[]" id="prodtype" data-placeholder="Choose product type" multiple>
                            <?php// echo $model->loadProdtype();?>
                          </select>
                          <span class="text-danger" id="errmsg_prodtype"> *เลือกได้มากกว่าหนึ่ง</span>
                        </div>
                      </div>
                    </div> -->
                    <!-- <div class="row">
                      <div class="col-md-12 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force bd-r-0-force">
                          <label class="form-control-label tx-bold">การจัดส่ง: <span class="tx-danger">*</span></label>
                          <select class="form-control bggray" name="is_shipping" id="is_shipping">
                            <option value="0">จัดส่งฟรี</option>
                            <option value="1">มีค่าจัดส่ง</option>
                          </select>
                          <span class="text-danger" id="errmsg_is_shipping"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row" id="is_shipping_amount" style="display:none;">
                      <div class="col-md-12 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force bd-r-0-force">
                          <label class="form-control-label tx-bold">ราคาค่าจัดส่ง: <span class="tx-danger">*</span></label>
                          <input class="form-control bggray" type="text" name="shipping_amount" id="shipping_amount" value="0" placeholder="">
                          <span class="text-danger" id="errmsg_shipping_amount"></span>
                        </div>
                      </div>
                    </div> -->
                    <div class="row">
                      <div class="col-md-12 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force bd-r-0-force">
                          <label class="form-control-label tx-bold">อัพโหลดไฟล์ (Datasheet):</label>
                          <div style="font-size:15px;color:#000;padding:3px;background-color:#eee;" id="datasheet-file"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force bd-r-0-force">
                          <label class="form-control-label tx-bold">อัพเดทเมื่อ:</label>
                          <input class="form-control bggray" type="text" name="create_date" id="create_date" placeholder="" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force bd-l-0-force bd-r-0-force">
                          <label class="form-control-label tx-bold">อัพเดทโดย:</label>
                          <input class="form-control bggray" type="text" name="user_create" id="user_create" placeholder="" readonly>
                        </div>
                      </div>
                    </div>
                  </div><!-- col-4 -->

                </div><!-- row -->
                <div class="row no-gutters" style="border-top:2px solid #333;">
                  <?php //echo $model->loadDataattribute();?>
                  <div class="col-xs-12 col-md-12 col-lg-12">
                    <div class="row optionBox mg-0 pd-10">

                      <div class="col-xl-6 mg-t-20 mg-xl-t-0 pd-l-0 pd-r-0 bg-gray-100 rounded block-option">
                        <!-- <span class="div-remove" style="position: absolute;right: 10px;top: 5px;color: red;"><i class="fa fa-times-circle"></i></span> -->
                        <div class="form-layout form-layout-5 pd-10">
                          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">รายการ (แถว)</h6>
                          <table class="table option1-list">
                            <!-- <tr>
                              <td width="30%" align="right">ชื่อรายการ :</td>
                              <td width="60%"><input type="text" class="form-control rounded" name="optionname[]" maxlength="20" placeholder="Ex : สินค้า1" style="border:2px solid #bbb;padding-left:5px;" ></td>
                              <td width="10%"></td>
                            </tr> -->
                            <tr class="optlist1">
                              <td width="20%" align="right">ชื่อรายการ 1:</td>
                              <td width="70%"><input type="text" class="form-control rounded" name="optionvalue1[]" onkeyup="calcuTable(0)" value="รายการ" placeholder="รายการ1" style="border:2px solid #bbb;padding-left:5px;"></td>
                              <td width="10%" align="center"><span class="removeopt1"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <tr class="optlist1">
                              <td width="20%" align="right"></td>
                              <td width="70%"><button type="button" class="btn addopt1list btn-outline-secondary active btn-block mg-b-10">เพิ่มรายการ</button></td>
                              <td width="10%" align="center"></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div class="col-xl-6 mg-t-20 mg-xl-t-0 pd-l-0 pd-r-0 bg-gray-100 rounded block-option">
                        <!-- <span class="div-remove" style="position: absolute;right: 10px;top: 5px;color: red;"><i class="fa fa-times-circle"></i></span> -->
                        <div class="form-layout form-layout-5 pd-10">
                          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">หัวข้อ (คอลัมน์)</h6>
                          <table class="table option2-list">
                            <!-- <tr>
                              <td width="30%" align="right">ชื่อหัวข้อ:</td>
                              <td width="60%"><input type="text" class="form-control rounded" name="optionname[]" maxlength="20" placeholder="Ex : ความกว้าง" style="border:2px solid #bbb;padding-left:5px;" ></td>
                              <td width="10%"></td>
                            </tr> -->
                            <tr class="optlist2">
                              <td width="20%" align="right">ชื่อหัวข้อ 1:</td>
                              <td width="40%"><input type="text" class="form-control rounded" name="optionvalue2[]" onkeyup="calcuTable(0)" value="คอลัมน์" placeholder="หัวข้อ1 ตัวอย่าง: ความกว้าง" style="border:2px solid #bbb;padding-left:5px;"></td>
                              <td width="30%">
                                <select class="form-control rounded" name="optionvalue3[]" onchange="calcuTable(0)" style="border:2px solid #bbb;padding-left:5px;">
                                  <option value="text">ข้อความ</option>
                                  <option value="file">อัพโหลดไฟล์</option>
                                  <option value="button">ปุ่มขอใบเสนอราคา</option>
                                </select>
                              </td>
                              <td width="10%" align="center"><span class="removeopt1"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <tr class="optlist2">
                              <td width="20%" align="right"></td>
                              <td width="40%"><button type="button" class="btn addopt2list btn-outline-secondary active btn-block mg-b-10">เพิ่มหัวข้อ</button></td>
                              <td width="30%" align="center"></td>
                              <td width="10%" align="center"></td>
                            </tr>
                          </table>
                        </div>
                      </div>

                      <!-- <div class="col-xl-3 mg-t-20 mg-xl-t-0 pd-l-0 pd-r-0 bg-gray-100 rounded block-option">
                        <div class="addoption text-center" style="margin-top:20%;margin-bottom:20%;cursor:pointer;">
                          <i class="fa fa-plus-circle tx-50"></i><br/>
                          <span class="tx-20">เพิ่มตัวเลือก</span>
                        </div>
                      </div> -->
                      <div class="inputoptionarr">

                      </div>
                    </div>
                    <!-- <div class="row mg-0 pd-10 bggray setoptionall" style="display:none;">
                      <div class="col-md-2 pd-t-20 text-center">
                        <h5>ข้อมูลตัวเลือกสินค้า</h5>
                      </div>
                      <div class="col-md-2 pd-l-0 pd-r-0">
                        <div class="form-group pd-5-force">
                          <input type="text" name="set_qty" id="set_price" class="form-control text-center bgwhite" placeholder="ราคา"/>
                        </div>
                      </div>
                      <div class="col-md-2 pd-l-0 pd-r-0">
                        <div class="form-group pd-5-force">
                          <input type="text" name="set_qty" id="set_qty" class="form-control text-center bgwhite" placeholder="จำนวน"/>
                        </div>
                      </div>
                      <div class="col-md-2 pd-l-0 pd-r-0">
                        <div class="form-group pd-5-force">
                          <input type="text" name="set_qty" id="set_sku" class="form-control text-center bgwhite" placeholder="SKU"/>
                        </div>
                      </div>
                      <div class="col-md-4 pd-t-5">
                        <button type="button" id="set-option-all" class="btn btn-lg btn-warning">อัพเดทกับตัวเลือกสินค้าทั้งหมด</button>
                      </div>
                    </div> -->

                    <div class="row mg-0 pd-10">
                      <table class="table">
                        <thead class="thead-colored thead-dark" border="1" id="headoption">
                        </thead>
                        <tbody id="itemoption">
                        </tbody>
                      </table>

                    </div>
                  </div>
                  <!-- ************************************************** -->
                </div>
                <div class="row no-gutters" style="border-top:2px solid #333;">
                  <div class="col-lg">
                    <div class="form-group pd-10-force bd-l-0-force">
                      <label class="form-control-label tx-bold">Product Photo</label>
                      <div class="row mg-md-0" style="padding:5px;border:1px solid #eee;" id="loadimggall">
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="col-item" onclick="clickFle();" style="background-image:url(<?=$url;?>/images/uploadimg.jpg);background-position: center center;background-repeat: no-repeat;background-size: cover;">
                                <div class="col-img">

                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row no-gutters" style="border-top:2px solid #333;">
                  <div class="col-md-12 mg-t--1 mg-md-t-0">
                    <div class="row">
                      <div class="col-md-12 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force">
                          <label class="form-control-label tx-bold">SEO TITLE:</label>
                          <input class="form-control bggray" type="text" name="seo_title" id="seo_title" maxlength="165" placeholder="" >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force">
                          <label class="form-control-label tx-bold">SEO DESCRIPTION:</label>
                          <input class="form-control bggray" type="text" name="seo_desc" id="seo_desc" maxlength="255" placeholder="" >
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 mg-md-t-0">
                        <div class="form-group pd-10-force bd-t-0-force">
                          <label class="form-control-label tx-bold">PRODUCT TAGS:</label>
                          <input class="form-control bggray" type="text" name="prodtag" id="prodtag" value="" data-role="tagsinput" placeholder="" >
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
      <form name="frmupload_photo" method="post" action="" id="imgupload" enctype="multipart/form-data" >
        <input type="hidden" name="prodid" class="id" value="<?=$get_part2;?>"/>
        <input type="file" id="prodimg" name="fle[]" multiple  style="width:0px;height:0px;display:none;"/>
      </form>
      <form name="frmdocument" action="" id="formdocument" method="post" enctype="multipart/form-data">
        <input type="file" name="doc_file" id="doc_file" style="display:none;"/>
      </form>
			<div class="hidden-md-up pd-10 bg-gray-600">
        <a href="javascript:;" class="btn btn-primary btn-with-icon btnsave">
          <div class="ht-40">
            <span class="icon wd-40"><i class="fa fa-save"></i></span>
            <span class="pd-x-15">บันทึก</span>
          </div>
        </a>
				<a href="javascript:history.back();" class="btn btn-secondary mg-l-5"> ย้อนกลับ </a>
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
  .bgwhite{
    background-color: #fff !important;
  }
  .select2-container{
    width: 100% !important;
  }
  .select2-container--default.select2-container--focus .select2-selection--multiple{
    border: 0px !important;
  }
  .select2-container--default .select2-selection--multiple{
    border: 0px !important;
  }
  .bootstrap-tagsinput{
    border: 0px !important;
    box-shadow: none;
  }
</style>

<script type="text/javascript">
  //begin function no enter
  document.onkeydown = chkEvent
  var formInUse = false;
  function chkEvent(e) {
    var keycode;
    if (window.event) keycode = window.event.keyCode; //*** for IE ***//
    else if (e) keycode = e.which; //*** for Firefox ***//
    if(keycode==13)
    {
      return false;
    }
    // if(keycode==13 || (keycode==8 && formInUse==false))
    // {
      // return false;
    // }
  }
  // clased function no enter
	$(document).ready(function(e){
		if ( top.location.href != location.href ) top.location.href = location.href;

    $('.colorpicker').spectrum({});

    $('#prodimg').change(function(){
      $('#imgupload').submit();
    })

    $("#is_shipping").on('change',function(){
      var is_shipping = $(this).val();
      if(is_shipping==1){
        $("#is_shipping_amount").css('display','block');
      }else{
        $("#is_shipping_amount").css('display','none');
      }
    })


    $("#imgupload").on('submit',(function(e){
      e.preventDefault();
      $.ajax({
        url: "<?=$url;?>/<?=$get_part0;?>?select=uploadimggall",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType: "json",
        success: function(data){

          if(data.status=="success"){
            toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
            loadimggall(data.id);
            $(".id").val(data.id);
						$("#prodid").val(data.id);
            $("#action").val('edit');
          }else{
            toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
          }

        },
        error: function(){}
      });
    }));


    $("#prodname_en").keyup(function(){
      var str = $(this).val();
      var slug = str.replace(" ", "-");
      $("#slug").val(slug);
    })


    /*===================================================*/
		$(".btnsave").on('click',function(e){
			e.preventDefault();

      if($("#prodname_th").val()==''){
        $("#prodname_th").focus();
        $("#errmsg_prodname_th").text('กรุณากรอกช่องนี้ด้วยครับ!');
      }else{
        $("#errmsg_prodname_th").text('');
      }
      if($("#prodname_en").val()==''){
        $("#prodname_en").focus();
        $("#errmsg_prodname_en").text('กรุณากรอกช่องนี้ด้วยครับ!');
      }else{
        $("#errmsg_prodname_en").text('');
      }
      if($("#slug").val()==''){
        $("#slug").focus();
        $("#errmsg_slug").text('กรุณากรอกช่องนี้ด้วยครับ!');
      }else{
        $("#errmsg_slug").text('');
      }
      if($("#prodcode").val()==''){
        $("#prodcode").focus();
        $("#errmsg_prodcode").text('กรุณากรอกช่องนี้ด้วยครับ!');
      }else{
        $("#errmsg_prodcode").text('');
      }
      if($("#prodprice").val()==''){
        $("#prodprice").focus();
        $("#errmsg_prodprice").text('กรุณากรอกช่องนี้ด้วยครับ!');
      }else{
        $("#errmsg_prodprice").text('');
      }
      if($("#cat_id").val()==''){
        $("#cat_id").focus();
        $("#errmsg_cat_id").text('กรุณากรอกช่องนี้ด้วยครับ!');
      }else{
        $("#errmsg_cat_id").text('');
      }
      // if($("#prodstatus").val()==''){
      //   $("#prodstatus").focus();
      //   $("#errmsg_prodstatus").text('กรุณากรอกช่องนี้ด้วยครับ!');
      // }else{
      //   $("#errmsg_prodstatus").text('');
      // }

      if($("#prodname_th").val() != '' && $("#prodname_en").val() != '' && $("#slug").val() != '' && $("#prodcode").val() != '' && $("#prodprice").val() != '' && $("#cat_id").val() != '' ){
        $("#action-form").submit();
      }else{
        return false;
      }
		});


		$("#action-form").on('submit',(function(e){
			e.preventDefault();


			$.ajax({
				 url: "<?=$url;?>/<?=$get_part0;?>?select=save",
				 type: "post",
				 data:  new FormData(this),
				 contentType: false,
				 cache: false,
				 processData:false,
				 dataType: "json",
				 success: function(data) {

					if(data.status=="success"){
            $("#action-form")[0].reset();
            $("#imgupload")[0].reset();
						toastr.success(data.msg, 'Create Data Success!',{timeOut: 5000,closeButton: true});
            $('#prodid').val(data.id);
            $('.id').val(data.id);
            loadData();
					}else{
						toastr.error(data.msg, 'Create Data Error!',{timeOut: 5000,closeButton: true});
					}
				 }
			});

		}));



    // ======================================================================= //
    $('#doc_file').change(function(){
      $('#formdocument').submit();
    });

    $("#btnadddocument").on('click',function(){
      $('#doc_file').click();
    });

    $("#formdocument").on('submit',(function(e){
      e.preventDefault();
      var prodid = $("#prodid").val();
      $.ajax({
        url: "<?=$url;?>/<?=$get_part0;?>?select=adddocument&prodid="+prodid,
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType: "json",
        success: function(data){

          if(data.status=="success"){
            toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
            $("#prodid").val(data.id);
            $("#action").val('edit');
            $("#formdocument")[0].reset();
            loadData();
          }else{
            toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
          }

        },
        error: function(){}
      });
    }));


    /*===============================================*/
    /*===============================================*/
    /*===============================================*/
    $(document).on('click','.addopt1list',function(){
      let countclass = $('.option1-list .optlist1').length;
      var opt = '<tr class="optlist1">'+
        '<td width="20%" align="right">ชื่อรายการ '+countclass+':</td>'+
        '<td width="70%"><input type="text" class="form-control rounded" name="optionvalue1[]" value="" onkeyup="calcuTable('+countclass+')" placeholder="รายการ'+countclass+'" style="border:2px solid #bbb;padding-left:5px;"></td>'+
        '<td width="10%" align="center" class="removeopt1"><span><i class="fa fa-trash"></i></span></td>'+
      '</tr>';

      $('.optlist1:last').before(opt);

      if(countclass==26)
        $('.optlist1:last').css('display','none');
      // console.log(countclass-1);
      $('.showoptcount1').text('('+countclass+'/25)');
      calcuTable(1);
    });

    $(document,'.option1-list').on('click','.removeopt1',function() {
     	$(this).parent().remove();
      // console.log($(this).parent());
      let countclass = $('.option1-list .optlist1').length;
      $('.showoptcount1').text('('+(parseInt(countclass)-1)+'/25)');
      if(countclass==25)
        $('.optlist1:last').css('display','');
      calcuTable(1);
    });

    /*===============================================*/
    /*===============================================*/
    /*===============================================*/

    $(document).on('click','.addopt2list',function(){
      let countclass = $('.option2-list .optlist2').length;
      var opt = '<tr class="optlist2">'+
        '<td width="20%" align="right">ชื่อหัวข้อ '+countclass+':</td>'+
        '<td width="40%"><input type="text" class="form-control rounded" name="optionvalue2[]" value="" onkeyup="calcuTable('+countclass+')" placeholder="หัวข้อ'+countclass+'" style="border:2px solid #bbb;padding-left:5px;"></td>'+
        '<td width="30%">'+
          '<select class="form-control rounded" name="optionvalue3[]" onchange="calcuTable('+countclass+')" style="border:2px solid #bbb;padding-left:5px;">'+
            '<option value="text">ข้อความ</option>'+
            '<option value="file">อัพโหลดไฟล์</option>'+
            '<option value="button">ปุ่มขอเสนอราคา</option>'+
          '</select>'+
        '</td>'+
        '<td width="10%" align="center" class="removeopt2"><span><i class="fa fa-trash"></i></span></td>'+
      '</tr>';

      $('.optlist2:last').before(opt);

      if(countclass==26)
        $('.optlist2:last').css('display','none');
      // console.log(countclass-1);
      $('.showoptcount2').text('('+countclass+'/25)');
      calcuTable(1);
    });

    $(document,'.option2-list').on('click','.removeopt2',function() {
     	$(this).parent().remove();
      // console.log($(this).parent());
      let countclass = $('.option2-list .optlist2').length;
      $('.showoptcount2').text('('+(parseInt(countclass)-1)+'/25)');
      if(countclass==25)
        $('.optlist2:last').css('display','');
      calcuTable(1);
    });

    /*===============================================*/
    /*===============================================*/

    /*========= check input number ========*/

    // $("#weight").keyup(function(e){
    //   var numbers = /^[0-9]+$/;
    //   if($(this).val().match(numbers)){
    //     // alert('Your Registration number has accepted....');
    //     $(this).css('border','0px');
    //     $(this).focus();
    //     return true;
    //   }else{
    //     // alert('Please input numeric characters only');
    //     $(this).css('border','1px solid red');
    //     $(this).focus();
    //     $(this).val('');
    //     return false;
    //   }
    // });

    $("#size_width").keyup(function(e){
      var numbers = /^[0-9]+$/;
      if($(this).val().match(numbers)){
        // alert('Your Registration number has accepted....');
        $(this).css('border','0px');
        $(this).focus();
        return true;
      }else{
        // alert('Please input numeric characters only');
        $(this).css('border','1px solid red');
        $(this).focus();
        $(this).val('');
        return false;
      }
    });

    $("#size_long").keyup(function(e){
      var numbers = /^[0-9]+$/;
      if($(this).val().match(numbers)){
        // alert('Your Registration number has accepted....');
        $(this).css('border','0px');
        $(this).focus();
        return true;
      }else{
        // alert('Please input numeric characters only');
        $(this).css('border','1px solid red');
        $(this).focus();
        $(this).val('');
        return false;
      }
    });

    $("#size_height").keyup(function(e){
      var numbers = /^[0-9]+$/;
      if($(this).val().match(numbers)){
        // alert('Your Registration number has accepted....');
        $(this).css('border','0px');
        $(this).focus();
        return true;
      }else{
        // alert('Please input numeric characters only');
        $(this).css('border','1px solid red');
        $(this).focus();
        $(this).val('');
        return false;
      }
    });

    /*========= check input number ========*/


    /*========= set option all ========*/
    $("#set-option-all").on('click',function(e){
      $(".setprice").val($("#set_price").val());
      $(".setqty").val($("#set_qty").val());
      $(".setsku").val($("#set_sku").val());
    });
    /*========= set option all ========*/


	});

  /*===============================================*/
  /*====================calculate table===========================*/
  calcuTable(0);
  function calcuTable(countclass){
    let optionvalue1 = document.getElementsByName('optionvalue1[]');
    let optionvalue2 = document.getElementsByName('optionvalue2[]');
    let optionvalue3 = document.getElementsByName('optionvalue3[]');

    $('#headoption').empty();
    

    const trhead = $('<tr></tr>');
    trhead.append(`<th class="text-center bd-l" width="20%">รายการ</th>`);


    // console.log(optionvalue1[0].value);
    // console.log(optionvalue1[0].value);
    var colwidth = 0;
    for(let k=0;k<optionvalue2.length;k++){
      colwidth = parseInt(80)/optionvalue2.length;
      trhead.append(`<th class="text-center bd-l" width="`+colwidth+`%">`+optionvalue2[k].value+`</th>`);
    }

    $('#headoption').append(trhead);
    $('#itemoption').empty();
    
    let num_i = 0;
    for(let i=1;i<=optionvalue1.length;i++){
      const trbody = $('<tr></tr>');
      trbody.append(`<td class="text-center bd-l">`+(optionvalue1[num_i].value==''?'รายการ':optionvalue1[num_i].value)+`<input type="hidden" name="option1[]" value="`+(optionvalue1[num_i].value==''?'รายการ':optionvalue1[num_i].value)+`"/></td>`);

      
      if (optionvalue2.length>0){
        let num_k = 2;
        for(let k=0;k<optionvalue2.length;k++){
          
          var optiondesc = $('input[name="option_val'+num_i+k+'[]"]');
          // console.log(optiondesc[0]);

          if(optionvalue3[k].value=='button'){
            trbody.append(`<td class="text-center bd-l"><input type="`+optionvalue3[k].value+`" style="width:100%;text-align:center;" name="option`+num_k+`[]" value="ขอใบเสนอราคา"/><input type="hidden" name="optiontype`+num_k+`[]" value="`+optionvalue3[k].value+`" /></td>`);
          }else if(optionvalue3[k].value=='file'){
            if(optiondesc[0]!=undefined){
              trbody.append(`<td class="text-center bd-l"><a href="`+(optiondesc[0]==undefined?'':optiondesc[0].value)+`" class="btn btn-sm btn-info" target="_blank">ดูไฟล์</a> <input type="`+optionvalue3[k].value+`" style="width:70%;text-align:left;" name="option`+num_k+`[]" value="`+(optiondesc[0]==undefined?'':optiondesc[0].value)+`"/><input type="hidden" name="optiontype`+num_k+`[]" value="`+optionvalue3[k].value+`" /></td>`);
            }else{
              trbody.append(`<td class="text-center bd-l"><input type="`+optionvalue3[k].value+`" style="width:100%;text-align:left;" name="option`+num_k+`[]" value="`+(optiondesc[0]==undefined?'':optiondesc[0].value)+`"/><input type="hidden" name="optiontype`+num_k+`[]" value="`+optionvalue3[k].value+`" /></td>`);
            }
          }else{
            trbody.append(`<td class="text-center bd-l"><input type="`+optionvalue3[k].value+`" style="width:100%;text-align:center;" name="option`+num_k+`[]" value="`+(optiondesc[0]==undefined?'':optiondesc[0].value)+`"/><input type="hidden" name="optiontype`+num_k+`[]" value="`+optionvalue3[k].value+`" /></td>`);
          }
          
          num_k++;
        }
      }

      $('#itemoption').append(trbody);

      num_i++;
    }

  
  }
  /*===============================================*/
  /*===============================================*/

	//load data
  //get function edit
  <?php if($get_part1=='edit' and $get_part2!=''){?>
    // window.onload = function(){
      $("#action-form")[0].reset();
      $("#imgupload")[0].reset();
      $("#action").empty();
      $('#prodid').val('<?=$get_part2;?>');
      $('.id').val('<?=$get_part2;?>');
      loadData();
      loadimggall('<?=$get_part2;?>');
    // };
  <?php }else{?>
    // window.onload = function(){
      loadimggall(null);
      loadCategory(null);
      loadApplication(null);
      loadProcess(null);
      loadBrand(null);
      loadSuppliers(null);
      loadStatus(null);
    // };
  <?php } ?>
  /*================================================*/

  function btngetfile(param){
    $('#'+param).click();
  }

  function clickFle(){
    $('#prodimg').click();
  }


  function loadimggall(id){
      $.ajax({
         type: "get",
         async: false,
         url: "<?=$url;?>/<?=$get_part0;?>",
         data: {select: 'loaddataimg',id:id},
         dataType: "json",
         success: function(data) {
          <?php if($get_part1=="add"):?>
          $("#id").val(data.id);
          $("#prodid").val(data.id);
          <?php endif;?>
          $("#loadimggall").empty();
          $("#loadimggall").html(data.dataimg);

         }
      });
  };

  function setcover(gallid,id){
    $.ajax({
      type: "post",
      url: "<?=$url.'/'.$get_part0;?>",
      data:{id:id,gallid:gallid,select:"setcovergall"},
      dataType: "json",
      success:function(data){
        if(data.status=="success"){
          loadimggall(data.id);
          toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
        }else{
          toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
        }
      }
    }).done(function(){

    });
  }


  function delImggall(gallid,id){
    $.ajax({
      type: "get",
      url: "<?=$url.'/'.$get_part0;?>",
      data:{id:id,gallid:gallid,select:"delimggall"},
      dataType: "json",
      success:function(data){
        if(data.status=="success"){
          loadimggall(data.id);
          toastr.success(data.msg, 'Success!',{timeOut: 5000,closeButton: true});
        }else{
          toastr.error(data.msg, 'Error!',{timeOut: 5000,closeButton: true});
        }
      }
    }).done(function(){

    });
  }

  /*================================================*/

  function loadCategory(catid){
      var url_json = '<?=$url;?>/<?=$get_part0;?>?select=loadcategory';
      $('#cat_id').empty();
      $.ajax({
        url: url_json,
        type: 'get',
        dataType: 'json',
        timeout: 3000,
        success: function(data, textStatus, jqXHR ) {
          $('#cat_id').append('<option value="">เลือกหมวดหมู่</option>');
          if(data!=null){
            if(catid==null)
              catid= '';

            // console.log(catid);
            var catarr = catid.split(',');
            $.each(data.datarow, function(index, value){
              if(catarr.includes(value.id)==true){
                $('#cat_id').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
              }else{
                $('#cat_id').append('<option value="' + value.id + '">' + value.name + '</option>');
              }
            });
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
        }
      });
  }

  function loadApplication(appid){
      var url_json = '<?=$url;?>/<?=$get_part0;?>?select=loadapplication';
      $('#app_id').empty();
      $.ajax({
        url: url_json,
        type: 'get',
        dataType: 'json',
        timeout: 3000,
        success: function(data, textStatus, jqXHR ) {
          $('#app_id').append('<option value="">เลือก Application</option>');
          if(data!=null){
            if(appid==null)
              appid= '';

            // console.log(catid);
            var apparr = appid.split(',');
            $.each(data.datarow, function(index, value){
              if(apparr.includes(value.id)==true){
                $('#app_id').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
              }else{
                $('#app_id').append('<option value="' + value.id + '">' + value.name + '</option>');
              }
            });
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
        }
      });
  }

  function loadProcess(processid){
      var url_json = '<?=$url;?>/<?=$get_part0;?>?select=loadprocess';
      $('#process_id').empty();
      $.ajax({
        url: url_json,
        type: 'get',
        dataType: 'json',
        timeout: 3000,
        success: function(data, textStatus, jqXHR ) {
          $('#process_id').append('<option value="">เลือก Process</option>');
          if(data!=null){
            if(processid==null)
              processid= '';

            // console.log(catid);
            var processarr = processid.split(',');
            $.each(data.datarow, function(index, value){
              if(processarr.includes(value.id)==true){
                $('#process_id').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
              }else{
                $('#process_id').append('<option value="' + value.id + '">' + value.name + '</option>');
              }
            });
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
        }
      });
  }

  function loadBrand(id){
    var url_json = '<?=$url;?>/<?=$get_part0;?>?select=loadbrand';
    $('#brand_id').empty();
    $.ajax({
      url: url_json,
      type: 'get',
      dataType: 'json',
      timeout: 3000,
      success: function(data, textStatus, jqXHR ) {
        $('#brand_id').append('<option value="">เลือกแบรนด์สินค้า</option>');
        if(data!=null){
          $.each(data.datarow, function(index, value){
            if(id==value.id){
              $('#brand_id').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
            }else{
              $('#brand_id').append('<option value="' + value.id + '">' + value.name + '</option>');
            }
          });
        }

      },
      error: function(jqXHR, textStatus, errorThrown) {

      }
    });
  }

  function loadSuppliers(id){
    var url_json = '<?=$url;?>/<?=$get_part0;?>?select=loadsuppliers';
    $('#supp_id').empty();
    $.ajax({
      url: url_json,
      type: 'get',
      dataType: 'json',
      timeout: 3000,
      success: function(data, textStatus, jqXHR ) {
        $('#supp_id').append('<option value="">เลือกผู้จำหน่ายสินค้า</option>');
        if(data!=null){
          $.each(data.datarow, function(index, value){
            if(id==value.id){
              $('#supp_id').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
            }else{
              $('#supp_id').append('<option value="' + value.id + '">' + value.name + '</option>');
            }
          });
        }

      },
      error: function(jqXHR, textStatus, errorThrown) {

      }
    });
  }

  function loadStatus(id){
    var url_json = '<?=$url;?>/<?=$get_part0;?>?select=loadstatus';
    $('#prodstatus').empty();
    $.ajax({
      url: url_json,
      type: 'get',
      dataType: 'json',
      timeout: 3000,
      success: function(data, textStatus, jqXHR ) {
        $('#prodstatus').append('<option value="">เลือกสถานะสินค้า</option>');
        if(data!=null){
          $.each(data.datarow, function(index, value){
            if(id==value.id){
              $('#prodstatus').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
            }else{
              $('#prodstatus').append('<option value="' + value.id + '">' + value.name + '</option>');
            }
          });
        }

      },
      error: function(jqXHR, textStatus, errorThrown) {

      }
    });
  }


	function loadData(){
    var prodid = $('#prodid').val();
		$.ajax({
			 type: "get",
			 async: false,
			 url: "<?=$url;?>/<?=$get_part0;?>",
			 data: {select: 'loaddataedit',id:prodid},
			 dataType: "json",
			 success: function(data) {
         $("#action").val('edit');
         $("#title-product").text('['+data.prodid+'] -'+data.prodname_th);
         $("#prodid").val(data.prodid);
         $(".id").val(data.prodid);
         $("#prodcode").val(data.prodcode);
         $("#prodname_th").val(data.prodname_th);
         $("#prodname_en").val(data.prodname_en);
         $("#slug").val(data.slug);
         $("#prodshortdetail_th").val(data.prodshortdetail_th);
         $("#prodshortdetail_en").val(data.prodshortdetail_en);
         $("#edit").val(data.proddetail_th);
         $("#edit2").val(data.proddetail_en);
         $("#prodlink").val(data.prodlink);
         $("#prodlink2").val(data.prodlink2);
         $("#prodlink3").val(data.prodlink3);
         $("#prodprice").val(data.prodprice);
         $("#prodprice_promotion").val(data.prodprice_promotion);
         $("#qty").val(data.qty);
         $("#weight").val(data.weight);
         $("#size_height").val(data.size_height);
         $("#size_long").val(data.size_long);
         $("#size_width").val(data.size_width);

         /*==== catarr ====*/
         $('#cat_id').empty();
         $('#cat_id').append('<option value="">เลือกหมวดหมู่</option>');
         if(data.cat_id!=null){
           var cat_arr = data.cat_id.split(',');
           $.each(data.catarr, function(index, value){
             if(cat_arr.includes(value.id)==true){
               $('#cat_id').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
             }else{
               $('#cat_id').append('<option value="' + value.id + '">' + value.name + '</option>');
             }
           });
         }
         /*==== apparr ====*/
         $('#app_id').empty();
         $('#app_id').append('<option value="">เลือก Application</option>');
         if(data.app_id!=null){
           var app_arr = data.app_id.split(',');
           $.each(data.apparr, function(index, value){
             if(app_arr.includes(value.id)==true){
               $('#app_id').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
             }else{
               $('#app_id').append('<option value="' + value.id + '">' + value.name + '</option>');
             }
           });
         }
         /*==== processarr ====*/
         $('#process_id').empty();
         $('#process_id').append('<option value="">เลือก Process</option>');
         if(data.process_id!=null){
           var process_arr = data.process_id.split(',');
           $.each(data.processarr, function(index, value){
             if(process_arr.includes(value.id)==true){
               $('#process_id').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
             }else{
               $('#process_id').append('<option value="' + value.id + '">' + value.name + '</option>');
             }
           });
         }

         /*==== brandarr ====*/
         $('#brand_id').empty();
         $('#brand_id').append('<option value="">เลือกแบรนด์สินค้า</option>');
         if(data.brandarr!=null){
           $.each(data.brandarr, function(index, value){
             if(value.id==data.brand_id){
               $('#brand_id').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
             }else{
               $('#brand_id').append('<option value="' + value.id + '">' + value.name + '</option>');
             }
           });
         }
         /*==== suppliers ====*/
         $('#supp_id').empty();
         $('#supp_id').append('<option value="">เลือกผู้จำหน่ายสินค้า</option>');
         if(data.supp_id!=null){
           $.each(data.supparr, function(index, value){
             if(value.id==data.supp_id){
               $('#supp_id').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
             }else{
               $('#supp_id').append('<option value="' + value.id + '">' + value.name + '</option>');
             }
           });
         }

         /*==== statusarr ====*/
        //  $('#prodstatus').empty();
        //  $('#prodstatus').append('<option value="">เลือกสถานะสินค้า</option>');
        //  if(data.prodstatus!=null){
        //    $.each(data.statusarr, function(index, value){
        //      if(value.id==data.prodstatus){
        //        $('#prodstatus').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
        //      }else{
        //        $('#prodstatus').append('<option value="' + value.id + '">' + value.name + '</option>');
        //      }
        //    });
        //  }

         /*==== statusarr ====*/

         $("#is_shipping").val(data.is_shipping);
         if(data.is_shipping==1){
           $("#is_shipping_amount").css('display','block');
           $("#shipping_amount").val(data.shipping_amount);
         }else{
           $("#is_shipping_amount").css('display','none');
         }
         $("#seo_title").val(data.seo_title);
         $("#seo_desc").val(data.seo_desc);
         $("#prodtag").val(data.prodtag);
         $("#create_date").val(data.created);
         $("#user_create").val(data.creator);
         $("#datasheet-file").html(data.proddatasheet);

         if(data.dataprodtype!=null){
           $('#prodtype').empty();
           var prodtype = data.prodtype.split(',');
           $.each(data.dataprodtype, function(index, value){
              if(prodtype.includes(value.id)==true){
                $('#prodtype').append('<option value="' + value.id + '" selected>' + value.name + '</option>');
              }else{
                $('#prodtype').append('<option value="' + value.id + '">' + value.name + '</option>');
              }
           });
         }

         /*========= product options ============*/
        //  console.log(data.optionarr[0].list1);
         if(data.optionarr!=null){
           $('.option1-list').empty();
           $.each(data.optionarr[0].list1, function(index, value){
             var opt = '<tr class="optlist1">'+
               '<td width="20%" align="right">ชื่อรายการ '+(index+1)+':</td>'+
               '<td width="70%"><input type="text" class="form-control rounded" name="optionvalue1[]" value="'+value.name+'" onkeyup="calcuTable('+(index+1)+')" placeholder="รายการ'+(index+1)+'" style="border:2px solid #bbb;padding-left:5px;"></td>'+
               '<td width="10%" align="center" class="removeopt1"><span><i class="fa fa-trash"></i></span></td>'+
             '</tr>';
             $('.option1-list').append(opt);
           });

           var optbtn = '<tr class="optlist1">'+
             '<td width="20%" align="right"></td>'+
             '<td width="70%"><button type="button" class="btn addopt1list btn-outline-secondary active btn-block mg-b-10">เพิ่มรายการ</button></td>'+
             '<td width="10%" align="center"></td>'+
           '</tr>';
           $('.option1-list').append(optbtn);

           $('.option2-list').empty();

           $.each(data.optionarr[0].list2, function(index, value){
              // console.log(value.type);
               var opt2 = '<tr class="optlist2">'+
                 '<td width="20%" align="right">ชื่อหัวข้อ '+(index+1)+':</td>'+
                 '<td width="40%"><input type="text" class="form-control rounded" name="optionvalue2[]" value="'+value.name+'" onkeyup="calcuTable('+(index+1)+')" placeholder="หัวข้อ'+(index+1)+'" style="border:2px solid #bbb;padding-left:5px;"></td>'+
                 '<td width="30%">'+
                   '<select class="form-control rounded" name="optionvalue3[]" onchange="calcuTable('+(index+1)+')" style="border:2px solid #bbb;padding-left:5px;">'+
                     '<option value="text" '+(value.type=='text'?'selected':'')+'>ข้อความ</option>'+
                     '<option value="file" '+(value.type=='file'?'selected':'')+'>อัพโหลดไฟล์</option>'+
                     '<option value="button" '+(value.type=='button'?'selected':'')+'>ปุ่มขอใบเสนอราคา</option>'+
                   '</select>'+
                 '</td>'+
                 '<td width="10%" align="center" class="removeopt2"><span><i class="fa fa-trash"></i></span></td>'+
               '</tr>';
               $('.option2-list').append(opt2);

           });

           var optbtn2 = '<tr class="optlist2">'+
             '<td width="20%" align="right"></td>'+
             '<td width="40%"><button type="button" class="btn addopt2list btn-outline-secondary active btn-block mg-b-10">เพิ่มหัวข้อ</button></td>'+
             '<td width="30%" align="center"></td>'+
             '<td width="10%" align="center"></td>'+
           '</tr>';
           $('.option2-list').append(optbtn2);




           for (var ii = 0; ii < data.optionarr[0].list1.length; ii++) {
             $.each(data.optionlistarr[ii].optionval, function(index, value){
               if(value!=null){
                $(".inputoptionarr").append('<input type="hidden" name="option_val'+ii+index+'[]" value="'+value+'" />');
               }
             });
           }

         }

         if(data.optionlistarr!=null){
           let optionvalue1 = document.getElementsByName('optionvalue1[]');
           let optionvalue2 = document.getElementsByName('optionvalue2[]');
           let optionvalue3 = document.getElementsByName('optionvalue3[]');

           $('#headoption').empty();
           const trhead = $('<tr></tr>');
           trhead.append(`<th class="text-center bd-l" width="20%">รายการ</th>`);
           var colwidth = 0;
           $.each(data.optionarr[0].list2, function(index, value){
             colwidth = parseInt(80)/data.optionarr[0].list2.length;
             trhead.append(`<th class="text-center bd-l" width="`+colwidth+`%">`+value.name+`</th>`);
           });
           $('#headoption').append(trhead);

           $('#itemoption').empty();
           $.each(data.optionlistarr, function(index, value){
             const trbody = $('<tr></tr>');
             trbody.append(`<td class="text-center bd-l">`+(value.option_1==''?'รายการ':value.option_1)+`<input type="hidden" name="option1[]" value="`+(value.option_1==''?'รายการ':value.option_1)+`"/></td>`);

             if (data.option2.length>0){
               let num_k = 2;
               $.each(value.optionval, function(index1, value1){

                 if(value1!=null){
                  //  console.log(value1);
                   if(optionvalue3[index1].value=='button'){
                    trbody.append(`<td class="text-center bd-l"><input type="`+optionvalue3[index1].value+`" style="width:100%;text-align:center;" name="option`+num_k+`[]" value="ขอใบเสนอราคา"/><input type="hidden" name="optiontype`+num_k+`[]" value="`+optionvalue3[index1].value+`" /></td>`);
                   }else if(optionvalue3[index1].value=='file'){
                    trbody.append(`<td class="text-center bd-l"><a href="`+value1+`" class="btn btn-sm btn-info" target="_blank">ดูไฟล์</a> <input type="`+optionvalue3[index1].value+`" style="width:70%;text-align:left;" name="option`+num_k+`[]" id="file`+num_k+`" value="`+value1+`"/><input type="hidden" name="optiontype`+num_k+`[]" value="`+optionvalue3[index1].value+`"/></td>`);
                  }else{
                    trbody.append(`<td class="text-center bd-l"><input type="`+optionvalue3[index1].value+`" style="width:100%;text-align:center;" name="option`+num_k+`[]" value="`+value1+`"/><input type="hidden" name="optiontype`+num_k+`[]" value="`+optionvalue3[index1].value+`" /></td>`);
                   }

                   num_k++;
                 }

               });
             }
             $('#itemoption').append(trbody);
            //  console.log(trbody);
           });
         }


         /*=========end product options ============*/

			 }
		});
	};

  function delDocument(id,filename){
    if ( 'undefined' != typeof id) {

      swal({
        title: 'คุณต้องการลบไฟล์นี้?',
        text: filename,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ลบรายการนี้',
        cancelButtonText: 'ยกเลิกไม่ลบ!',
        confirmButtonClass: 'confirm-class',
        cancelButtonClass: 'cancel-class',
        closeOnConfirm: true,
        closeOnCancel: false },
        function(isConfirm) {
        if (isConfirm) {

          $.ajax({
             type: "post",
             async: false,
             url: "<?=$url;?>/<?=$get_part0;?>",
             data: {select: 'deldocument',id:id},
             dataType: "json",
             success: function(data) {
               if(data.status=="success"){
                 toastr.success(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
                 loadData();
               }else{
                 toastr.error(data.textrespon,data.msg,{timeOut: 5000,closeButton: true});
               }
             }
          });

        }else{
          swal('ยกเลิกแล้ว','ยกเลิกการลบรายการ','error');
        }
      });


    } else toastr.error('Unknown row id','',{timeOut: 5000,closeButton: true});
  }




  // begin function addRow() and delRow()
  function addRow(tableID) {
    var table = document.getElementById(tableID);

    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    var colCount = table.rows[0].cells.length;

    for(var i=0; i<colCount; i++) {

      var newcell	= row.insertCell(i);

      newcell.innerHTML = table.rows[0].cells[i].innerHTML;
      //alert(newcell.childNodes);
      switch(newcell.childNodes[0].type) {
        case "text":
            newcell.childNodes[0].value = "";
            break;
        case "color":
            newcell.childNodes[0].value = "";
            break;
        case "file":
            newcell.childNodes[0].value = "";
            break;
        case "checkbox":
            newcell.childNodes[0].checked = false;
            break;
        case "select":
            newcell.childNodes[0].selectedIndex = 0;
            break;
      }
    }
  }

  function deleteRow(tableID) {
    try {
    var table = document.getElementById(tableID);
    var rowCount = table.rows.length;

    for(var i=0; i<rowCount; i++) {
      var row = table.rows[i];
      var chkbox = row.cells[0].childNodes[0];
      if(null != chkbox && true == chkbox.checked) {
        if(rowCount <= 1) {
          swal("Warning!","ไม่สามารถลบแถวนี้ได้ เนื่องจากต้องมีคงไว้อย่างน้อย 1 แถว!.","warning");
          break;
        }
        table.deleteRow(i);
        rowCount--;
        i--;
      }

    }
    }catch(e) {
      alert(e);
    }
  }


  // add commas to currency
  function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
  }


	</script>
