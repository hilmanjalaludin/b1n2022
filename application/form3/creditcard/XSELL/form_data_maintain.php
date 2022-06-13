<?php $selected = ""; ?>
<div class="wraplable">
	<div class="paperworktitle">DATA MAINTAIN INFORMASI</div>
	<table class="paperworktable">
		<input type="hidden" name="CustomerNumber" value="<?php echo $CustomerNumber; ?>">
		<input type="hidden" class="FRM_XSell_Id" name="FRM_XSell_Id" value="<?php echo $Detail->get_value("FRM_XSell_Id"); ?>">
		<tr>
			<td>Deal Statement</td>
			<td colspan="3"><input <?php if ($Detail->get_value("DB_Deal_Statement") == "Y") echo " checked='checked' "; ; ?> type="radio" value="Y" class="tolong" name="DB_Deal_Statement" placeholder=""> Y
			<input type="radio" <?php if ($Detail->get_value("DB_Deal_Statement") == "N") echo " checked='checked' "; ; ?> value="N" class="tolong" name="DB_Deal_Statement" placeholder=""> N</td>
		</tr>
		
		<tr>
			<td>NPWP</td>
			<td colspan="3"><input type="text" value="<?php echo $Detail->get_value("DB_NPWP"); ?>" class="input_text tolong" name="DB_NPWP" placeholder="" maxlength="20" required></td>
		</tr>

		<tr>
			<td> Logo</td>
			<td colspan="3">
				<select required type="combo" id="DB_Logo" class="select tolong select-chosen" name="DB_Logo">
				<?php
					$CardReguler = $Lookup->CardReguler();
					echo "<option value=''>- PILIH -</option>";
					foreach ( $CardReguler as $cd ) {
						if ( $cd["id"] == $Detail->get_value("DB_Logo") ) $selected = " selected='selected' "; 
						echo "<option $selected trigger='".$cd["trigger"]."' value='".$cd["id"]."'>".$cd["name"]."</option>";
					}
				?>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>Tempat Lahir</td>
			<td colspan="3"><input type="text" value="<?php echo $Detail->get_value("XSELL_Tempat_Lahir"); ?>" class="input_text tolong" name="XSELL_Tempat_Lahir" placeholder="" required></td>
		</tr>
		
		<tr>
			<td>KTP</td>
			<td colspan="3"><input type="text" class="number input_text tolong" value="<?php echo $Detail->get_value("XSELL_Ktp"); ?>" name="XSELL_Ktp" placeholder="" maxlength="16" required></td>
		</tr>
	</table>
</div>
