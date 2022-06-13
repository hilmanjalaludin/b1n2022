<table class="paperworktable" style="margin-top:25px;">
	<tr>

		<td style="border:0px solid #000;text-align:center;">
		<?php if($CekRowTapenas['TR_CustNo'] == null ){ ?>
		<button name="btnSubmitXTradana" class="btn btn-info btn-sm button1" onclick="window.EventSubmit();">
		<i class="fa fa-save"></i>&nbsp;Save</button>
		<?php }
		else if ($QcId['user_role']==10){ ?>
		<button name="btnSubmitXTradana" class="btn btn-info btn-sm button1" onclick="window.EventSubmit();">
		<i class="fa fa-save"></i>&nbsp;Save</button>
		<?php }
		
		else { ?> 
		
		<?php
			}
		?>		
		
			
		<button name="btnSubmitXTradana" class="btn btn-info btn-sm button2" onclick="window.EventCancel();">
		<i class="fa fa-close"></i>&nbsp;Exit</button>
		
		<!--
		<button name="btnKalXTradana" class="btn btn-info btn-sm button3" onclick="window.EventSimulasi();">
		<i class="fa fa-calculator"></i>&nbsp;Simulasi</button>
			-->
		</td>
	</tr>
</table>

