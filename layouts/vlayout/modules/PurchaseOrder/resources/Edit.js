/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Inventory_Edit_Js("PurchaseOrder_Edit_Js", {
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

                var url = 'index.php?module=PurchaseOrder&action=Check&record=' + recordId;
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

    billingShippingFields: {
        'bill': {
            'street': '',
            'pobox': '',
            'city': '',
            'state': '',
            'code': '',
            'country': ''
        },
        'ship': {
            'street': '',
            'pobox': '',
            'city': '',
            'state': '',
            'code': '',
            'country': ''
        }

    },
    companyDetails: false,


    /**
     * Function to get popup params
     */
    getPopUpParams: function (container) {
        var params = this._super(container);
        var sourceFieldElement = jQuery('input[class="sourceField"]', container);

        if (sourceFieldElement.attr('name') == 'contact_id') {
            var form = this.getForm();
            var parentIdElement = form.find('[name="vendor_id"]');
            if (parentIdElement.length > 0 && parentIdElement.val().length > 0 && parentIdElement.val() != 0) {
                var closestContainer = parentIdElement.closest('td');
                params['related_parent_id'] = parentIdElement.val();
                params['related_parent_module'] = closestContainer.find('[name="popupReferenceModule"]').val();
            }
        }
        return params;
    },

    /**
     * Function to search module names
     */
    searchModuleNames: function (params) {
        var aDeferred = jQuery.Deferred();

        if (typeof params.module == 'undefined') {
            params.module = app.getModuleName();
        }
        if (typeof params.action == 'undefined') {
            params.action = 'BasicAjax';
        }

        if (params.search_module == 'Contacts') {
            var form = this.getForm();
            var parentIdElement = form.find('[name="vendor_id"]');
            if (parentIdElement.length > 0 && parentIdElement.val().length > 0) {
                var closestContainer = parentIdElement.closest('td');
                params.parent_id = parentIdElement.val();
                params.parent_module = closestContainer.find('[name="popupReferenceModule"]').val();
            }
        }

        AppConnector.request(params).then(
            function (data) {
                aDeferred.resolve(data);
            },
            function (error) {
                aDeferred.reject();
            }
        )
        return aDeferred.promise();
    },

    registerCopyCompanyAddress: function () {
        var thisInstance = this;
        var editViewForm = this.getForm();
        jQuery('[name="copyCompanyAddress"]', editViewForm).on('click', function (e) {
            var addressType = (jQuery(e.currentTarget).data('target'));
            var container = jQuery(e.currentTarget).closest('table');

            var moduleName = app.getModuleName();
            var url = {
                'mode': 'getCompanyDetails',
                'action': 'CompanyDetails',
                'module': moduleName
            }

            if (!thisInstance.companyDetails) {
                AppConnector.request(url).then(function (data) {
                        var response = data['result'];
                        thisInstance.companyDetails = response;
                        thisInstance.copyAddressFields(addressType, container);
                    },
                    function (error, err) {
                    });
            } else {
                thisInstance.copyAddressFields(addressType, container);
            }
        });
    },

    copyAddressFields: function (addressType, container) {
        var thisInstance = this;
        var company = thisInstance.companyDetails;
        var fields = thisInstance.billingShippingFields[addressType];
        for (var key in fields) {
            container.find('[name="' + addressType + '_' + key + '"]').val(company[key]);
            container.find('[name="' + addressType + '_' + key + '"]').trigger('change');
        }
    },

    tregisterEventForChangeType: function (formElement) {
        if (typeof formElement == 'undefined')
            var formElement = this.getForm();

        var typeElement = jQuery('[name="cf_765"]', formElement);
        var inElement = jQuery('[name="cf_767"]', formElement);
        var outElement = jQuery('[name="cf_763"]', formElement);
        typeElement.change(function (e) {
            var type = jQuery(this).val();
            if (type == 'Out Stock') {
                inElement.disable();
                outElement.enable();
            } else if (type == 'Adjust Stock') {
                inElement.enable();
                outElement.enable();
            } else {
                inElement.enable();
                outElement.disable();
            }
            inElement.trigger('liszt:updated');
            outElement.trigger('liszt:updated');
        }).trigger('change');
    },

    registerRecordPreSaveEvent: function (formElement) {
        if (typeof formElement == 'undefined')
            var formElement = this.getForm();

        var typeElement = jQuery('[name="cf_765"]', formElement);
        var inElement = jQuery('[name="cf_767"]', formElement);
        var outElement = jQuery('[name="cf_763"]', formElement);

        formElement.on(Vtiger_Edit_Js.recordPreSave, function (e, data) {
            var type = typeElement.val();
            var inStock = inElement.val();
            var outStock = outElement.val();
            if (type == 'In Stock' && inStock == '') {
                var message = app.vtranslate('请选择入库仓库');
                var params = {
                    title: app.vtranslate('提交错误'),
                    text: message,
                    width: '35%'
                }
                Vtiger_Helper_Js.showPnotify(params);
                e.preventDefault();
                return false;
            }
            if (type == 'Out Stock' && outStock == '') {
                var message = app.vtranslate('请选择出库仓库');
                var params = {
                    title: app.vtranslate('提交错误'),
                    text: message,
                    width: '35%'
                }
                Vtiger_Helper_Js.showPnotify(params);
                e.preventDefault();
                return false;
            }
            if (type == 'Adjust Stock') {
                if (inStock == '') {
                    var message = app.vtranslate('请选择入库仓库');
                    var params = {
                        title: app.vtranslate('提交错误'),
                        text: message,
                        width: '35%'
                    }
                    Vtiger_Helper_Js.showPnotify(params);
                    e.preventDefault();
                    return false;
                }
                if (outStock == '') {
                    var message = app.vtranslate('请选择出库仓库');
                    var params = {
                        title: app.vtranslate('提交错误'),
                        text: message,
                        width: '35%'
                    }
                    Vtiger_Helper_Js.showPnotify(params);
                    e.preventDefault();
                    return false;
                }
                if (inStock == outStock) {
                    var message = app.vtranslate('入库仓库和出库仓库不能是同一个');
                    var params = {
                        title: app.vtranslate('提交错误'),
                        text: message,
                        width: '35%'
                    }
                    Vtiger_Helper_Js.showPnotify(params);
                    e.preventDefault();
                    return false;
                }
            }
        });
    },

    registerBasicEvents: function (container) {
        this._super(container);
        this.tregisterEventForChangeType(container);
        this.registerRecordPreSaveEvent(container);
    },

    registerEvents: function () {
        this._super();
        this.registerEventForCopyAddress();
        this.registerCopyCompanyAddress();
    }
});

