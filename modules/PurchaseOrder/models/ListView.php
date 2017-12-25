<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class PurchaseOrder_ListView_Model extends Inventory_ListView_Model {

    public function getListViewEntries ($pagingModel){
        $moduleName = $this->getModule()->get('name');
        $moduleFocus = CRMEntity::getInstance($moduleName);

        $listViewRecordModels = parent::getListViewEntries($pagingModel);
        foreach ($listViewRecordModels as $recordId => $m) {
            $recordModel = Inventory_Record_Model::getInstanceById($recordId);

            if($m->valueMap['postatus']){
                $m->valueMap['postatus'] = vtranslate($recordModel->get('postatus'), $moduleName);
            }

            $m->CHECKABLE = $moduleFocus->isCheckByStatus($recordModel);
            $m->DELEABLE = $moduleFocus->isDeleteByStatus($recordModel);
            $m->EDITABLE = $moduleFocus->isEditByStatus($recordModel);

            $_listViewRecordModels[$recordId] = $m;
        }
        $listViewRecordModels = $_listViewRecordModels;

        return $listViewRecordModels;
    }
}