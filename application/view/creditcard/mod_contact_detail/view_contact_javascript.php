<script language="text/javascript">
    /*
     * @ def : toolbars on navigation
     * ------------------------------------------
     *
     * @ param : no define
     * @ aksess : procedure
     */

    var reason = [];
    var AgentScript = {};

    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */


    window.initFunc = {
        validParam: false,
        isCallPhone: false,
        isRunCall: false,
        isHangup: false,
        isCancel: true,
        isSave: false,
        isDial: false
    }
    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.CallInterest = function() {
        return (Ext.Ajax({
            url: Ext.DOM.INDEX + '/SetCallResult/getEventType/',
            method: 'GET',
            param: {
                CallResultId: Ext.Cmp('CallResultId').getValue()
            }
        }).json());
    }

    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.EventSetFollowup = function(MasterDataId) {
        // lepas aja ya
        var callDataResponse = 0,
            row = Ext.Json('SrcCustomerList/SetFollowup', {
                MasterDataId: MasterDataId
            });

        // return each data process .
        row.dataItemEach(function(item) {
            console.log(item.success)
            if (item.success) {
                callDataResponse++;
            }
        });
        return callDataResponse;
    }
    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.EventUnsetFollowup = function(MasterDataId) {
        var dataScriptDataJson = {},
            dataRowUrl = Ext.Json("SrcCustomerList/UnsetFollowup", {
                MasterDataId: MasterDataId
            });

        dataRowUrl.dataItemEach(function(dataJson) {
            if (typeof(dataJson) == 'object') {
                dataScriptDataJson = dataJson;
            }
        });
        // return callback to user .
        return dataScriptDataJson;
    }

    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.dataScriptDataJson = function() {
        var dataScriptDataJson = {},
            dataRowUrl = Ext.Json("SetProductScript/getScript", {
                CampaignId: Ext.Cmp('DM_CampaignId').getValue()
            });

        // check apakah data object
        dataRowUrl.dataItemEach(function(dataJson) {

            console.log(typeof(dataJson));
            if (typeof(dataJson) == 'object') {
                dataScriptDataJson = dataJson;
            } else {
                dataScriptDataJson = {};
            }
        });

        return dataScriptDataJson;
    }

    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.PolicyReady = function() {
        var dataScriptDataJson = false,
            dataRowUrl = Ext.Json("SrcCustomerList/PolicyStatus", {
                CustomerId: Ext.Cmp('DM_Id').getValue()
            });

        // sent to client data object.
        dataRowUrl.dataItemEach(function(dataJson) {
            if (typeof(dataJson) == 'object') {
                dataScriptDataJson = dataJson;
            }
        });

        // return callback to user .
        return dataScriptDataJson;
    }

    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.EventRefreshPhone = function() {
        var object = $('#AddPhoneNumber');

        $("#ui-add-phone-list").loader({
            url: new Array('ModApprovePhone', 'RefreshPhoneNumber'),
            param: {
                FieldName: object.attr('id'),
                FieldValue: object.attr('value'),
                FieldStyle: object.attr('class'),
                CustomerId: Ext.Cmp('CustomerId').getValue()
            },
            complete: function(obj) {
                window.propLayout();
                $('.select-chosen').chosen();
            }
        });
    }

    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.DisabledActivity = function() {
        if (Ext.DOM.initFunc.isCallPhone != true) {
            Ext.Cmp('CallStatus').disabled(true);
            Ext.Cmp('CallResult').disabled(true);
        } else {
            Ext.Cmp('CallStatus').disabled(false);
            Ext.Cmp('CallResult').disabled(false);
        }
    }
    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    Ext.DOM.ShowWindowScript = function(ScriptId) {
        var WindowScript = new Ext.Window({
            url: Ext.DOM.INDEX + '/SetProductScript/ShowProductScript/',
            name: 'WinProduct',
            height: (Ext.Layout(window).Height()),
            width: (Ext.Layout(window).Width()),
            left: (Ext.Layout(window).Width() / 2),
            top: (Ext.Layout(window).Height() / 2),
            param: {
                ScriptId: Ext.BASE64.encode(ScriptId),
                Time: Ext.Date().getDuration()
            }
        }).popup();

        if (ScriptId == '') {
            window.close();
        }
    }
    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */
    window.ButtonStyle = function(dial) {
        if (dial) {
            // disabled
            $(['.dial', '.save', '.next', '.cancel', '.add']).each(function(i, button) {
                $(button).attr('disabled', true);
            });
            // enabled
            $(['.hangup']).each(function(i, button) {
                $(button).attr('disabled', false);
            });
        }
        // jika dalam kondisi handle hangup
        else {
            // disabled = false
            $(['.dial', '.save', '.next', '.cancel', '.add']).each(function(i, button) {
                $(button).attr('disabled', false);
            });
            // disabled
            $(['.hangup']).each(function(i, button) {
                $(button).attr('disabled', true);
            });
        }
    }
    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    Ext.DOM.getLastCall = function() {
        var conds = false;

        if (Ext.Ajax({
                url: Ext.EventUrl(['SrcCustomerList', 'CheckLastCall']).Apply(),
                method: 'POST',
                param: {}
            }).json().result) {
            conds = true;
        }

        return conds;
    }


    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.EventPlay = function(RecordId) {
        var WinUrl = new Ext.EventUrl(new Array("QualityApproveInterest", "VoicePlay")),
            ControllerId = Ext.Cmp('ControllerId').getValue(),
            WinHeight = 100;

        var WinPlay = new Ext.Window({
            url: WinUrl.Apply(),
            name: 'winplay',
            scrollbars: 1,
            resizable: 1,
            top: 0,
            left: $(window).width(),
            width: ($(window).width() / 2),
            height: $(window).innerHeight(),

            param: {
                RecordId: RecordId,
                ControllerId: ControllerId
            }
        });

        WinPlay.popup();

    }


    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.EventCallRecording = function(obj) {
        var tabPanelDataID = Ext.Cmp('tab-bottom-activity-voice');
        if (tabPanelDataID.IsNull()) {
            console.log('tab panel id empty');
            return false;
        }
        var CustomerId = Ext.Cmp('DM_Id').getValue(),
            ControllerId = Ext.Cmp('ControllerId').getValue(),
            dataUrlServer = Ext.EventUrl(new Array('ModCallHistory', 'PageCallRecording'));

        // loader by spiner process data .
        $('#tab-bottom-activity-voice').Spiner({
            url: dataUrlServer.Apply(),
            param: {
                CustomerId: CustomerId,
                ControllerId: ControllerId
            },
            order: {
                order_type: obj.type,
                order_by: obj.orderby,
                order_page: obj.page
            },
            handler: 'EventCallRecording',
            complete: function(html) {
                $(html).css({
                    'height': '100%'
                });
            }
        });
    }


    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.PaperWork = function(obj) {
        var tabpanel = Ext.Cmp("tab-bottom-activity-form").IsNull();
        var CustomerId = Ext.Cmp('CustomerId').getValue();
        var ProductId = Ext.Cmp('ProductId').getValue();
        var ProductName = Ext.Cmp('ProductName').getValue();
        var CampaignName = Ext.Cmp('CampaignName').getValue();
        console.log(ProductName)
        if (!tabpanel) {
            // pake yang ini yang lama DOM nya suka gak ke load
            // ini pakejqueryloader aja,

            $('#tab-bottom-activity-form').Spiner({
                url: Ext.EventUrl(new Array('ProductController', 'PaperWork', ProductName, CustomerId)).Apply(),
                param: {
                    CustomerId: CustomerId
                },
                order: {
                    order_type: obj.type,
                    order_by: obj.orderby,
                    order_page: obj.page
                },
                handler: 'PaperWork',
                complete: function(html) {
                    //console.log( html );
                    $(html).css({
                        'height': '500px'
                    });
                    //console.log( obj );
                }
            });
        }
    }

    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.EventNext = function() {
        var stdCls = new Ext.AutoCall('', {}),
            MasterId = Ext.Cmp('DM_Id').getValue(),
            StdObj = new stdCls.Utils.Next(MasterId);

        if (typeof(StdObj) == 'object' &&
            typeof(StdObj.Value) == 'function') {
            try {
                // unset on followup if OK
                window.EventUnsetFollowup(MasterId);

                // set data followup on data master OK
                var NextMasterId = StdObj.Value(),
                    NextControllId = StdObj.Triger();

                // then will get trial process .
                window.EventSetFollowup(NextMasterId);

                // then will aceptable menu action
                Ext.ActiveMenu().NotActive();
                Ext.ShowMenu(new Array('SrcCustomerList', 'ContactDetail'),
                    Ext.System.view_file_name(), {
                        MasterDataId: NextMasterId,
                        ControllerId: NextControllId
                    });
            } catch (dataERR) {
                console.log(typeof(StdObj.Value));
            }
        }
    }

    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.EventCall = function() {
        console.log(window.initFunc.isDial);
        if (window.initFunc.isDial) {
            console.log('on dial exist');
            return false;
        }

        // jika kondisi call dalam kondisi salah
        try {
            var ctiCall = ExtApplet.setData({
                Phone: Ext.Cmp("CallingNumber").getValue(),
                CustomerId: Ext.Cmp("DM_Id").getValue()
            }).Call();

            window.ButtonStyle(1);
            // customize data button

            window.initFunc.isCallPhone = true;
            window.initFunc.isCancel = false;
            window.setTimeout(function() {
                window.DisabledActivity();
                window.initFunc.isRunCall = true;
                window.initFunc.isDial = true;
            }, 100);
        }
        // jika appletnya error lakukan handle ini,
        catch (errorMessage) {
            console.log(errorMessage);
            window.ButtonStyle(0);
            window.initFunc.isRunCall = true;
            window.initFunc.isDial = true;

        }
    }

    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.EventHangup = function() {

        window.ButtonStyle(0);
        // tidak ada call maka lakukan ini
        if (!window.initFunc.isDial) {
            console.log('no call proceess');
            return false;
        }

        // jika process call memang sedang terjadi.
        try {
            ExtApplet.setHangup();
            window.initFunc.isDial = false;
            window.initFunc.isRunCall = false;
            window.initFunc.isCancel = false;
        }

        // handle error log ke window object
        catch (errorMessage) {
            console.log(errorMessage);

            window.initFunc.isDial = false;
            window.initFunc.isRunCall = false;
            window.initFunc.isCancel = false;

            window.ButtonStyle(0);
        }
    }
    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */
    window.EventCallResultID = function(dropdown) {

        var urlDataWindow = new Ext.EventUrl(new Array('SrcCustomerList', 'SelectCallResultId'));
        $('#ui-call-result-id').loader({
            url: urlDataWindow.Apply(),
            method: 'POST',
            param: {
                CallStatusId: dropdown.value
            },
            complete: function(html) {
                $(html).css({
                    'height': '100%'
                });
                new window.propLayout();

                $(html).find('.select').chosen();


                Ext.Cmp('DateLater').setValue('');
                Ext.Cmp('HourLater').setValue('');
                Ext.Cmp('MinuteLater').setValue('');

                Ext.Cmp('DateLater').disabled(true);
                Ext.Cmp('HourLater').disabled(true);
                Ext.Cmp('MinuteLater').disabled(true);
            }
        });
    }

    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.EventValidationSelling = function() {
        var dataURL = Ext.EventUrl(new Array('AuthValidation', 'selling')).Apply();


        // define global data variable to process OK SIP YA .
        var ProductName = Ext.Cmp('ProductName').getValue(),
            ProductId = Ext.Cmp('ProductId').getValue(),
            CustomerNum = Ext.Cmp('DM_Custno').getValue();

        console.log("##debug" + ProductName);

        var dataJsonServer = Ext.Json(dataURL, {
            ProductId: ProductId,
            ProductName: ProductName,
            CustomerNum: CustomerNum
        });

        var retJson = dataJsonServer.dataItem();
        return (typeof(retJson) ?
            retJson : {});

    }
    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */


    window.CallSessionId = function() {
        return (typeof(ExtApplet.getCallSessionId()) == 'undefined' ?
            'NULL' : ExtApplet.getCallSessionId());
    }
    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.CekPolicyForm = function() {
        return (
            Ext.Ajax({
                url: Ext.DOM.INDEX + '/SrcCustomerList/CekPolicyForm/',
                method: 'POST',
                param: {
                    CustomerId: Ext.Cmp('CustomerId').getValue(),
                    CallReasonId: Ext.Cmp('CallResultId').getValue()
                }
            }).json());
    }
    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.EventCreatePod = function(obj) {
        alert(obj.value);
    }
    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */


    window.EventSave = function() {

        // call my object data Util
        this.Utils = new Ext.Util({});

        // define all variable to process
        var callDataConn = Ext.DOM.CallInterest(),
            callDispositionBlock = Ext.Cmp('CallResultId').getValue();

        var frmCallActivityData = Ext.Serialize('frmActivityCall');
        frmCallActivityReqs = new Array('QualityStatus', 'ProductForm',
            'CallingNumber', 'PhoneNumber',
            'AddPhoneNumber', 'DateLater',
            'HourLater', 'MinuteLater',
            'CallProdukScript');


        // default required process
        frmCallActivityData.Complete(frmCallActivityReqs);


        // jika data type object maka masukan data ini.
        if (this.Utils.IsObject(callDataConn.event) &&
            (callDataConn.event.CallReasonLater == 1)) {
            frmCallActivityReqs = new Array('QualityStatus', 'ProductForm',
                'CallingNumber', 'PhoneNumber',
                'AddPhoneNumber',
                'CallProdukScript');
            // replace new object array .
            frmCallActivityData.Complete(frmCallActivityReqs);
        }



        // jika form tidak terisi dengan benar
        if (!frmCallActivityData) {
            Ext.Msg('Input form not complete').Info();
            console.log(frmCallActivityData);
            return false;
        }

        // cek apakah status kategory closing , jika YA cek apakah ada datanya
        // jika tidak ada return false.


        if (this.Utils.IsObject(callDataConn.event) &&
            (callDataConn.event.CallReasonEvent == 1)) {

            var checkValidation = window.EventValidationSelling(),
                checkKondition = parseInt(checkValidation.success);

            if (!checkKondition) {
                Ext.Msg('No Form Application Data').Info();
                $("#ui-activity-history-tab").tabs('option', 'selected', 1);
                return false;
            }
        }


        // cek apakah status yang di simpan dalam kategory NEW
        if (callDispositionBlock == window.CONFIG.NEW_STATUS) {
            Ext.Msg("Please select other status").Info();
            return false;
        }

        // submit data di process

        window.initFunc.isSave = true;
        window.initFunc.isCallPhone = false;
        window.initFunc.isCancel = true;


        var frmActivityCall = Ext.Serialize('frmActivityCall').Initialize(),
            frmInfoCustomer = Ext.Serialize('frmInfoCustomer').Initialize(),
            frmActivityData = Ext.Serialize('frmActivityData').Initialize(),
            frmAdditionalCall = {
                CustomerId: Ext.Cmp('DM_Id').getValue(),
                CallingNumber: Ext.Cmp('CallingNumber').getValue(),
                CallSessionId: Ext.DOM.CallSessionId()
            }

        // validation setiap form jika tidak benar gak boleh save .
        var dataRequired = Ext.Serialize('frmActivityData').Required(new Array('CallStatusId', 'CallResultId'));
        if (!dataRequired) {
            return false;
        }

        // process data jiak kondisi di atas sudah terpenuhi semuanya
        // tinggal check process sale form "paper work".
        // harus di cek terlebih dahulu.
        // add dida local storage status approved
        var ProductID = Ext.Cmp('ProductId').getValue();
        var status_daftarkartu = localStorage.getItem('status_daftarkartu')
        var CallStatusID = Ext.Cmp('CallStatusId').getValue()
        var dataConnUrl = Ext.EventUrl(new Array('ModSaveActivity/SaveAgentActivity'));
        if (ProductID == 27) {
            Ext.Ajax({
                url: dataConnUrl.Apply(),
                method: 'POST',
                param: Ext.Join(new Array(frmActivityCall, frmInfoCustomer,
                    frmAdditionalCall, frmActivityData)).object(),
                success: function(xhr) {
                    Ext.Util(xhr).proc(function(dataConnServer) {
                        if (dataConnServer.success) {
                            Ext.Msg("Save Call Activity").Success();
                            $("#ui-activity-history-tab").mytab().tabs().tabs("option", "selected", 0);
                            window.PageCallHistory({
                                page: 0,
                                orderby: "",
                                type: ""
                            });
                        } else {
                            Ext.Msg("Save Call Activity").Failed();
                            return false;
                        }
                    });
                }
            }).post();
        } else {
            if ((status_daftarkartu != null && CallStatusID != 13) || (status_daftarkartu == null && CallStatusID == 13) || (status_daftarkartu != null && CallStatusID != 2) || (status_daftarkartu == null && CallStatusID == 2)) {
                Ext.Ajax({
                    url: dataConnUrl.Apply(),
                    method: 'POST',
                    param: Ext.Join(new Array(frmActivityCall, frmInfoCustomer,
                        frmAdditionalCall, frmActivityData)).object(),
                    success: function(xhr) {
                        Ext.Util(xhr).proc(function(dataConnServer) {
                            if (dataConnServer.success) {
                                Ext.Msg("Save Call Activity").Success();
                                $("#ui-activity-history-tab").mytab().tabs().tabs("option", "selected", 0);
                                window.PageCallHistory({
                                    page: 0,
                                    orderby: "",
                                    type: ""
                                });
                            } else {
                                Ext.Msg("Save Call Activity").Failed();
                                return false;
                            }
                        });
                    }
                }).post();
            } else {
                alert('status fixid belum diisi')
            }
        }
    }


    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.PageCallHistory = function(obj) {
        var CustomerId = Ext.Cmp('DM_Id').getValue(),
            winDataUrl = Ext.EventUrl(new Array('ModCallHistory', 'PageCallHistory'));


        $('#tab-bottom-activity-history').Spiner({
            url: winDataUrl.Apply(),
            param: {
                CustomerId: CustomerId
            },
            order: {
                order_type: obj.type,
                order_by: obj.orderby,
                order_page: obj.page
            },
            handler: 'PageCallHistory',
            complete: function(html) {
                //console.log( html );
                $(html).css({
                    'height': '100%'
                });
            }
        });
    }

    // -----------------------------------------------------------

    /*
     * Method AddUser
     *
     * @pack wellcome on eui first page
     * @param testing all
     */
    window.ProdPreview = function(ProductId) {
        Ext.Ajax({
            url: Ext.DOM.INDEX + "/ModSaveActivity/ProdPreview/",
            method: 'GET',
            param: {
                ProductId: ProductId,
                CustomerId: Ext.Cmp('CustomerId').getValue(),
                CustomerDOB: Ext.Cmp('CustomerDOB').getValue(),
                GenderId: Ext.Cmp('GenderId').getValue()
            }
        }).load("product_list_preview");
    }

    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.EeventFromProduct = function(e) {

        //e.log(Ext.Cmp('CustomerId').Encrypt());

        if (e.value != '') {
            Ext.Window({
                url: Ext.DOM.INDEX + '/ProductForm/index/',
                method: 'POST',
                width: (Ext.query(window).width() - (Ext.query(window).width() / 4)),
                height: Ext.query(window).height(),
                left: (Ext.query(window).width() / 2),
                scrollbars: 1,
                resizable: 1,
                param: {
                    ViewLayout: 'ADD_FORM',
                    ProductId: Ext.Cmp(e.id).getValue(),
                    CustomerId: Ext.Cmp('CustomerId').Encrypt(),
                }
            }).popup();

            /* disabled on user show form data **/
            Ext.Cmp('CallStatus').disabled(true);
            Ext.Cmp('CallResult').disabled(true);
            Ext.Cmp('ProductForm').disabled(true);
            //Ext.Cmp('ButtonUserCancel').disabled(true);
            //Ext.Cmp('ButtonUserSave').disabled(true);
        }
    }

    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.EventSaleHandler = function(object) {
        var ProductId = Ext.Cmp('ProductId').getValue();
        Ext.Ajax({
            url: Ext.DOM.INDEX + '/SetCallResult/getEventType/',
            method: 'GET',
            param: {
                CallResultId: object.value
            },
            ERROR: function(fn) {
                try {
                    var ERR = JSON.parse(fn.target.responseText);
                    if (ERR.success) {
                        if (typeof(ERR.event) == 'object') {
                            if (ERR.event.CallReasonEvent == 1) {
                                Ext.Cmp('ProductForm').disabled(false);
                                if (ProductId != 0) {
                                    Ext.Cmp('ProductForm').setValue(ProductId);
                                    Ext.DOM.EeventFromProduct(Ext.Cmp('ProductForm').getElementId());
                                }
                            } else {
                                Ext.Cmp('ProductForm').disabled(true);
                                Ext.Cmp('ProductForm').setValue('');
                            }

                            if (ERR.event.CallReasonLater == 1) {
                                Ext.Cmp('DateLater').disabled(false);
                                Ext.Cmp('HourLater').disabled(false);
                                Ext.Cmp('MinuteLater').disabled(false);
                            } else {
                                Ext.Cmp('DateLater').setValue('');
                                Ext.Cmp('HourLater').setValue('');
                                Ext.Cmp('MinuteLater').setValue('');
                                Ext.Cmp('DateLater').disabled(true);
                                Ext.Cmp('HourLater').disabled(true);
                                Ext.Cmp('MinuteLater').disabled(true);
                            }
                        }
                    } else {

                    }
                } catch (e) {
                    console.log('error undefined');
                    //Ext.Msg(e).Error();
                }
            }
        }).post();
    }

    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.EventClose = function() {
        var ControllerId = Ext.Cmp('ControllerId').getValue();
        if ((Ext.DOM.initFunc.isCancel == true)) {
            Ext.ActiveMenu().Active();
            Ext.DOM.EventUnsetFollowup(Ext.Cmp('DM_Id').getValue());
            Ext.ShowMenu(new Array(ControllerId),
                Ext.System.view_file_name(), {
                    time: Ext.Date().getDuration()
                });
        } else {
            Ext.Msg('Please Save Activity').Info();
        }
    }

    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.EventAdd = function() {
        var ControllerId = Ext.Cmp('ControllerId').getValue(),
            CustomerId = Ext.Cmp('DM_Id').getValue();

        console.log(window.sprintf("custid: %s, control:%s", CustomerId, ControllerId));
        // call window function "UI/view/<js:>"
        if (typeof(window.AdditionalPhone) == 'function') {
            window.AdditionalPhone({
                CustomerId: CustomerId,
                ControllerId: ControllerId
            });
        }
    }

    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.EventScript = function(data) {

        var ScriptId = data.value,
            dataURL = Ext.EventUrl(new Array('SetProductScript', 'ShowProductScript'));

        // jika script nya kosong redirec ke rpcess close .
        if (ScriptId == '') {
            if (typeof(window.callDataConnId) == 'object') {
                window.callDataConnId.winnewProtectedNew.close();
            }
            return false;
        }

        //open new window OK
        window.callDataConnId = Ext.Window({
            url: dataURL.Apply(),
            name: 'windowScript',
            height: ($(window).innerHeight()),
            width: ($(window).innerWidth() - ($(window).innerWidth() / 2)),
            left: ($(window).innerWidth() / 2),
            top: ($(window).innerHeight() / 2),
            param: {
                ScriptId: Ext.BASE64.encode(ScriptId.toString()),
            }
        }).popup();
        // end popup.

    }

    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.AddReferal = function() {
        Ext.Window({
            url: Ext.DOM.INDEX + '/Referal/index/',
            method: 'POST',
            width: (Ext.query(window).width() - (Ext.query(window).width() / 4)),
            height: Ext.query(window).height(),
            left: (Ext.query(window).width() / 2),
            scrollbars: 1,
            resizable: 1,
            param: {
                CustomerId: Ext.Cmp('CustomerId').Encrypt(),
                Customer: Ext.Cmp('CustomerId').getValue()
            }
        }).popup();
    }

    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.propLayout = function() {

        $('.boox').css({
            'width': '75px'
        });
        // customize for text-area
        $('.tolong').each(function(item, val) {
            if ($(val).is('select')) {
                $(val).css({
                    'width': '258px'
                });
            }
            // jika jenis text area
            if ($(val).is('textarea')) {
                $(val).css({
                    'width': '250px',
                    'height': '120px'
                });
            }
        });
    }
    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    window.UserLayout = function() {
        $('#ui-widget-contact-tabs').css({
            "background-color": "#FBFEFF",
            "padding-bottom": "15px",
            'margin': '0px -8px 0px 0px'
        });
        $('.ui-widget-contact-tabs').css({
            "background-color": "#FBFEFF"
        });

        $('.date').datepicker({
            showOn: 'button',
            buttonImage: Ext.Image('calendar.gif'),
            buttonImageOnly: true,
            dateFormat: 'dd-mm-yy',
            readonly: true
        });
        $(".ui-widget-box").css({
            "width": "30%"
        });

        // customize button dial and hangup
        $(['.dial', '.hangup', '.add']).each(function(item, button) {
            $(button).css({
                'width': '28%'
            });
        });

        $(['.save', '.next', '.cancel']).each(function(item, button) {
            $(button).css({
                'width': '28%'
            });
        });


        //$('span.ui-li-ext-toolbar').css({"color": "red"});
        $('.ui-widget-contact-tabs').css({
            'padding': '10px 0px 0px 0px '
        });

        $('.tab-bottom-activity-user').css({
            'background-color': '#FFFFFF',
            'overflow': 'auto'
        });

        $('.ui-customize-width-tabs').css({
            'width': '130px'
        });
        // then will call this function
        window.propLayout();

    }

    /*
     * [Recovery data failed upload HSBC TAMAN SARI]
     * @param [type] $CustomerId [description]
     * @return [type] [description]
     */

    $(document).ready(function() {


        // --- tab informasi ----------------------------------------
        // $('#contact_detail').scroll(function() {
        // $('.ui-widget-form-table-compact').css('top', $(this).scrollTop());
        // });

        $("#ui-widget-contact-tabs").mytab().tabs();
        $("#ui-widget-contact-tabs").mytab().tabs("option", "selected", 0);
        $("#ui-widget-contact-tabs").mytab().close({}, true);



        // ---------- tab history ------------------------

        $("#ui-activity-history-tab").mytab().tabs();
        $("#ui-activity-history-tab").mytab().tabs().tabs("option", "selected", 0);
        $("#ui-activity-history-tab").mytab().close({}, true);

        // disabled activity
        window.DisabledActivity();

        // --- disabled image drag ----
        $('.ui-disabled').each(function() {
            Ext.Cmp($(this).attr("id")).disabled(true);
        });


        // load my page on bottom data tabs .
        window.UserLayout();
        window.PageCallHistory({
            page: 0,
            orderby: "",
            type: ""
        });
        window.PaperWork({
            page: 0,
            orderby: "",
            type: ""
        });
        window.EventCallRecording({
            page: 0,
            orderby: "",
            type: ""
        });

        // load combo $('.select-chosen').chosen();
        $('.select-chosen').chosen();

        // scrollbars data view */
        $('.ui-widget-form-flexi-scrollbars').jScrollPane({
            hijackInternalLinks: true
        });


        // create object popup
        var dataURL = Ext.EventUrl(new Array('UserPopup', 'Result'));
        $('.winpop')
            .winpop({
                setting: {
                    url: dataURL.Apply(),
                    name: 'winresult',
                    width: 400,
                    height: 200,
                },

                handler: {
                    origin: 'CallStatusId',
                    target: 'CallResultId',
                    events: 'EventUpdateResult'
                }
            });

        $('.addcol1').css({
            'width': '85px'
        });
        // end popup;

        // button callculator hanya akan muncul kalau product Usage
        // saja.

        var ProductName = Ext.Cmp('ProductName').getValue();
        console.log("ProductName", ProductName);
        if (ProductName.localeCompare('USAGE')) {
            $('.button-calculator')
                .css({
                    'width': '91%'
                });
            $('.usage-row-data-balcon').css('display', 'none');
            $('.button-calculator-balcon').css('display', 'none');
        } else if (ProductName.localeCompare('BALCON')) {
            $('.button-calculator-balcon')
                .css({
                    'width': '91%'
                });
            $('.usage-row-data').css('display', 'none');
            $('.button-calculator').css('display', 'none');
        } else {
            $('.usage-row-data').css('display', 'none');
            $('.button-calculator').css('display', 'none');
            $('.usage-row-data-balcon').css('display', 'none');
            $('.button-calculator-balcon').css('display', 'none');

        }
    });
</script>