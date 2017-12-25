<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Accounts_RelationListView_Model extends Vtiger_RelationListView_Model {

	public function getHeaders() {
		$headerFields = parent::getHeaders();
		if($this->getRelationModel()->getRelationModuleModel()->getName() == 'SalesOrder') {
			//Added to support Unit Price
            $headerFields = array();

            $field = new Vtiger_Field_Model();
            $field->set('name', 'salesorder_no');
            $field->set('column', 'salesorder_no');
            $field->set('label', 'SalesOrder No');
            $headerFields['salesorder_no'] = $field;

            $field = new Vtiger_Field_Model();
            $field->set('name', 'subject');
            $field->set('column', 'subject');
            $field->set('label', 'Subject');
            $headerFields['subject'] = $field;

            $field = new Vtiger_Field_Model();
            $field->set('name', 'hdnGrandTotal');
            $field->set('column', 'total');
            $field->set('label', 'Total');
            $headerFields['total'] = $field;

            $field = new Vtiger_Field_Model();
            $field->set('name', 'cf_782');
            $field->set('column', 'cf_782');
            $field->set('label', 'SalesOrder Type');
            $headerFields['cf_782'] = $field;

            $field = new Vtiger_Field_Model();
            $field->set('name', 'cf_784');
            $field->set('column', 'cf_784');
            $field->set('label', 'Warehouse');
            $headerFields['cf_784'] = $field;

            $field = new Vtiger_Field_Model();
            $field->set('name', 'sostatus');
            $field->set('column', 'sostatus');
            $field->set('label', 'Status');
            $headerFields['sostatus'] = $field;

            $field = new Vtiger_Field_Model();
            $field->set('name', 'createdtime');
            $field->set('column', 'createdtime');
            $field->set('label', 'Created Time');
            $headerFields['createdtime'] = $field;
		}
		
		return $headerFields;
	}
	
}
