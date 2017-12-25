<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

/**
 * Inventory Record Model Class
 */
class SalesOrder_Record_Model extends Inventory_Record_Model
{

    function getCreateInvoiceUrl()
    {
        $invoiceModuleModel = Vtiger_Module_Model::getInstance('Invoice');

        return "index.php?module=" . $invoiceModuleModel->getName() . "&view=" . $invoiceModuleModel->getEditViewName() . "&salesorder_id=" . $this->getId();
    }

    function getCreatePurchaseOrderUrl()
    {
        $purchaseOrderModuleModel = Vtiger_Module_Model::getInstance('PurchaseOrder');
        return "index.php?module=" . $purchaseOrderModuleModel->getName() . "&view=" . $purchaseOrderModuleModel->getEditViewName() . "&salesorder_id=" . $this->getId();
    }

    function updateStockToProducts($recordId = '')
    {
        if (!empty($recordId)) {
            $recordModel = Inventory_Record_Model::getInstanceById($recordId);
            $type = $recordModel->get('cf_782');
            $warehouse = $recordModel->get('cf_784');
            $productlist = $recordModel->getProducts();
        } else {
            $type = $this->get('cf_782');
            $warehouse = $this->get('cf_784');
            $productlist = $this->getProducts();
        }

        $db = PearDatabase::getInstance();

        foreach ($productlist as $i => $product) {
            $qty = $product['qty' . $i];
            $productId = $product['hdnProductId' . $i];

            if (empty($productId) || empty($qty))
                continue;

            $sql = 'SELECT pro.qtyinstock, procf.cf_753, procf.cf_755, procf.cf_757, procf.cf_751 FROM vtiger_products pro INNER JOIN vtiger_productcf procf ON procf.productid=pro.productid WHERE pro.productid=?';
            $result = $db->pquery($sql, array($productId));
            $stock0 = intval($db->query_result($result, 0, 'qtyinstock'));
            $stock1 = intval($db->query_result($result, 0, 'cf_753'));
            $stock2 = intval($db->query_result($result, 0, 'cf_755'));
            $stock3 = intval($db->query_result($result, 0, 'cf_757'));

            if ($type == 'Selling') {
                if($warehouse == 'Stock-0'){
                    $stock = $stock0 - $qty;
                    $db->pquery('UPDATE vtiger_products SET qtyinstock=? WHERE productid=?', array($stock, $productId));
                }else{
                    if ($warehouse == 'Stock-1') {
                        $stock = $stock1 - $qty;
                        $field = 'cf_753';
                    } elseif ($warehouse == 'Stock-2') {
                        $stock = $stock2 - $qty;
                        $field = 'cf_755';
                    } else {
                        $stock = $stock3 - $qty;
                        $field = 'cf_757';
                    }
                    $db->pquery('UPDATE vtiger_productcf SET ' . $field . '=? WHERE productid=?', array($stock, $productId));
                }
            } elseif ($type == 'Refund') {
                if($warehouse == 'Stock-0'){
                    $stock = $stock0 + $qty;
                    $db->pquery('UPDATE vtiger_products SET qtyinstock=? WHERE productid=?', array($stock, $productId));
                }else{
                    if ($warehouse == 'Stock-1') {
                        $stock = $stock1 + $qty;
                        $field = 'cf_753';
                    } elseif ($warehouse == 'Stock-2') {
                        $stock = $stock2 + $qty;
                        $field = 'cf_755';
                    } else {
                        $stock = $stock3 + $qty;
                        $field = 'cf_757';
                    }
                    $db->pquery('UPDATE vtiger_productcf SET ' . $field . '=? WHERE productid=?', array($stock, $productId));
                }
            }
        }
    }
}