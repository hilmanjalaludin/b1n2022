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
		<?php //echo form()->input('TX_Usg_SimulDana', 'input_text tolong ui-disabled ui-normal',
								 //$Detail->field('TX_Usg_JumlahDana',array('SetNominal','SetCurrency') ), array('keyup' => 'window.EventGetSimulDana(this);') );?> 
		
		<?php //echo form()->input('TX_Usg_SimulDana', 'input_text tolong ui-disabled ui-normal',
			//$Detail->field('TX_Usg_AvailableXD','SetCurrency'),array('keyup' => 'window.EventGetSimulDana(this);'));?>						 
	<input type="text"  name="TX_Usg_SimulDana" id="TX_Usg_SimulDana" class="input_text tolong ui-disabled ui-normal" value="<?php echo $Detail->field('TX_Usg_AvailableXD','SetCurrency') ?>" onkeyup="window.EventGetSimulDana(this);" disabled="disabled"> 
	</td>
				
		</td>
		
		<td class='ui-data-center ui-data-lasted'>
		 <button name="btnSubmitXTradana" class="btn btn-success btn-xs button3" onclick="window.EventCallculator(this);">
			<i class="fa fa-sign-out  "></i>&nbsp;</button>
		</td>  
		
	</tr>
	
	
	
</table>
	

<table class="paperworktable" style="margin-top:25px;">
	<tr> 
		<td style="border:0px solid #000;text-align:center;">
		<?php if(_get_session('HandlingType') != '19'){  ?>
		<button name="btnSubmitXTradana" class="btn btn-info btn-sm button1" onclick="window.EventSubmit();">
		<i class="fa fa-save"></i>&nbsp;Save</button>
		<?php } ?>
			
		<button name="btnSubmitXTradana" class="btn btn-info btn-sm button2" onclick="window.EventCancel();">
		<i class="fa fa-close"></i>&nbsp;Exit</button>
		
		<!-- <button name="btnSubmitXTradana" class="btn btn-info btn-sm button1" onclick="window.Eventaddnew();">
		<i class="fa fa-save"></i>&nbsp;New</button>
		 -->
		<!--
		<button name="btnKalXTradana" class="btn btn-info btn-sm button3" onclick="window.EventSimulasi();">
		<i class="fa fa-calculator"></i>&nbsp;Simulasi</button>
			-->
		</td>
	</tr>
</table>