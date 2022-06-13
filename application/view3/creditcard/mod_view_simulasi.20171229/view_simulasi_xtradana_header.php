<div class="ui-widget-form-table" style="width:99%;">

 <div class="ui-widget-form-row">
	<div class="ui-widget-form-cell text_caption">Dana Yang Di Ambil</div>
	<div class="ui-widget-form-cell">:</div>
	<div class="ui-widget-form-cell"><?php echo form()->input('txJsDana','input_text long u-max-length', $dataheader->field('JumlahDana') );?></div>
	<div class="ui-widget-form-cell text_caption">(%) Rate</div>
	<div class="ui-widget-form-cell">:</div>
	<div class="ui-widget-form-cell"><?php echo form()->input('txJsRate','input_text long u-max-length disabled', $rowdata->field('CV_Data_Penawaran','SetRealPercent'));?></div>
  </div>
  
  <div class="ui-widget-form-row">
	<div class="ui-widget-form-cell text_caption">Tenor /Jangka Waktu</div>
	<div class="ui-widget-form-cell">:</div>
	<div class="ui-widget-form-cell"><?php echo form()->combo('txJsTenor','select long u-max-length disabled', Tenor(), null, array('change' => 'window.EventProcessXtradana(this);') );?></div>
	<div class="ui-widget-form-cell text_caption">&nbsp;</div>
	<div class="ui-widget-form-cell"></div>
	<div class="ui-widget-form-cell"><button class="btn btn-info btn-xs button-max" onclick="window.EventProcessXtradana(this);"><i class="fa fa-search"></i>&nbsp;Process</button></div>
  </div>
  
</div>
