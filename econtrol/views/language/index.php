<div class="br-mainpanel">
  <div class="br-pageheader pd-x-5 pd-y-5 pd-md-l-10">
    <nav class="breadcrumb pd-0 mg-0 tx-14">
      <a class="breadcrumb-item" href="<?=$url;?>">Dashboard</a>
      <span class="breadcrumb-item active"><?=$pagename;?></span>
    </nav>
  </div><!-- br-pageheader -->
  <div class="br-pagebody pd-x-5 pd-sm-x-5 mg-b-15">
    <div class="adiv card bd-0 shadow-base pd-0">
      <div class="row mg-0">
        <div class="col-md-6 col-xs-12 pd-0">
          <div class="pd-5 text-left">
            <div class="input-group">
              <input type="text" class="form-control" name="search" id="searchkeyword" placeholder="ค้นหาด้วยคีย์เวิร์ด...">
              <span class="input-group-btn">
                <button class="btn bd bg-white tx-gray-600" type="submit"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-xs-12 pd-0 hidden-xs-down">
          <div class="pd-5 text-right">
    				<?php //echo getMenu_permission_button($mainmenu);?>
            <a href="javascript:history.back();" class="btn btn-secondary btn-with-icon hidden-xs-down">
							<div class="ht-40">
								<span class="icon wd-40"><i class="icon ion-reply"></i></span> <span class="pd-x-15">ย้อนกลับ</span>
							</div>
						</a>
    	    </div>
        </div>
      </div>
			<div class="gdiv col-lg-12 col-md-12 col-xs-12 col-sm-12 pd-0">
				<div class="ndiv panel">
					<div class="mdiv panel-body">
						<!--BEGIN PAGE -->
            <table id="jqGridlist"></table>
            <div id="jqGridPager"></div>
						<!--END PAGE -->
					</div>
				</div>
			</div>

    </div>
  </div><!-- br-pagebody -->
</div><!-- br-contentpanel -->


<style type="text/css">
  html { height: 100%; }
  body { height: calc(100% - 60px); }

  .br-mainpanel { height: 100%; }
  .br-pagebody { height: calc(100% - 55px); }

  .adiv { height: calc(100% - 0px); display: block; }
  .gdiv { height: calc(100% - 45px); }
  .ndiv { height: calc(100% - 10px); }
  .mdiv { height: calc(100% - 0px); }

  #gbox_jqGridlist { height: calc(100% - 35px); }
  #gview_jqGridlist { height: 100%; }

  #gview_jqGridlist .ui-jqgrid-bdiv { height: calc( 100% - 35px ) !important; }

  @media only screen and (max-width: 480px){
    .br-mainpanel { height: 100%; }
    .br-pagebody { height: calc(100% - 55px); }

    .adiv { height: calc(100% - 0px); display: block; }
    .gdiv { height: calc(100% - 50px); }
    .ndiv { height: calc(100% - 5px); }
    .mdiv { height: calc(100% - 0px); }

    #gbox_jqGridlist { height: calc(100% - 35px); }
    #gview_jqGridlist { height: 100%; }

    #gview_jqGridlist .ui-jqgrid-bdiv { height: calc( 100% - 35px ) !important; }
  }

  .ui-jqgrid,
	.ui-jqgrid-view,
	.ui-jqgrid-hdiv,
	.ui-jqgrid-htable,
	.ui-jqgrid-bdiv,
	.ui-jqgrid-btable,
	.ui-jqgrid-pager {
		width: 100% !important;
	}

	.ui-th-column-header,.ui-th-column {
		text-align: center !important;
	}

	.bggray{
		background-color: #333 !important;
		color: #fff !important;
		border: 0px !important;
	}
</style>

<script type="text/javascript">

  $(document).ready(function () {
    // $.jgrid.defaults.width = 100;
    $.jgrid.defaults.responsive = false;
    $.jgrid.defaults.styleUI = 'Bootstrap4';

    function ajax(options) {
  		return new Promise(function (resolve, reject) {
  			$.ajax(options).done(resolve).fail(reject);
  		});
  	}

  	function buttonToggle(mode) {

      	if(mode=='view') {
  			$('#btn-addrow-mf').show();
  			$('#btn-saverow-mf').hide();
  			$('#btn-cancelrow-mf').hide();

      	}
      	else {
  			$('#btn-addrow-mf').hide();
  			$('#btn-saverow-mf').show();
  			$('#btn-cancelrow-mf').show();
      	}

  	}

  	var iiRow;
  	var iiCol;
    $("#jqGridlist").jqGrid({
      url: '<?="{$url}/{$get_part0}/{$get_part1}";?>?select=loaddata',
      datatype: "json",
      colModel: [
  			{ label: '#', name: 'id', width: 20, editable: false, hidden: true, align: 'center' },
  			// { label: 'No', name: 'rownum', width: 30, editable: false, align: 'center' },
  			{ label: 'Word TH', name: 'word_th', width: 200, editable: true,
  				editrules : { required: false} },
  			{ label: 'Word EN', name: 'word_en', width: 200, editable: true,
  				editrules : { required: false} },
  			{ label: 'Created', name: 'create_date', width: 150, editable: false, align: 'left'},
  		],
			sortname: 'id',
			sortorder : 'asc',
			loadonce: false,
			viewrecords: true,
      width: null,
  		shrinkToFit: false,
  		autowidth: true,
      // page: 1,
      scroll: 1,
      rowNum: 20,
      multiselect: true,
      rowList:[20,30,50,100],
      emptyrecords: 'Scroll to bottom to retrieve new page',
      pager: "#jqGridPager",
      gridview: false,
  		cellEdit: true,
  		cellsubmit: 'remote',
  		cellurl: '<?="{$url}/{$get_part0}/{$get_part1}";?>?select=celledit',
      	jsonReader: { repeatitems : false, id: 'id' },
  		afterSubmitCell: function (serverresponse, rowid, cellname, value, iRow, iCol) {
  			if (serverresponse.responseText == 'abc') {
  				window.location.href = 'http://abc.txt';
  				return true;
  			}
  			data = JSON.parse(serverresponse.responseText);
  			if(data.status!='success') {
  				return [false, data.errmsg];
  			}
  			return [true, ''];

  		},
  		afterEditCell: function (rowid, cellname, value, iRow, iCol) {
  			iiRow = iRow;
  			iiCol = iCol;
  			if($('#'+iRow+'_'+cellname).is('textarea')) {
  				$('#'+iRow+'_'+cellname).unbind('keydown');
  				$('#'+iRow+'_'+cellname).keyup(function(e){
      				if(e.keyCode === 27)
  						$(this).jqGrid('restoreCell', iRow, iCol);
  				});
  			}
  		},
  		// gridComplete : function(data, response) {
  		// 	$('#gview_jqGridlist .ui-jqgrid-bdiv').scrollTop(0);
  		// },
  		beforeRequest: function() {
  			buttonToggle('view');
  		},
    });


    $("#jqGridlist").jqGrid('navGrid', '#jqGridPager',
		{
			edit: false,
			add: false,
			del: true,
			search:false,
		},
		{},
		{},
		{
			beforeInitData: function(formid) {
				if($('#jqGridlist').getGridParam('selrow')==='newrow')
					return false;
			},
			beforeShowForm: function (form) {
			},
			afterShowForm: function(form) {
			},

			mtype: 'POST',
			url: '<?="{$url}/{$get_part0}/{$get_part1}";?>?select=deleteselect',
			afterSubmit : function (response, postdata) {
				data = JSON.parse(response.responseText);
				if(data.status!='success')
					return [false, data.errmsg];

				return [true, ''];
			},
			reloadAfterSubmit: false,
			closeOnEscape: true,
			bottominfo: 'Fields marked with (*) are required.'
		}
	);


	var addparameters = {
		rowID : 'newrow',
		addRowParams: {
			keys: true,
			url: '<?="{$url}/{$get_part0}/{$get_part1}";?>?select=celledit',
			extraparam: {},
			errorfunc: null,
			restoreAfterError: false,
			mtype: 'POST',
			oneditfunc: function() {
				buttonToggle('edit');
			},
			afterrestorefunc: function() {
				buttonToggle('view');
			},
			successfunc: function(response ) {
				data = JSON.parse(response.responseText);
				if(data.status!='success') {
					swal('คำเตือน', data.errmsg, 'error');
					return false;
				}

				setTimeout(function() {
					$('tr#newrow').attr('id', data.newrow_id);
					$('#jqg_'+'jqGridlist_'+'newrow').attr('id', 'jqg'+'jqGridlist_'+data.newrow_id);
				}, 100);
				buttonToggle('view');
				return true;
			}
		}
	};

	$('#jqGridlist').jqGrid('navButtonAdd','#jqGridPager', {
		id:'btn-addrow-mf',
    	caption:'',
    	buttonicon:'oi-plus',
    	title:'เพิ่มข้อมูล',
    	cursor: 'pointer',
    	onClickButton: function(){
			$('#jqGridlist').jqGrid('restoreCell', iiRow, iiCol);
			$('#jqGridlist').jqGrid('resetSelection');
			$('#jqGridlist').jqGrid('addRow', addparameters);
		},
	} );

	$('#jqGridlist').jqGrid('navButtonAdd','#jqGridPager', {
		id:'btn-saverow-mf',
		caption:'',
		buttonicon:'oi-check',
		title:'บันทึก',
		cursor: 'pointer',
		onClickButton: function(){
			$('#jqGridlist').jqGrid('saveRow', 'newrow', addparameters.addRowParams );
		},
	});

	$('#jqGridlist').jqGrid('navButtonAdd','#jqGridPager', {
		id:'btn-cancelrow-mf',
    	caption:'',
    	buttonicon:'oi-action-undo',
    	title:'ยกเลิก',
    	cursor: 'pointer',
    	onClickButton: function(){
			$('#jqGridlist').jqGrid('restoreRow', 'newrow');
			buttonToggle('view');
		},
	});

	buttonToggle('view');


  /* =====================================================================*/
	$("#searchkeyword").on('change',function(e){
		e.preventDefault();
    $('#gmail_loading').show();
    var search = $(this).val();
    // alert(search);
    // return false;
    var newurl= '<?=$url;?>/<?=$get_part0;?>/<?=$get_part1;?>?select=loaddata&search='+search;
    $("#jqGridlist").jqGrid().setGridParam({url : newurl,datatype: "json"}).trigger("reloadGrid");

    $('#gmail_loading').hide();
	});



});

</script>
