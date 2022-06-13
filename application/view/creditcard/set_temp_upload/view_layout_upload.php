<?php
	$result_array = array();
	for( $i = 1; $i<= count($fields); $i++ )
		$result_array[$i] = $i;
?>

<fieldset class="corner ui-widget-fieldset" style="margin:-5px 2px 2px -5px; padding:8px 15px 8px 15px;">
<?php echo form()->legend(lang("Layout Upload / Insert"),"fa-pencil");?>
	<div class="ui-widget-form-table table-body-content">
		<div class="table-row-extend ui-widget-header table-row-header">
			<div class="table-cell-header-extend ui-corner-top table-cell-header center" ><?php echo form()->checkbox('CheckAll',null,null,array("click"=>"Ext.Cmp('field_num').setChecked();")); ?></div>
			<div class="table-cell-header-extend ui-corner-top table-cell-header center" ><?php echo lang('Field');?></div>
			<div class="table-cell-header-extend ui-corner-top table-cell-header center" ><?php echo lang('Label');?></div>
			<div class="table-cell-header-extend ui-corner-top table-cell-header center" ><?php echo lang('Order');?></div>
		</div>
		
	<?php  $num_row = 1;
			foreach( $fields as $key => $value ) { ?>
			<div class="table-row-extend">
				<div class="table-cell-content-extend table-cell-content center" style="padding:5px 2px 5px 2px;"><?php echo form()->checkbox("field_num", 'jlistbox', $num_row ); ?></div>
				<div class="table-cell-content-extend table-cell-content left"   style="padding:5px 2px 5px 2px;"><?php echo form()->combo(sprintf("field_names_%s", $num_row),  'select long', 		$select, $value ); ?></div>
				<div class="table-cell-content-extend table-cell-content left"   style="padding:5px 2px 5px 2px;"><?php echo form()->input(sprintf("field_label_%s", $num_row),  'input_text long', 	$value ); ?></div>
				<div class="table-cell-content-extend table-cell-content left"   style="padding:5px 2px 5px 2px;"><?php echo form()->combo(sprintf("field_order_%s", $num_row),  'select box', 		$result_array, $num_row); ?></div>
			</div>
		<?php 
			$num_row++;
		} ?>
	</div> 
</fieldset>