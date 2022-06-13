<?php
$relation_addon = $Lookup->_general_lookup("relation_addon");
$gender = $Lookup->_general_lookup("gender");
$selected = "";
?>

<div class="wraplable" id="addon_1">
	<div class="paperworktitle" id="titles_1">DATA PADA KARTU TAMBAHAN 1</div>
	<input type="hidden" class="CustomerNumber" name="CustomerNumber1" id="CustomerNumber1" value="<?php echo $CustomerNumber; ?>">
	<input type="hidden" class="FRM_ADDON_Id" name="FRM_ADDON_Id_1" id="FRM_ADDON_Id_1" value="<?php echo $AddTrans["TR_Id"]; ?>">
	<input type="hidden" class="FRM_ADDON_Ke" name="FRM_ADDON_Ke_1" id="FRM_ADDON_Ke_1" value="1">

	<table class="paperworktable">
		<tr>
			<td>Nama Kartu Tambahan</td>
			<td><input type="text" value="<?php echo $Detail->get_value("ADDON_Nama_Kartu"); ?>" class="input_text tolong" name="ADDON_Nama_Kartu_1" id="ADDON_Nama_Kartu_1" placeholder="" maxlength="20"></td>
			<td>Hubungan</td>
			<td><select type="combo" id="ADDON_Hubungan_1" class="select select-chosen" name="ADDON_Hubungan_1">
				<?php   
					echo "<option value=''>- PILIH -</option>";
					foreach ( $relation_addon as $ra ) {
						if ( $ra["code"] == $Detail->get_value("ADDON_Hubungan") ) $selected = " selected='selected '";
						echo "<option $selected value='".$ra["code"]."'>".$ra["name"]."</option>";
					}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td>DOB</td>
			<td><input type="text" style="width:20%;" value="<?php echo $Detail->get_value("ADDON_Umur"); ?>" class="" id="ADDON_Umur_1" name="ADDON_Umur_1" placeholder="">
				<input type="text" style="width:70%;" value="<?php echo $Detail->get_value("ADDON_DOB"); ?>" class="input_text tolong fate" id="ADDON_DOB_1" name="ADDON_DOB_1" placeholder=""></td>
			<td>Jenis Kartu</td>
			<td><select type="combo" id="ADDON_Jenis_Kartu_1" class="select select-chosen" name="ADDON_Jenis_Kartu_1">
				<?php
					$CardReguler = $Lookup->CardReguler();
					echo "<option value=''>- PILIH -</option>";
					foreach ( $CardReguler as $cd ) {
						if ( $cd["id"] == $Detail->get_value("ADDON_Jenis_Kartu") ) $selected = " selected='selected '";
						echo "<option $selected trigger='".$cd["trigger"]."' value='".$cd["id"]."'>".$cd["name"]."</option>";
					}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="3">Jenis Kelamin</td>
			<td><select type="combo" class="select select-chosen" name="ADDON_Jenis_Kelamin_1" id="ADDON_Jenis_Kelamin_1">
				<?php
					echo "<option value=''>- PILIH -</option>";
					foreach ( $gender as $gd ) {
						if ( $gd["code"] == $Detail->get_value("ADDON_Jenis_Kelamin") ) $selected = " selected='selected '";
						echo "<option $selected value='".$gd["code"]."'>".$gd["name"]."</option>";
					}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="3">No. Hp</td>
			<td><input type="text" value="<?php echo $Detail->get_value("ADDON_No_Hp"); ?>" class="input_text tolong" id="ADDON_No_Hp_1" name="ADDON_No_Hp_1" placeholder=""></td>
		</tr>
		<tr>
			<td colspan="2">
				<button class="submit-button" type="submit" id="saveaddon1"><i class="fa fa-save" aria-hidden="true"></i> <b>SAVE</b></button>
				<!-- u tton class="submit-button" type="button" id="saveaddon1" onclick="SaveAddon(this.id)"><i class="fa fa-save" aria-hidden="true"></i> <b>SAVE</b></butto n -->
			</td>
			<td><button class="reset-button" type="button" id='cancel1' onclick="removeAddon(this.id)"><i class="fa fa-close" aria-hidden="true"></i> <b>CANCEL</b></button></td>
			<td><button class="reset-button" type="button" id='addnew1' onclick="duplicates()"><i class="fa fa-new" aria-hidden="true"></i> <b>ADD</b></button></td>
		</tr>
	</table>
</div>


