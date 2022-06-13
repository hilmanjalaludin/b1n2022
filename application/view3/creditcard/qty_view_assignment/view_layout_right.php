<fieldset class="corner" style="width:98%;margin:15px 5px 5px 5px; padding:8px;border-radius:5px;">
<?php echo form()->legend(lang("Assign Data"),"fa-pencil");?>
<form name="filterQualityAssignment">

<div class="ui-widget-form-table-left">
	<div class='ui-widget-form-row'>
		<div class='ui-widget-form-cell text_caption'><?php echo lang("SPV");?></div>
		<div class='ui-widget-form-cell text_caption center'>:</div>
		<div class='ui-widget-form-cell'>
			<?php echo form()->combo('SPVId','select long xzselect',Leader(), null, array('change' => 'Ext.DOM.DetailAssignment(this);') ); ?>
		</div>	
	</div>

	<div class='ui-widget-form-row'>
		<div class='ui-widget-form-cell text_caption'><?php echo lang("Method");?></div>
		<div class='ui-widget-form-cell text_caption center'>:</div>
		<div class='ui-widget-form-cell'>
			<?php echo form()->combo('submit_filter','select long xzselect',array('CHECKED'=> 'CHECKED','AMOUNT' => 'AMOUNT'), null, array('change' => 'Ext.DOM.DetailAssignment(this);') ); ?>
			<?php echo form()->checkbox('submit_filte_all',null,1,array("change" =>"Ext.DOM.OpenAllGrid(this);"));?><?php echo lang("Open All Grid");?>
		</div>	
	</div>
	
	
	<div class='ui-widget-form-row'>
		<div class='ui-widget-form-caption-top text_caption'></div>
		<div class='ui-widget-form-cell center'></div>
		<div class='ui-widget-form-cell' id="result_content_combo"></div>	
	</div>
	
	
	<div class='ui-widget-form-row'>
		<div class='ui-widget-form-cell text_caption'></div>
		<div class='ui-widget-form-cell text_caption center'></div>
		<div class='ui-widget-form-cell'><?php echo form() -> button('Assign','assign button','Assign', array('click' => 'Ext.DOM.AssignData();')); ?></div>	
	</div>
</div>
</div>
<!--

	<div> 
		<table border=0 cellspacing=0 width='100%'>
			<tr>
				<td class='text_caption bottom' width='12%'>Method </td> 
				<td class='bottom'>
					<?php __(); ?> 
				</td>
			</tr>
			<tr>	
				<td class='text_caption left'>&nbsp;</td> 
				<td align='left'><div id='result_content_combo'>&nbsp;</div></td>
			</tr>	
			<tr>	
				<td class='text_caption bottom' nowrap>Quality Staff</td> 
				<td class='bottom'><?php __(); ?></td>
			</tr>	
			
			<tr>	
				<td class='text_caption bottom'>&nbsp;</td> 
				<td class='bottom'><?php __(); ?></td>
			</tr>	
		</table>
	</div>-->
	
</fieldset>