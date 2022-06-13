<?php
$relation_addon = $Lookup->_general_lookup("relation_addon");
$gender 	= $Lookup->_general_lookup("gender");
$selected = "";
?>

<div class="wraplable">
	<div class="paperworktitle">DATA PADA KARTU TAMBAHAN 3</div>
	<input type="hidden" class="FRM_ADDON_Id" name="FRM_ADDON_Id" value="<?php echo $Detail->get_value("TR_ADDONID"); ?>">
	<input type="hidden" class="FRM_ADDON_Ke" name="FRM_ADDON_Ke" value="3">

	<table class="paperworktable">


		<tr>
			<td>Nama Kartu Tambahan</td>
			<td><input type="text" value="<?php echo $Detail->get_value("ADDON_Nama_Kartu"); ?>" class="input_text tolong" name="ADDON_Nama_Kartu_3" id="ADDON_Nama_Kartu_3" placeholder=""></td>

      <td>Hubungan</td>
			<td>
				<select type="combo" id="ADDON_Hubungan_3" class="select select-chosen" name="ADDON_Hubungan_3">
				<?php   
					echo "<option value='0'>- PILIH -</option>";
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
			<td><input type="text" style="width:20%;" value="<?php echo $Detail->get_value("ADDON_Umur"); ?>" class="input_text" id="ADDON_Umur_3" name="ADDON_Umur_3" placeholder="">
      <input type="text" style="width:70%;" value="<?php echo $Detail->get_value("ADDON_DOB"); ?>" class="input_text tolong" id="ADDON_DOB_3" name="ADDON_DOB_3" placeholder=""></td>

      <td> Jenis Kartu</td>
			<td>
				<select type="combo" id="ADDON_Jenis_Kartu_3" class="select select-chosen" name="ADDON_Jenis_Kartu_3">
				<?php
					$CardReguler = $Lookup->CardReguler();
					echo "<option value='0'>- PILIH -</option>";
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
			<td>
				<select type="combo" class="select select-chosen" name="ADDON_Jenis_Kelamin_3" id="ADDON_Jenis_Kelamin_3">
				<?php
					echo "<option value='0'>- PILIH -</option>";
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
      <td><input type="text" value="<?php echo $Detail->get_value("ADDON_No_Hp"); ?>" class="input_text tolong" id="ADDON_No_Hp_3" name="ADDON_No_Hp_3" placeholder=""></td>
    </tr>


    <tr>
      <td colspan="2"><button class="submit-button"><i class="fa fa-save" aria-hidden="true"></i> <b>SAVE</b></button></td>
      <td colspan="2"><button class="reset-button"><i class="fa fa-close" aria-hidden="true"></i> <b>CANCEL</b></button></td>
    </tr>

	</table>
</div>
