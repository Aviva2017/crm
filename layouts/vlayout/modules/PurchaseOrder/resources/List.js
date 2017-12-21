Vtiger_List_Js("PurchaseOrder_List_Js",{},{

    registerCheckClickEvent: function(){
        var thisInstance = this;

        var listViewContentDiv = thisInstance.getListViewContentContainer();
        listViewContentDiv.on('click', '.checkBtn', function(e){
            var elem = jQuery(e.currentTarget);
            var recordId = elem.closest('tr').data('id');
            PurchaseOrder_Edit_Js.Check(recordId);
            e.stopPropagation();
        });
    },

    registerEvents: function () {
        this._super();
        this.registerCheckClickEvent();
    }
});