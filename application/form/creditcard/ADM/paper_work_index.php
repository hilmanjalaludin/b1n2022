<?php  $this->load->form("UI/styleform.php"); ?>
<?php  $this->load->form("UI/ADM_JS.php"); ?>

<script>
function myFunction() {
    document.getElementById("SV_Cust_KoresValue").disabled = true;
}
function myFunction2() {
    document.getElementById("SV_Cust_KoresValue").disabled = true;
}
function myFunction3() {
    document.getElementById("SV_Cust_KoresValue").disabled = false;
}
</script>

<?php
//$datas = $kores;
//var_dump($datas);
?>

<div class="paperwork">
<form name="frmAdminPaperWork" id="frmAdminPaperWork">
<?php echo form()->hidden('SV_Cust_Id', null, $row->field('DM_Id'));?>
<?php echo form()->hidden('SV_Cust_Num', null, $row->field('DM_Custno'));?>

<div class="wraplable admpaperwork">	
	<div class="paperworktitle">Data Copy</div>
	<table class="paperworktable">
		<tr>
			<td style="padding:2px 5px 2px 20px;">Email</td>
			<td><input type="text" class="input_text tolong disallowed" id="SV_Cust_MailAddress" 
				name="SV_Cust_MailAddress" placeholder="text here..."
				value="<?php printf('%s', $row->field('SV_Cust_MailAddress')); ?>"> </td>
		</tr>
		
		<tr>
			<td style="padding:2px 5px 2px 20px;">Fax</td>
			<td><input type="text" class="input_text tolong disallowed" id="SV_Cust_FaxNum" 
				name="SV_Cust_FaxNum" placeholder="text here..."
				value="<?php printf('%s', $row->field('SV_Cust_FaxNum')); ?>"> </td>
		</tr>
	
		<tr>
			<td style="padding:2px 5px 2px 20px;"> Kurir </td>
			<td>
				<select type="combo" id="SV_Kurir_Id" class="select tolong select-chosen" name="SV_Kurir_Id">
			    <?php   
			        //inisial variable get data.
                    $datas = $get;
                    $COURIER = $data;
                    //if there is already live courier get data
					if(printf('%s', $row->field('SV_Kurir_Id'))) {
						echo "<option value='". $row->field('SV_Kurir_Id')."'>".$datas['KurirDesc']."</option>";
                        //jika ingin ganti kurir
						foreach ( $COURIER as $ar ) {
							echo "<option value='".$ar["KurirID"]."'>".$ar["KurirDesc"]."</option>";
						}
					} else {
						//jika kurir belum ada
						echo "<option value='0'>- PILIH -</option>";
						//loop data untuk get data kurir yang ada dalam database.
						foreach ( $COURIER as $ar ) {
							echo "<option value='".$ar["KurirID"]."'>".$ar["KurirDesc"]."</option>";
						}
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<td style="padding:2px 5px 2px 20px;"> Coverage Area </td>
			<td>
				<select type="combo" id="SV_Coverage_Id" class="select tolong select-chosen" name="SV_Coverage_Id">
			   	<?php   
			        //inisial variable get data.
                    $datas = $area;
                    $cov = $row_area;
                    //if there is already live courier get data
					if(printf('%s', $row->field('SV_Coverage_Id'))) {
						echo "<option value='". $row->field('SV_Coverage_Id')."'>".$datas['Area']."</option>";
                        //jika ingin ganti kurir
						foreach ( $cov as $ar ) {
							echo "<option value='".$ar["CoverageId"]."'>".$ar["Area"]."</option>";
						}
					} else {
						//jika kurir belum ada
						echo "<option value='0'>- PILIH -</option>";
						//loop data untuk get data kurir yang ada dalam database.
						foreach ( $cov as $ar ) {
							echo "<option value='".$ar["CoverageId"]."'>".$ar["Area"]."</option>";
						}
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<td style="padding:2px 5px 2px 20px;">Whatsapp</td>
			<td><input type="text" class="input_text tolong disallowed" id="SV_WA" 
				name="SV_WA" placeholder="text here..."
				value="<?php printf('%s', $row->field('SV_WA')); ?>"> </td>
		</tr>
	</table>
</div>	
	
<div class="wraplable admpaperwork">	
	<div class="paperworktitle">Data Asli</div>
	<table class="paperworktable">
		<tr>
			<td style="padding:2px 15px 2px 20px;">
				<input type="radio" id="SV_Cust_KoresKode"  onchange ="window.EventRadioValid(this);" name="SV_Cust_KoresKode" value="601" <?php echo ( !strcmp( $row->field('SV_Cust_KoresKode'), '601' ) ? 'checked = "true"' : null); ?> onclick="myFunction()">Home Address
			</td>
			<td colspan="2">
				<input type="radio" id="SV_Cust_KoresKode"  onchange ="window.EventRadioValid(this);" name="SV_Cust_KoresKode" value="602" <?php echo ( !strcmp( $row->field('SV_Cust_KoresKode'), '602' ) ? 'checked = "true"' : null); ?>  placeholder="" onclick="myFunction2()">Office Address
			</td> 
		</tr>
		
		<tr>
			<td style="padding:2px 55px 2px 20px;"> 
				<input type="radio" id="SV_Cust_KoresKode" onchange ="window.EventRadioValid(this);"" name="SV_Cust_KoresKode" value="605" <?php echo ( !strcmp( $row->field('SV_Cust_KoresKode'), '605' ) ? 'checked = "true"' : null); ?>  placeholder="" onclick="myFunction3()"> Other
			</td>
			<td colspan="2">
				<textarea class="input" id="SV_Cust_KoresValue" name="SV_Cust_KoresValue" placeholder="text here..." style="text-align:left;width:60%; resize: none;">
					<?php
					$data = $kores;
                    //if there is already live courier get data
					if($data == 601) {
						printf('%s', $row->field('DM_AddressLine1'));
					} else if ($data == 602) {
						printf('%s', $row->field('DM_OfficeLine1'));
						}
					  else{
					  	printf('%s', $row->field('SV_Cust_KoresValue'));
					  }
					?>
				</textarea>

			</td>
		</tr>
	</table>
</div>


<div class="wraplable admpaperwork">	
	<div class="paperworktitle">Data Konfirmasi</div>
	<table class="paperworktable" border=1>
		<tr>
			<td> 
				<div class="ui-widget-form-table" style="margin-top:-5px;">
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell">Apakah Sudah Terima kartu ?</div>
					</div>
				</div>
			</td> 
			
			<td>		
				<input type="radio" id="SV_Cust_KonfirmKartu" name="SV_Cust_KonfirmKartu" value="Y" placeholder="" <?php echo ( !strcmp( $row->field('SV_Cust_KonfirmKartu'), 'Y' ) ? 'checked = "true"' : null); ?>>Sudah 
				<input type="radio"  id="SV_Cust_KonfirmKartu" name="SV_Cust_KonfirmKartu" value="N" placeholder="" <?php echo ( !strcmp( $row->field('SV_Cust_KonfirmKartu'), 'N' ) ? 'checked = "true"' : null); ?>>Belum 
			</td>
		</tr>
	</table>
 </div>
 </form>

 <!-- button section -->
 
 <div class="wraplable admpaperwork wraper-bottom-data">	
	<div class="ui-widget-form-table" style="margin-right:18px;float:right !important;">
		<div class="ui-widget-form-row">
		
			<div class="ui-widget-form-cell">
				<button class="submit-button-adm  disallowed" id="button-submit" onclick="window.EventPaperWorkSubmit();" style="margin-left:10px;width:70px;"><b>SAVE</b></button>
			</div>
			
			<div class="ui-widget-form-cell">
				<button class="reset-button-adm  disallowed" id="button-reset" onclick="window.EventPaperWorkReset();" 	style="margin-left:10px;width:70px;"><b>CANCEL</b></button>
			</div>
			
			<div class="ui-widget-form-cell">
				<button class="submit-button-adm " id="button-reload" onclick="window.EventPaperWorkReload();" 	style="margin-left:10px;width:70px;"><b>RELOAD</b></button>
			</div>
			
		</div>
	</div>	
 </div>	
 
</div>

