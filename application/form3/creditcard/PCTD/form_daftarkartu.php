<table class="paperworktable">
	<tr>
		<td>
			<div class="ui-widget-form-table-compact table-body-content" style="margin:10px 10px 10px 0px;">
				<div class="table-row-extend ui-widget-header table-row-header">
					<div class="table-cell-header-extend ui-corner-top table-cell-header center">No</div>
					<div class="table-cell-header-extend ui-corner-top table-cell-header center">Kartu</div>

					<div class="table-cell-header-extend ui-corner-top table-cell-header center">Jumlah Transaksi</div>
					<div class="table-cell-header-extend ui-corner-top table-cell-header center">Detail Transaksi</div>
					<div class="table-cell-header-extend ui-corner-top table-cell-header center">Cycle</div>
					<div class="table-cell-header-extend ui-corner-top table-cell-header center">Limit</div>
					<!-- <div class="table-cell-header-extend ui-corner-top table-cell-header center">Kredit Limit</div>
					<div class="table-cell-header-extend ui-corner-top table-cell-header center">Membal</div>
					<div class="table-cell-header-extend ui-corner-top table-cell-header center">Cycle</div>
					<div class="table-cell-header-extend ui-corner-top table-cell-header center">Block</div> -->

					<div class="table-cell-header-extend ui-corner-top table-cell-header center">Validasi Exp</div>

					<!-- <div class="table-cell-header-extend ui-corner-top table-cell-header center">Penawaran</div> -->

					<div class="table-cell-header-extend ui-corner-top table-cell-header center">Action</div>
				</div>

				<?php
        		// ambil data katu di table Customer Verification
				// berdasarkan Customer Number
				$result_array = DaftarKartu();
				// echo '<pre>';
				// var_dump($result_array[0]);
				// die;
        		$rowDataNo = 1;
				
				if (is_array($result_array[0]))
					foreach ($result_array[0] as $key => $row_array) {
						$row = Objective($row_array);
						// echo '<pre>';
						// print_r($row);
						if (!$row->field('CV_Data_CustId')) {
							continue;
						}

						$URI = &UR();
						$formButtonControlEdit = null;
						if ($URI->field('CustomerEdit')) {
							$formButtonControlEdit = sprintf("<button class=\"btn btn-success btn-xs\"  style=\"color:#FFF;\" onclick=\"window.ActionPaperWork('%s','UPDATEDATA');\">
															<i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>&nbsp;EDIT
															</button>",  $row->field('CV_Data_Id'));
						}
						$row->add('VR_Data_No', $rowDataNo);

						printf("%s", "<div class=\"table-row-extend\">");
						printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('VR_Data_No'));
						printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('CV_Data_CardType', 'SetCapital'));

						printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('jumlahTransaksi'));
						printf(
							"<div class=\"table-cell-content-extend table-cell-content center\">
								<div class=\"ui-widget-form-table\" style=\"width:99%%;margin-top:-2px;\">
									<div class=\"ui-widget-form-row\">
										<div class=\"ui-widget-form-cell\"><button class=\"btn btn-default btn-xs field-after-verifikasi77 field-after-state77 button_detail\" id=\"%s\" onclick=\"window.ActionDetailPenawaran('%s','%s','%s','PCTD');\">
										<i class=\"fa fa-eye\" aria-hidden=\"true\"></i>&nbsp;Detail</button>
										%s
										</div>
									</div>
								</div>
							</div>",
							sprintf('Detail_%s', $row->field('CV_Data_Id')),
							$row->field('CV_Data_CustId'),
							$row->field('CV_Data_FixID'),
							$row->field('CV_Data_Id'),
							$formButtonControlEdit
						);
						printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('CV_Data_Cycle', 'SetCurrency'));
						printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('CV_Data_Crelimit', 'SetCurrency'));
						// printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('CV_Data_Membal', 'SetCurrency'));
						//
						// printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('CV_Data_Cycle'));
						// printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('CV_Data_Block'));

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
								sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
								sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
								sprintf('%s', VerifikasiKartu($row)),
								sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
								sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
								sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
								sprintf("{field: 'CV_Data_CcExpired',id:'%s'}", $row->field('CV_Data_Id'))
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
								sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
								sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
								sprintf('%s', VerifikasiKartu($row)),
								sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
								sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
								sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
								sprintf("{field: 'CV_Data_CcExpired',id:'%s'}", $row->field('CV_Data_Id'))
							);
						}
                		// printf("<div class=\"table-cell-content-extend table-cell-content center\">%s</div>", $row->field('CV_Data_Penawaran'));
						printf(
							"<div class=\"table-cell-content-extend table-cell-content center\">
								<div class=\"ui-widget-form-table\" style=\"width:99%%;margin-top:-2px;\">
									<div class=\"ui-widget-form-row\">
										<div class=\"ui-widget-form-cell\"><button class=\"btn btn-default btn-xs field-after-verifikasi field-after-state button_%s\" id=\"%s\" name=\"%s\" onclick=\"window.ActionPaperWork('%s','%s','%s','%s','PCTD');\">
										<i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>&nbsp;PCTD</button>
										%s
										</div>
									</div>
								</div>
							</div>",
							sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
							sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
							sprintf('CV_Data_CcExpired_%s', $row->field('CV_Data_Id')),
							$row->field('CV_Data_CustId'),
							$row->field('CV_Data_FixID'),
							$row->field('CV_Data_Penawaran'),
							$row->field('CV_Data_Id'),
							$formButtonControlEdit
						);
          				printf("%s", "</div>");
						$rowDataNo++;
					}
				?>
			</div>
		</td>
	</tr>
</table>
