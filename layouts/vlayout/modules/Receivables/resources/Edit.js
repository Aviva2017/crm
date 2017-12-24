Vtiger_Edit_Js("Receivables_Edit_Js", {
    Check: function (recordId) {
        var message = app.vtranslate('LBL_CONFIRM RECEIPT');

        Vtiger_Helper_Js.showConfirmationBox({'message': message}).then(
            function (e) {
                var progressMessage = app.vtranslate('LBL_CONFIRM RECEIPT');
                var progressIndicatorElement = jQuery.progressIndicator({
                    'message': progressMessage,
                    'position': 'html',
                    'blockInfo': {
                        'enabled': true
                    }
                });

                var url = 'index.php?module=Receivables&action=Check&record=' + recordId;
                AppConnector.request(url).then(
                    function (data) {
                        progressIndicatorElement.progressIndicator({
                            'mode': 'hide'
                        });
                        if (data.success) {
                            if (typeof Vtiger_List_Js != 'undefined') {
                                var listinstance = new Vtiger_List_Js();
                                listinstance.getListViewRecords();
                            } else {
                                window.location.reload();
                            }
                        } else {
                            var params = {
                                text: app.vtranslate(data.error.message),
                                title: app.vtranslate('JS_LBL_PERMISSION')
                            }
                            Vtiger_Helper_Js.showPnotify(params);
                        }
                    }
                );
            }
        );
    }
}, {
    registerEventForChangeType: function (formElement) {
        if (typeof formElement == 'undefined')
            var formElement = this.getForm();

        var typeElement = jQuery('[name="receivablestype"]', formElement);
        var relationElement = jQuery('#Receivables_editView_fieldName_relation_id_dropDown', formElement);
        typeElement.change(function (e) {
            var type = jQuery(this).val();
            if(type == 'Purchase payment' || type == 'Purchase refund'){
                jQuery('[value="Accounts"]', relationElement).disable();
                jQuery('[value="Vendors"]', relationElement).enable();
                relationElement.val('Vendors');
            }else{
                jQuery('[value="Accounts"]', relationElement).enable();
                jQuery('[value="Vendors"]', relationElement).disable();
                relationElement.val('Accounts');
            }
            formElement.find('.referenceModulesList').chosen().trigger('change');
            relationElement.trigger('liszt:updated');
        }).trigger('change');
    },
    registerBasicEvents: function (container) {
        this._super(container);
        this.registerEventForChangeType(container);
    },

    registerEvents: function () {
        this._super();
    }
});