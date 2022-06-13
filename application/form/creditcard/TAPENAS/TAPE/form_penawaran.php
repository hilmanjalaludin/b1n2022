<script>
function sum() {
      var txtFirstNumberValue = document.getElementById('txt1').value;
      var txtSecondNumberValue = document.getElementById('txt2').value;
      var a = document.getElementById('txt4').value;
      var b = document.getElementById('txt5').value;
      var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);
      var hasil  = parseInt(a) + parseInt(b);
      if (!isNaN(result)) {
         document.getElementById('txt3').value = result;
      }
      if (!isNaN(hasil)) {
         document.getElementById('txt6').value = hasil;
      }
}

function a(evt) {
	  var charCode = (evt.which) ? evt.which : event.keyCode
	  if (charCode > 31 && (charCode < 48 || charCode > 57))
		 return false;
		 return true;
	  }
</script>

<?php
	//print_r($CekRowTapenas);
	foreach($DetailTapenas as $key => $value) { 
		 //print_r($value['TapensasCustId']);
		?>
		<form name="frmTapenas">
		 <table class="paperworktable">
			<tr> 
				<td class="ui-data-cell-1" hidden="hidden">Id</td>
				<td class="ui-data-cell-2" colspan="3" hidden="hidden">
					<input type="text" class="input_text" name="TR_CustNo" value="<?php echo $value['TapenasId'] ?>" disabled="disabled">
				</td>
			</tr>

			<tr> 
				<td class="ui-data-cell-1" hidden="hidden">TapenasCustId</td>
				<td class="ui-data-cell-2" colspan="3" hidden="hidden">
					<input type="text" class="input_text" name="TR_CustId" value="<?php echo $value['TapensasCustId'] ?>" disabled="disabled">
				</td>
			</tr>

			<tr> 
				<td class="ui-data-cell-1" hidden="hidden">Tapenas CIF</td>
				<td class="ui-data-cell-2" colspan="3" hidden="hidden">
					<input type="text" class="input_text" name="TR_TapenasCIF" value="<?php echo $value['TapenasCIF'] ?>" disabled="disabled">
				</td>
			</tr>
			<tr> 
				<td class="ui-data-cell-1">Setoran Sebelum</td>
				<td class="ui-data-cell-2" colspan="3">
					<input type="text" class="input_text" name="TR_SetoranSebelum" value="<?php echo ($CekRowTapenas['TR_SetoranSebelum'] != "") ? $CekRowTapenas['TR_SetoranSebelum'] : $value['TapenasSetoran'] ?>" id="txt1" disabled="disabled">
				</td>
			</tr>
			
			<tr> 
				<td class="ui-data-cell-1">Setoran Tambahan</td>
				<td class="ui-data-cell-2" colspan="3">
					<input type="text" class="input_text tolong" name="TR_SetoranTambahan" value="<?php echo ($CekRowTapenas['TR_SetoranTambahan'] != "") ? $CekRowTapenas['TR_SetoranTambahan'] : "" ?>" id="txt2" onkeypress="return a(event)" required>
				</td>
			</tr>
			
			<tr> 
				<td class="ui-data-cell-1">Setoran Sesudah</td>
				<td class="ui-data-cell-2" colspan="3">
					<input type="text" class="input_text tolong" name="TR_SetoranTotal" value="<?php echo ($CekRowTapenas['TR_SetoranTotal'] != "") ? $CekRowTapenas['TR_SetoranTotal'] : "" ?>" id="txt3" disabled="disabled">
				</td>
			</tr>
			
			<tr> 
				<td class="ui-data-cell-1">Tenor Sebelum</td>
				<td class="ui-data-cell-2" colspan="3">
					<input type="text" class="input_text tolong" name="TR_TenorSebelum" id="txt4" value="<?php echo ($CekRowTapenas['TR_TenorSebelum'] != "") ? $CekRowTapenas['TR_TenorSebelum'] : $value['TapenasJangkaWaktu'] ?>" id="txt2"  disabled="disabled">
				</td>
			</tr>
			
			<tr> 
				<td class="ui-data-cell-1">Tenor Tambahan</td>
				<td class="ui-data-cell-2" colspan="3">
					<input type="text" class="input_text tolong" name="TR_TenorTambahan" value="<?php echo ($CekRowTapenas['TR_TenorTambahan'] != "") ? $CekRowTapenas['TR_TenorTambahan'] : "" ?>" id="txt5" onkeyup="sum();"  onkeypress="return a(event)" placeholder="">
				</td>
			</tr>
			
			<tr> 
				<td class="ui-data-cell-1">Tenor Sesudah</td>
				<td class="ui-data-cell-2" colspan="3">
					<input type="text" class="input_text tolong" name="TR_TenorTotal" value="<?php echo ($CekRowTapenas['TR_TenorTotal'] != "") ? $CekRowTapenas['TR_TenorTotal'] : "" ?>" id="txt6" disabled="disabled">
				</td>
			</tr>
			 
		</table>
		</form>
	<?php }
		// print_r($data['TR_TapenasCIF']);
?>