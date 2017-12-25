Vtiger_List_Js("SalesOrder_List_Js",{},{

    registerCheckClickEvent: function(){
        var thisInstance = this;

        var listViewContentDiv = thisInstance.getListViewContentContainer();
        listViewContentDiv.on('click', '.checkBtn', function(e){
            var elem = jQuery(e.currentTarget);
            var recordId = elem.closest('tr').data('id');
            SalesOrder_Edit_Js.Check(recordId);
            e.stopPropagation();
        });
    },

    registerEvents: function () {
        this._super();
        this.registerCheckClickEvent();
    }
});