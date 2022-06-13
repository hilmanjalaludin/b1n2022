<div class="ui-widget-form-table table-body-content">

  <div class="table-row-extend ui-widget-header table-row-header">
  <?php
    if(is_array($label))  
	foreach( $label as $key => $Head ){
		printf("<div class='table-cell-header-extend ui-corner-top table-cell-header center'>%s</div>", $Head); 
   } 
  ?>	
  </div>
  <?php $num_row = 0;
	if(is_array($rowdata)) 
	  foreach( $rowdata as $Tn => $Row )
	{
		
		foreach( $Row as $key => $val ){
	 // convert object data process 'OK' 	
		$row = Objective( $val );
		//debug($row);
			
	// customize select-row 
		$selectRowClass = ( ( $num_row%2 ) == 0 ? 'table-cell-selcted-one' 
								: 'table-cell-selcted-two' );
			
	// print of row data selected tabs .
		printf("<div class='table-row-extend %s'>", $selectRowClass);
		printf("<div class='table-cell-content-extend table-cell-content center'>%s</div>", $row->field('TX_Rate') );
		printf("<div class='table-cell-content-extend table-cell-content right'>%s</div>",	$row->field('TX_Dana') );
		printf("<div class='table-cell-content-extend table-cell-content center'>%s</div>", $row->field('TX_Tenor') );
		printf("<div class='table-cell-content-extend table-cell-content right'>%s</div>", 	$row->field('TX_Pokok') );
		printf("<div class='table-cell-content-extend table-cell-content right'>%s</div>", 	$row->field('TX_Bunga') );
		printf("<div class='table-cell-content-extend table-cell-content right'>%s</div>", 	$row->field('TX_Total') );
		printf("%s","</div>");
	// print testing data OK -- row --- 
		$num_row++;
		}
	}
	
	?>
</div>
