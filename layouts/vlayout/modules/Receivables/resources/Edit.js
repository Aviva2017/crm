Vtiger_Edit_Js("Receivables_Edit_Js", {}, {
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