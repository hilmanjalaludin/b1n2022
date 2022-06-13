<?php 

$relation_addon = $Lookup->_general_lookup("relation_addon");

?>
<div class="wraplable">
	<div class="paperworktitle">ADDITIONAL ADDON XSELL</div>
	
	<input type="hidden" id="totaladdon" value="0" name="totaladdon">
	<input type="hidden" id="transactionid" value="" name="transactionid">
	<input type="hidden" id="addoncancel" value="" name="addoncancel">
	
	
	<table class="paperworktable">
		<tr>
			<td><input class="dualcardagree" addon="1" value="" id="ADDON_1" type="checkbox" class="input_text tolong" name="ADDON_1" placeholder="" disabled> ADDON 1</td>
			<td>Nama</td>
			<td colspan="2"><input type="text" class="input_text tolong" id="ADDON_Nama_Kartu_1" name="ADDON_Nama_Kartu_1" placeholder=""></td>
		</tr>

		<tr>
			<td></td>
			<td>DOB</td>
			<td>
			<input type="text" class="input_text" id="ADDON_Umur_1" name="ADDON_Umur_1" placeholder="">
			</td>
			<td><input type="text" class="input_text tolong" id="ADDON_DOB_1" name="ADDON_DOB_1" placeholder=""></td>
		</tr>

		<tr>
			<td></td>
			<td>Jenis Kartu</td>
			<td colspan="2">
				<select type="combo" id="ADDON_Jenis_Kartu_1" name="ADDON_Jenis_Kartu_1" class="select cardtypeaddon tolong select-chosen">
					<option value="">- PILIH -</option>
					<option value="1">Kartu Pertama</option>
				</select>
			</td>
		</tr>

		<tr>
			<td></td>
			<td>Relation</td>
			<td colspan="2">
				<select type="combo" id="ADDON_Hubungan_1" name="ADDON_Hubungan_1" class="select tolong select-chosen">
				<?php   
					echo "<option value=''>- PILIH -</option>";
					foreach ( $relation_addon as $ra ) {
						echo "<option value='".$ra["code"]."'>".$ra["name"]."</option>";
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<td></td>
			<td>Jenis Kelamin</td>
			<td colspan="2">
				<input type="radio" class="ADDON_Jenis_Kelamin_1" id="ADDON_Jenis_Kelamin_1" name="ADDON_Jenis_Kelamin_1" value="1" placeholder=""> P
				<input type="radio" class="ADDON_Jenis_Kelamin_1" id="ADDON_Jenis_Kelamin_1" name="ADDON_Jenis_Kelamin_1" value="2" placeholder=""> W
			</td>
		</tr>

		<tr>
			<td></td>
			<td>Phone Num</td>
			<td colspan="2"><input type="text" class="input_text tolong" id="ADDON_No_Hp_1" name="ADDON_No_Hp_1" placeholder=""></td>
		</tr>

		<tr>
			<td><input class="dualcardagree" addon="2" value="" id="ADDON_2" type="checkbox" class="input_text tolong" name="ADDON_2" placeholder="" disabled> ADDON 2</td>
			<td>Nama</td>
			<td colspan="2"><input type="text" class="input_text tolong" id="ADDON_Nama_Kartu_2" name="ADDON_Nama_Kartu_2" placeholder=""></td>
		</tr>

		<tr>
			<td></td>
			<td>DOB</td>
			<td>
			<input type="text" class="input_text" id="ADDON_Umur_2" name="ADDON_Umur_2" placeholder="">
			</td>
			<td><input type="text" class="input_text tolong" id="ADDON_DOB_2" name="ADDON_DOB_2" placeholder=""></td>
		</tr>

		<tr>
			<td></td>
			<td>Jenis Kartu</td>
			<td colspan="2">
				<select type="combo" id="ADDON_Jenis_Kartu_2" name="ADDON_Jenis_Kartu_2" class="select cardtypeaddon tolong select-chosen">
					<option value="">- PILIH -</option>
					<option value="1">Kartu Pertama</option>
				</select>
			</td>
		</tr>

		<tr>
			<td></td>
			<td>Relation</td>
			<td colspan="2">
				<select type="combo" id="ADDON_Hubungan_2" name="ADDON_Hubungan_2" class="select tolong select-chosen">
				<?php   
					echo "<option value=''>- PILIH -</option>";
					foreach ( $relation_addon as $ra ) {
						echo "<option value='".$ra["code"]."'>".$ra["name"]."</option>";
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<td></td>
			<td>Jenis Kelamin</td>
			<td colspan="2">
				<input type="radio" class="ADDON_Jenis_Kelamin_2" id="ADDON_Jenis_Kelamin_2" name="ADDON_Jenis_Kelamin_2" value="1" placeholder=""> P
				<input type="radio" class="ADDON_Jenis_Kelamin_2" id="ADDON_Jenis_Kelamin_2" name="ADDON_Jenis_Kelamin_2" value="2" placeholder=""> W
			</td>
		</tr>

		<tr>
			<td></td>
			<td>Phone Num</td>
			<td colspan="2"><input type="text" class="input_text tolong" id="ADDON_No_Hp_2" name="ADDON_No_Hp_2" placeholder=""></td>
		</tr>

		<tr>
			<td><input class="dualcardagree" addon="3" value="" id="ADDON_3" type="checkbox" class="input_text tolong" name="ADDON_3" placeholder="" disabled> ADDON 3</td>
			<td>Nama</td>
			<td colspan="2"><input type="text" class="input_text tolong" id="ADDON_Nama_Kartu_3" name="ADDON_Nama_Kartu_3" placeholder=""></td>
		</tr>

		<tr>
			<td></td>
			<td>DOB</td>
			<td>
			<input type="text" class="input_text" id="ADDON_Umur_3" name="ADDON_Umur_3" placeholder="">
			</td>
			<td><input type="text" class="input_text tolong" id="ADDON_DOB_3" name="ADDON_DOB_3" placeholder=""></td>
		</tr>

		<tr>
			<td></td>
			<td>Jenis Kartu</td>
			<td colspan="2">
				<select type="combo" id="ADDON_Jenis_Kartu_3" name="ADDON_Jenis_Kartu_3" class="select cardtypeaddon tolong select-chosen">
					<option value="">- PILIH -</option>
					<option value="1">Kartu Pertama</option>
				</select>
			</td>

		</tr>

		<tr>
			<td></td>
			<td>Relation</td>
			<td colspan="2">
				<select type="combo" name="ADDON_Hubungan_3" id="ADDON_Hubungan_3" class="select tolong select-chosen">
				<?php   
					echo "<option value=''>- PILIH -</option>";
					foreach ( $relation_addon as $ra ) {
						echo "<option value='".$ra["code"]."'>".$ra["name"]."</option>";
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<td></td>
			<td>Jenis Kelamin</td>
			<td colspan="2">
				<input type="radio" class="ADDON_Jenis_Kelamin_3" id="ADDON_Jenis_Kelamin_3" name="ADDON_Jenis_Kelamin_3" value="1" placeholder=""> P
				<input type="radio" class="ADDON_Jenis_Kelamin_3" id="ADDON_Jenis_Kelamin_3" name="ADDON_Jenis_Kelamin_3" value="2" placeholder=""> W
			</td>
		</tr>

		<tr>
			<td></td>
			<td>Phone Num</td>
			<td colspan="2"><input type="text" class="input_text tolong" id="ADDON_No_Hp_3" name="ADDON_No_Hp_3" placeholder=""></td>
		</tr>

    <tr>
      <td colspan="2"><button class="submit-button"><i class="fa fa-save" aria-hidden="true"></i> <b>SAVE</b></button></td>
      <td colspan="2"><button class="reset-button"><i class="fa fa-close" aria-hidden="true"></i> <b>CANCEL</b></button></td>
    </tr>


	</table>


</div>
