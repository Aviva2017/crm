<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class SalesOrder_DetailView_Model extends Inventory_DetailView_Model
{

    /**
     * Function to get the detail view links (links and widgets)
     * @param <array> $linkParams - parameters which will be used to calicaulate the params
     * @return <array> - array of link models in the format as below
     *                   array('linktype'=>list of link models);
     */
    public function getDetailViewLinks($linkParams)
    {
//        $currentUserModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();

        $linkModelList = parent::getDetailViewLinks($linkParams);
        $moduleModel = $this->getModule();
        $recordModel = $this->getRecord();

        $moduleName = $moduleModel->getName();
        $recordId = $recordModel->getId();

        $detailViewLinks = array();

        $moduleFocus = CRMEntity::getInstance($moduleName);
        if ($moduleFocus->isCheckByStatus($recordModel)) {
            $detailViewLinks[] = array(
                'linktype' => 'DETAILVIEWBASIC',
                'linklabel' => 'Check',
                'linkurl' => 'javascript:SalesOrder_Edit_Js.Check(' . $recordId . ');',
                'linkicon' => 'icon-ok-sign'
            );
        }

//        $invoiceModuleModel = Vtiger_Module_Model::getInstance('Invoice');
//        if ($currentUserModel->hasModuleActionPermission($invoiceModuleModel->getId(), 'EditView')) {
//            $detailViewLinks[] = array(
//                'linktype' => 'DETAILVIEW',
//                'linklabel' => vtranslate('LBL_CREATE') . ' ' . vtranslate($invoiceModuleModel->getSingularLabelKey(), 'Invoice'),
//                'linkurl' => $recordModel->getCreateInvoiceUrl(),
//                'linkicon' => ''
//            );
//        }

//        $purchaseOrderModuleModel = Vtiger_Module_Model::getInstance('PurchaseOrder');
//        if ($currentUserModel->hasModuleActionPermission($purchaseOrderModuleModel->getId(), 'EditView')) {
//            $detailViewLinks[] = array(
//                'linktype' => 'DETAILVIEW',
//                'linklabel' => vtranslate('LBL_CREATE') . ' ' . vtranslate($purchaseOrderModuleModel->getSingularLabelKey(), 'PurchaseOrder'),
//                'linkurl' => $recordModel->getCreatePurchaseOrderUrl(),
//                'linkicon' => ''
//            );
//        }

        if (!empty($detailViewLinks)) {
            foreach ($detailViewLinks as $detailViewLink) {
                $_DETAILVIEWBASIC[] = Vtiger_Link_Model::getInstanceFromValues($detailViewLink);
            }
            if (!empty($DETAILVIEWBASIC))
                $DETAILVIEWBASIC = array_merge($_DETAILVIEWBASIC, $DETAILVIEWBASIC);
            else
                $DETAILVIEWBASIC = $_DETAILVIEWBASIC;
            $linkModelList['DETAILVIEWBASIC'] = $DETAILVIEWBASIC;
        }

        return $linkModelList;
    }

}
