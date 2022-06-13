<table  class='paperworktable'>
	<tr> 
		<td class="ui-data-cell-3" align="center">Dana <br>Yang diambil</td>
		<td class="ui-data-cell-4" align="center">Simulasi</td>
		 
		<td class="ui-data-cell-5 ui-data-center" rowspan=2 >
			<div class="work-loader-data" id="ui-sim-calculator">
				<table class='paperworktable'>
					<tr> 
						<td class="header-cell-1 label-bold">&nbsp;</td>
						<td class="header-cell-2 label-bold">Pokok <span class='paperworknote'>( Rp. )</span></td>
						<td class="header-cell-3 label-bold">Bunga <span class='paperworknote'>( Rp. )</span></td>
						<td class="header-cell-4 label-bold">Total <span class='paperworknote'>( Rp. )</span></td>
					</tr>
					
					<tr> 
						<td class="header-cell-1">-</td>
						<td class="header-cell-2">0</td>
						<td class="header-cell-3">0</td>
						<td class="header-cell-4">0</td>
					</tr>
				</table>		
			</div>
		</td>
		
	</tr>
	
	<tr> 
		<td class='ui-data-center ui-data-lasted'> 
		<?php echo form()->input('TX_Usg_SimulDana', 'input_text ui-text-autolong',
								 $Detail->field('TX_Usg_JumlahDana',array('SetNominal','SetCurrency') ), array('keyup' => 'window.EventGetSimulDana(this);') );?> </td>
		 
		</td>
		
		<td class='ui-data-center ui-data-lasted'>
		 <button name="btnSubmitXTradana" class="btn btn-success btn-xs button3" onclick="window.EventCallculator(this);">
			<i class="fa fa-sign-out  "></i>&nbsp;</button>
		</td>  
		
	</tr>
	
	<div id="dialog-confirm" title="Perisai Plus" style="display: none;">
		<p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Apakah Customer setuju dengan penawaran Perisai Plus?</p>
	</div>
	
</table>
	

<table class="paperworktable" style="margin-top:25px;">
	<tr> 
		<td style="border:0px solid #000;text-align:center;">
		
		<button name="btnSubmitXTradana" class="btn btn-info btn-sm button2" onclick="window.EventSubmit();">
		<i class="fa fa-save"></i>&nbsp;Save</button>
		
		<button id="btnPerisaiPlus" class="btn btn-sm button1 btn-infos"  onclick="window.EventPerisaiPlus();">
		<i class="fa fa-save"></i>&nbsp;Perisai Plus &nbsp;</button>
			
		<button name="btnSubmitXTradana" class="btn btn-info btn-sm button2" onclick="window.EventCancel();">
		<i class="fa fa-close"></i>&nbsp;Exit</button>
		
		<button name="btnSubmitXTradana" class="btn btn-info btn-sm button1" onclick="window.Eventaddnew();">
		<i class="fa fa-save"></i>&nbsp;New</button>
		
		<!--
		<button name="btnKalXTradana" class="btn btn-info btn-sm button3" onclick="window.EventSimulasi();">
		<i class="fa fa-calculator"></i>&nbsp;Simulasi</button>
			-->
		</td>
	</tr>
</table>