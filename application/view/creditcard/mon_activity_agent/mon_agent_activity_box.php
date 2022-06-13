<?php foreach( $row as $key => $row_agent ) : 
	$data = Objective( $row_agent );
?>
	<div class="ui-widget-form-table ui-widget-activty-panel panel-<?php echo $data->field('UserId');?>">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell" style="text-vertical:top;">
				<div class="ui-widget-form-table ui-widget-cell-box">
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell center">
							<div class="ui-widget-photo-frame">&nbsp;</div>
						</div>
					</div>
					
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell center <?php echo $data->field('UserId');?>">
							<?php printf('%s', $data->field('Fullname','strtoupper')); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="ui-widget-form-cell" style="text-vertical:top;">
				<div class="ui-widget-form-table ui-widget-cell-box">
					<div class="ui-widget-form-row ui-field-row-frame">
						<div class="ui-widget-form-cell text_caption">Extension</div>
						<div class="ui-widget-form-cell center">:</div>
						<div class="ui-widget-form-cell left"> 
							<div class='ui-field-value <?php echo $data->field('extension');?>'>&nbsp;</div>
						</div>
					</div>
					
					<div class="ui-widget-form-row ui-field-row-frame">
						<div class="ui-widget-form-cell text_caption">Status</div>
						<div class="ui-widget-form-cell center">:</div>
						<div class="ui-widget-form-cell left"> 
							<div class='ui-field-value <?php echo $data->field('agentstatus');?>'>&nbsp;</div>
						</div>
					</div>
					
					<div class="ui-widget-form-row ui-field-row-frame">
						<div class="ui-widget-form-cell text_caption">Time</div>
						<div class="ui-widget-form-cell center">:</div>
						<div class="ui-widget-form-cell left">
							<div class='ui-field-value <?php echo $data->field('timestatus');?>'>&nbsp;</div>
						</div>
					</div>
					
					<div class="ui-widget-form-row ui-field-row-frame">
						<div class="ui-widget-form-cell text_caption">Ext Status</div>
						<div class="ui-widget-form-cell center">:</div>
						<div class="ui-widget-form-cell left">
							<div class='ui-field-value <?php echo $data->field('extstatus');?>'>&nbsp;</div>
						</div>
					</div>
					
					<div class="ui-widget-form-row ui-field-row-frame">
						<div class="ui-widget-form-cell text_caption">Data</div>
						<div class="ui-widget-form-cell center">:</div>
						<div class="ui-widget-form-cell left">
							<div class='ui-field-value <?php echo $data->field('datastatus');?>'>&nbsp;</div>
						</div>
					</div>
					
					<div class="ui-widget-form-row ui-field-row-frame">
						<div class="ui-widget-form-cell text_caption"></div>
						<div class="ui-widget-form-cell center"></div>
						<div class="ui-widget-form-cell left">
							<div class="ui-widget-form-table" style="margin-left:-2px;margin-top:-2px;width:98%;">
								<div class="ui-widget-form-row">
									<div class="ui-widget-form-cell left">
										<button class="btn btn-style-<?php echo $data->field('UserId');?> btn-info btn-xs ui-btn-automax">
											<i class="fa fa-headphones"></i>&nbsp;Spy</button>
									</div>
									<div class="ui-widget-form-cell left">
										<button class="btn btn-style-<?php echo $data->field('UserId');?> btn-info btn-xs ui-btn-automax">
											<i class="fa fa-phone"></i>&nbsp;Coach</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
<?php endforeach; ?>

