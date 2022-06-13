<?php
	// add dida
	$statusUsage = $this->db->query("select * from t_lk_approved")->result_array();
	$arrStatusUsage = array();
	foreach($statusUsage as $item) {
		$arrStatusUsage[$item['idlook']] = $item['status'];
	}
?>
<table class="paperworktable">
	<tr> 
		<td>
				<div class="ui-widget-form-table-compact table-body-content" style="margin:10px 10px 10px 0px;">
					<div class="table-row-extend ui-widget-header table-row-header">
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">No</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Kartu</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Aval XD</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Aval SS</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Kredit Limit</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Membal</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Cycle</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Block</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Member Since</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Perisai +</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Penawaran</div>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Action</div>
						<!-- // add dida -->
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Status</div>
						<?php
							if(_get_session('HandlingType') == 19 || _get_session('HandlingType') == 4) {
						?>
						<div class="table-cell-header-extend ui-corner-top table-cell-header center">Campaign</div>
						<?php
							}
						?>
					</div>
					
				<?php 
				
				// ambil data katu di table Customer Verification 
				// berdasarkan Customer Number 
				$result_array = DaftarKartu();
				
				$rowDataNo = 1;
				if(is_array($result_array)) 
				foreach( $result_array as $row_array ){
					$row = Objective( $row_array );
					if( !$row->field('CV_Data_CustId') ){
						continue;
					}					
					// add button untuk handle Edit / yang lainya juga boleh asal mau .
					$URI=&UR();
					$formButtonControlEdit = null;
					if( $URI->field('CustomerEdit') ){ 
						$formButtonControlEdit = sprintf("<button class=\"btn btn-success btn-xs\"  style=\"color:#FFF;\" onclick=\"window.ActionPaperWork('%s','UPDATEDATA');\">
															<i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>&nbsp;EDIT
															</button>",  $row->field('CV_Data_Id'));
					}
					
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
					printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('CV_Data_CardType', 'SetCapital') );
					printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('CV_Data_AvailXD', 'SetCurrency'));
					printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('CV_Data_AvailSS', 'SetCurrency'));
					printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('CV_Data_Crelimit', 'SetCurrency'));
					printf("<div class=\"table-cell-content-extend table-cell-content center\">xxx</div>", $row->field('CV_Data_Membal', 'SetCurrency'));
					printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('CV_Data_Cycle'));
					printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('CV_Data_Block') );
					// printf("<div class=\"table-cell-content-extend table-cell-content center\">
					if ($this->EUI_Session->_get_session('HandlingType') == 19) {
						printf(
							"<div class=\"table-cell-content-extend table-cell-content center\">
					<div class=\"ui-widget-form-table\" style=\"width:99%%;margin-top:-2px;\">
						<div class=\"ui-widget-form-row\">
							<div class=\"ui-widget-form-cell\"><input type=\"text\" class=\"input_text long field-after-verifikasi\" id=\"%s\" name=\"%s\" value=\"%s\" placeholder=\"\"></div>
							<div class=\"ui-widget-form-cell\"><button class=\"btn btn-default btn-xs field-after-verifikasi check_%s\" id=\"check_%s\" name=\"check_%s\" onclick=\"window.VerifikasiDaftarKartu(%s);\"> 
							<i class=\"fa fa-check\" aria-hidden=\"true\"></i>&nbsp;Check</button> </div>
						</div>
					</div>
				</div>",
							// sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
							// sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
							// sprintf('%s', VerifikasiKartu($row)),
							// sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
							// sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
							// sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
							// sprintf("{field: 'CV_Data_CcExpired',id:'%s'}", $row->field('CV_Data_Id'))
							// edit hilman 
							sprintf('CV_Data_MemberSince_%s', $row->field('CV_Data_Id')),
							sprintf('CV_Data_MemberSince_%s', $row->field('CV_Data_Id')),
							sprintf('%s', VerifikasiKartu($row)),
							sprintf('CV_Data_MemberSince_%s', $row->field('CV_Data_Id')),
							sprintf('CV_Data_MemberSince_%s', $row->field('CV_Data_Id')),
							sprintf('CV_Data_MemberSince_%s', $row->field('CV_Data_Id')),
							sprintf("{field: 'CV_Data_MemberSince',id:'%s'}", $row->field('CV_Data_Id'))
						);
					} else {
						printf(
							"<div class=\"table-cell-content-extend table-cell-content center\">
								<div class=\"ui-widget-form-table\" style=\"width:99%%;margin-top:-2px;\">
									<div class=\"ui-widget-form-row\">
										<div class=\"ui-widget-form-cell\"><input type=\"text\" class=\"input_text long field-after-verifikasi\" id=\"%s\" name=\"%s\" value=\"%s\" placeholder=\"\"></div>
										<div class=\"ui-widget-form-cell\"><button class=\"btn btn-default btn-xs field-after-verifikasi check_%s\" id=\"check_%s\" name=\"check_%s\" onclick=\"window.VerifikasiDaftarKartu(%s);\"> 
										<i class=\"fa fa-check\" aria-hidden=\"true\"></i>&nbsp;Check</button> </div>
									</div>
								</div>
							</div>",
						//  sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
						//  sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
						//  sprintf('%s', VerifikasiKartu($row)),
						//  sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
						//  sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
						//  sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
						//  sprintf("{field: 'CV_Data_CcExpired',id:'%s'}", $row->field('CV_Data_Id')) 
						// edit hilman 
						sprintf('CV_Data_MemberSince_%s', $row->field('CV_Data_Id')),
								sprintf('CV_Data_MemberSince_%s', $row->field('CV_Data_Id')),
								sprintf('%s', VerifikasiKartu($row)),
								sprintf('CV_Data_MemberSince_%s', $row->field('CV_Data_Id')),
								sprintf('CV_Data_MemberSince_%s', $row->field('CV_Data_Id')),
								sprintf('CV_Data_MemberSince_%s', $row->field('CV_Data_Id')),
								sprintf("{field: 'CV_Data_MemberSince',id:'%s'}", $row->field('CV_Data_Id'))
						);
					
					// if($this -> EUI_Session ->_get_session('HandlingType')==19){
					// 	printf("<div class=\"table-cell-content-extend table-cell-content center\">
					// 	<div class=\"ui-widget-form-table\" style=\"width:99%%;margin-top:-2px;\">
					// 		<div class=\"ui-widget-form-row\">
					// 			<div class=\"ui-widget-form-cell\"><input type=\"text\" class=\"input_text long field-after-verifikasi\" id=\"%s\" name=\"%s\" value=\"%s\" placeholder=\"\"></div>
					// 			<div class=\"ui-widget-form-cell\"><button class=\"btn btn-default btn-xs field-after-verifikasi check_%s\" id=\"check_%s\" name=\"check_%s\" onclick=\"window.VerifikasiDaftarKartu(%s);\"> 
					// 			<i class=\"fa fa-check\" aria-hidden=\"true\"></i>&nbsp;Check</button> </div>
					// 		</div>
					// 	</div>
					// </div>", sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
					// 		 sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
					// 		 sprintf('%s', VerifikasiKartu($row)),
					// 		 sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
					// 		 sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
					// 		 sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
					// 		 sprintf("{field: 'CV_Data_CcExpired',id:'%s'}", $row->field('CV_Data_Id')) );
					// }else{
                    //     printf("<div class=\"table-cell-content-extend table-cell-content center\">
					// 				<div class=\"ui-widget-form-table\" style=\"width:99%%;margin-top:-2px;\">
					// 					<div class=\"ui-widget-form-row\">
					// 						<div class=\"ui-widget-form-cell\"><input type=\"password\" class=\"input_text long field-after-verifikasi\" id=\"%s\" name=\"%s\" value=\"%s\" placeholder=\"\"></div>
					// 						<div class=\"ui-widget-form-cell\"><button class=\"btn btn-default btn-xs field-after-verifikasi check_%s\" id=\"check_%s\" name=\"check_%s\" onclick=\"window.VerifikasiDaftarKartu(%s);\"> 
					// 						<i class=\"fa fa-check\" aria-hidden=\"true\"></i>&nbsp;Check</button> </div>
					// 					</div>
					// 				</div>
					// 			</div>", sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
					// 					 sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
					// 					 sprintf('%s', VerifikasiKartu($row)),
					// 					 sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
					// 					 sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
					// 					 sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
					// 					 sprintf("{field: 'CV_Data_CcExpired',id:'%s'}", $row->field('CV_Data_Id')) );
					// }
						
					}			
					printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", ($row->field('CV_PerisaiPlus') == 'Y') ? 'Sudah Punya' : ($row->field('CV_PerisaiPlus') == 'T' ? 'Belum Punya' : '' ));
					printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('CV_Data_Penawaran'));
					printf(
						"<div class=\"table-cell-content-extend table-cell-content center\">	
								<div class=\"ui-widget-form-table\" style=\"width:99%%;margin-top:-2px;\">
									<div class=\"ui-widget-form-row\">
										<div class=\"ui-widget-form-cell\"><button class=\"btn btn-default btn-xs field-after-verifikasi field-after-state button_%s\" id=\"%s\" name=\"%s\" onclick=\"window.ActionPaperWork('%s','XTRADANA');\">
										<i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>&nbsp;XTRADANA</button> 
										%s
										</div>
									</div>
								</div>
							</div>",
									//  sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')), 
									//  sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')), 
									//  sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
									// edit hilman 
									sprintf('CV_Data_MemberSince_%s', $row->field('CV_Data_Id')),
									sprintf('CV_Data_MemberSince_%s', $row->field('CV_Data_Id')),
									sprintf('CV_Data_MemberSince_%s', $row->field('CV_Data_Id')), 
									 $row->field('CV_Data_Id'),
									 $formButtonControlEdit
									 );
								// add dida
						printf(form()->combo('CV_Data_Status_'.$row->field('CV_Data_Id'),'select CV_Data_Status',$arrStatusUsage,$row->field('CV_Data_status'), array('change' => 'window.pickStatusApproved(%s);'), ($row->field('CV_Data_status') == 1 && $row->field('DM_QualityReasonKode') != 'RDPC') ? array('disabled' => true) : null),$row->field('CV_Data_Id'));
						if(_get_session('HandlingType') == 19 || _get_session('HandlingType') == 4) {
							printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('campaign'));
						}
					printf("%s", "</div>");
					$rowDataNo++;
				}
				?>
				 </div> 
		</td>
	</tr>
</table>
<script>
	setTimeout(() => {
		var status_approve = '<?php echo $row->field('CV_Data_status');?>'
		if(status_approve != '' || status_approve != NULL) { localStorage.setItem('status_daftarkartu', JSON.stringify(status_approve)) }
	}, 2000)
</script>