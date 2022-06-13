<?php 
// $Detail = DetailVerification(); 
// debug( $Detail );

?>
<form name="frmXTradana">
 <?php echo form()->hidden('TX_Usg_VerId',    NULL, $Detail->field('TX_Usg_VerId'));?>
 <?php echo form()->hidden('TX_Usg_CustId',   NULL, $Detail->field('TX_Usg_CustId'));?>
 <?php echo form()->hidden('TX_Usg_Custno',   NULL, $Detail->field('TX_Usg_Custno'));?>
 <?php echo form()->hidden('TX_Usg_FixID',    NULL, $Detail->field('TX_Usg_FixID'));?>
 <?php echo form()->hidden('TX_Usg_Membal',   NULL, $Detail->field('TX_Usg_Membal'));?>
 <?php echo form()->hidden('TX_US_AvailDana', NULL, $Detail->field('TX_Usg_AvailableXD', 'AvailXtradana'));?>
 <?php echo form()->hidden('TX_Usg_TransId',  NULL, $Detail->field('TX_Usg_TransId'));?>
  
 
 <?php echo form()->hidden('TX_Usg_Program', 'input_text tolong', ( $Detail->field('TX_Usg_Program','strlen') ?  $Detail->field('TX_Usg_Program')  : 'XTRADANA'));?>
 <table class="paperworktable">
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Jenis Kartu');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('TX_Usg_JenisKartu', 'input_text tolong ui-disabled ui-normal', 
			$Detail->field('TX_Usg_JenisKartu','SetCapital'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Expired Date');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('TX_Usg_ExpiredKartu', 'input_text tolong ui-disabled ui-normal', 
			$Detail->field('TX_Usg_ExpiredKartu'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Kredit Limit');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('TX_Usg_KreditLimit', 'input_text tolong ui-disabled ui-normal', 
			$Detail->field('TX_Usg_KreditLimit','SetCurrency'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Available XD');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('TX_Usg_AvailableXD', 'input_text tolong ui-disabled ui-normal', 
			$Detail->field('TX_Usg_AvailableXD','SetCurrency'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Available SS');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('TX_Usg_AvailableSS', 'input_text tolong ui-disabled ui-normal', 
			$Detail->field('TX_Usg_AvailableSS','SetCurrency'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Penawaran');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('TX_Usg_Penawaran', 'input_text tolong ui-disabled ui-normal', 
													 $Detail->field('TX_Usg_Penawaran'));?> </td>
	</tr>
	
	
	<!-- test -->
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Cycle');?></td>
		<td class="ui-data-cell-0"><?php echo form()->input('TX_Usg_Cycle', 'input_text tolong ui-disabled ui-unormal', 
			$Detail->field('TX_Usg_Cycle'));?> </td>
	
		<td class="ui-data-cell-3"><?php echo lang('Block');?></td>
		<td class="ui-data-cell-4"><?php echo form()->input('TX_Usg_Block', 'input_text tolong ui-disabled ui-unormal', 
			$Detail->field('TX_Usg_Block'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1" colspan='4'>&nbsp;</td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Status Penawaran');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->combo('TX_Usg_Statement', 'select superlong', array('Y'=>'SETUJU','N'=>'TIDAK SETUJU'),
			$Detail->field('TX_Usg_Statement'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Program');?></td>
		<td class="ui-data-cell-2" colspan="3">
		<?php echo form()->combo('TX_Usg_ProgramData', 'select superlong', 
			ProgramDetail($Detail->field('TX_Usg_Penawaran','SetRealPercent')), 
			$Detail->field('TX_Usg_ProgramData'), array('change' => 'window.EventCallculator(this);')) ?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Nama Rekening');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('TX_Usg_NamaRekening', 'input_text tolong',
		( $Detail->field('TX_Usg_NamaRekening') 
			? $Detail->field('TX_Usg_NamaRekening') :  
			$Detail->field('TX_Usg_CustomerName')) );?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('No. Rekening');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('TX_Usg_NoRekening', 'input_text tolong',
		$Detail->field('TX_Usg_NoRekening'), null, array( 'length' => 16 ));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Nama Bank');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('TX_Usg_NamaBank', 'input_text tolong',
		$Detail->field('TX_Usg_NamaBank'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Cabang');?></td>
		<td class="ui-data-cell-2" colspan="3"><?php echo form()->input('TX_Usg_Cabang', 'input_text tolong',
		$Detail->field('TX_Usg_Cabang'));?> </td>
	</tr>
	
	<tr> 
		<td class="ui-data-cell-1"><?php echo lang('Jumlah Dana');?> 
		<span class='paperworknote'>( Rp. )</span></td>
		<td class="ui-data-cell-2">
		<?php echo form()->input('TX_Usg_JumlahDana', 'input_text tolong',
		$Detail->field('TX_Usg_JumlahDana',array('SetNominal','SetCurrency') ), array('keyup' => 'window.EventSetJumlahDana(this);') );?> </td>
		
		<td class="ui-data-cell-3"><?php echo lang('Tenor');?></td>
		<td class="ui-data-cell-4"><?php echo form()->combo('TX_Usg_Tenor', 'select long ui-select-data',Tenor(), 
			$Detail->field('TX_Usg_Tenor'));?> </td>
	</tr>
	 
</table>
</form>