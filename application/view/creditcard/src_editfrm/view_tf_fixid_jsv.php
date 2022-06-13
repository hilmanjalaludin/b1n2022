<script>
  var gTotalData = {
    cm: 0,
    cv: 0,
  }

  window.percentData = {
    cm: 0,
    cv: 0,
  }

  window.SearchDataCm = function() {
    new window.ViewCmData({
      orderby: '',
      type: '',
      page: 0
    });
  }

  window.ViewCmData = function(item) {
    
    
    var formCmFilter = Ext.Serialize('formCmFilter');
    $('#ui-widget-cm-list').Spiner({
      url: new Array('Editfrm', 'PageCm'),
      param: Ext.Join(new Array(formCmFilter.getElement())).object(),
      order: {
        order_type: item.type,
        order_by: item.orderby,
        order_page: item.page
      },
      handler: 'ViewCmData',
      complete: function(obj) {
        // get total to set on right of page 
        this.dataSize = parseInt($('#ui-total-ui-pager-cm-data-record').text());
        // tambahan slider untuk wrap table 
        // add customize for scroll testing 
        if (!$('.ui-widget-scroll-top-table-cm').length) {
          $("<div class='ui-widget-scroll-top-table-cm'>" +
            "<div class='ui-wdget-slider-top-cm' style='width:99%;'></div>").insertBefore(obj);
        }
        // callculate of height this 
        this.protectedHeighes = $('#ui-pager-cm-data').innerHeight() + $('#ui-pager-cm-data-bottom').innerHeight();
        this.protectedHeights = this.protectedHeighes + 15;
        this.protectedWidths = $(window).innerWidth() - ($(window).innerWidth() / 3);
        // replace styleSheets of overflow method 	
        $(".ui-widget-cm-list").css({
          width: Math.round(this.protectedWidths),
          height: Math.round(this.protectedHeights)
        });
        $(".ui-widget-cm-list").addClass("ui-scroller-width-right-border-fixed");

        if (this.dataSize == 0) {
          this.maxWidthPager = (($('.ui-fieldset-cm-top').innerHeight() + $('.ui-fieldset-cm-bot').innerHeight()) + 200);
          $(".ui-widget-cm-list").css({
            height: this.maxWidthPager
          });
        }
        if (this.dataSize > 0) {
          this.maxWidthPager = (($('.ui-fieldset-cm-top').innerHeight() + $('.ui-fieldset-cm-bot').innerHeight()) + 200);
          $(".ui-widget-cm-list").css({
            height: this.maxWidthPager
          });
        }
        //console.log(window.percentData.perDis);
        if (window.percentData.cm) {
          $('.ui-widget-cm-list').scrollLeft(window.percentData.cm);
        }
        // create slider data process 
        $(".ui-wdget-slider-top-cm").slider({
          slide: function(event, ui) {
            this.widthData = $('.ui-pager-cm-data-headers').innerWidth();
            //this.widthData = $('.ui-widget-cm-list').innerWidth();
            window.percentData.cm = ((this.widthData * ui.value) / 100);
            //console.log(window.percentData.cm);
            $('.ui-widget-cm-list').scrollLeft(window.percentData.cm);
          }
        });
        // set data on pager cm process 
        // isi ke object global di atas .
        gTotalData.cm = this.dataSize;
        // components attributes process 
        Ext.Cmp('cm_quantity').setValue(0);
        Ext.Cmp('cm_total').setValue(this.dataSize);
        Ext.Cmp('cm_total').disabled(true);
      }
    });
  }

  window.ClearDataCm = function() {
    Ext.Serialize('formCmFilter').Clear(new Array('cm_record_page'));
    new Ext.DOM.SearchDataCm();
  }

  Ext.DOM.ActionCheckCm = function(item) {
    // alert(Ext.Cmp(item).getValue())
    // return false
    if (Ext.Cmp(item).getValue() != '' || Ext.Cmp(item).getValue() != null) {
      Ext.Ajax({
        url: Ext.EventUrl(['Editfrm', 'getCmDetail']).Apply(),
        method: 'POST',
        param: {
          'TX_Usg_Id': Ext.Cmp(item).getValue()
        },
        ERROR: function(e) {
          Ext.Util(e).proc(function(response) {
            console.log('data respon',response.data.TX_Usg_Id)
            Ext.Cmp('TX_Usg_Id').setValue(response.data.TX_Usg_Id)
            Ext.Cmp('custid').setValue(Ext.Cmp(item).getValue())
            Ext.Cmp('custid_assignment').setValue(Ext.Cmp(item).getValue())
            // Ext.Cmp('TX_Usg_Id').setValue(response.data.TX_Usg_Id)
            Ext.Cmp('spv_old').setValue(response.data.TX_Usg_SpvKode)
            Ext.Cmp('seller_old').setValue(response.data.TX_Usg_SellerKode)
            Ext.Cmp('label_seller_old').setValue(response.data.DM_SellerId+' - '+response.data.name_agent)
            // Ext.Cmp('spv_old').setValue(response.data.AssignSpv)
            // Ext.Cmp('label_spv_old').setValue(response.data.AssignSpv+' - '+response.data.name_spv)
            $("#frmCmOption").show()
            $("#frmCmOptionAssignment").show()
            Ext.Cmp(item).disabled(true)
          });
        }
      }).post();
    }
  }

  window.UpdateCm = function() {
    var Data = new Array(
      Ext.Serialize("frmCmOption").getElement(), 
    );
    Ext.Ajax({
      url: Ext.EventUrl(['Editfrm', 'updateCm']).Apply(),
      method: 'POST',
      param 	: Ext.Join( Data ).object(),
      ERROR: function(e) {
        Ext.Util(e).proc(function(response) {
          if(response.status == 1) {
            Ext.DOM.CancelCm();
          } else {
            alert('Opss, something wrong');
          }
        });
      }
    }).post();
  }

  Ext.DOM.CancelCm = function() {
    $("#frmCmOptionAssignment").hide()
    $("#frmCmOption").hide()
    new Ext.DOM.SearchDataCm()
  }

  // assignment
  Ext.DOM.pickSpv = function(spv) {
    Ext.Ajax({
      url: Ext.EventUrl(['Editfrm', 'getAgent']).Apply(),
      method: 'POST',
      param 	: {spv_id: spv.value},
      ERROR: function(e) {
        Ext.Util(e).proc(function(response) {
          if(response.status == 1) {
            var content = ''
            for(var i = 0; i < response.data.length; i++) {
              content += '<option value="'+response.data[i].UserId+'">'+response.data[i].id+' - '+response.data[i].full_name+'</option>'
            }
            document.getElementById('seller_new').innerHTML = content
          } else {
            alert('Opss, something wrong');
          }
        });
      }
    }).post();
  }

  Ext.DOM.UpdateCmAssignment = function() {
    var Data = new Array(
      Ext.Serialize("frmCmOptionAssignment").getElement(), 
    );
    Ext.Ajax({
      url: Ext.EventUrl(['Editfrm', 'updateCmAssignment']).Apply(),
      method: 'POST',
      param 	: Ext.Join( Data ).object(),
      ERROR: function(e) {
        Ext.Util(e).proc(function(response) {
          if(response.status == 1) {
            alert('Edit assignment sukses')
            Ext.DOM.CancelCmAssignment();
          } else {
            alert('Opss, something wrong');
          }
        });
      }
    }).post();
  }

  Ext.DOM.CancelCmAssignment = function() {
    $("#frmCmOptionAssignment").hide()
    $("#frmCmOption").hide()
    new Ext.DOM.SearchDataCm()
  }

  window.SearchDataCv = function() {
    new window.ViewCvData({
      orderby: '',
      type: '',
      page: 0
    });
  }

  window.ViewCvData = function(item) {
    var formCvFilter = Ext.Serialize('formCvFilter');
    $('#ui-widget-cv-list').Spiner({
      url: new Array('Editfrm', 'PageCv'),
      param: Ext.Join(new Array(formCvFilter.getElement())).object(),
      order: {
        order_type: item.type,
        order_by: item.orderby,
        order_page: item.page
      },
      handler: 'ViewCvData',
      complete: function(obj) {
        // get total to set on right of page 
        this.dataSize = parseInt($('#ui-total-ui-pager-cv-data-record').text());
        // tambahan slider untuk wrap table 
        // add customize for scroll testing 
        if (!$('.ui-widget-scroll-top-table-cv').length) {
          $("<div class='ui-widget-scroll-top-table-cv'>" +
            "<div class='ui-wdget-slider-top-cv' style='width:99%;'></div>").insertBefore(obj);
        }
        // callculate of height this 
        this.protectedHeighes = $('#ui-pager-cv-data').innerHeight() + $('#ui-pager-cv-data-bottom').innerHeight();
        this.protectedHeights = this.protectedHeighes + 15;
        this.protectedWidths = $(window).innerWidth() - ($(window).innerWidth() / 3);
        // replace styleSheets of overflow method 	
        // $(".ui-widget-cv-list").css({
        //   width: Math.round(this.protectedWidths),
        //   height: Math.round(this.protectedHeights)
        // });
        $(".ui-widget-cv-list").addClass("ui-scroller-width-right-border-fixed");

        if (this.dataSize == 0) {
          this.maxWidthPager = (($('.ui-fieldset-cv-top').innerHeight() + $('.ui-fieldset-cv-bot').innerHeight()) + 500);
          $(".ui-widget-cv-list").css({
            height: this.maxWidthPager
          });
        }
        if (this.dataSize > 0) {
          this.maxWidthPager = (($('.ui-fieldset-cv-top').innerHeight() + $('.ui-fieldset-cv-bot').innerHeight()) + 500);
          $(".ui-widget-cv-list").css({
            height: this.maxWidthPager
          });
        }
        //console.log(window.percentData.perDis);
        if (window.percentData.cv) {
          $('.ui-widget-cv-list').scrollLeft(window.percentData.cv);
        }
        // create slider data process 
        $(".ui-wdget-slider-top-cv").slider({
          slide: function(event, ui) {
            this.widthData = $('.ui-pager-cv-data-headers').innerWidth();
            //this.widthData = $('.ui-widget-cv-list').innerWidth();
            window.percentData.cv = ((this.widthData * ui.value) / 100);
            //console.log(window.percentData.cv);
            $('.ui-widget-cv-list').scrollLeft(window.percentData.cv);
          }
        });
        // set data on pager cv process 
        // isi ke object global di atas .
        gTotalData.cv = this.dataSize;
        // components attributes process 
        Ext.Cmp('cv_quantity').setValue(0);
        Ext.Cmp('cv_total').setValue(this.dataSize);
        Ext.Cmp('cv_total').disabled(true);
      }
    });
  }

  window.ClearDataCv = function() {
    Ext.Serialize('formCvFilter').Clear(new Array('cv_record_page'));
    new Ext.DOM.SearchDataCv();
  }

  Ext.DOM.ActionCheckCv = function(item) {
    // alert(Ext.Cmp(item).getValue())
    // console.log(Ext.Cmp(item).getValue())
    // return false
    if (Ext.Cmp(item).getValue() != '' || Ext.Cmp(item).getValue() != null) {
      Ext.Ajax({
        url: Ext.EventUrl(['Editfrm', 'getCvDetail']).Apply(),
        method: 'POST',
        param: {
          'CV_Data_Id': Ext.Cmp(item).getValue()
          // 'CV_Data_Id': Ext.Cmp(item).getValue()
        },
        ERROR: function(e) {
          Ext.Util(e).proc(function(response) {
            console.log(response.data)
            Ext.Cmp('cv_dataid').setValue(Ext.Cmp(item).getValue())
            Ext.Cmp('custid_old_cv').setValue(response.data.CV_Data_CustId)
            Ext.Cmp('campaign_old_cv').setValue(response.data.CV_Data_Campaign_Id)
            $("#frmCvOption").show()
            Ext.Cmp(item).disabled(true)
          });
        }
      }).post();
    }
  }

  window.UpdateCv = function() {
    var Data = new Array(
      Ext.Serialize("frmCvOption").getElement(), 
    );
    Ext.Ajax({
      url: Ext.EventUrl(['Editfrm', 'updateCv']).Apply(),
      method: 'POST',
      param 	: Ext.Join( Data ).object(),
      ERROR: function(e) {
        Ext.Util(e).proc(function(response) {
          if(response.status == 1) {
            Ext.DOM.CancelCv();
          } else {
            alert('Opss, something wrong');
          }
        });
      }
    }).post();
  }

  Ext.DOM.CancelCv = function() {
    $("#frmCvOption").hide()
    new Ext.DOM.SearchDataCv()
  }

  $(document).ready(function() {
    $("#frmCmOption").hide()
    $("#frmCvOption").hide()
    $("#frmCmOptionAssignment").hide()
    $('#ui-widget-user-tf-fixid').mytab().tabs();
    $('#ui-widget-user-tf-fixid').mytab().tabs("option", "selected", 0);
    $('#ui-widget-user-tf-fixid').css({
      'background-color': '#FFFFFF'
    });
    $("#ui-widget-user-tf-fixid").mytab().close(function() {
      Ext.DOM.RoleBack();
    }, true);

    $('#ui-widget-tf-fixid-cm').css({
      'background-color': '#FFFFFF'
    });
    $('#ui-widget-tf-fixid-cv').css({
      'background-color': '#FFFFFF'
    });
    $('.xselect').chosen();
    $('.corner').css({
      'border-radius': '0'
    });
    $('.date').datepicker({
      showOn: 'button',
      changeYear: true,
      changeMonth: true,
      buttonImage: Ext.Image('calendar.gif'),
      buttonImageOnly: true,
      dateFormat: 'dd-mm-yy',
      readonly: true
    });

    // // open data view tab process on handle 
    // // tf-fixid data OK 	
    window.SearchDataCm();
    window.SearchDataCv();
  });
</script>