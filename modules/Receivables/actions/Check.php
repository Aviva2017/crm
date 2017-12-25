<?php
/**
 * Created by Jacobs.
 * Auth: jacobs@anviz.com
 * Copyright: Anviz Global Inc.
 * Date: 2017/12/21
 * Time: 14:13
 * FileName: Check.php
 */

class Receivables_Check_Action extends Vtiger_Save_Action
{
    public function process(Vtiger_Request $request)
    {
        $moduleName = $request->getModule();
        $recordId = $request->get('record');
        if(empty($recordId)){
            throw new AppException('LBL_PERMISSION_DENIED');
        }

        $moduleFocus = CRMEntity::getInstance($moduleName);
        $recordModel = Vtiger_Record_Model::getInstanceById($recordId, $moduleName);
        if(!$moduleFocus->isCheckByStatus($recordModel)){
            throw new AppException('LBL_PERMISSION_DENIED');
        }

        $db = PearDatabase::getInstance();
        $query = 'UPDATE vtiger_receivablescf SET cf_780=? WHERE receivablesid=?';
        $db->pquery($query, array('Delivered', $recordId));

        $response = new Vtiger_Response();
        $response->setEmitType(Vtiger_Response::$EMIT_JSON);
        $response->setResult(array());
        $response->emit();
    }
}