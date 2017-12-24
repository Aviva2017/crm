<?php
/**
 * Created by PhpStorm.
 * User: jacobs
 * Date: 17-12-23
 * Time: 下午6:12
 */
include_once 'include/Webservices/Revise.php';
include_once 'include/Webservices/Retrieve.php';

class ReceivablesHandler extends VTEventHandler
{
    function handleEvent($eventName, $entityData) {
        $moduleName = $entityData->getModuleName();


        // Validate the event target
        if ($moduleName != 'Receivables') {
            return;
        }

        //Get Current User Information
        global $current_user, $currentModule;
        if ($eventName == 'vtiger.entity.aftersave') {
//            if ($currentModule != 'Receivables')
//                return;
//
//            $receivablestype = $entityData->get('receivablestype');
//            if($receivablestype == 'Purchase payment' || $receivablestype == 'Purchase refund'){
//
//            }

        }
    }
}