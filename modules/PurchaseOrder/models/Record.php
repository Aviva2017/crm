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
 * PurchaseOrder Record Model Class
 */
class PurchaseOrder_Record_Model extends Inventory_Record_Model
{

    /**
     * This Function adds the specified product quantity to the Product Quantity in Stock
     * @param type $recordId
     */
    function updateStockToProducts($recordId = '')
    {
        if (!empty($recordId)) {
            $recordModel = Inventory_Record_Model::getInstanceById($recordId);
            $type = $recordModel->get('cf_765');
            $inStock = $recordModel->get('cf_767');
            $outStock = $recordModel->get('cf_763');
            $productlist = $recordModel->getProducts();
        } else {
            $type = $this->get('cf_765');
            $inStock = $this->get('cf_767');
            $outStock = $this->get('cf_763');
            $productlist = $this->getProducts();
        }

        $db = PearDatabase::getInstance();

        foreach ($productlist as $i => $product) {
            $qty = $product['qty' . $i];
            $productId = $product['hdnProductId' . $i];
            if (empty($productId) || empty($qty))
                continue;

            if ($type == 'In Stock') {
                if($inStock == 'Stock-0'){
                    $result = $db->pquery("SELECT qtyinstock FROM vtiger_products WHERE productid=?", array($productId));
                    $_qty = $db->query_result($result,0,"qtyinstock");
                    $_qty = empty($_qty)?0:intval($_qty);
                    $stock = $_qty + $qty;
                    $db->pquery("UPDATE vtiger_products SET qtyinstock=? WHERE productid=?", array($stock, $productId));
                }else{
                    if($inStock == 'Stock-1'){
                        $field = 'cf_753';
                    }elseif($inStock == 'Stock-2'){
                        $field = 'cf_755';
                    }else{
                        $field = 'cf_757';
                    }
                    $result = $db->pquery('SELECT '.$field.' FROM vtiger_productcf WHERE productid=?', array($productId));
                    $_qty = $db->query_result($result,0,$field);
                    $_qty = empty($_qty)?0:intval($_qty);
                    $stock = $_qty + $qty;
                    $db->pquery('UPDATE vtiger_productcf SET '.$field.'=? WHERE productid=?', array($stock, $productId));
                }
            } elseif ($type == 'Out Stock') {
                if($outStock == 'Stock-0'){
                    $result = $db->pquery("SELECT qtyinstock FROM vtiger_products WHERE productid=?", array($productId));
                    $_qty = $db->query_result($result,0,"qtyinstock");
                    $_qty = empty($_qty)?0:intval($_qty);
                    $stock = $_qty - $qty;
                    $db->pquery("UPDATE vtiger_products SET qtyinstock=? WHERE productid=?", array($stock, $productId));
                }else{
                    if($inStock == 'Stock-1'){
                        $field = 'cf_753';
                    }elseif($inStock == 'Stock-2'){
                        $field = 'cf_755';
                    }else{
                        $field = 'cf_757';
                    }
                    $result = $db->pquery('SELECT '.$field.' FROM vtiger_productcf WHERE productid=?', array($productId));
                    $_qty = $db->query_result($result,0,$field);
                    $_qty = empty($_qty)?0:intval($_qty);
                    $stock = $_qty - $qty;
                    $db->pquery('UPDATE vtiger_productcf SET '.$field.'=? WHERE productid=?', array($stock, $productId));
                }
            } elseif ($type == 'Adjust Stock') {
                if($inStock != $outStock){
                    if($inStock == 'Stock-0'){
                        $result = $db->pquery("SELECT qtyinstock FROM vtiger_products WHERE productid=?", array($productId));
                        $_qty = $db->query_result($result,0,"qtyinstock");
                        $_qty = empty($_qty)?0:intval($_qty);
                        $stock = $_qty + $qty;
                        $db->pquery("UPDATE vtiger_products SET qtyinstock=? WHERE productid=?", array($stock, $productId));
                    }else{
                        if($inStock == 'Stock-1'){
                            $field = 'cf_753';
                        }elseif($inStock == 'Stock-2'){
                            $field = 'cf_755';
                        }else{
                            $field = 'cf_757';
                        }
                        $result = $db->pquery('SELECT '.$field.' FROM vtiger_productcf WHERE productid=?', array($productId));
                        $_qty = $db->query_result($result,0,$field);
                        $_qty = empty($_qty)?0:intval($_qty);
                        $stock = $_qty + $qty;
                        $db->pquery('UPDATE vtiger_productcf SET '.$field.'=? WHERE productid=?', array($stock, $productId));
                    }
                    if($outStock == 'Stock-0'){
                        $result = $db->pquery("SELECT qtyinstock FROM vtiger_products WHERE productid=?", array($productId));
                        $_qty = $db->query_result($result,0,"qtyinstock");
                        $_qty = empty($_qty)?0:intval($_qty);
                        $stock = $_qty - $qty;
                        $db->pquery("UPDATE vtiger_products SET qtyinstock=? WHERE productid=?", array($stock, $productId));
                    }else{
                        if($inStock == 'Stock-1'){
                            $field = 'cf_753';
                        }elseif($inStock == 'Stock-2'){
                            $field = 'cf_755';
                        }else{
                            $field = 'cf_757';
                        }
                        $result = $db->pquery('SELECT '.$field.' FROM vtiger_productcf WHERE productid=?', array($productId));
                        $_qty = $db->query_result($result,0,$field);
                        $_qty = empty($_qty)?0:intval($_qty);
                        $stock = $_qty - $qty;
                        $db->pquery('UPDATE vtiger_productcf SET '.$field.'=? WHERE productid=?', array($stock, $productId));
                    }
                }
            }
        }
//		$db = PearDatabase::getInstance();
//
//		$recordModel = Inventory_Record_Model::getInstanceById($recordId);
//		$relatedProducts = $recordModel->getProducts();
//
//		foreach ($relatedProducts as $key => $relatedProduct) {
//			if($relatedProduct['qty'.$key]){
//				$productId = $relatedProduct['hdnProductId'.$key];
//				$result = $db->pquery("SELECT qtyinstock FROM vtiger_products WHERE productid=?", array($productId));
//				$qty = $db->query_result($result,0,"qtyinstock");
//				$stock = $qty + $relatedProduct['qty'.$key];
//				$db->pquery("UPDATE vtiger_products SET qtyinstock=? WHERE productid=?", array($stock, $productId));
//			}
//		}
    }

    /**
     * This Function returns the current status of the specified Purchase Order.
     * @param type $purchaseOrderId
     * @return <String> PurchaseOrderStatus
     */
    function getPurchaseOrderStatus($purchaseOrderId)
    {
        $db = PearDatabase::getInstance();
        $sql = "SELECT postatus FROM vtiger_purchaseorder WHERE purchaseorderid=?";
        $result = $db->pquery($sql, array($purchaseOrderId));
        $purchaseOrderStatus = $db->query_result($result, 0, "postatus");
        return $purchaseOrderStatus;
    }
}