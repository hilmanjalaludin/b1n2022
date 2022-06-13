<fieldset class="corner ui-fieldset-cv-top" style="width:auto;padding: 4px 4px 2px 4px;margin:-12px -5px 5px 0px;">
  <?php echo form()->legend(lang("Filter Data"), "fa-search"); ?>
  <form name="formCvFilter">
    <div class="ui-widget-form-table" style="margin-top:-5px;width:100%;">
      <div class="ui-widget-form-row">
        <div class="ui-widget-form-cell text_caption"><?php echo lang("Cust No"); ?></div>
        <div class="ui-widget-form-cell text_caption">:</div>
        <div class="ui-widget-form-cell"><?php echo form()->input("cust_no_cv", "input_text tolong"); ?></div>
      </div>
      <div class="ui-widget-form-row">
        <div class="ui-widget-form-cell text_caption"></div>
        <div class="ui-widget-form-cell text_caption"></div>
        <div class="ui-widget-form-cell">
          <?php echo form()->button("BtnCvFilter", "button search", lang("Search"), array('click' => 'Ext.DOM.SearchDataCv();')); ?>
          <?php echo form()->button("BtnCvReset", "button clear", lang(array("Clear", "&nbsp;&nbsp;")), array('click' => 'Ext.DOM.ClearDataCv();')); ?>
        </div>
      </div>
    </div>
  </form>
</fieldset>