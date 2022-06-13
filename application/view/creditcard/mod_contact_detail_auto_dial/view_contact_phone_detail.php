

    <fieldset class="corner" style="margin-top:-5px;border-radius:0px;padding:5px 0px 10px 0px;">
    <?php echo form()->legend(lang(array('Call Activity')), "fa-phone"); ?>
    <div style="overflow:auto;margin-top:-5px;" class="ui-widget-form-table-compact">
    <?php echo form()->hidden("CallingNumber",NULL, $Detail->field('DM_Id', array('PhoneCall'))); ?>
    <form name="frmActivityCall" onsubmit="return false;">
    <?php echo form()->hidden('QualityStatus',NULL,$Detail->get_value('CallReasonQue') );?>
     
    <div class="ui-widget-form-table-compact">
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption ui-row-col1"><?php echo lang("LB_CallNumber");?></div>
    <div class="ui-widget-form-cell center ui-row-col2">:</div>
    <div class="ui-widget-form-cell ui-row-col3">
    <?php echo form()->combo('PhoneNumber','select tolong select-chosen',
    $Detail->field('DM_Id', array('CustomerContactPhoneAutoDial')),
    $Detail->field('DM_Id', array('CustomerContactPhoneFirst')),
//    $Detail->field('DM_Id', array('CustomerContactLasted','base64_encode')),
    array("change" =>"window.SetNumber(this.value);") ); ?>
    </div>
    </div>

     
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption ui-row-col1"><?php echo lang("LB_AddCallNumber");?></div>
    <div class="ui-widget-form-cell center ui-row-col2">:</div>
    <div class="ui-widget-form-cell ui-row-col3">
    <span id="ui-add-phone-list">
    <?php echo form()->combo('AddPhoneNumber','select tolong select-chosen after-user-sale',
    $Detail->field('DM_Id', array('CustomerAdditionalPhone')),
    $Detail->field('DM_Id', array('CustomerContactLasted','base64_encode')),
    array("change" =>"Ext.Cmp('CallingNumber').setValue(Ext.BASE64.decode(this.value));")); ?></span>
    <span class="ui-widget-refresh-active" title='Refresh Data' onclick="window.EventRefreshPhone();" title="Refresh aditional phone">&nbsp;&nbsp;&nbsp;</span>
    </div>
    </div>
     
    <div class="ui-widget-form-row baris1">
    <div class="ui-widget-form-cell text_caption ui-row-col1"></div>
    <div class="ui-widget-form-cell center ui-row-col2"></div>
    <div class="ui-widget-form-cell left ui-row-col3">
    <?php echo form()->button_role('_CAL_TOOL_',$Button);?>
    <?php echo form()->button_role('_HAG_TOOL_',$Button);?>
    <!-- ubah tanggal 12-8-2020 -->
    <?php
    if($this->EUI_Session->_get_session('HandlingType')!= '4'){
    echo form()->button_role('_ADD_TOOL_',$Button);
    }
    ?>
    <!-- end -->
    </div>
    </div>
     
     
     
    <div class="ui-widget-form-row baris1">
    <div class="ui-widget-form-cell text_caption ui-row-col1"></div>
    <div class="ui-widget-form-cell center ui-row-col2"></div>
    <div class="ui-widget-form-cell ui-row-col1"></div>
    </div>
     
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption ui-row-col1"><?php echo lang("LB_ProdukScript");?></div>
    <div class="ui-widget-form-cell center ui-row-col2">:</div>
    <div class="ui-widget-form-cell ui-row-col3"><?php echo form()->combo('CallProdukScript','select tolong select-chosen', $Detail->field('DM_ProductId', 'ProductScript'), null, array('change' => 'window.EventScript(this);')); ?></div>
    </div>
    <?php if($Detail->field('DM_Note')){?>
    <div class="ui-widget-form-row">
    <div class="ui-widget-form-cell text_caption ui-row-col1"><?php echo lang("IS Publish");?></div>
    <div class="ui-widget-form-cell center ui-row-col2">:</div>
    <div class="ui-widget-form-cell ui-row-col3">
    <select type="combo" name="ispublish" id="ispublish" class="select tolong select-chosen" style="width: 258px; display: none;">
    <option value=""> --choose -- </option>
    <option value="YES">YES</option>
    <option value="NO">NO</option>
    </select>
    </div>
    </div>
    <?php }?>
     
    <div class="ui-widget-form-row baris1 usage-row-data-balcon">
    <div class="ui-widget-form-cell text_caption"></div>
    <div class="ui-widget-form-cell center"></div>
    <div class="ui-widget-form-cell">
    <button name="btnKalXTradana" class="btn btn-info btn-xs button-calculator-balcon"
    onclick="window.EventUserCalculator('Usage', 'XTRADANA');">
    <i class="fa fa-calculator"></i>&nbsp;&nbsp;Usage Calculator</button>
    </div>
    </div>
     
    <div class="ui-widget-form-row baris1 usage-row-data">
    <div class="ui-widget-form-cell text_caption"></div>
    <div class="ui-widget-form-cell center"></div>
    <div class="ui-widget-form-cell">
    <button name="btnKalXTradana" class="btn btn-info btn-xs button-calculator"
    onclick="window.EventUserCalculatorBalcon('BALCON', 'BALCON');">
    <i class="fa fa-calculator"></i>&nbsp;&nbsp;Balcon Calculator</button>
    </div>
    </div>
     
    </div>
    </form>
    </fieldset>
     
    <!-- form activity account -->
     
    <fieldset class="corner" style="margin-top:20px;border-radius:0px;padding:22px 0px 10px 0px;">
    <form name="frmActivityData" onsubmit="return false;">
    <div style="overflow:auto;margin-top:-5px;" class="ui-widget-form-table-compact">
    <div class="ui-widget-form-row baris1">
    <div class="ui-widget-form-cell text_caption ui-row-col1 addcol1"><?php echo lang("LB_CallReasonCategoryName");?></div>
    <div class="ui-widget-form-cell center ui-row-col2">:</div>
    <div class="ui-widget-form-cell ui-row-col3"><?php echo form()->combo('CallStatusId','select tolong select-chosen', CallStatusDisposition() ,$Detail->get_value('DM_CallCategoryId'),array('change'=>"window.EventCallResultID(this);")); ?></div>
    </div>
     
    <div class="ui-widget-form-row baris1">
    <div class="ui-widget-form-cell text_caption ui-row-col1 addcol1"><?php echo lang("LB_CallReasonName");?></div>
    <div class="ui-widget-form-cell center ui-row-col2">:</div>
    <div class="ui-widget-form-cell ui-row-col3" >
    <span id="ui-call-result-id">
    <?php echo form()->combo('CallResultId','select tolong select-chosen ', CallResultByCategory( $Detail->field('DM_CallCategoryId') ),
    $Detail->field('DM_CallReasonId'),array('change'=>'window.EventSaleHandler(this);')); ?>
    </span>
    <span class="ui-widget-refresh-active winpop" id="winpop" name="winpop">&nbsp;&nbsp;</span>
    </div>
     
    <!--
    <div class="ui-widget-form-cell left">
     
    </div>
    -->
     
    </div>
     
    <div class="ui-widget-form-row baris1">
    <div class="ui-widget-form-cell text_caption ui-row-col1 addcol1"><?php echo lang("LB_CallLater");?></div>
    <div class="ui-widget-form-cell center ui-row-col2">:</div>
    <div class="ui-widget-form-cell ui-row-col3">
    <?php echo form()->input('DateLater','input_text box date'); ?>&nbsp;
    <?php echo form()->combo('HourLater','select boox select-chosen',ListHour(), '00', null,array('style'=>'margin-top:2px;')); ?> :
    <?php echo form()->combo('MinuteLater','select boox select-chosen',ListMinute(),'00', null, array('style'=>'margin-top:2px;'));?>
    </div>
    </div>
     
    <div class="ui-widget-form-row baris1">
    <div class="ui-widget-form-cell text_caption ui-row-col1 addcol1"><?php echo lang("Note");?></div>
    <div class="ui-widget-form-cell center ui-row-col2">:</div>
    <div class="ui-widget-form-cell ui-row-col3"><?php echo form()->textarea("CallRemarks", "textarea tolong uppercase", null, null );?></div>
    </div>
     
    <div class="ui-widget-form-row baris1">
    <div class="ui-widget-form-cell text_caption ui-row-col1 addcol1"></div>
    <div class="ui-widget-form-cell center ui-row-col2"></div>
    <div class="ui-widget-form-cell ui-row-col3">
    <?php echo form()->button_role('_SAV_TOOL_',$Button);?>
    <?php //echo form()->button_role('_NXT_TOOL_',$Button);?>
    <?php echo form()->button_role('_CLS_TOOL_',$Button);?>
    </div>
    </div>
     
    </div>
     
    </form>
    </div>
    </fieldset> 

