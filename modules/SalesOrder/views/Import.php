<?php
/**
 * Created by Jacobs.
 * Auth: jacobs@anviz.com
 * Copyright: Anviz Global Inc.
 * Date: 2017/12/25
 * Time: 12:41
 * FileName: Import.php
 */

class SalesOrder_Import_View extends Vtiger_Import_View
{
    public function getHeaderScripts(Vtiger_Request $request)
    {
        parent::getHeaderScripts($request);
        $headerScriptInstances = parent::getHeaderScripts($request);

        $moduleName = $request->getModule();
        $modulePopUpFile = 'modules.' . $moduleName . '.resources.Import';
        unset($headerScriptInstances[$modulePopUpFile]);

        $jsFileNames = array(
            'modules.Products.resources.Import',
        );
        $jsFileNames[] = $modulePopUpFile;

        $jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
        $headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
        return $headerScriptInstances;
    }

    function importBasicStep(Vtiger_Request $request)
    {
        $from = $request->get('from');
        if (!empty($from)) {
            $viewer = $this->getViewer($request);
            $moduleName = $request->getModule();

            $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
            $moduleMeta = $moduleModel->getModuleMeta();

            $viewer->assign('FOR_MODULE', $moduleName);
            $viewer->assign('MODULE', 'Import');
            $viewer->assign('SUPPORTED_FILE_TYPES', Import_Utils_Helper::getSupportedFileExtensions());
            $viewer->assign('SUPPORTED_FILE_ENCODING', Import_Utils_Helper::getSupportedFileEncoding());
            $viewer->assign('SUPPORTED_DELIMITERS', Import_Utils_Helper::getSupportedDelimiters());
            $viewer->assign('AUTO_MERGE_TYPES', Import_Utils_Helper::getAutoMergeTypes());

            //Duplicate records handling not supported for inventory moduels
            $duplicateHandlingNotSupportedModules = getInventoryModules();
            if (in_array($moduleName, $duplicateHandlingNotSupportedModules)) {
                $viewer->assign('DUPLICATE_HANDLING_NOT_SUPPORTED', true);
            }
            //End

            $viewer->assign('AVAILABLE_FIELDS', $moduleMeta->getMergableFields());
            $viewer->assign('ENTITY_FIELDS', $moduleMeta->getEntityFields());
            $viewer->assign('ERROR_MESSAGE', $request->get('error_message'));
            $viewer->assign('IMPORT_UPLOAD_SIZE', '3145728');
            return $viewer->view('Import_1.tpl', $moduleName);
        } else {
            parent::importBasicStep($request);
        }
    }

    function uploadAndParse(Vtiger_Request $request)
    {
        if (Import_Utils_Helper::validateFileUpload($request)) {
            $moduleName = $request->getModule();
            $user = Users_Record_Model::getCurrentUserModel();

            $fileReader = Import_Utils_Helper::getFileReader($request, $user);
            if ($fileReader == null) {
                $request->set('error_message', vtranslate('LBL_INVALID_FILE', 'Import'));
                $this->importBasicStep($request);
                exit;
            }
            $viewer = $this->getViewer($request);

            $autoMerge = $request->get('auto_merge');
            if (!$autoMerge) {
                $request->set('merge_type', 0);
                $request->set('merge_fields', '');
            } else {
                $viewer->assign('MERGE_FIELDS', Zend_Json::encode($request->get('merge_fields')));
            }

            $moduleName = $request->getModule();
            $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
            $moduleMeta = $moduleModel->getModuleMeta();

            $data = $fileReader->read();
            foreach ($data as $row) {

            }

            $importInfo = array(
                'module' => $moduleName,
                'user_id' => $user->getId(),
                'merge_type' => 'Merge',
            );
            $this->showResult($importInfo, array(
                'IMPORTED' => 35,
                'CREATED' => 10,
                'SKIPPED' => 25,
                'FAILED' => 0,
                'TOTAL' => 70,
            ));

        } else {
            $this->importBasicStep($request);
        }
    }

    public function showResult($importInfo, $importStatusCount) {
        $moduleName = $importInfo['module'];
        $ownerId = $importInfo['user_id'];

        $viewer = new Vtiger_Viewer();
        $viewer->assign('FOR_MODULE', $moduleName);
        $viewer->assign('MODULE', 'Import');
        $viewer->assign('OWNER_ID', $ownerId);
        $viewer->assign('IMPORT_RESULT', $importStatusCount);
        $viewer->assign('INVENTORY_MODULES', getInventoryModules());
        $viewer->assign('MERGE_ENABLED', $importInfo['merge_type']);

        $viewer->view('ImportResult.tpl', $moduleName);
    }
}