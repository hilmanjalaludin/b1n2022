 
<div class="ui-widget-form-table-compact table-body-content">
	<div class="table-row-extend  table-row-header" style="width:100%;">
		<div class="table-cell-header-extend ui-corner-top table-cell-header center">No</div>
		<div class="table-cell-header-extend ui-corner-top table-cell-header center">Agent</div>
		<div class="table-cell-header-extend ui-corner-top table-cell-header center">Ext</div>
		<div class="table-cell-header-extend ui-corner-top table-cell-header center">Status</div>
		<div class="table-cell-header-extend ui-corner-top table-cell-header center">Status Time</div>
		<div class="table-cell-header-extend ui-corner-top table-cell-header center">Ext Status</div>
		<div class="table-cell-header-extend ui-corner-top table-cell-header center">Data</div>
		<div class="table-cell-header-extend ui-corner-top table-cell-header center">Action</div>
	</div>
 
	<?php 
	$num = 0;
	foreach( $row as $key => $row_agent ) {  
		$num++;
		$data = Objective( $row_agent ); 
		$selectdata  = ( $num%2 == 0 ? 'table-cell-selcted-one' : 'table-cell-selcted-two' );
		$userfullname = sprintf("<b> %s </b>- %s", $data->field('UserId'), $data->field('Fullname','strtoupper'));
		
	?>

	<div class="table-row-extend ui-extend-pager-row-1 <?php echo $selectdata; ?> onselect panel-<?php echo $data->field('UserId');?>">
		<div class="table-cell-content-extend table-cell-content center"><?php echo $num; ?></div>
		<div class="table-cell-content-extend table-cell-content left"><?php echo $userfullname; ?></div>
		<div class="table-cell-content-extend table-cell-content center <?php echo $data->field('extension');?>"></div>
		<div class="table-cell-content-extend table-cell-content center <?php echo $data->field('agentstatus');?>"></div>
		<div class="table-cell-content-extend table-cell-content center <?php echo $data->field('timestatus');?>"></div>
		<div class="table-cell-content-extend table-cell-content center <?php echo $data->field('extstatus');?>"></div>
		<div class="table-cell-content-extend table-cell-content left <?php echo $data->field('datastatus');?>"></div>
		<div class="table-cell-content-extend table-cell-content center" style="padding:3px 0px 3px 0px;">
			<button class="btn btn-style-<?php echo $data->field('UserId');?> btn-info btn-xs ui-btn-automax"><i class="fa fa-headphones"></i>&nbsp;Spy</button>
			<button class="btn btn-style-<?php echo $data->field('UserId');?> btn-info btn-xs ui-btn-automax"><i class="fa fa-phone"></i>&nbsp;Coach </button>
		</div>
	</div>
	
<?php } ?>	 
</div>
