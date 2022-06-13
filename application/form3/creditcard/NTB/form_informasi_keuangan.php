<div class="wraplable">
	<div class="paperworktitle">INFORMASI KEUANGAN</div>
	<table class="paperworktable">

		<tr>
			<td>Penghasilan dari tempat saat ini bekerja</td>
			<td colspan="3">
				Rp. <input type="text" class="input_text tolong" name="FINANCE_Penghasilan_Sekarang" placeholder=""> /tahun <span class="paperworknote">(nett)</span>
			</td>
		</tr>

		<tr>
			<td>Penghasilan Lainnya</td>
			<td colspan="3">
				Rp. <input type="text" class="input_text tolong" name="FINANCE_Penghasilan_Lain" placeholder=""> /tahun <span class="paperworknote">(nett)</span>
			</td>
		</tr>

		<tr>
			<td>Sebutkan Sumbernya</td>
			<td colspan="3">
				<input type="text" class="input_text tolong" name="FINANCE_Sumber_Penghasilan_Lain" placeholder="">
			</td>
		</tr>

		<tr>
			<td>Kartu Kredit yang dimiliki Sekarang</td>
			<td class="smallinput" colspan="2">
				1. <input maxlength="4" minlength="4" type="text" class="input_text number tolong" name="FINANCE_No_Kartu_Kredit_Dimiliki1_1" placeholder=""> - 
				<input maxlength="4" minlength="4" type="text" class="input_text number tolong" name="FINANCE_No_Kartu_Kredit_Dimiliki1_2" placeholder=""> -
				<input maxlength="4" minlength="4" type="text" class="input_text number tolong" name="FINANCE_No_Kartu_Kredit_Dimiliki1_3" placeholder=""> -
				<input maxlength="4" minlength="4" type="text" class="input_text number tolong" name="FINANCE_No_Kartu_Kredit_Dimiliki1_4" placeholder="">
				<br>
				Sejak <input type="text" class="FINANCE_Kartu_Kredit_Sejak1 input_text datemy tolong" name="FINANCE_Kartu_Kredit_Sejak1" placeholder=""> <span class="paperworknote">(mm-yy)</span> Berlaku s.d. 
				<input type="text" class="FINANCE_Kartu_Kredit_Expired1 input_text datemy tolong" name="FINANCE_Kartu_Kredit_Expired1" placeholder=""> <span class="paperworknote">(mm-yy)</span> <br>
			</td>

			<td>Bank Penerbit <br> <input type="text" class="input_text tolong" name="FINANCE_Bank_Kartu_Kredit1" placeholder=""></td>

			
		</tr>

		<tr>
			<td></td>
			<td class="smallinput" colspan="2">
				2. <input maxlength="4" minlength="4" type="text" class="input_text number tolong" name="FINANCE_No_Kartu_Kredit_Dimiliki2_1" placeholder=""> - 
				<input maxlength="4" minlength="4" type="text" class="input_text number tolong" name="FINANCE_No_Kartu_Kredit_Dimiliki2_2" placeholder=""> -
				<input maxlength="4" minlength="4" type="text" class="input_text number tolong" name="FINANCE_No_Kartu_Kredit_Dimiliki2_3" placeholder=""> -
				<input maxlength="4" minlength="4" type="text" class="input_text number tolong" name="FINANCE_No_Kartu_Kredit_Dimiliki2_4" placeholder="">
				<br>
				Sejak <input type="text" class="FINANCE_Kartu_Kredit_Sejak2 input_text datemy tolong" name="FINANCE_Kartu_Kredit_Sejak2" placeholder=""> 
				<span class="paperworknote">(mm-yy)</span> Berlaku s.d. <input type="text" class="FINANCE_Kartu_Kredit_Expired2 input_text datemy tolong" name="FINANCE_Kartu_Kredit_Expired2" placeholder=""> <span class="paperworknote">(mm-yy)</span> 
			</td>
			<td>Bank Penerbit <br> <input type="text" class="input_text tolong" name="FINANCE_Bank_Kartu_Kredit2" placeholder=""></td>
		</tr>

		<tr>
			<td colspan="4">Rekening Koran/Tabungan/Pinjaman di BNI yang dimiliki</td>
		</tr>

		<tr>
			<td>No Rekening</td>
			<td colspan="3">
				<input type="text" class="input_text tolong" name="FINANCE_No_Rekening_Tabungan" placeholder="">
			</td>
		</tr>

    <tr>
        <?php 
      /* [FS] cek apakah dia spv ? jika spv disabled */
      if($spvdisabled->get_value('handling_type') == 22) {
      ?>
      <td colspan="2"><button class="submit-button" id="ngek" disabled="disabled"><i class="fa fa-save" aria-hidden="true"></i> <b>SAVE</b></button></td>
      <td colspan="2"><button class="reset-button"><i class="fa fa-close" aria-hidden="true"></i> <b>CANCEL</b></button>
      </td>
     <?php } 
     
     else {
     ?>

       <td colspan="2"><button class="submit-button" id="ngek"><i class="fa fa-save" aria-hidden="true"></i> <b>SAVE</b></button></td>
      <td colspan="2"><button class="reset-button"><i class="fa fa-close" aria-hidden="true"></i> <b>CANCEL</b></button>
      </td>
  <?php } ?>
    
    </tr>

	</table>
</div>
