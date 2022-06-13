<p>Date from : <?php echo $param->get_value("start_date" , "_getDateEnglish"); ?> <br>
   To        : <?php echo $param->get_value("end_date" , "_getDateEnglish"); ?></p>

<h4>Reporting - Data Tapenas</h4>
<table border="1">
	<tr>
		<th>No</th>
		<th>Prospect Name</th>
		<th>No. Rek</th>
		<th>Branch Name</th>
		<th>Setoran Bulanan Sebelum</th>
		<th>Setoran Tambahan</th>
		<th>Setoran Bulanan Sesudah</th>
		<th>Tenor Sebelum</th>
		<th>Tenor Tambahan</th>
		<th>Tenor Sesudah</th>
		<th>Agent Code</th>
		<th>SPV Code</th>
		<th>QC Code</th>
		<th>Close Deal</th>
	</tr>
	
		<?php
		if ( $data_tapenas != false ) {
			$no = 1;
			foreach ( $data_tapenas->result_array() as $dt ){
			//print_r($dt); 
		?>
		
	<tr>
		<td><?php echo $no++; ?></td>
		<td><?php echo $dt['DM_FirstName']; ?></td>
		<td><?php echo $dt['TapenasNoRekening']; ?></td>
		<td><?php echo $dt['TapenasKodeWilayah']; ?></td>
		<td><?php echo $dt['TR_SetoranSebelum']; ?></td>
		<td><?php echo $dt['TR_SetoranTambahan']; ?></td>
		<td><?php echo $dt['TR_SetoranTotal']; ?></td>
		<td><?php echo $dt['TR_TenorSebelum']; ?></td>
		<td><?php echo $dt['TR_TenorTambahan']; ?></td>
		<td><?php echo $dt['TR_TenorTotal']; ?></td>
		<td><?php echo $dt['Agent_Code']; ?></td>
		<td><?php echo $dt['Spv_Code']; ?></td>
		<td><?php echo $dt['Qc_Code']; ?></td>
		<td></td>
	</tr>
		<?php
			}
		}
		?>	
</table>