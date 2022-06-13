

<div class="wraplable">
	<div class="paperworktitle">KARTU KREDIT</div>
	<table class="paperworktable">
		<input type="hidden" name="CustomerNumber" value="<?php echo $CustomerNumber; ?>">
		<input type="hidden" id="FRM_NTB_Id" name="FRM_NTB_Id" value="">
		<tr>
			<td> Kredit BNI yang dikehendaki</td>
			<td>
				<select type="combo" id="typecard" class="select tolong select-chosen" name="CC_Kartu_Yang_Diinginkan">
				<?php   
					$CardReguler = $Lookup->CardReguler();
					echo "<option value='0'>- PILIH -</option>";
					foreach ( $CardReguler as $cd ) {
						echo "<option trigger='".$cd["trigger"]."' value='".$cd["id"]."'>".$cd["name"]."</option>";
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<td>Nama yang dikehendaki dikartu anda</td>
			<td>
				<input type="text" class="input_text tolong" name="CC_Nama_Yang_Diinginkan" placeholder="" maxlength="20">
			</td>
		</tr>

		<tr>
			<td>Affinity Card</td>
			<td>

			<select type="combo" id="affinitycard" class="select tolong select-chosen" name="CC_Afinity">
				<?php   
					$AffinityReguler = $Lookup->AffinityReguler();
					echo "<option value='0'>- PILIH -</option>";
					foreach ( $AffinityReguler as $ar ) {
						echo "<option level='".$ar["level"]."' value='".$ar["id"]."'>".$ar["name"]."</option>";
					}
				?>
			</select>

			<br><br>

			<select type="combo" id="cardlevel" class="select tolong select-chosen" name="CC_Card_Level">
				<?php   
					$AffinityCardLevel = $Lookup->AffinityCardLevel();
					echo "<option value='0'>- PILIH -</option>";
					foreach ( $AffinityCardLevel as $acl ) {
						echo "<option value='".$acl["id"]."'>".$acl["name"]."</option>";
					}
				?>
			</select>

			</td>
		</tr>

		<tr>
			<td>Hubungan Dengan Universitas/Organisasi</td>
			<td>

			<select type="combo" id="orgaffinity" class="select tolong select-chosen" name="CC_Relation_Afinity">
				<?php   
					$Org = $Lookup->Org();
					echo "<option value='0'>- PILIH -</option>";
					foreach ( $Org as $aclo ) {
						echo "<option value='".$aclo["id"]."'>".$aclo["name"]."</option>";
					}
				?>
			</select>
			<br> <span class="paperworknote">(Khusus kartu kredit BNI Affinity) </span>

			</td>



		</tr>


	</table>
</div>
