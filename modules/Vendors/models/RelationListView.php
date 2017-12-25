<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Vendors_RelationListView_Model extends Vtiger_RelationListView_Model {

	public function getHeaders() {
		$headerFields = parent::getHeaders();
		if($this->getRelationModel()->getRelationModuleModel()->getName() == 'Products') {
			//Added to support Unit Price
			$unitPriceField = new Vtiger_Field_Model();
			$unitPriceField->set('name', 'unit_price');
			$unitPriceField->set('column', 'unit_price');
			$unitPriceField->set('label', 'Unit Price');

			$headerFields['unit_price'] = $unitPriceField;

			//Added to support List Price
			$field = new Vtiger_Field_Model();
			$field->set('name', 'listprice');
			$field->set('column', 'listprice');
			$field->set('label', 'List Price');

			$headerFields['listprice'] = $field;
		}
		
		return $headerFields;
	}
	
}
