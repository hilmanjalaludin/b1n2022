<table class="paperworktable">
	<tr> 
		<td>
				<div class="ui-widget-form-table-compact table-body-content" style="margin:10px 10px 10px 0px;">
					<div class="table-row-extend ui-widget-header table-row-header">
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">No</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">No. Rekening</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Nama Nasabah</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Cabang</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Tgl Buka</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">jatuh Tempo</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Tenor</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Setoran Bulanan</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Action</div>
					</div>
					
				<?php 
				
				// ambil data katu di table Customer Verification 
				// berdasarkan Customer Number 
				$result_array = Daftarkartu();
				
				$rowDataNo = 1;
				if(is_array($result_array)) 
				foreach( $result_array as $row_array ){
					$row = Objective( $row_array );
					if( !$row->field('TapensasCustId') ){
						continue;
					}
					
					
					
					// add button untuk handle Edit / yang lainya juga boleh asal mau .
					// $URI=&UR();
					// $formButtonControlEdit = null;
					// if( $URI->field('CustomerEdit') ){ 
					// 	$formButtonControlEdit = sprintf("<button class=\"btn btn-success btn-xs\"  style=\"color:#FFF;\" onclick=\"window.ActionPaperWork('%s','UPDATEDATA');\">
					// 										<i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>&nbsp;EDIT
					// 										</button>",  $row->field('CV_Data_Id'));
					// }
					
					// add pada push OK 
					
					$row->add('VR_Data_No', $rowDataNo);
					// set row data daftar kartu ya .
					/*
					[CV_Data_Id] => 4
					[CV_Data_CustId] => 4
					
					[CV_Data_Custno] => 0000000001268893
					[CV_Data_FixID] => 7601268893W50011940
					[CV_Data_MotherName] => LIES WARDIATI
					[CV_Data_Dob] => 1962-08-09
					[CV_Data_Membal] => 25819474.00
					[CV_Data_DLDate] => 2017-07-14
					[CV_Data_RzipCode] => 95126
					[CV_Data_LzipCode] => 95114
					[CV_Data_Block] => 
					[CV_Data_OpenDate] => 2007-11-26
					[CV_Data_NoOfMonth] => 116
					[CV_Data_AvailXD] => 3590263.00
					[CV_Data_AvailSS] => 3590263.00
					[CV_Data_CardType] => ME
					[CV_Data_Cycle] => 18
					[CV_Data_Penawaran] => 
					[CV_Data_VerficationStatus] => N
					[CV_Data_VerficationDateTs] => 0000-00-00 00:00:00
					[CV_Data_VerificationCreator] => 0
					*/
					printf("%s", "<div class=\"table-row-extend\">");					
					printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('VR_Data_No') );
					printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('TapenasNoRekening') );
					printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('DM_FirstName') );
					printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('TapenasKodeWilayah') );
					printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('TapenasTglBuka') );
					printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('TapenasTglJatuhTempo') );
					printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('TapenasJangkaWaktu') );
					printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('TapenasSetoran') );
					printf("<div class=\"table-cell-content-extend table-cell-content center\">	
								<div class=\"ui-widget-form-table\" style=\"width:99%%;margin-top:-2px;\">
									<div class=\"ui-widget-form-row\">
										<div class=\"ui-widget-form-cell\"><button class=\"btn btn-default\" id=\"%s\" name=\"%s\" onclick=\"window.ActionPaperWork('%s','TAPE');\">
										<i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>&nbsp;TAPENAS</button> 
										%s
										</div>
									</div>
								</div>
							</div>", 
									sprintf('%s', $row->field('TapenasId')), 
									sprintf('%s', $row->field('TapenasId')), 
									//sprintf('TapenasId_%s', $row->field('TapenasId')),
									 $row->field('TapenasId'),
									 $formButtonControlEdit
									 );
								
					printf("%s", "</div>");
					$rowDataNo++;
				}
				?></div> 
		</td>
	</tr>
</table>