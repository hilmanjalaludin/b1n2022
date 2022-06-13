<table class="paperworktable" nowrap>
	<tr>
		<td class="ui-data-cell-1 center">Transaksi No.</td>
		<td class="ui-data-cell-1 center">Setoran Sebelum</td>
		<td class="ui-data-cell-1 center">Setoran Tambahan</td>
		<td class="ui-data-cell-1 center">Setoran Total</td>
		<td class="ui-data-cell-1 center">Tenor Sebelum</td>
		<td class="ui-data-cell-1 center">Tenor Tambahan</td>
		<td class="ui-data-cell-1 center">Tenor Total</td>
	</tr>		
	
	<?php
		//print_r($CekRowTapenas);
		if ( $CekRowTapenas != false ) {
			$no = 1;
	?>

		<tr>	
			<td class="ui-data-cell-1 center"><?php echo $no; ?></td>
			<td class="ui-data-cell-1 center"><?php echo $CekRowTapenas['TR_SetoranSebelum'] ?></td>
			<td class="ui-data-cell-1 center"><?php echo $CekRowTapenas['TR_SetoranTambahan'] ?></td>
			<td class="ui-data-cell-1 center"><?php echo $CekRowTapenas['TR_SetoranTotal'] ?></td>
			<td class="ui-data-cell-1 center"><?php echo $CekRowTapenas['TR_TenorSebelum'] ?></td>
			<td class="ui-data-cell-1 center"><?php echo $CekRowTapenas['TR_TenorTambahan'] ?></td>
			<td class="ui-data-cell-1 center"><?php echo $CekRowTapenas['TR_TenorTotal'] ?></td>
		</tr>

	<?php 
		}
	?>	
</table>
	