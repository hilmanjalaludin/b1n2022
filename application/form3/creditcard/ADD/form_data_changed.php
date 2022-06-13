<?php
	// if(is_array($AddTrans)){
		// $AddTrans = new EUI_Object($AddTrans);
	// }
?>
<div class="wraplable">

	<input type="hidden" name="CustomerNumber" value="<?php echo $CustomerNumber; ?>">
	<input type="hidden" class="FRM_ADDON_Id" name="FRM_ADDON_Id" value="<?php echo $AddTrans["TR_ADDONID"]; ?>">
	
	<div class="paperworktitle">IF DATA CHANGED IS NEEDED</div>
	<table class="paperworktable">

		<tr>
			<td>Alamat Kirim Kartu 1</td>
			<td colspan="3"><input value="<?php echo $AddTrans["DB_Alamat_Krim_1"]; ?>" type="text" class="input_text tolong" name="DB_Alamat_Krim_1" placeholder=""></td>
		</tr>

		<tr>
			<td>Alamat Kirim Kartu 2</td>
			<td colspan="3"><input value="<?php echo $AddTrans["DB_Alamat_Krim_2"]; ?>" type="text" class="input_text tolong" name="DB_Alamat_Krim_2" placeholder=""></td>
		</tr>

		<tr>
			<td>Alamat Kirim Kartu 3</td>
			<td colspan="3"><input value="<?php echo $AddTrans["DB_Alamat_Krim_3"]; ?>" type="text" class="input_text tolong" name="DB_Alamat_Krim_3" placeholder=""></td>
		</tr>

		<tr>
			<td>Alamat Kirim Kartu 4</td>
			<td colspan="3"><input value="<?php echo $AddTrans["DB_Alamat_Krim_4"]; ?>" type="text" class="input_text tolong" name="DB_Alamat_Krim_4" placeholder=""></td>
		</tr>

		<tr>
			<td>Kota</td>
			<td colspan="3"><input value="<?php echo $AddTrans["DB_Kota"]; ?>" type="text" class="input_text tolong" name="DB_Kota" placeholder=""></td>
		</tr>

		<tr>
			<td>Kode Pos</td>
			<td colspan="3"><input maxlength="5" value="<?php echo $AddTrans["DB_Kode_Pos"]; ?>" type="text" class="number input_text tolong" name="DB_Kode_Pos" placeholder=""></td>
		</tr>

		<tr>
			<td>Home Num</td>
			<td colspan="3"><input value="<?php echo $AddTrans["DB_Home_Phone"]; ?>" type="text" class="input_text tolong" name="DB_Home_Phone" placeholder=""></td>
		</tr>

		<tr>
			<td>Mobile Num</td>
			<td colspan="3"><input value="<?php echo $AddTrans["DB_Mobil_Phone"]; ?>" type="text" class="input_text tolong" name="DB_Mobil_Phone" placeholder=""></td>
		</tr>

		<tr>
			<td>Office Num</td>
			<td colspan="3"><input value="<?php echo $AddTrans["DB_Office_Phone"]; ?>" type="text" class="input_text tolong" name="DB_Office_Phone" placeholder=""></td>
		</tr>

    <tr>
      <td colspan="2"><button class="submit-button"><i class="fa fa-save" aria-hidden="true"></i> <b>SAVE</b></button></td>
      <td colspan="2"><button class="reset-button"><i class="fa fa-close" aria-hidden="true"></i> <b>CANCEL</b></button></td>
    </tr>

	</table>
</div>
