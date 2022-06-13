<?php  
$relation_keluarga = $Lookup->_general_lookup("relation_keluarga");
?>

<div class="wraplable">
	<div class="paperworktitle">KELUARGA TIDAK SERUMAH YANG DAPAT DIHUBUNGI DALAM KEADAAN DARURAT</div>
	<table class="paperworktable">

		<tr>
			<td>Emergency Contact</td>
			<td>
				<input type="text" class="input_text tolong" name="EC_Nama" placeholder="">
			</td>

			<td>Hubungan</td>
			<td>
				<select type="combo" id="EC_Hubungan" class="select select-chosen" name="EC_Hubungan">
				<?php   
					echo "<option value='0'>- PILIH -</option>";
					foreach ( $relation_keluarga as $rk ) {
						echo "<option value='".$rk["code"]."'>".$rk["name"]."</option>";
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<td>Alamat EC</td>
			<td colspan="3"><input type="text" class="input_text tolong" name="EC_Alamat" placeholder=""></td>
		</tr>

		<tr>
			<td>Kota</td>
			<td><input type="text" class="input_text tolong" name="EC_Kota" placeholder=""></td>
		</tr>

		<tr>
			<td>Telepon EC</td>
			<td><input type="text" class="input_text tolong" name="EC_Telp" placeholder=""></td>
		</tr>
	</table>
</div>
