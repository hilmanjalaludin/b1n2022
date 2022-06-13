<?php
	if ( isset($DetailJs["ntb"]) && count($DetailJs["ntb"]) > 0  ) {
		$CM = new EUI_object(array());
	}
?>
<div class="wraplable">
	<div class="paperworktitle">INFORMASI LAINNYA</div>
	<table class="paperworktable">

		<tr>
			<td>No Kartu Kredit</td>
			<td>
				<input type="text" class="input_text tolong" name="OTHER_No_Kartu_Credit" placeholder="">
			</td>

			<td>Nama Bank</td>
			<td>
				<input type="text" class="input_text tolong" name="OTHER_Nama_Bank" placeholder="">
			</td>
		</tr>

		<tr>
			<td>Minat Fleksi</td>
			<td><input type="radio" class="" name="OTHER_Perisai_Plus" placeholder="" value = "1"> Y
			<input type="radio" class="tolong" name="OTHER_Perisai_Plus" placeholder="" value = "0"> N</td>

			<td>No Polis </td>
			<td>
				<input type="text" class="input_text tolong" name="OTHER_No_Polis" placeholder="">
			</td>
		</tr>

		<tr>
			<td>Nama Cabang Pembuka</td>
			<td>
				<input type="text" class="input_text tolong" name="OTHER_Nama_Asuransi" placeholder="" value="<?php echo $CM->get_value("DM_NamaCabang");?>">
			</td>

			<td>Tenor Pinjaman</td>
			<td>
				<input type="text" class="input_text tolong" name="OTHER_Other1" placeholder="" value="<?php echo $CM->get_value("DM_Tenor");?>">
			</td>
		</tr>

		<tr>
			<td>Bunga Pinjaman</td>
			<td>
				<input type="text" class="input_text tolong" name="OTHER_Other2" placeholder="" value="<?php echo $CM->get_value("DM_Wilayah");?>">
			</td>

			<td>Other3</td>
			<td>
				<input type="text" class="input_text tolong" name="OTHER_Other3" placeholder="">
			</td>
		</tr>

		<tr>
			<td>Other4</td>
			<td>
				<input type="text" class="input_text tolong" name="OTHER_Other4" placeholder="">
			</td>

			<td>Other5</td>
			<td>
				<input type="text" class="input_text tolong" name="OTHER_Other5" placeholder="">
			</td>
		</tr>

		<tr>
			<td>Other6</td>
			<td>
				<input type="text" class="input_text tolong" name="OTHER_Other6" placeholder="">
			</td>
		</tr>

	</table>
</div>
