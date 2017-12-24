<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Receivables_DetailView_Model extends Vtiger_DetailView_Model
{

    public function getDetailViewLinks($linkParams)
    {
        $linkModelList = parent::getDetailViewLinks($linkParams);
        $DETAILVIEWBASIC = $linkModelList['DETAILVIEWBASIC'];

        $moduleModel = $this->getModule();
        $recordModel = $this->getRecord();

        $moduleName = $moduleModel->getName();
        $recordId = $recordModel->getId();

        $detailViewLink = array();

        $moduleFocus = CRMEntity::getInstance($moduleName);
        if ($moduleFocus->isCheckByStatus($recordModel)) {
            $detailViewLinks[] = array(
                'linktype' => 'DETAILVIEWBASIC',
                'linklabel' => 'Check',
                'linkurl' => 'javascript:Receivables_Edit_Js.Check(' . $recordId . ');',
                'linkicon' => 'icon-ok-sign'
            );
        }

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
