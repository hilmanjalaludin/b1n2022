<?php  
// lookup information 
$gender 	= $Lookup->_general_lookup("gender");
$state 		= $Lookup->_general_lookup("state");
$marital 	= $Lookup->_general_lookup("marital");
$education  = $Lookup->_general_lookup("education");
$occupation = $Lookup->_general_lookup("occupation");
$company 	= $Lookup->_general_lookup("company");

if ( isset($DetailJs["ntb"]) && count($DetailJs["ntb"]) > 0  ) {
	$CM = new EUI_object(array());
}

?>


<div class="wraplable">
	<div class="paperworktitle">DATA MAINTAIN INFORMASI</div>
	<table class="paperworktable">


		<tr>
			<td>No.KTP</td>
			<td colspan="3"><input type="text" class="number input_text tolong" name="CONTACT_No_Ktp" placeholder="" maxlength="16"></td>
		</tr>

		<tr>
			<td>Jenis Kelamin</td>
			<td>
				<select type="combo" class="select select-chosen" name="CONTACT_Jenis_Kelamin">
				<?php   
					echo "<option value=''>- PILIH -</option>";
					foreach ( $gender as $gd ) {
						echo "<option value='".$gd["code"]."'>".$gd["name"]."</option>";
					}
				?>
				</select>

			</td>

			<td>Kewarganegaraan</td>
			<td><input type="text" class="input_text tolong" name="CONTACT_Kewarganegaraan" placeholder=""></td>

		</tr>

		<tr>
			<td>Tempat Lahir</td>
			<td><input type="text" class="input_text tolong" name="CONTACT_Tempat_Lahir" placeholder=""></td>

			<td>Tanggal Lahir</td>
			<td><input type="text" id="CONTACT_Tgl_Lahir" class="CONTACT_Tgl_Lahir input_text tolong" name="CONTACT_Tgl_Lahir" placeholder=""></td>
			
		</tr>

		<tr>
			<td></td>
			<td><input type="checkbox" class="tolong" name="" placeholder=""></td>

			<td>Tanggal Jatuh Tempo</td>
			<td><input type="text" maxlength="2" class="CONTACT_Tgl_Jatuh_Tempo input_text tolong" name="CONTACT_Tgl_Jatuh_Tempo" placeholder=""></td>
			
		</tr>

		<tr>
			<td>Alamat Rumah 1</td>
			<td><input type="text" value="<?php echo $CM->get_value("DM_AddressLine1");?>" class="input_text tolong" name="CONTACT_Alamat_Rumah_1" placeholder=""></td>

			<td>Alamat Rumah 2</td>
			<td><input type="text" value="<?php echo $CM->get_value("DM_AddressLine2");?>" class="input_text tolong" name="CONTACT_Alamat_Rumah_2" placeholder=""></td>
			
		</tr>

		<tr>
			<td>Alamat Rumah 3</td>
			<td><input type="text" value="<?php echo $CM->get_value("DM_AddressLine3");?>" class="input_text tolong" name="CONTACT_Alamat_Rumah_3" placeholder=""></td>

			<td>Alamat Rumah 4</td>
			<td><input type="text" value="<?php echo $CM->get_value("DM_AddressLine4");?>" class="input_text tolong" name="CONTACT_Alamat_Rumah_4" placeholder=""></td>
			
		</tr>

		<tr>
			<td>Kota</td>
			<td><input type="text" value="<?php echo $CM->get_value("DM_City");?>"  class="input_text tolong" name="CONTACT_Kota" placeholder=""></td>

			<td>Kode Pos</td>
			<td><input type="text" maxlength="5" class="number input_text tolong" name="CONTACT_Kode_Post" placeholder=""></td>
			
		</tr>

		<tr>
			<td>Kode Area Telp.</td>
			<td><input type="text"   maxlength="4" class="number input_text tolong" name="CONTACT_Kode_Area_Tlp" placeholder=""></td>

			<td>Telp Rumah</td>
			<td><input type="text"  value="<?php echo $CM->get_value("DM_HomePhoneNum");?>"  class="number input_text tolong" name="CONTACT_Tlp_Rumah" placeholder=""></td>
			
		</tr>

		<tr>
			<td>Lama Tinggal</td>
			<td class="smallinput">
				<input type="text" class="number input_text tolong" name="CONTACT_Lama_Tinggal_Tahun" placeholder=""> Tahun
				<input type="text" class="number input_text tolong" name="CONTACT_Lama_Tinggal_Bulan" placeholder=""> Bulan
			</td>

			<td>Handphone</td>
			<td><input type="text" value="<?php echo $CM->get_value("DM_MobilePhoneNum");?>"  class="number input_text tolong" name="CONTACT_Mobile_Phone" placeholder=""></td>
			
		</tr>

		<tr>
			<td>Status Tempat Tinggal</td>
			<td colspan="2">
				<select type="combo" id="CONTACT_Status_Tempat_Tinggal" class="select tolong select-chosen" name="CONTACT_Status_Tempat_Tinggal">
				<?php   
					echo "<option value='0'>- PILIH -</option>";
					foreach ( $state as $st ) {
						echo "<option value='".$st["code"]."'>".$st["name"]."</option>";
					}
				?>
				</select>
			</td>

			<td ><input type="text" id="CONTACT_Status_Tempat_Tinggal_Other" class="input_text tolong" name="CONTACT_Status_Tempat_Tinggal_Other" placeholder="Lainnya"></td>
			
		</tr>

		<tr>

			<td>Status Pernikahan</td>
			<td>
				<select type="combo" class="select select-chosen" name="CONTACT_Status_Pernikahan">
				<?php   
					echo "<option value='0'>- PILIH -</option>";
					foreach ( $marital as $mt ) {
						echo "<option value='".$mt["code"]."'>".$mt["name"]."</option>";
					}
				?>
				</select>
			</td>

			<td>Jumlah Tanggungan</td>
			<td class="smallinput">
				<input type="text" class="number input_text tolong" name="CONTACT_Jumlah_Tanggungan" placeholder=""> Orang
			</td>

			
			
		</tr>


		<tr>
			<td>Pendidikan Terakhir</td>
			<td colspan="2">

				<select id="CONTACT_Pendidikan_Terakhir" type="combo" class="select tolong select-chosen" name="CONTACT_Pendidikan_Terakhir">
				<?php   
					echo "<option value='0'>- PILIH -</option>";
					foreach ( $education as $edu ) {
						echo "<option value='".$edu["code"]."'>".$edu["name"]."</option>";
					}
				?>
				</select>
			</td>

			<td ><input id="CONTACT_Pendidikan_Terakhir_Other" type="text" class="input_text tolong" name="CONTACT_Pendidikan_Terakhir_Other" placeholder="Lainnya"></td>
			
		</tr>

		<tr>
			<td>Nama Ibu Kandung</td>
			<td><input type="text" class="input_text tolong" name="CONTACT_Nama_Ibu_Kandung" placeholder=""></td>

			<td>Email</td>
			<td><input type="text" class="input_text tolong" name="CONTACT_Email" placeholder=""></td>
			
		</tr>



		<tr>
			<td>Pekerjaan</td>
			<td colspan="2">
				<select type="combo" id="WORK_Pekerjaan" class="select tolong select-chosen" name="WORK_Pekerjaan">
				<?php   
					echo "<option value='0'>- PILIH -</option>";
					foreach ( $occupation as $occ ) {
						echo "<option value='".$occ["code"]."'>".$occ["name"]."</option>";
					}
				?>
				</select>
			</td>

			<td ><input id="WORK_Jenis_Pekerjaan_Other" type="text" class="input_text tolong" name="WORK_Jenis_Pekerjaan_Other" placeholder="Lainnya"></td>
			
		</tr>


		<tr>
			<td>Jenis Perusahaan</td>
			<td colspan="2">
				<select type="combo" id="WORK_Jenis_Perusahaan" class="select tolong select-chosen" name="WORK_Jenis_Perusahaan">
				<?php   
					echo "<option value='0'>- PILIH -</option>";
					foreach ( $company as $occ ) {
						echo "<option value='".$occ["code"]."'>".$occ["name"]."</option>";
					}
				?>
				</select>
			</td>

			<td ><input id="WORK_Jenis_Perusahaan_Other" type="text" class="input_text tolong" name="WORK_Jenis_Perusahaan_Other" placeholder="Lainnya"></td>
			
		</tr>

		<tr>
			<td>Bidang Usaha</td>
			<td><input type="text" class="input_text tolong" name="WORK_Bidang_Usaha" placeholder=""></td>

			<td>NPWP</td>
			<td><input type="text" class="input_text tolong" name="WORK_Nonpwp" placeholder="" maxlength="20"></td>
			
		</tr>

		<tr>
			<td>Jabatan</td>
			<td><input type="text" class="input_text tolong" name="WORK_Jabatan" placeholder=""></td>

			<td>Nama Kantor</td>
			<td><input type="text" class="input_text tolong" name="WORK_Nama_Kantor" placeholder=""></td>
			
		</tr>	

		<tr>
			<td>Alamat Kantor 1</td>
			<td><input type="text" class="input_text tolong" name="WORK_Almat_Kantor_1" placeholder=""></td>

			<td>Alamat Kantor 2</td>
			<td><input type="text" class="input_text tolong" name="WORK_Almat_Kantor_2" placeholder=""></td>
			
		</tr>

		<tr>
			<td>Alamat Kantor 3</td>
			<td><input type="text" class="input_text tolong" name="WORK_Almat_Kantor_3" placeholder=""></td>

			<td>Alamat Kantor 4</td>
			<td><input type="text" class="input_text tolong" name="WORK_Almat_Kantor_4" placeholder=""></td>
			
		</tr>

		<tr>
			<td>Kota</td>
			<td><input type="text" class="input_text tolong" name="WORK_Kota_Kantor" placeholder=""></td>

			<td>Kode Pos</td>
			<td><input type="text" maxlength="5" class="number input_text tolong" name="WORK_Kode_Pos_Kantor" placeholder=""></td>
			
		</tr>


		<tr>
			<td>Kode Area Tlp. Kantor</td>
			<td><input type="text"  maxlength="4"  class="number input_text tolong" name="WORK_Kode_Area_Tlp_Kantor" placeholder=""></td>

			<td>Telp Kantor</td>
			<td><input value="<?php echo $CM->get_value("DM_OfficePhoneNum");?>" type="text" class="number input_text tolong" name="WORK_Tlp_Kantor" placeholder=""></td>
			
		</tr>


		<tr>
			<td>Kirim Biling</td>
			<td><input type="radio" value="R" class="tolong" name="WORK_Alamat_Biling" placeholder=""> Rumah
			<input type="radio" value="K" class="tolong" name="WORK_Alamat_Biling" placeholder=""> Kantor</td>

			<td>Kirim Kartu</td>
			<td><input type="radio" value="R" class="" name="WORK_Alamat_Kartu" placeholder=""> Rumah
			<input type="radio" value="K" class="tolong" name="WORK_Alamat_Kartu" placeholder=""> Kantor</td>
			
		</tr>





	</table>
</div>
