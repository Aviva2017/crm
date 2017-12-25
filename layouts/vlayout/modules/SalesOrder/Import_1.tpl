{*<!--
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
* ("License"); You may not use this file except in compliance with the License
* The Original Code is:  vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*
********************************************************************************/
-->*}
{strip}
<div id="toggleButton" class="toggleButton" title="{vtranslate('LBL_LEFT_PANEL_SHOW_HIDE', 'Vtiger')}">
				<i id="tButtonImage" class="{if $LEFTPANELHIDE neq '1'}icon-chevron-left{else}icon-chevron-right{/if}"></i>
			</div>&nbsp
<div style="padding-left: 15px;">
    <form onsubmit="" action="index.php" enctype="multipart/form-data" method="POST" name="importBasic">
        <input type="hidden" name="module" value="{$FOR_MODULE}" />
        <input type="hidden" name="view" value="Import" />
        <input type="hidden" name="mode" value="uploadAndParse" />
        <table style=" width:90%;margin-left: 5% " class="searchUIBasic" cellspacing="12">
            <tr>
                <td class="font-x-large" align="left" colspan="2">
                    <strong>{'LBL_IMPORT'|@vtranslate:$MODULE} {$FOR_MODULE|@vtranslate:$FOR_MODULE}</strong>
                </td>
            </tr>
            {if $ERROR_MESSAGE neq ''}
                <tr>
                    <td class="style1" align="left" colspan="2">
                        <span class="alert-error">{$ERROR_MESSAGE}</span>
                    </td>
                </tr>
            {/if}
            <tr>
                <td class="leftFormBorder1 importContents" width="40%" valign="top">
                    <table width="100%" cellspacing="0" cellpadding="2">
                        <tr>
                            <td><strong>{'LBL_IMPORT_STEP_1'|@vtranslate:$MODULE}:</strong></td>
                            <td class="big">{'LBL_IMPORT_STEP_1_DESCRIPTION'|@vtranslate:$MODULE}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td data-import-upload-size="{$IMPORT_UPLOAD_SIZE}" data-import-upload-size-mb="{$IMPORT_UPLOAD_SIZE_MB}">
                                <input type="hidden" name="type" value="xls" />
                                <input type="hidden" name="is_scheduled" value="1" />
                                <input type="file" name="import_file" id="import_file" onchange="ImportJs.checkFileType()"/>
                                <!-- input type="hidden" name="userfile_hidden" value=""/ -->
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>{'LBL_IMPORT_FROM_SUPPORTED_FILE_TYPES'|@vtranslate:$FOR_MODULE}</td>
                        </tr>
                    </table>
                </td>
                <td class="leftFormBorder1 importContents" width="40%" valign="top">
                    <table width="100%" cellspacing="0" cellpadding="2">
                        <tr>
                            <td><strong>{'LBL_IMPORT_STEP_2'|@vtranslate:$MODULE}:</strong></td>
                            <td class="big">{'LBL_IMPORT_STEP_2_DESCRIPTION'|@vtranslate:$MODULE}</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr id="file_encoding_container">
                            <td>&nbsp;</td>
                            <td><span>{'LBL_CHARACTER_ENCODING'|@vtranslate:$MODULE}</span></td>
                            <td>
                                <select name="file_encoding" id="file_encoding">
                                    {foreach key=_FILE_ENCODING item=_FILE_ENCODING_LABEL from=$SUPPORTED_FILE_ENCODING}
                                        <option value="{$_FILE_ENCODING}">{$_FILE_ENCODING_LABEL|@vtranslate:$MODULE}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr id="has_header_container">
                            <td>&nbsp;</td>
                            <td><span>{'LBL_HAS_HEADER'|@vtranslate:$MODULE}</span></td>
                            <td><input type="checkbox" id="has_header" name="has_header" checked /></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="right" colspan="2">
                    {include file='Import_Basic_Buttons.tpl'|@vtemplate_path:'Import'}
                </td>
            </tr>
        </table>
    </form>
</div>
{/strip}