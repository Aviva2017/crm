if (typeof(_ImportJs) == 'undefined') {
    _ImportJs = {
        handleFileTypeChange: function() {
            var fileType = jQuery('#type').val();
            var hasHeaderContainer = jQuery('#has_header_container');
            if(fileType != 'xls' && fileType != 'xlsx') {
                return false;
            }
        },

        validateFilePath: function() {
            var importFile = jQuery('#import_file');
            var filePath = importFile.val();
            if(jQuery.trim(filePath) == '') {
                var errorMessage = app.vtranslate('JS_IMPORT_FILE_CAN_NOT_BE_EMPTY');
                var params = {
                    text: errorMessage,
                    type: 'error'
                };
                Vtiger_Helper_Js.showMessage(params);
                importFile.focus();
                return false;
            }
            if(!ImportJs.uploadFilter("import_file", "xls|xlsx")) {
                return false;
            }
            if(!ImportJs.uploadFileSize("import_file")) {
                return false;
            }
            return true;
        },
    };
}

ImportJs = typeof(ImportJs) == 'undefined' ? _ImportJs : jQuery.extend(ImportJs, _ImportJs);