
<fieldset class="corner ui-panel-group-header">
<?php echo form()->legend(lang("Search Data"), "fa-search"); ?>
<form name="frmKodepos" onsubmit="return false;">
<div class="ui-widget-form-table" style="width:99%;margin-top:-10px !important">

 <div class="ui-widget-form-row">
	<div class="ui-widget-form-cell text_caption">Provinsi</div>
	<div class="ui-widget-form-cell">:</div>
	<div class="ui-widget-form-cell"><?php echo form()->input('KDP_Provinsi','input_text long u-max-length', null);?></div>
	<div class="ui-widget-form-cell text_caption">Kabupaten/Kota</div>
	<div class="ui-widget-form-cell">:</div>
	<div class="ui-widget-form-cell"><?php echo form()->input('KDP_Kabupaten','input_text long u-max-length', null);?></div>
  </div>
  
  <div class="ui-widget-form-row">
  
	<div class="ui-widget-form-cell text_caption">Kecamatan</div>
	<div class="ui-widget-form-cell">:</div>
	<div class="ui-widget-form-cell"><?php echo form()->input('KDP_Kecamatan','select long u-max-length', null, null );?></div>
	<div class="ui-widget-form-cell text_caption">Kelurahan</div>
	<div class="ui-widget-form-cell">:</div>
	<div class="ui-widget-form-cell"><?php echo form()->input('KDP_Kelurahan','select long u-max-length',  null, null );?></div>

 </div>
  
    <div class="ui-widget-form-row">
  
	<div class="ui-widget-form-cell text_caption">Kode Pos</div>
	<div class="ui-widget-form-cell">:</div>
	<div class="ui-widget-form-cell"><?php echo form()->input('KDP_ZipKode','select long u-max-length', null, null );?></div>
	<div class="ui-widget-form-cell text_caption">&nbsp;</div>
	<div class="ui-widget-form-cell"></div>
	<div class="ui-widget-form-cell">
		<button class="btn btn-info btn-xs button-max" onclick="window.EventSearchData(this);">
			<i class="fa fa-search"></i>&nbsp;Search</button>
			
		<button class="btn btn-info btn-xs button-max" onclick="window.EventClearData(this);">
			<i class="fa fa-refresh"></i>&nbsp;Clear</button>
			
		</div>
	
 </div>
</div>
</form>
</fieldset>
