<table class='paperworktable'>
					<tr> 
						<td class="header-cell-1 label-bold">&nbsp;</td>
						<td class="header-cell-2 label-bold">Pokok <span class='paperworknote'>( Rp. )</span></td>
						<td class="header-cell-3 label-bold">Bunga <span class='paperworknote'>( Rp. )</span></td>
						<td class="header-cell-4 label-bold">Total <span class='paperworknote'>( Rp. )</span></td>
					</tr>
<?php if( is_array( $data ) ) foreach( $data as $rows ) {
	
	$row = @call_user_func( 'Objective', $rows);
	printf("%s", "<tr>");
		printf("<td class='header-cell-1'>%s</td>", $row->field('label') );
		printf("<td class='header-cell-2'>%s</td>", $row->field('pokok', 'SetCurrency'));
		printf("<td class='header-cell-3'>%s</td>", $row->field('bunga', 'SetCurrency'));
		printf("<td class='header-cell-4'>%s</td>", $row->field('total', 'SetCurrency'));
		
	printf("%s", "</tr>");	
					 
}	
?>
</table>