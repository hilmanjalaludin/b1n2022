<div class="wraplable">
	<div class="paperworktitle">DUAL CARD APPLICATION</div>
	<table class="paperworktable" status="1" id="dualcardtable">


		<tr>
			<td>Dual Card ? </td>
			<td colspan="3"><input id="dualcardagree" value="1" type="checkbox" class="input_text tolong" name="DC_Dual_Card_Agree" placeholder=""></td>
		</tr>

		<tr>
			<td><input status="1" value="AFF" type="radio" class="affinity_enabled_choose DC_Dual_Card_Type input_text tolong" name="DC_Dual_Card_Type" placeholder=""> Affinity</td>
			<td colspan="2">

				<select type="combo" class="affinity_select_choose DC_Dual_Card_Propose  select tolong select-chosen" name="DC_Dual_Card_Propose">
				<?php   
					$AffinityDualCard = $Lookup->AffinityDualCard();
					echo "<option value='0'>- PILIH -</option>";
					foreach ( $AffinityDualCard as $adc ) {
						echo "<option value='".$adc["id"]."'>".$adc["name"]."</option>";
					}
				?>
				</select>

			</td>

			<td ><input type="text" class="DC_Dual_Card_Propose_Type input_text tolong" name="DC_Dual_Card_Propose_Type" placeholder="Select"> </td>
		</tr>

		<tr>
			<td><input status="1" type="radio" value="COB" class="cobrand_enabled_choose DC_Dual_Card_Type input_text tolong" name="DC_Dual_Card_Type" placeholder=""> Cobrand</td>
			<td  colspan="2">

				<select type="combo" class="cobrand_select_choose DC_Dual_Card_Propose select tolong select-chosen" name="DC_Dual_Card_Propose">
				<?php   
					$Cobrand = $Lookup->Cobrand();
					echo "<option value='0'>- PILIH -</option>";
					foreach ( $Cobrand as $cob ) {
						echo "<option value='".$cob["id"]."'>".$cob["name"]."</option>";
					}
				?>
				</select>

			</td>

			<td ><input type="text" class="DC_Dual_Card_Propose_Type input_text tolong" name="DC_Dual_Card_Propose_Type" placeholder="Select"> </td>
		</tr>

		<tr>
			<td>Limit DualCard</td>
			<td><input type="text" class="number DM_CcLimit input_text tolong" name="DM_CcLimit" placeholder=""></td>
		</tr>


	</table>
</div>
